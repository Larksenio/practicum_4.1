<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Institucion;
use App\Models\Objetivo;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function __construct()
    {
        // Si manejas permisos con Spatie, descomenta y ajusta:
        // $this->middleware('permission:proyectos.view')->only(['index','show']);
        // $this->middleware('permission:proyectos.create')->only(['create','store']);
        // $this->middleware('permission:proyectos.edit')->only(['edit','update']);
        // $this->middleware('permission:proyectos.delete')->only(['destroy']);
    }

    /* ──────────── LISTADO ──────────── */
    public function index()
    {
        $proyectos = Proyecto::with('institucion')
            ->latest('idProyecto')
            ->paginate(10);

        return view('proyectos.index', compact('proyectos'));
    }

    /* ──────────── CREATE ──────────── */
    public function create()
    {
        $instituciones = Institucion::orderBy('nombre')->get();

        // Objetivos para multi-select
        $objetivos = Objetivo::orderBy('codigo')
            ->get(['id', 'codigo', 'descripcion']); // si tu PK NO es id, dime cuál es

        return view('proyectos.create', compact('instituciones', 'objetivos'));
    }

    /* ──────────── STORE ──────────── */
    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        // Creamos proyecto
        $proyecto = Proyecto::create($data);

        // Asociar objetivos (si llegaron)
        $objetivosIds = $request->input('objetivos_ids', []);
        if (is_array($objetivosIds)) {
            $proyecto->objetivos()->sync($objetivosIds);
        }

        return redirect()
            ->route('proyectos.index')
            ->with('success', 'Proyecto creado satisfactoriamente');
    }

    /* ──────────── EDIT ──────────── */
    public function edit($id)
    {
        $proyecto = Proyecto::with('objetivos')->findOrFail($id);

        $instituciones = Institucion::orderBy('nombre')->get();

        $objetivos = Objetivo::orderBy('codigo')
            ->get(['id', 'codigo', 'descripcion']);

        return view('proyectos.edit', compact('proyecto', 'instituciones', 'objetivos'));
    }

    /* ──────────── UPDATE ──────────── */
    public function update(Request $request, $id)
    {
        $data = $this->validatedData($request);

        $proyecto = Proyecto::findOrFail($id);
        $proyecto->update($data);

        $objetivosIds = $request->input('objetivos_ids', []);
        if (is_array($objetivosIds)) {
            $proyecto->objetivos()->sync($objetivosIds);
        }

        return redirect()
            ->route('proyectos.index')
            ->with('success', 'Proyecto actualizado satisfactoriamente');
    }

    /* ──────────── DELETE ──────────── */
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return redirect()
            ->route('proyectos.index')
            ->with('success', 'Proyecto eliminado satisfactoriamente');
    }

    /* ──────────── VALIDACIÓN ──────────── */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'idInstitucion' => 'required|exists:instituciones,idInstitucion',
            'codigo'        => 'required|integer',
            'nombre'        => 'required|string|max:255',
            'descripcion'   => 'nullable|string',
            'estado'        => 'required|in:activo,inactivo',
            'actividades'   => 'nullable|string',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'nullable|date|after_or_equal:fecha_inicio',
            'tipologia'     => 'required|string|max:255',

            // objetivos_ids viene del form (multi-select)
            'objetivos_ids'   => 'nullable|array',
            'objetivos_ids.*' => 'integer|exists:objetivos,id',
        ]);
    }
}
