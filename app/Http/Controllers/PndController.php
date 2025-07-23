<?php

namespace App\Http\Controllers;

use App\Models\Pnd;
use Illuminate\Http\Request;

// app/Http/Controllers/PndController.php
class PndController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']); // todo el módulo sólo admin
    }

    public function index()
    {
        $pnds = Pnd::orderBy('codigo')->paginate(10);
        return view('pnds.index', compact('pnds'));
    }

    public function create()
    {
        return view('pnds.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'codigo'      => 'required|integer|unique:pnds',
            'descripcion' => 'required|string|max:200',
            'eje'         => 'required|string|max:50',
            'nombre'      => 'required|string|max:120',
        ]);

        Pnd::create($data);
        return redirect()->route('pnds.index')
                         ->with('success','PND creado.');
    }

    public function edit(Pnd $pnd)
    {
        return view('pnds.edit', compact('pnd'));
    }

    public function update(Request $r, Pnd $pnd)
    {
        $data = $r->validate([
            'codigo'      => 'required|integer|unique:pnds,codigo,'.$pnd->id,
            'descripcion' => 'required|string|max:200',
            'eje'         => 'required|string|max:50',
            'nombre'      => 'required|string|max:120',
        ]);

        $pnd->update($data);
        return back()->with('success','PND actualizado.');
    }

    public function destroy(Pnd $pnd)
    {
        // opcional: prevenir borrado si hay objetivos asociados
        if ($pnd->objetivos()->exists()) {
            return back()->with('error','No se puede eliminar: tiene objetivos.');
        }

        $pnd->delete();
        return back()->with('success','PND eliminado.');
    }
}
