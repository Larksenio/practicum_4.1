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

    public function index()
    {
        $instituciones = Institucion::with('padre')
            ->orderBy('idInstitucion', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('instituciones.index', compact('instituciones'));
    }

    public function create()
    {
        $padres = Institucion::activas()->get();
        $inst   = new Institucion();

        return view('instituciones.create', compact('padres', 'inst'));
    }

    public function store(Request $r)
    {
        $data = $this->validateForm($r);

        $inst = Institucion::create($data);

        return redirect()
            ->route('instituciones.index')
            ->with('ok', "Institución «{$inst->nombre}» creada");
    }

    public function edit(Institucion $institucion)
    {
        $padres = Institucion::activas()
            ->where('idInstitucion', '!=', $institucion->idInstitucion)
            ->get();

        return view('instituciones.edit', compact('institucion', 'padres'));
    }

    public function update(Request $r, Institucion $institucion)
    {
        $data = $this->validateForm($r, $institucion->idInstitucion);

        $institucion->update($data);

        return redirect()
            ->route('instituciones.index')
            ->with('ok', 'Institución actualizada correctamente');
    }

    public function destroy(Institucion $institucion)
    {
        $institucion->delete();

        return back()->with('ok','Institución eliminada');
    }

    private function validateForm(Request $r, $id = null): array
    {
        return $r->validate(
            [
                'codigo' => [
                    'required',
                    'integer',
                    'min:1',
                    Rule::unique('instituciones','codigo')->ignore($id,'idInstitucion')
                ],
                'nombre'         => ['required','string','max:120'],
                'subsector'      => ['nullable','string','max:255'],
                'nivel_gobierno' => ['nullable','string','max:255'],
                'parent_id'      => [
                    'nullable',
                    'integer',
                    'exists:instituciones,idInstitucion',
                    // evita asignarse a sí misma
                    Rule::notIn(array_filter([$id])),
                ],
                'estado' => ['required','in:activo,inactivo'],
            ],
            // Mensajes personalizados (mejor UX + accesibilidad)
            [
                'codigo.required' => 'El código es obligatorio.',
                'codigo.integer'  => 'El código debe ser un número entero.',
                'codigo.min'      => 'El código debe ser mayor a 0.',
                'codigo.unique'   => 'Ya existe una institución con ese código.',
                'nombre.required' => 'El nombre es obligatorio.',
                'nombre.max'      => 'El nombre no puede superar 120 caracteres.',
                'parent_id.exists'=> 'La institución padre seleccionada no existe.',
                'parent_id.integer'=> 'El campo Padre no es válido.',
                'estado.in'       => 'El estado debe ser Activo o Inactivo.',
            ]
        );
    }
}
