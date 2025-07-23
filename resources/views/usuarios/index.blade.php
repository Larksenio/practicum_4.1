@extends('layouts.app')

@section('header')
    <h2 class="text-2xl font-bold">Usuarios</h2>
   
@endsection

@section('content')
 <h2 class="text-2xl font-bold mb-4">Listado de usuarios:</h2>
<a href="{{ route('usuarios.create') }}">+ Nuevo usuario</a>

<table class="mt-4 w-full border">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-2">ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($usuarios as $u)
        <tr class="border-t">
            <td class="p-2">{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->roles->pluck('name')->join(', ') }}</td>
            <td class="space-x-2">
                <a href="{{ route('usuarios.edit',$u) }}"
                   class="text-blue-600 underline">Editar</a>
                <form action="{{ route('usuarios.destroy',$u) }}"
                      method="POST" class="inline"
                      onsubmit="return confirm('¿Eliminar?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 underline">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $usuarios->links() }}
@endsection
