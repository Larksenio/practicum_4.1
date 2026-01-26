<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgramaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:programas.view')->only(['index','show']);
        $this->middleware('permission:programas.create')->only(['create','store']);
        $this->middleware('permission:programas.edit')->only(['edit','update']);
        $this->middleware('permission:programas.delete')->only(['destroy']);
    }

    /* ───────────── LISTADO ───────────── */
    public function index()
    {
        $programas = Programa::with('institucion')
            ->orderBy('nombre')
            ->paginate(10);

        return view('programas.index', compact('programas'));
    }

    /* ───────────── FORM CREAR ───────────── */
    public function create()
    {
        $programa = new Programa();

        $instituciones = Institucion::orderBy('nombre')
            ->pluck('nombre', 'idInstitucion'); // value => idInstitucion

        return view('programas.create', compact('programa', 'instituciones'));
    }

    /* ───────────── GUARDAR ───────────── */
    public function store(Request $request)
    {
        $data = $this->validateForm($request);

        Programa::create($data);

        return redirect()
            ->route('programas.index')
            ->with('ok', 'Programa creado correctamente.');
    }

    /* ───────────── FORM EDITAR ───────────── */
    public function edit(Programa $programa)
    {
        $instituciones = Institucion::orderBy('nombre')
            ->pluck('nombre', 'idInstitucion');

        return view('programas.edit', compact('programa', 'instituciones'));
    }

    /* ───────────── ACTUALIZAR ───────────── */
    public function update(Request $request, Programa $programa)
    {
        $data = $this->validateForm($request, $programa->idPrograma);

        $programa->update($data);

        return redirect()
            ->route('programas.index')
            ->with('ok', 'Programa actualizado correctamente.');
    }

    /* ───────────── ELIMINAR ───────────── */
    public function destroy(Programa $programa)
    {
        $programa->delete();

        return back()->with('ok', 'Programa eliminado.');
    }

    /* ───────────── VALIDACIÓN ───────────── */
    private function validateForm(Request $request, $idPrograma = null): array
    {
        return $request->validate([
            'institucion_id' => ['required', 'integer', 'exists:instituciones,idInstitucion'],

            'nombre' => [
                'required', 'string', 'max:255',
                Rule::unique('programas', 'nombre')->ignore($idPrograma, 'idPrograma')
            ],

            'descripcion' => ['nullable', 'string'],
            'estado'      => ['required', 'in:activo,inactivo'],
        ]);
    }
}
