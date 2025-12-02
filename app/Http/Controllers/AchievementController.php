<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Member;
use App\Models\Event;
use Illuminate\Support\Str;
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
        $members = Member::orderBy('full_name')->get();
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.achievements.create', compact('members', 'events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required',
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'nullable|string',
            'members' => 'nullable|array',
            'members.*' => 'exists:members,id',
            'event_id' => 'nullable|exists:events,id',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('achievements', 'public');
            $validated['image'] = $path;
        }

        // Remove members from validated data since it's not a direct column
        $members = $validated['members'] ?? [];
        unset($validated['members']);

        $achievement = Achievement::create($validated);
        
        // Attach members to the achievement
        if (!empty($members)) {
            $achievement->members()->attach($members);
        }

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function show(Achievement $achievement)
    {
        return view('admin.achievements.show', compact('achievement'));
    }

    public function edit(Achievement $achievement)
    {
        $members = Member::orderBy('full_name')->get();
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.achievements.edit', compact('achievement', 'members', 'events'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'year' => 'required',
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'nullable|string',
            'members' => 'nullable|array',
            'members.*' => 'exists:members,id',
            'event_id' => 'nullable|exists:events,id',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('achievements', 'public');
            $validated['image'] = $path;
        }

        // Remove members from validated data since it's not a direct column
        $members = $validated['members'] ?? [];
        unset($validated['members']);

        $achievement->update($validated);
        
        // Sync members to the achievement (replaces old members)
        $achievement->members()->sync($members);

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