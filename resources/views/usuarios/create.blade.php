@extends('layouts.app')

@section('title', 'Nuevo usuario')

@section('header')
    <h2 class="text-2xl font-bold mb-4">Registrar usuario</h2>
@endsection

@section('content')
    {{-- Errores de validación --------------------------------------------------- --}}
    @if ($errors->any())
        <ul class="mb-4 list-disc pl-6 text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{-- Formulario -------------------------------------------------------------- --}}
    <form action="{{ route('usuarios.store') }}" method="POST" class="max-w-md space-y-4">
        @csrf

        {{-- Nombre --}}
        <div>
            <label class="block font-semibold">Nombre</label>
            <input type="text"
                   name="name"
                   required
                   value="{{ old('name') }}"
                   class="w-full border rounded px-2 py-1">
        </div>

        {{-- Email --}}
        <div>
            <label class="block font-semibold">E-mail</label>
            <input type="email"
                   name="email"
                   required
                   value="{{ old('email') }}"
                   class="w-full border rounded px-2 py-1">
        </div>

        {{-- Contraseña --}}
        <div>
            <label class="block font-semibold">Contraseña</label>
            <input type="password"
                   name="password"
                   required
                   class="w-full border rounded px-2 py-1">
            <input type="password"
                   name="password_confirmation"
                   required
                   class="w-full border rounded px-2 py-1 mt-1"
                   placeholder="Confirmar contraseña">
        </div>

        {{-- Rol --}}
        <div>
            <label class="block font-semibold">Rol</label>
            <select name="role_id"
                    required
                    class="w-full border rounded px-2 py-1">
                <option value="">— Seleccione —</option>
                @foreach ($roles as $id => $nombre)
                    <option value="{{ $id }}"
                            {{ old('role_id') == $id ? 'selected' : '' }}>
                        {{ ucfirst($nombre) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Botones --}}
        <div class="pt-4">
            <button type="submit"
            class="ml-4 underline text-blue-600">
                Guardar
            </button>

            <a href="{{ route('usuarios.index') }}"
               class="ml-4 underline text-blue-600">
               Cancelar
            </a>
        </div>
    </form>
@endsection
