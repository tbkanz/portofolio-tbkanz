<?php

use App\Http\Controllers\Admin\AdminSkillController;
use App\Http\Controllers\Admin\AdminCertificateController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman Contact (Dapat diakses oleh semua pengguna, tanpa autentikasi)
Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [AdminContactController::class, 'store'])->name('contacts.store');


// Halaman utama diarahkan ke PortofolioController
Route::get('/', [PortofolioController::class, 'index'])->name('home');

// Rute untuk dashboard admin dan halaman utama
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', [PortofolioController::class, 'index'])->name('admin.portofolio.index');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Rute resource untuk skill, certificate, about, project, dan contact
    Route::resource('/skills', AdminSkillController::class);
    Route::resource('/certificates', AdminCertificateController::class);
    Route::resource('/abouts', AdminAboutController::class);
    Route::resource('/projects', AdminProjectController::class);
    Route::resource('/contacts', AdminContactController::class);

    // Rute tambahan untuk skill
    Route::get('/skills/{id}/show', [AdminSkillController::class, 'show'])->name('skills.show');
    Route::get('/skills/{id}/certificate', [AdminSkillController::class, 'certificate'])->name('skills.certificate');
});

// Rute untuk profil pengguna
Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
