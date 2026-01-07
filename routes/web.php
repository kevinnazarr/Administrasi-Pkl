<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    SiswaController,
    LoginController,
    JurusanController,
    PembimbingController,
    OnlyOfficeController,
    SuratController,
    DudiController
};

Route::redirect('/', '/dashboard');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/siswa/create', [SiswaController::class, 'create'])
        ->name('siswa.create');

    Route::post('/siswa', [SiswaController::class, 'store'])
        ->name('siswa.store');
});

Route::middleware(['auth', 'role:super_admin,admin_jurusan'])->group(function () {

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    Route::get('/pembimbing', [PembimbingController::class, 'index'])->name('pembimbing.index');
    Route::get('/pembimbing/create', [PembimbingController::class, 'create'])->name('pembimbing.create');
    Route::post('/pembimbing', [PembimbingController::class, 'store'])->name('pembimbing.store');
    Route::get('/pembimbing/{pembimbing}', [PembimbingController::class, 'show'])->name('pembimbing.show');
    Route::get('/pembimbing/{pembimbing}/edit', [PembimbingController::class, 'edit'])->name('pembimbing.edit');
    Route::put('/pembimbing/{pembimbing}', [PembimbingController::class, 'update'])->name('pembimbing.update');
    Route::delete('/pembimbing/{pembimbing}', [PembimbingController::class, 'destroy'])->name('pembimbing.destroy');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
});

Route::middleware(['auth', 'role:super_admin,admin_jurusan'])->group(function () {
    Route::get('/jurusan/{jurusan}', [JurusanController::class, 'show'])->name('jurusan.show');
    Route::get('/jurusan/{jurusan}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{jurusan}', [JurusanController::class, 'update'])->name('jurusan.update');
});


Route::middleware(['auth', 'role:super_admin,admin_jurusan'])->group(function () {
    Route::resource('dudi', DudiController::class);
});

Route::prefix('surat')->group(function () {
    Route::get('/', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/penjajakan', [SuratController::class, 'penjajakan'])->name('surat.penjajakan');
    Route::post('/penjajakan/preview', [SuratController::class, 'penjajakanPreview'])->name('surat.penjajakan.preview');
    Route::get('/penjajakan/preview-page', [SuratController::class, 'previewPage'])->name('surat.penjajakan.preview.page');

    Route::get('/penjajakan/preview-file', [SuratController::class, 'previewFile'])
        ->name('surat.penjajakan.preview.file');

    Route::get('/penjajakan/download', [SuratController::class, 'download'])
        ->name('surat.penjajakan.download');
});

Route::get('/surat/file/{name}', function ($name) {
    $path = storage_path("app/tmp/{$name}");
    abort_unless(file_exists($path), 404);
    return response()->file($path);
});

