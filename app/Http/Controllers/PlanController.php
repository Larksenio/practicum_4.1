<?php

namespace App\Http\Controllers;

use App\Models\{Plan, Programa};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:planes.view')->only(['index','show']);
        $this->middleware('permission:planes.create')->only(['create','store']);
        $this->middleware('permission:planes.edit')->only(['edit','update']);
        $this->middleware('permission:planes.delete')->only(['destroy']);
    }

    public function index()
    {
        $planes = Plan::with('programa')->orderBy('created_at','desc')->paginate(15);
        return view('planes.index', compact('planes'));
    }

    public function create()
    {
        $programas = \App\Models\Programa::activos()->pluck('nombre','idPrograma');
        return view('planes.create', compact('programas'));
    }

    public function store(Request $r)
    {
        $data = $this->validateForm($r);
        Plan::create($data);
        return redirect()->route('planes.index')->with('ok','Plan creado');
    }

    public function edit(Plan $plan)
    {
        $programas = Programa::activos()->pluck('nombre','idPrograma');
        return view('planes.edit', compact('plan','programas'));
    }

    public function update(Request $r, Plan $plan)
    {
        $data = $this->validateForm($r, $plan->idPlan);
        $plan->update($data);
        return back()->with('ok','Plan actualizado');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return back()->with('ok','Plan eliminado');
    }

    private function validateForm(Request $r, $id = null): array
    {
        return $r->validate([
            'programa_id' => ['required','exists:programas,idPrograma'],
            'codigo'      => ['required','integer'],
            'version'     => ['required','integer'],
            'nombre'      => ['required','string','max:255',
                              Rule::unique('planes','nombre')
                                  ->ignore($id,'idPlan')],
            'descripcion' => ['nullable','string'],
            'estado'      => ['required','in:activo,inactivo'],
        ]);
    }
}
