@extends('layouts.app')

@section('title','Instituciones')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Listado de instituciones:</h2>

    {{-- Validacion mensaje --}}
        @if (session('success'))
            <div>
                {{session('success')}}
            </div>
        @endif

    {{--Boton para llamar al formulario crear instituciones --}}

        <a href="{{route('instituciones.create')}}">+ Nueva Institución</a>

    {{-- Tabla para listar todas las instituciones --}}

    <table style="background-color: #f8f8fa;">

        <thead>
            <tr>
                <th style="border: 1px solid #ccc; padding: 8px">ID</th>
                <th style="border: 1px solid #ccc; padding: 8px">Código</th>
                 <th style="border: 1px solid #ccc; padding: 8px">Nombre</th>
                <th style="border: 1px solid #ccc; padding: 8px">Subsector</th>
                <th style="border: 1px solid #ccc; padding: 8px">Nivel de Gobierno</th>
                <th style="border: 1px solid #ccc; padding: 8px">Estado</th>
                <th style="border: 1px solid #ccc; padding: 8px">Fecha de Creación</th>
                <th style="border: 1px solid #ccc; padding: 8px">Fecha de Actualización</th>
                <th style="border: 1px solid #ccc; padding: 8px">Acciones</th>
            </tr>
        </thead>
        <tbody>

            @foreach($instituciones as $institucion)
                <tr>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$institucion->idInstitucion}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$institucion->codigo}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$institucion->nombre}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$institucion->subsector}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$institucion->nivel_gobierno}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$institucion->estado}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$institucion->fecha_creacion}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$institucion->fecha_actualizacion}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">
                        <a href="{{route('instituciones.edit', $institucion->idInstitucion)}}">Editar</a>
                        <form action="{{ route('instituciones.destroy', $institucion->idInstitucion) }}" method="POST" onsubmit="return confirm('Estas seguro de querer eliminar estas institucion?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                        </td>
                    


                </tr>
            @endforeach

         

        </tbody>



    </table>



@endsection

