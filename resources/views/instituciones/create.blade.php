@extends('layouts.app')

@section('title','Nueva Institucion')

@section('content')
    
    @if ($errors->any())
        <div>

            <ul>

                @foreach($errors->all() as $error)

                <li> - {{$error}} </li>

                @endforeach

            </ul>

        </div>
    @endif

        {{-- Formulario para la creación de instituciones --}}

        <form action="{{ route ('instituciones.store')}}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block">Código</label>
                <input type="number" name="codigo" require value="{{ old('codigo') }}">
            </div>

             <div>
                <label class="block">Nombre</label>
                <input type="text" name="nombre" require value="{{ old('nombre') }}">
            </div>

             <div>
                <label class="block">Subsector</label>
                <input type="text" name="subsector" require value="{{ old('subsector') }}">
            </div>

             <div>
                <label class="block">Nivel de Gobierno</label>
                <input type="text" name="nivel_gobierno" require value="{{ old('nivel_gobierno') }}">
            </div>

             <div>
                <label class="block">Estado</label>
                <input type="text" name="estado" require value="{{ old('estado') }}">
            </div>

             <div>
                <label class="block">Fecha de Creación</label>
                <input type="date" name="fecha_creacion" require value="{{ old('fecha_creacion') }}">
            </div>

             <div>
                <label class="block">Fecha de Actualización</label>
                <input type="date" name="fecha_actualizacion" require value="{{ old('fecha_actualizacion') }}">
            </div>

            <button type="submit">Guardar</button>

            <a href="{{route('instituciones.index')}}">Volver</a>
            
        </form>

@endsection

