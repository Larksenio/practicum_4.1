@extends('layouts.app')

@section('title','Proyectos')

@section('content')
  <h2 class="text-2xl font-bold mb-4">Listado de Proyectos:</h2>

  @if (session('success'))
      <div>{{ session('success') }}</div>
  @endif

  {{-- botón crear --}}
  <a href="{{ route('proyectos.create') }}">+ Nuevo proyecto</a>

  <table style="background-color:#f8f8fa;">
    <thead>
      <tr>
        <th style="border:1px solid #ccc;padding:8px">ID</th>
        <th style="border:1px solid #ccc;padding:8px">Institución</th>
        <th style="border:1px solid #ccc;padding:8px">Nombre</th>
        <th style="border:1px solid #ccc;padding:8px">Descripción</th>
        <th style="border:1px solid #ccc;padding:8px">Estado</th>
        <th style="border:1px solid #ccc;padding:8px">Acciones</th>
        <th style="border:1px solid #ccc;padding:8px">Alinear</th>   {{-- nueva col. --}}
      </tr>
    </thead>
    <tbody>
      @foreach ($proyectos as $proyecto)
        <tr>
          <td style="border:1px solid #ccc;padding:8px">{{ $proyecto->idProyecto }}</td>
          <td style="border:1px solid #ccc;padding:8px">{{ $proyecto->institucion->subsector }}</td>
          <td style="border:1px solid #ccc;padding:8px">{{ $proyecto->nombre }}</td>
          <td style="border:1px solid #ccc;padding:8px">{{ $proyecto->descripcion }}</td>
          <td style="border:1px solid #ccc;padding:8px">{{ $proyecto->estado }}</td>

          {{-- Acciones CRUD --}}
          <td style="border:1px solid #ccc;padding:8px">
            <a href="{{ route('proyectos.edit',$proyecto) }}">Editar</a>
            <form action="{{ route('proyectos.destroy',$proyecto) }}" method="POST"
                  onsubmit="return confirm('¿Eliminar este proyecto?')" style="display:inline">
              @csrf @method('DELETE')
              <button type="submit">Eliminar</button>
            </form>
          </td>

          {{-- Botón Alinear --}}
          <td style="border:1px solid #ccc;padding:8px">
            @can('alinear.view')
              <a href="{{ route('alinear.edit',$proyecto) }}"
                 class="text-indigo-600">Alinear</a>
            @endcan
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
