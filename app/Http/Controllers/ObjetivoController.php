<?php

namespace App\Http\Controllers;

use App\Models\{Objetivo, Pnd, Ods};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ObjetivoController extends Controller
{
    public function __construct()
    {
        // Si SOLO admin entra, deja esto:
        $this->middleware(['auth', 'role:admin']);

        // Si quieres además permisos finos (recomendado para que @can funcione):
        // $this->middleware('permission:objetivos.view')->only(['index','show']);
        // $this->middleware('permission:objetivos.create')->only(['create','store']);
        // $this->middleware('permission:objetivos.edit')->only(['edit','update']);
        // $this->middleware('permission:objetivos.delete')->only(['destroy']);
    }

    public function index()
{
    $objetivos = Objetivo::query()
        ->when(method_exists(Objetivo::class, 'pnd'), fn ($q) => $q->with('pnd'))
        ->when(method_exists(Objetivo::class, 'ods'), fn ($q) => $q->with('ods'))
        ->latest('fecha_registro')
        ->paginate(10);

    $objetivos->withQueryString();

    return view('objetivos.index', compact('objetivos'));
}


    public function create()
    {
        $pnds = Pnd::orderBy('nombre')->pluck('nombre', 'id');
        $ods  = Ods::orderBy('nombre')->pluck('nombre', 'id');

        return view('objetivos.create', compact('pnds', 'ods'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        Objetivo::create($data);

        return redirect()
            ->route('objetivos.index')
            ->with('success', 'Objetivo creado correctamente.');
    }

    public function edit(Objetivo $objetivo)
    {
        $pnds = Pnd::orderBy('nombre')->pluck('nombre', 'id');
        $ods  = Ods::orderBy('nombre')->pluck('nombre', 'id');

        return view('objetivos.edit', compact('objetivo', 'pnds', 'ods'));
    }

    public function update(Request $request, Objetivo $objetivo)
    {
        // ✅ usamos el route key real del modelo
        $ignoreId = $objetivo->getKey();

        $data = $this->validatedData($request, $ignoreId);

        $objetivo->update($data);

        return redirect()
            ->route('objetivos.index')
            ->with('success', 'Objetivo actualizado.');
    }

    public function destroy(Objetivo $objetivo)
    {
        $objetivo->delete();

        return back()->with('success', 'Objetivo eliminado.');
    }

    private function validatedData(Request $request, $ignoreId = null): array
    {
        return $request->validate(
            [
                'codigo' => [
                    'required',
                    'integer',
                    'min:1',
                    Rule::unique('objetivos', 'codigo')->ignore($ignoreId),
                ],
                'descripcion' => ['required', 'string', 'max:1000'],
                'estado' => ['required', Rule::in(['ACTIVO','INACTIVO'])],
                'version' => ['required', 'integer', 'min:1'],
                'fecha_registro' => ['required', 'date'],
                'pnd_id' => ['nullable', 'integer', 'exists:pnds,id'],
                'ods_id' => ['nullable', 'integer', 'exists:ods,id'],
            ],
            [
                'codigo.required' => 'El código es obligatorio.',
                'codigo.integer'  => 'El código debe ser numérico.',
                'codigo.min'      => 'El código debe ser mayor a 0.',
                'codigo.unique'   => 'Ya existe un objetivo con ese código.',
                'descripcion.required' => 'La descripción es obligatoria.',
                'descripcion.max' => 'La descripción no puede superar 1000 caracteres.',
                'estado.required' => 'El estado es obligatorio.',
                'estado.in'       => 'El estado debe ser ACTIVO o INACTIVO.',
                'version.required'=> 'La versión es obligatoria.',
                'version.min'     => 'La versión mínima es 1.',
                'fecha_registro.required' => 'La fecha de registro es obligatoria.',
                'pnd_id.exists'   => 'El PND seleccionado no existe.',
                'ods_id.exists'   => 'El ODS seleccionado no existe.',
            ]
        );
    }
}
