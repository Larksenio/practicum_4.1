<?php

namespace App\Http\Controllers;

use App\Models\Pnd;
use Illuminate\Http\Request;
use App\Models\PndEje;
// app/Http/Controllers/PndController.php
class PndController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']); // todo el módulo sólo admin
    }

    public function index()
    {
          $pnds = Pnd::with('eje')->orderBy('codigo')->paginate(10);
    return view('pnds.index', compact('pnds'));
    }

    public function create()
    {
         $ejes = PndEje::orderBy('nombre')->get();
    return view('pnds.create', compact('ejes'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'codigo'      => 'required|integer|min:1|unique:pnds,codigo',
    'descripcion' => 'required|string|max:200',
    'eje_id'      => 'required|exists:pnd_ejes,id',
    'nombre'      => 'required|string|max:120',
        ]);

        Pnd::create($data);
        return redirect()->route('pnds.index')
                         ->with('success','PND creado.');
    }

    public function edit(Pnd $pnd)
    {
       $ejes = PndEje::orderBy('nombre')->get();
    return view('pnds.edit', compact('pnd','ejes'));
    }

    public function update(Request $r, Pnd $pnd)
    {
        $data = $r->validate([
        'codigo'      => 'required|integer|min:1|unique:pnds,codigo,'.$pnd->id,
    'descripcion' => 'required|string|max:200',
    'eje_id'      => 'required|exists:pnd_ejes,id',
    'nombre'      => 'required|string|max:120',
        ]);

         return redirect()->route('pnds.index')
        ->with('success', 'PND actualizado.');
    }

   public function destroy(Pnd $pnd)
{
    $pnd->delete();
    return back()->with('success','PND eliminado.');
}


}
