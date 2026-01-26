<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReporteController;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\PndController;
use App\Http\Controllers\OdsController;

use App\Http\Controllers\AlineacionController;

Route::get('reportes/{reporte}/download', [ReporteController::class, 'download'])
    ->name('reportes.download');

Route::resource('reportes', ReporteController::class);

/* ───── LOGIN ───── */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

/* ───── ZONA AUTH ───── */
Route::middleware(['auth'])->group(function () {

    /* INICIO */
    Route::get('/', [InicioController::class, 'index'])->name('inicio');

    /* PERFIL */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* MÓDULOS PRINCIPALES (permisos en controllers) */
    Route::resource('instituciones', InstitucionController::class)
        ->parameters(['instituciones' => 'institucion']);

    Route::resource('proyectos', ProyectoController::class);

    Route::resource('programas', ProgramaController::class);

    Route::resource('planes', PlanController::class)
        ->parameters(['planes' => 'plan']);

    Route::resource('reportes', ReporteController::class);

    /* ADMIN */
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('pnds', PndController::class);
        Route::resource('ods', OdsController::class);
        Route::resource('objetivos', ObjetivoController::class);
    });

    /* ALINEACIÓN */
    Route::get('proyectos/{proyecto}/alinear', [AlineacionController::class, 'edit'])
        ->name('alinear.edit')
        ->middleware('permission:alinear.view');

    Route::put('proyectos/{proyecto}/alinear', [AlineacionController::class, 'update'])
        ->name('alinear.update')
        ->middleware('permission:alinear.update');
});

/* EXTRA AUTH */
require __DIR__ . '/auth.php';
