@extends('layouts.app')

@section('header')
    <h2 class="text-2xl font-bold">
        {{ isset($usuario) ? 'Editar usuario' : 'Nuevo usuario' }}
    </h2>
@endsection

@section('content')
@if ($errors->any())
    <ul class="mb-4 text-red-600 list-disc pl-6">
        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
@endif

<form action="{{ isset($usuario)
        ? route('usuarios.update',$usuario)
        : route('usuarios.store') }}"
      method="POST" class="space-y-4 max-w-md">
    @csrf
    @isset($usuario) @method('PUT') @endisset

    <div>
        <label>Nombre</label>
        <input type="text" name="name" required
               value="{{ old('name',$usuario->name ?? '') }}"
               class="w-full border rounded px-2 py-1">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" required
               value="{{ old('email',$usuario->email ?? '') }}"
               class="w-full border rounded px-2 py-1">
    </div>

    <div>
        <label>Contraseña {{ isset($usuario)? '(dejar vacío para no cambiar)': '' }}</label>
        <input type="password" name="password" {{ isset($usuario)? '' : 'required' }}
               class="w-full border rounded px-2 py-1">
        <input type="password" name="password_confirmation"
               class="w-full border rounded px-2 py-1 mt-1"
               placeholder="Confirmar contraseña">
    </div>

    <div>
        <label>Rol</label>
        <select name="role_id" required class="w-full border rounded px-2 py-1">
            <option value="">— Seleccione —</option>
            @foreach ($roles as $id => $nombre)
                <option value="{{ $id }}"
                    {{ old('role_id',
                           isset($usuario)? $usuario->roles->first()->id ?? '' : '')
                       == $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
    <a href="{{ route('usuarios.index') }}" class="ml-4 underline">Cancelar</a>
</form>
@endsection
