<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * Display list of members
     */
    public function index(): View
    {
        $members = Member::orderBy('full_name', 'asc')->paginate(15);
        return view('admin.member.index', compact('members'));
    }

    /**
     * Show create member form
     */
    public function create(): View
    {
        return view('admin.member.create');
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
        return view('admin.member.edit', compact('member'));
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
