<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstitucionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:instituciones.view')->only(['index','show']);
        $this->middleware('permission:instituciones.create')->only(['create','store']);
        $this->middleware('permission:instituciones.edit')->only(['edit','update']);
        $this->middleware('permission:instituciones.delete')->only(['destroy']);
    }

    /* ──────────── LISTADO ──────────── */
    public function index()
    {
        $instituciones = Institucion::with('padre')->paginate(15);
        return view('instituciones.index', compact('instituciones'));
    }

    /* ──────────── CREATE ──────────── */
    public function create()
    {
        $padres = Institucion::activas()->get();          // para el combo padre
        return view('instituciones.create', compact('padres'));
    }

    public function store(Request $r)
    {
        $data = $this->validateForm($r);                  // array validado

        $inst = Institucion::create($data);               // mass-assign seguro

        return redirect()
               ->route('instituciones.index')
               ->with('ok', "Institución «{$inst->nombre}» creada");
    }

    /* ──────────── EDIT / UPDATE ──────────── */
    public function edit(Institucion $institucion)
    {
        $padres = Institucion::activas()                  // excluye el propio registro
                  ->where('idInstitucion','!=',$institucion->idInstitucion)
                  ->get();

        return view('instituciones.edit', compact('institucion','padres'));
    }

    public function update(Request $r, Institucion $institucion)
    {
        $data = $this->validateForm($r, $institucion->idInstitucion);
        $institucion->update($data);

        return back()->with('ok','Institución actualizada');
    }

    /* ──────────── DELETE ──────────── */
    public function destroy(Institucion $institucion)
    {
        $institucion->delete();
        return back()->with('ok','Institución eliminada');
    }

    /* ──────────── VALIDACIÓN ──────────── */
    private function validateForm(Request $r, $id = null): array
    {
        return $r->validate([
            'codigo'        => ['required','integer',
                                Rule::unique('instituciones','codigo')
                                    ->ignore($id,'idInstitucion')],
            'nombre'        => ['required','string','max:120'],
            'subsector'     => ['nullable','string','max:255'],
            'nivel_gobierno'=> ['nullable','string','max:255'],
            'parent_id'     => ['nullable',
                                'exists:instituciones,idInstitucion',
                                Rule::notIn([$id])],
            'estado'        => ['required','in:activo,inactivo'],
        ]);
    }
}
