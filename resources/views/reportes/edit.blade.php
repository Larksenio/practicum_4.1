@extends('layouts.app')

@section('title', 'Editar Reporte')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Editar reporte</h2>

    @if ($errors->any())
        <div><ul>@foreach ($errors->all() as $e)<li>- {{ $e }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('reportes.update', $reporte) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label>Nombre*</label>
            <input type="text" name="nombre" value="{{ old('nombre', $reporte->nombre) }}" required>
        </div>

        <div>
            <label>Tipo*</label>
            <select name="tipo" required>
                @foreach (['PDF', 'Excel', 'Web'] as $t)
                    <option value="{{ $t }}" @selected(old('tipo', $reporte->tipo) == $t)>{{ $t }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Responsable*</label>
            <select name="responsable_id" required>
                @foreach ($usuarios as $id => $nom)
                    <option value="{{ $id }}" @selected(old('responsable_id', $reporte->responsable_id) == $id)>
                        {{ $nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Fecha de creación</label>
            <input type="date" name="fecha_creacion"
                   value="{{ old('fecha_creacion', optional($reporte->fecha_creacion)->toDateString()) }}">
        </div>

        <div>
            <label>Antecedentes</label>
            <textarea name="antecedentes">{{ old('antecedentes', $reporte->antecedentes) }}</textarea>
        </div>

        <div>
            <label>Desarrollo</label>
            <textarea name="desarrollo">{{ old('desarrollo', $reporte->desarrollo) }}</textarea>
        </div>

        <div>
            <label>Conclusiones</label>
            <textarea name="conclusiones">{{ old('conclusiones', $reporte->conclusiones) }}</textarea>
        </div>

        <button>Actualizar</button>
        <a href="{{ route('reportes.index') }}">Volver</a>
    </form>
@endsection
