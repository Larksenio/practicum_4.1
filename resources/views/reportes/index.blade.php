@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Listado de Reportes</h2>

    {{-- mensaje flash --}}
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('reportes.create') }}">+ Nuevo reporte</a>

    <table style="background-color:#f8f8fa;">
        <thead>
            <tr>
                <th style="border:1px solid #ccc;padding:8px">ID</th>
                <th style="border:1px solid #ccc;padding:8px">Nombre</th>
                <th style="border:1px solid #ccc;padding:8px">Tipo</th>
                <th style="border:1px solid #ccc;padding:8px">Responsable</th>
                <th style="border:1px solid #ccc;padding:8px">Creación</th>
                <th style="border:1px solid #ccc;padding:8px">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($reportes as $rep)
            <tr>
                <td style="border:1px solid #ccc;padding:8px">{{ $rep->id }}</td>
                <td style="border:1px solid #ccc;padding:8px">{{ $rep->nombre }}</td>
                <td style="border:1px solid #ccc;padding:8px">{{ $rep->tipo }}</td>
                <td style="border:1px solid #ccc;padding:8px">{{ $rep->responsable->name }}</td>
                <td style="border:1px solid #ccc;padding:8px">{{ $rep->fecha_creacion}}</td>
                <td style="border:1px solid #ccc;padding:8px">
                    <a href="{{ route('reportes.edit', $rep) }}">Editar</a>
                    <form action="{{ route('reportes.destroy', $rep) }}"
                          method="POST" style="display:inline"
                          onsubmit="return confirm('¿Eliminar este reporte?');">
                        @csrf @method('DELETE')
                        <button>Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- paginación --}}
    {{ $reportes->links() }}
@endsection
