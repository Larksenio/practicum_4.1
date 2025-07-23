@extends('layouts.app')

@section('header')<h2 class="text-2xl font-bold">PND</h2>@endsection

@section('content')
<a href="{{ route('pnds.create') }}">+ Nuevo</a>

<table class="w-full border">
    <thead class="bg-gray-100">
        <tr><th class="p-2">Código</th><th>Nombre</th><th>Eje</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    @foreach($pnds as $p)
        <tr class="border-t">
            <td class="p-2">{{ $p->codigo }}</td>
            <td>{{ $p->nombre }}</td>
            <td>{{ $p->eje }}</td>
            <td>
                <a href="{{ route('pnds.edit',$p) }}" class="text-blue-600 underline">Editar</a>
                <form action="{{ route('pnds.destroy',$p) }}" method="POST"
                      class="inline" onsubmit="return confirm('¿Eliminar?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 underline">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $pnds->links() }}
@endsection
