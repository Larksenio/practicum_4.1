@extends('layouts.app')

@section('title','Proyectos')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Listado de Proyectos:</h2>

    {{-- Validacion mensaje --}}
        @if (session('success'))
            <div>
                {{session('success')}}
            </div>
        @endif

    {{--Boton para llamar al formulario crear proyectos --}}

        <a href="{{route('proyectos.create')}}">+ Nuevo proyecto</a>

    {{-- Tabla para listar todos los proyectos --}}

    <table style="background-color: #f8f8fa;">

        <thead>
            <tr>
                <th style="border: 1px solid #ccc; padding: 8px">ID</th>
                <th style="border: 1px solid #ccc; padding: 8px">Institucion</th>
                <th style="border: 1px solid #ccc; padding: 8px">Nombre</th>
                <th style="border: 1px solid #ccc; padding: 8px">Descripción</th>
                 <th style="border: 1px solid #ccc; padding: 8px">Estado</th>
                <th style="border: 1px solid #ccc; padding: 8px">Acciones</th>
                
            </tr>
        </thead>
        <tbody>

            @foreach($proyectos as $proyecto)
                <tr>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$proyecto->idProyecto}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$proyecto->institucion->subsector}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$proyecto->nombre}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$proyecto->descripcion}}</td>
                     <td style="border: 1px solid #ccc; padding: 8px">{{$proyecto->estado}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">
                        <a href="{{route('proyectos.edit', $proyecto->idProyecto)}}">Editar</a>
                        <form action="{{ route('proyectos.destroy', $proyecto->idProyecto) }}" method="POST" onsubmit="return confirm('Estas seguro de querer eliminar este proyecto?');">
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

