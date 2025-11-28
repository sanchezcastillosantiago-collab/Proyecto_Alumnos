<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\SeccionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'must.change'])
    ->name('dashboard');
    /////////////////////////////////////////////////////
    
Route::resource('alumnos', AlumnoController::class);

// Secciones
Route::resource('secciones', SeccionController::class)->only(['show'])->middleware(['auth','must.change']);
Route::post('secciones/{seccion}/alumnos', [SeccionController::class, 'attachAlumnos'])->name('secciones.attach.alumnos')->middleware(['auth','must.change','admin.or404']);

// CRUD de Tareas
// index/show son públicos; create/store/edit/update/destroy requieren auth
Route::resource('tareas', TareaController::class);







    /////////////////////////////////////////////////////

Route::middleware(['auth', 'must.change'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';

// Change password routes (used when must_change_password is true)
Route::get('password/change', [App\Http\Controllers\PasswordChangeController::class, 'show'])
    ->name('password.change')
    ->middleware('auth');

Route::post('password/change', [App\Http\Controllers\PasswordChangeController::class, 'update'])
    ->name('password.change.post')
    ->middleware('auth');
