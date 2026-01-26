<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Institucion;
use App\Models\Proyecto;
use App\Models\Programa;
use App\Models\Plan;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Resumen NO sensible (solo conteos)
        $stats = [
            'instituciones' => Institucion::count(),
            'proyectos'     => Proyecto::count(),
            'programas'     => Programa::count(),
            'planes'        => Plan::count(),
        ];

        // Admin (o auditor) puede ver usuarios
        if ($user->hasRole('admin') || $user->hasRole('auditor')) {
            $stats['usuarios'] = User::count();
        }

        return view('inicio', compact('user','stats'));
    }
}
