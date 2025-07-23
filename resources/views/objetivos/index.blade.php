@extends('layouts.app')

@section('title', 'Objetivos')

@section('header')
    <h2 class="text-2xl font-bold">Objetivos</h2>
@endsection

@section('content')
    {{-- botón para crear --}}
    <a href="{{ route('objetivos.create') }}">
        + Nuevo objetivo
    </a>

    {{-- tabla --}}
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">Código</th>
                <th>Descripción</th>
                <th>Versión</th>
                <th>Fecha registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($objetivos as $obj)
            <tr class="border-t">
                <td class="p-2">{{ $obj->codigo }}</td>
                <td class="max-w-xs truncate">{{ $obj->descripcion }}</td>
                <td>{{ $obj->version }}</td>
                <td>{{ \Carbon\Carbon::parse($obj->fecha_registro)->format('Y-m-d') }}</td>
                <td class="space-x-2">
                    <a href="{{ route('objetivos.edit', $obj) }}"
                       class="text-blue-600 underline">Editar</a>
                    <form action="{{ route('objetivos.destroy', $obj) }}"
                          method="POST" class="inline"
                          onsubmit="return confirm('¿Eliminar objetivo?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 underline">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="p-4 text-center">No hay objetivos registrados.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- paginación --}}
    <div class="mt-4">
        {{ $objetivos->links() }}
    </div>
@endsection
