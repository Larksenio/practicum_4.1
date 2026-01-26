<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\Proyecto;
use App\Models\User;

// NUEVOS MODELOS:
use App\Models\Programa;
use App\Models\Plan;
use App\Models\Objetivo;
use App\Models\Pnd;
use App\Models\Ods;

class InicioController extends Controller
{
    public function index()
    {
        $kpiInstituciones = Institucion::count();
        $kpiProyectos     = Proyecto::count();
        $kpiUsuarios      = User::count();

        // NUEVOS KPIs
        $kpiProgramas = Programa::count();
        $kpiPlanes    = Plan::count();
        $kpiObjetivos = Objetivo::count();
        $kpiPnd       = Pnd::count();
        $kpiOds       = Ods::count();

        $estadoGeneral = ($kpiInstituciones > 0) ? 'Óptimo' : 'En progreso';

        $avance = [
            'revision'    => 65,
            'aprobadas'   => 48,
            'finalizadas' => 32,
        ];

        return view('inicio', compact(
            'kpiInstituciones',
            'kpiProyectos',
            'kpiUsuarios',
            'kpiProgramas',
            'kpiPlanes',
            'kpiObjetivos',
            'kpiPnd',
            'kpiOds',
            'estadoGeneral',
            'avance'
        ));
    }
}
