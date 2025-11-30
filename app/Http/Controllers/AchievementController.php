<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->paginate(10);
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required',
            'title' => 'required|max:255',
            'category' => 'required'
        ]);

        Achievement::create($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function show(Achievement $achievement)
    {
        return view('admin.achievements.show', compact('achievement'));
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'year' => 'required',
            'title' => 'required|max:255',
            'category' => 'required'
        ]);

        $achievement->update($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil diupdate!');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil dihapus!');
    }
}