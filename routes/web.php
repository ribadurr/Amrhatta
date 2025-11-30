<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

// ===== PUBLIC ROUTES =====
Route::get('/', [PublicController::class, 'index'])->name('public.home');
Route::get('/events', [PublicController::class, 'events'])->name('public.events');
Route::get('/about', [PublicController::class, 'about'])->name('public.about');
Route::get('/members', [PublicController::class, 'members'])->name('public.members');
Route::get('/anggota', [PublicController::class, 'members'])->name('public.members');

// ===== AUTH & PROFILE ROUTES =====
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== ADMIN ROUTES =====
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Event CRUD
    Route::resource('events', EventController::class);
    
    // Achievement CRUD
    Route::resource('achievements', AchievementController::class);
    
    // Coach CRUD
    Route::resource('coaches', CoachController::class);
    
    // Member CRUD
    Route::resource('member', MemberController::class);
    
    // Agenda routes (yang sudah ada)
    Route::get('/agenda', [AdminController::class, 'agendaIndex'])->name('agenda.index');
    Route::get('/agenda/create', [AdminController::class, 'agendaCreate'])->name('agenda.create');
    Route::post('/agenda', [AdminController::class, 'agendaStore'])->name('agenda.store');
    Route::get('/agenda/{agenda}/edit', [AdminController::class, 'agendaEdit'])->name('agenda.edit');
    Route::put('/agenda/{agenda}', [AdminController::class, 'agendaUpdate'])->name('agenda.update');
    Route::delete('/agenda/{agenda}', [AdminController::class, 'agendaDestroy'])->name('agenda.destroy');
});

require __DIR__.'/auth.php';