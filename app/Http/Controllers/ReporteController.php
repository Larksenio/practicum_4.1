<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReporteController extends Controller
{
    /* -----------------------------------------------------------------
     | 1. Listado
     |------------------------------------------------------------------*/
    public function index()
    {
        // Trae responsable (user) y pagina de 10
        $reportes = Reporte::with('responsable')
            ->latest()
            ->paginate(10);

        return view('reportes.index', compact('reportes'));
    }

    /* -----------------------------------------------------------------
     | 2. Formulario de creación
     |------------------------------------------------------------------*/
    public function create()
    {
        // Lista de usuarios para el <select>
        $usuarios = User::pluck('name', 'id');

        return view('reportes.create', compact('usuarios'));
    }

    /* -----------------------------------------------------------------
     | 3. Guardar nuevo reporte
     |------------------------------------------------------------------*/
    public function store(Request $request)
    {
        $request->validate([
            'nombre'         => 'required|string|max:255',
            'tipo'           => 'required|string|max:50',
            'responsable_id' => 'required|exists:users,id',
            // campos opcionales sin reglas estrictas:
            'antecedentes'   => 'nullable|string',
            'desarrollo'     => 'nullable|string',
            'conclusiones'   => 'nullable|string',
            'fecha_creacion' => 'nullable|date',
        ]);

        // Crea el reporte
        $reporte = Reporte::create($request->all());

        /* ------ (opcional) crea versión 1 del informe asociado -------- */
        $reporte->informes()->create([
            'codigo'  => strtoupper(Str::uuid()),      // REP-2024-…
            'version' => 1,
        ]);

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte creado satisfactoriamente.');
    }

    /* -----------------------------------------------------------------
     | 4. Formulario de edición
     |------------------------------------------------------------------*/
    public function edit(Reporte $reporte)
    {
        $usuarios = User::pluck('name', 'id');

        return view('reportes.edit', compact('reporte', 'usuarios'));
    }

    /* -----------------------------------------------------------------
     | 5. Actualizar
     |------------------------------------------------------------------*/
    public function update(Request $request, Reporte $reporte)
    {
        $request->validate([
            'nombre'         => 'required|string|max:255',
            'tipo'           => 'required|string|max:50',
            'responsable_id' => 'required|exists:users,id',
            'antecedentes'   => 'nullable|string',
            'desarrollo'     => 'nullable|string',
            'conclusiones'   => 'nullable|string',
            'fecha_creacion' => 'nullable|date',
        ]);

        $reporte->update($request->all());

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte actualizado.');
    }

    /* -----------------------------------------------------------------
     | 6. Eliminar
     |------------------------------------------------------------------*/
    public function destroy(Reporte $reporte)
    {
        $reporte->delete();

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte eliminado.');
    }
}