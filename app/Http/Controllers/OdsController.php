<?php

namespace App\Http\Controllers;

use App\Models\Ods;
use Illuminate\Http\Request;

// app/Http/Controllers/OdsController.php
class OdsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    /* -------- LISTADO -------- */
    public function index()
    {
        $ods = Ods::orderBy('meta')->paginate(10);
        return view('ods.index', compact('ods'));
    }

    /* -------- FORM CREAR ----- */
    public function create()
    {
        return view('ods.create');
    }

    /* -------- GUARDAR -------- */
    public function store(Request $r)
    {
        $data = $r->validate([
            'codigo'      => 'required|integer|unique:ods',
            'meta'        => 'required|integer|min:1|max:17',
            'nombre'      => 'required|string|max:120',
            'descripcion' => 'required|string|max:200',
        ]);

        Ods::create($data);
        return redirect()->route('ods.index')
                         ->with('success','ODS creado.');
    }

    /* -------- EDITAR --------- */
    public function edit(Ods $od)
    {
        return view('ods.edit', ['od' => $od]);
    }

    /* -------- ACTUALIZAR ----- */
    public function update(Request $r, Ods $od)
    {
        $data = $r->validate([
            'codigo'      => 'required|integer|unique:ods,codigo,'.$od->id,
            'meta'        => 'required|integer|min:1|max:17',
            'nombre'      => 'required|string|max:120',
            'descripcion' => 'required|string|max:200',
        ]);

        $od->update($data);
        return back()->with('success','ODS actualizado.');
    }

    /* -------- ELIMINAR ------- */
    public function destroy(Ods $od)
    {
        if ($od->objetivos()->exists()) {
            return back()->with('error','No se puede eliminar: tiene objetivos ligados.');
        }
        $od->delete();
        return back()->with('success','ODS eliminado.');
    }

}
