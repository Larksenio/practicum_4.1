<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Institucion;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::all();
        return view('proyectos.index', compact('proyectos'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institucion = Institucion::all();
        return view('proyectos.create', compact('institucion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idInstitucion'=> 'required|exists:instituciones,idInstitucion',
            'nombre'=> 'required|string',
            'descripcion'=> 'nullable|string',
            'estado'=> 'nullable|string',
            'actividades'=> 'nullable|string',
            'fecha_inicio'=> 'required|date',
            'fecha_fin'=> 'nullable|date',
            'tipologia'=> 'required|string',

        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto Creado Satisfactoriamente');


    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proyecto = Proyecto::findOrfail($id);
        $instituciones = Institucion::all();
        return view('proyectos.edit', compact('proyecto','instituciones')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'idInstitucion'=> 'required|exists:instituciones,idInstitucion',
            'nombre'=> 'required|string',
            'descripcion'=> 'nullable|string',
            'estado'=> 'nullable|string',
            'actividades'=> 'nullable|string',
            'fecha_inicio'=> 'required|date',
            'fecha_fin'=> 'nullable|date',
            'tipologia'=> 'required|string',

        ]);

        $proyecto = Proyecto::findOrfail($id);
        $proyecto->update($request->all()); 

        return redirect()->route('proyectos.index')->with('success', 'Proyecto Actualizada Satisfactoriamente');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrfail($id);
        $proyecto->delete();

         return redirect()->route('proyectos.index')->with('success', 'Proyecto Eliminada Satisfactoriamente');

    }
}
