<?php
namespace App\Http\Controllers;

use App\Models\{Proyecto, Objetivo};
use Illuminate\Http\Request;

class AlineacionController extends Controller
{
   public function edit(Proyecto $proyecto)
{
    // Lista de objetivos para el select
    $objetivos = Objetivo::orderBy('descripcion')->get();   // ← o ::all()

    return view('alinear.edit', compact('proyecto','objetivos'));
}

    public function update(Request $r, Proyecto $proyecto)
    {
        // $r->objetivos  — array de ids marcados
        $ids = $r->input('objetivos', []);          // si se desmarca todo → []
        $proyecto->objetivos()->sync($ids);

        return back()->with('ok', 'Alineación actualizada');
    }
}