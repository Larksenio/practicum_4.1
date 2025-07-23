<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstitucionController extends Controller
{
    /*---------------------------------------------------------------------
    | 1. LISTADO (GET /instituciones)
    ---------------------------------------------------------------------*/
    public function index()
    {
        $instituciones = Institucion::all();
        return view('instituciones.index', compact('instituciones'));
    }

    /*---------------------------------------------------------------------
    | 2. FORMULARIO CREAR (GET /instituciones/create)
    ---------------------------------------------------------------------*/
    public function create()
    {
        return view('instituciones.create');
    }

    /*---------------------------------------------------------------------
    | 3. GUARDAR NUEVA (POST /instituciones)
    ---------------------------------------------------------------------*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo'            => ['required', 'integer', 'unique:instituciones,codigo'],
            'nombre'            => ['required', 'string'],
            'subsector'         => ['required', 'string'],
            'nivel_gobierno'    => ['required', 'string'],
            'estado'            => ['required', 'string'],
            'fecha_creacion'    => ['required', 'date'],
            'fecha_actualizacion'=> ['nullable', 'date'],
        ]);

        Institucion::create($validated);

        return redirect()
            ->route('instituciones.index')
            ->with('success', 'Institución creada satisfactoriamente');
    }

    /*---------------------------------------------------------------------
    | 4. MOSTRAR UNA (GET /instituciones/{institucion})
    ---------------------------------------------------------------------*/
    public function show(Institucion $institucion)
    {
        // Route-model binding inyecta el modelo listo
        return view('instituciones.show', compact('institucion'));
    }

    /*---------------------------------------------------------------------
    | 5. FORMULARIO EDITAR (GET /instituciones/{institucion}/edit)
    ---------------------------------------------------------------------*/
    public function edit(Institucion $institucion)
    {
        return view('instituciones.edit', compact('institucion'));
    }

    /*---------------------------------------------------------------------
    | 6. ACTUALIZAR (PUT/PATCH /instituciones/{institucion})
    ---------------------------------------------------------------------*/
    public function update(Request $request, Institucion $institucion)
    {
        $validated = $request->validate([
            'codigo'            => [
                'required',
                'integer',
                // ignora la fila actual al verificar unicidad
                Rule::unique('instituciones', 'codigo')->ignore($institucion->id ?? $institucion->idInstitucion),
            ],
            'nombre'            => ['required', 'string'],
            'subsector'         => ['required', 'string'],
            'nivel_gobierno'    => ['required', 'string'],
            'estado'            => ['required', 'string'],
            'fecha_creacion'    => ['required', 'date'],
            'fecha_actualizacion'=> ['nullable', 'date'],
        ]);

        $institucion->update($validated);

        return redirect()
            ->route('instituciones.index')
            ->with('success', 'Institución actualizada satisfactoriamente');
    }

    /*---------------------------------------------------------------------
    | 7. ELIMINAR (DELETE /instituciones/{institucion})
    ---------------------------------------------------------------------*/
    public function destroy(Institucion $institucion)
    {
        $institucion->delete();

        return redirect()
            ->route('instituciones.index')
            ->with('success', 'Institución eliminada satisfactoriamente');
    }
}
