@extends('layouts.app')

@section('title','Nuevo Proyecto')

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

        {{-- Formulario para la creación de proyectos --}}

        <form action="{{ route ('proyectos.store')}}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block">Institución</label>
                <select name="idInstitucion" required>
                    @foreach($institucion as $institucion)
                        <option value="{{$institucion->idInstitucion}}">{{$institucion->nombre}}</option>
                    @endforeach
                </select>
            </div>

             <div>
                <label class="block">Código</label>
                <input type="number" name="codigo" require value="{{ old('codigo') }}">
            </div>

             <div>
                <label class="block">Nombre</label>
                <input type="text" name="nombre" require>
            </div>

             <div>
                <label class="block">Descripción</label>
                <input type="text" name="descripcion" require>
            </div>
            <div>
                <label class="block">Estado</label>
                <input type="text" name="estado" require>
            </div>
            <div>
                <label class="block">Actividades</label>
                <input type="text" name="actividades" require>
            </div>
            <div>
                <label class="block">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" require>
            </div><div>
                <label class="block">Fecha de Fin</label>
                <input type="date" name="fecha_fin" require>
            </div>
             <div>
                <label class="block">Tipología</label>
                <input type="text" name="tipologia" require>
            </div>

            <button type="submit">Guardar</button>

            <a href="{{route('proyectos.index')}}">Volver</a>
            
        </form>




@endsection

