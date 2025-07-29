<?php

namespace App\Http\Controllers;

use App\Models\{Objetivo, Pnd, Ods};
use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
    public function __construct()
    {
        // sólo administradores autenticados
        $this->middleware(['auth', 'role:admin']);
    }

    /* ───────────────────── LISTADO ───────────────────── */
    public function index()
    {
        // eager-load sólo si las relaciones existen
        $objetivos = Objetivo::query()
            ->when(method_exists(Objetivo::class, 'pnd'), fn ($q) => $q->with('pnd'))
            ->when(method_exists(Objetivo::class, 'ods'), fn ($q) => $q->with('ods'))
            ->latest('fecha_registro')
            ->paginate(10);

        return view('objetivos.index', compact('objetivos'));
    }

    /* ────────────────── FORM CREAR ───────────────────── */
    public function create()
    {
        $pnds = Pnd::orderBy('nombre')->pluck('nombre', 'id');
        $ods  = Ods::orderBy('nombre')->pluck('nombre', 'id');

        return view('objetivos.create', compact('pnds', 'ods'));
    }

    /* ─────────────────── GUARDAR ─────────────────────── */
    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        Objetivo::create($data);

        return redirect()
            ->route('objetivos.index')
            ->withSuccess('Objetivo creado correctamente.');
    }

    /* ────────────────── FORM EDITAR ──────────────────── */
    public function edit(Objetivo $objetivo)
    {
        $pnds = Pnd::orderBy('nombre')->pluck('nombre', 'id');
        $ods  = Ods::orderBy('nombre')->pluck('nombre', 'id');

        return view('objetivos.edit', compact('objetivo', 'pnds', 'ods'));
    }

    /* ─────────────────── ACTUALIZAR ───────────────────── */
    public function update(Request $request, Objetivo $objetivo)
    {
        $data = $this->validatedData($request, $objetivo->id);

        $objetivo->update($data);

        return redirect()
            ->route('objetivos.index')
            ->withSuccess('Objetivo actualizado.');
    }

    /* ─────────────────── ELIMINAR ─────────────────────── */
    public function destroy(Objetivo $objetivo)
    {
        $objetivo->delete();

        return back()->withSuccess('Objetivo eliminado.');
    }

    /* ───────────────── AYUDA PRIVADA ──────────────────── */
    private function validatedData(Request $request, int $ignoreId = 0): array
    {
        $uniqueCodigo = 'unique:objetivos,codigo' . ($ignoreId ? ',' . $ignoreId : '');

        return $request->validate([
          'codigo'        => ["required","integer",$uniqueCodigo],
        'descripcion'   => ['required','string','max:255'],
        'estado'        => ['required','in:activo,inactivo'],
        'version'       => ['required','integer','min:1'],
        'fecha_registro'=> ['nullable','date'],
        'pnd_id'        => ['nullable','exists:pnds,id'],
        'ods_id'        => ['nullable','exists:ods,id'],
        ]);
    }
}
