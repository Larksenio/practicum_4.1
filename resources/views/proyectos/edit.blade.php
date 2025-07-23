@extends('layouts.app')

@section('title','Editar Proyectos')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Editar los proyectos</h2>

    {{-- Formulario para edición de proyectos --}}

        <form action="{{ route ('proyectos.update' , $proyecto->idProyecto )}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block">Institucion</label>
                <select name="idInstitucion" required>
                    @foreach($instituciones as $institucion)
                        <option value="{{$institucion->idInstitucion}}"{{$proyecto->idInstitucion == $institucion->idInstitucion?:''}}>
                            {{$institucion->subSector}}
                        </option>
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

            <button type="submit">Actualizar</button>

            <a href="{{route('proyectos.index')}}">Volver</a>
            
        </form>



@endsection


