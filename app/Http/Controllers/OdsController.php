<?php

namespace App\Http\Controllers;

use App\Models\Ods;
use Illuminate\Http\Request;
use App\Models\OdsMeta;
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
    $ods = Ods::with('metas')->orderBy('codigo')->paginate(10);
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
  'codigo' => 'required|integer|min:1|max:17|unique:ods,codigo',
  'nombre' => 'required|string|max:120',
  'descripcion' => 'required|string|max:500',
  'metas' => 'nullable|array',
  'metas.*.codigo' => 'required_with:metas|string|max:10',
  'metas.*.descripcion' => 'required_with:metas|string|max:500',
]);

$ods = Ods::create($data);

foreach (($data['metas'] ?? []) as $m) {
  $ods->metas()->create($m);
}

return redirect()->route('ods.index')->with('success','ODS creado.');

    }

    /* -------- EDITAR --------- */
   public function edit(Ods $od)
{
    $od->load('metas'); // o Ods::with('metas')->find($od->id)
    return view('ods.edit', compact('od'));
}


    /* -------- ACTUALIZAR ----- */
    
public function update(Request $r, Ods $od)
{
    $data = $r->validate([
        'codigo'      => 'required|integer|min:1|max:17|unique:ods,codigo,' . $od->id,
        'nombre'      => 'required|string|max:120',
        'descripcion' => 'required|string|max:500',

        // metas dinámicas
        'metas'                => 'nullable|array',
        'metas.*.id'           => 'nullable|integer|exists:ods_metas,id',
        'metas.*.codigo'       => 'required_with:metas|string|max:10',
        'metas.*.descripcion'  => 'required_with:metas|string|max:500',
    ]);

    // 1) Actualiza ODS (sin meta)
    $od->update([
        'codigo' => $data['codigo'],
        'nombre' => $data['nombre'],
        'descripcion' => $data['descripcion'],
    ]);

    // 2) Sincroniza metas
    $metas = $data['metas'] ?? [];

    // ids enviados (para saber cuáles quedan)
    $idsEnviados = collect($metas)->pluck('id')->filter()->values();

    // borra metas que ya no vienen en el form
    $od->metas()->whereNotIn('id', $idsEnviados)->delete();

    // crea/actualiza las que vienen
    foreach ($metas as $m) {
        // si el usuario dejó filas vacías, sáltalas
        if (empty($m['codigo']) && empty($m['descripcion'])) continue;

        if (!empty($m['id'])) {
            // update
            $od->metas()->where('id', $m['id'])->update([
                'codigo' => $m['codigo'],
                'descripcion' => $m['descripcion'],
            ]);
        } else {
            // create
            $od->metas()->create([
                'codigo' => $m['codigo'],
                'descripcion' => $m['descripcion'],
            ]);
        }
    }

    return redirect()->route('ods.index')->with('success', 'ODS actualizado.');
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
