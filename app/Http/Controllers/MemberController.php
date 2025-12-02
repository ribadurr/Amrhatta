<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Shuchkin\SimpleXLSX;
// Excel facade removed — using native CSV read/write

class MemberController extends Controller
{
    /**
     * Display list of members
     */
    public function index(): View
    {
        $members = Member::with('coach')->orderBy('full_name', 'asc')->paginate(15)->withQueryString();
        return view('admin.member.index', compact('members'));
    }

    /**
     * Export members to Excel
     */
    public function export()
    {
        $members = Member::orderBy('full_name')->get(['full_name','nisn','grade_class','position','join_date','coach_id']);

            $fileName = 'members_' . date('Ymd_His') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            ];

            $callback = function() use ($members) {
                $out = fopen('php://output', 'w');
                fputcsv($out, ['full_name','nisn','grade_class','position','join_date','coach_id']);
                foreach ($members as $m) {
                    fputcsv($out, [
                        $m->full_name,
                        $m->nisn,
                        $m->grade_class,
                        $m->position,
                        $m->join_date ? $m->join_date->format('Y-m-d') : '',
                        $m->coach_id,
                    ]);
                }
                fclose($out);
            };

            return response()->stream($callback, 200, $headers);
    }

    /**
     * Import members from uploaded Excel
     */
    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        $uploaded = $request->file('file');
        $ext = strtolower($uploaded->getClientOriginalExtension());
        $path = $uploaded->getRealPath();

        $rows = [];

        if (in_array($ext, ['csv'])) {
            if (($handle = fopen($path, 'r')) !== false) {
                while (($row = fgetcsv($handle, 10000, ',')) !== false) {
                    $rows[] = $row;
                }
                fclose($handle);
            }
        } elseif (in_array($ext, ['xlsx'])) {
            // parse XLSX with SimpleXLSX
            if ($xlsx = SimpleXLSX::parse($path)) {
                $rows = $xlsx->rows();
            } else {
                return redirect()->route('admin.member.index')->with('error', 'Gagal membaca file Excel. Pastikan file .xlsx valid.');
            }
        } else {
            return redirect()->route('admin.member.index')->with('error', 'Format file tidak didukung. Gunakan CSV atau XLSX.');
        }

        if (!empty($rows)) {
            $header = null;
            foreach ($rows as $row) {
                if (!$header) {
                    $header = array_map('trim', $row);
                    if (!empty($header[0])) {
                        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
                    }
                    continue;
                }

                // skip empty rows
                $allEmpty = true;
                foreach ($row as $cell) {
                    if (trim((string) $cell) !== '') {
                        $allEmpty = false;
                        break;
                    }
                }
                if ($allEmpty) {
                    continue;
                }

                // normalize counts
                $headerCount = count($header);
                $rowCount = count($row);
                if ($rowCount < $headerCount) {
                    $row = array_pad($row, $headerCount, null);
                } elseif ($rowCount > $headerCount) {
                    $row = array_slice($row, 0, $headerCount);
                }

                $dataRow = array_combine($header, $row);

                // Normalize coach_id: accept numeric id, or lookup by nip or name. Empty => null.
                $rawCoach = $dataRow['coach_id'] ?? null;
                $coach_id = null;
                if ($rawCoach !== null && trim((string) $rawCoach) !== '') {
                    if (is_numeric($rawCoach)) {
                        $candidate = (int) $rawCoach;
                        if (Coach::where('id', $candidate)->exists()) {
                            $coach_id = $candidate;
                        }
                    } else {
                        $found = Coach::where('nip', $rawCoach)->orWhere('name', $rawCoach)->first();
                        if ($found) {
                            $coach_id = $found->id;
                        }
                    }
                }

                $data = [
                    'full_name' => $dataRow['full_name'] ?? ($dataRow['name'] ?? null),
                    'nisn' => $dataRow['nisn'] ?? null,
                    'grade_class' => $dataRow['grade_class'] ?? null,
                    'position' => $dataRow['position'] ?? 'Anggota',
                    'join_date' => !empty($dataRow['join_date']) ? $dataRow['join_date'] : null,
                    'coach_id' => $coach_id,
                ];

                if (!empty($data['nisn'])) {
                    Member::updateOrCreate(['nisn' => $data['nisn']], $data);
                }
            }
        }

        return redirect()->route('admin.member.index')->with('success', 'Import anggota selesai.');
    }

    /**
     * Show create member form
     */
    public function create(): View
    {
        $coaches = \App\Models\Coach::orderBy('name')->get();
        return view('admin.member.create', compact('coaches'));
    }

    /**
     * Store new member
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nisn' => 'required|string|unique:members,nisn|max:20',
            'grade_class' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'join_date' => 'nullable|date',
            'coach_id' => 'nullable|exists:coaches,id',
        ], [
            'full_name.required' => 'Nama lengkap harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'grade_class.required' => 'Kelas harus diisi',
            'position.required' => 'Jabatan harus diisi',
        ]);

        Member::create($validated);

        return redirect()->route('admin.member.index')
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    /**
     * Show edit member form
     */
    public function edit(Member $member): View
    {
        $coaches = \App\Models\Coach::orderBy('name')->get();
        return view('admin.member.edit', compact('member', 'coaches'));
    }

    /**
     * Update member
     */
    public function update(Request $request, Member $member): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:members,nisn,' . $member->id,
            'grade_class' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'join_date' => 'nullable|date',
            'coach_id' => 'nullable|exists:coaches,id',
        ], [
            'full_name.required' => 'Nama lengkap harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'grade_class.required' => 'Kelas harus diisi',
            'position.required' => 'Jabatan harus diisi',
        ]);

        $member->update($validated);

        return redirect()->route('admin.member.index')
            ->with('success', 'Anggota berhasil diperbarui');
    }

    /**
     * Delete member
     */
    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()->route('admin.member.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
}
