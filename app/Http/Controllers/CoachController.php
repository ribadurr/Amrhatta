<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::latest()->paginate(10);
        return view('admin.coaches.index', compact('coaches'));
    }

    public function create()
    {
        return view('admin.coaches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'position' => 'nullable|max:255',
            'experience_years' => 'nullable|integer',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('coaches', 'public');
            $validated['photo'] = $path;
        }

        // keep backward-compatible 'experience' field if present
        if ($request->filled('experience_years')) {
            $validated['experience'] = $request->input('experience_years');
        }

        Coach::create($validated);

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Pembina berhasil ditambahkan!');
    }

    public function show(Coach $coach)
    {
        return view('admin.coaches.show', compact('coach'));
    }

    public function edit(Coach $coach)
    {
        return view('admin.coaches.edit', compact('coach'));
    }

    public function update(Request $request, Coach $coach)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'position' => 'nullable|max:255',
            'experience_years' => 'nullable|integer',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('coaches', 'public');
            $validated['photo'] = $path;
        }

        if ($request->filled('experience_years')) {
            $validated['experience'] = $request->input('experience_years');
        }

        $coach->update($validated);

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Pembina berhasil diupdate!');
    }

    public function destroy(Coach $coach)
    {
        $coach->delete();

        return redirect()->route('admin.coaches.index')
            ->with('success', 'Pembina berhasil dihapus!');
    }
}