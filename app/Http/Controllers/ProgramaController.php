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

    /* LISTA */
    public function index()
    {
        $programas = Programa::with('institucion')
                     ->orderBy('created_at','desc')
                     ->paginate(15);

        return view('programas.index', compact('programas'));
    }

    /* CREATE */
    public function create()
    {
        $instituciones = Institucion::activas()->pluck('nombre','idInstitucion');
        return view('programas.create', compact('instituciones'));
    }

    public function store(Request $r)
    {
        $data = $this->validateForm($r);
        Programa::create($data);
        return redirect()->route('programas.index')->with('ok','Programa creado');
    }

    /* EDIT / UPDATE */
    public function edit(Programa $programa)
    {
        $instituciones = Institucion::activas()->pluck('nombre','idInstitucion');
        return view('programas.edit', compact('programa','instituciones'));
    }

    public function update(Request $r, Programa $programa)
    {
        $data = $this->validateForm($r, $programa->idPrograma);
        $programa->update($data);
        return back()->with('ok','Programa actualizado');
    }

    /* DELETE */
    public function destroy(Programa $programa)
    {
        $programa->delete();
        return back()->with('ok','Programa eliminado');
    }

    /* VALIDACIÓN */
    private function validateForm(Request $r, $id = null): array
    {
        return $r->validate([
            'institucion_id' => ['required','exists:instituciones,idInstitucion'],
            'nombre'         => ['required','string','max:255',
                                 Rule::unique('programas','nombre')
                                      ->ignore($id,'idPrograma')],
            'descripcion'    => ['nullable','string'],
            'estado'         => ['required','in:activo,inactivo'],
        ]);
    }
}
