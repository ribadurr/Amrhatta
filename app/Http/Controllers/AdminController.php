<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Constructor to apply auth middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ===== AGENDA METHODS =====

    /**
     * Display list of agendas
     */
    public function agendaIndex(): View
    {
        $agendas = Agenda::orderBy('date', 'desc')->paginate(10);
        return view('admin.agenda.index', compact('agendas'));
    }

    /**
     * Show create agenda form
     */
    public function agendaCreate(): View
    {
        return view('admin.agenda.create');
    }

    /**
     * Store new agenda
     */
    public function agendaStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string|min:10',
        ], [
            'title.required' => 'Judul agenda harus diisi',
            'date.required' => 'Tanggal agenda harus diisi',
            'date.after_or_equal' => 'Tanggal harus sama atau lebih besar dari hari ini',
            'description.required' => 'Deskripsi harus diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
        ]);

        Agenda::create($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan');
    }

    /**
     * Show edit agenda form
     */
    public function agendaEdit(Agenda $agenda): View
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update agenda
     */
    public function agendaUpdate(Request $request, Agenda $agenda): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string|min:10',
        ], [
            'title.required' => 'Judul agenda harus diisi',
            'date.required' => 'Tanggal agenda harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
        ]);

        $agenda->update($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui');
    }

    /**
     * Delete agenda
     */
    public function agendaDestroy(Agenda $agenda): RedirectResponse
    {
        $agenda->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus');
    }

    // ===== MEMBER METHODS =====

    /**
     * Display list of members
     */
    public function memberIndex(): View
    {
        $members = Member::orderBy('full_name', 'asc')->paginate(15);
        return view('admin.member.index', compact('members'));
    }

    /**
     * Show create member form
     */
    public function memberCreate(): View
    {
        return view('admin.member.create');
    }

    /**
     * Store new member
     */
    public function memberStore(Request $request): RedirectResponse
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
    public function memberEdit(Member $member): View
    {
        return view('admin.member.edit', compact('member'));
    }

    /**
     * Update member
     */
    public function memberUpdate(Request $request, Member $member): RedirectResponse
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
    public function memberDestroy(Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()->route('admin.member.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
}
