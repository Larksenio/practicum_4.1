<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\AuthenticatedSessionController,
    InstitucionController,
    ProyectoController,
    ReporteController,
    ProfileController,
    UsuarioController,
    ObjetivoController, PndController, OdsController
};
Route::resource('instituciones', InstitucionController::class)
     ->whereNumber('institucion');

/* ───── 1) LOGIN / LOGOUT ───── */
Route::middleware('guest')->group(function () {
    Route::get ('/login',  [AuthenticatedSessionController::class,'create'])->name('login');
    Route::post('/login',  [AuthenticatedSessionController::class,'store']);
});

/* ───── 2) PÁGINA INICIO (protegida) ───── */
Route::view('/', 'inicio')
     ->middleware(['auth','role:user|admin'])
     ->name('inicio');

/* ───── 3) ADMIN (usuarios, pnd, ods, objetivos) ───── */
Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('usuarios',   UsuarioController::class);
    Route::resource('pnds',       PndController::class);
    Route::resource('ods',        OdsController::class);
    Route::resource('objetivos',  ObjetivoController::class);
    Route::resource('programas', App\Http\Controllers\ProgramaController::class);
      Route::resource('planes', App\Http\Controllers\PlanController::class);

       Route::get  ('proyectos/{proyecto}/alinear',  [App\Http\Controllers\AlineacionController::class,'edit'])
         ->name('alinear.edit')
         ->middleware('permission:alinear.view');

    Route::put  ('proyectos/{proyecto}/alinear',  [App\Http\Controllers\AlineacionController::class,'update'])
         ->name('alinear.update')
         ->middleware('permission:alinear.update');

});

/* ───── 4) INSTITUCIONES ───── */

/* 4-a  rutas públicas */
Route::get('/instituciones', [InstitucionController::class,'index'])
        ->name('instituciones.index');

/* 4-b  rutas protegidas (crear, editar, eliminar) */
Route::middleware(['auth','role:user|admin'])->group(function () {
    Route::get   ('/instituciones/create',          [InstitucionController::class,'create'])->name('instituciones.create');
    Route::post  ('/instituciones',                 [InstitucionController::class,'store' ])->name('instituciones.store');
    Route::get   ('/instituciones/{institucion}/edit',[InstitucionController::class,'edit' ])->name('instituciones.edit');
    Route::put   ('/instituciones/{institucion}',   [InstitucionController::class,'update'])->name('instituciones.update');
    Route::delete('/instituciones/{institucion}',   [InstitucionController::class,'destroy'])->name('instituciones.destroy');

    /* proyectos y reportes */
    Route::resource('proyectos', ProyectoController::class);
    Route::resource('reportes',  ReporteController::class);

    /* perfil */
    Route::get   ('/profile', [ProfileController::class,'edit'   ])->name('profile.edit');
    Route::patch ('/profile', [ProfileController::class,'update' ])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');
});

/* 4-c  show (después de create y restringido a números) */
Route::get('/instituciones/{institucion}', [InstitucionController::class,'show'])
        ->whereNumber('institucion')
        ->name('instituciones.show');

/* ───── 5) EXTRA AUTH (reset-password, etc.) ───── */
require __DIR__.'/auth.php';
