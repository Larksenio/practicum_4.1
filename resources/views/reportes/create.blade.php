@extends('layouts.app')

@section('title', 'Nuevo Reporte')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Crear reporte</h2>

    {{-- errores --}}
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $e) <li>- {{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reportes.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label>Nombre*</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div>
            <label>Tipo*</label>
            <select name="tipo" required>
                @foreach (['PDF', 'Excel', 'Web'] as $t)
                    <option value="{{ $t }}" @selected(old('tipo') == $t)>{{ $t }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Responsable*</label>
            <select name="responsable_id" required>
                @foreach ($usuarios as $id => $nom)
                    <option value="{{ $id }}" @selected(old('responsable_id') == $id)>{{ $nom }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Fecha de creación</label>
            <input type="date" name="fecha_creacion" value="{{ old('fecha_creacion') ?? now()->toDateString() }}">
        </div>

        <div>
            <label>Antecedentes</label>
            <textarea name="antecedentes">{{ old('antecedentes') }}</textarea>
        </div>

        <div>
            <label>Desarrollo</label>
            <textarea name="desarrollo">{{ old('desarrollo') }}</textarea>
        </div>

        <div>
            <label>Conclusiones</label>
            <textarea name="conclusiones">{{ old('conclusiones') }}</textarea>
        </div>

        <button>Guardar</button>
        <a href="{{ route('reportes.index') }}">Volver</a>
    </form>
@endsection
