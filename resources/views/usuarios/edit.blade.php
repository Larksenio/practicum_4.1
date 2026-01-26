@extends('layouts.app')

@section('title', 'Editar usuario')

@section('content')
<div class="max-w-3xl mx-auto py-8">

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-900">
                {{ isset($usuario) ? 'Editar usuario' : 'Nuevo usuario' }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                {{ isset($usuario) ? 'Actualiza la información del usuario y guarda los cambios.' : 'Registra un nuevo usuario en el sistema.' }}
            </p>
        </div>

        {{-- Errores --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($usuario) ? route('usuarios.update', $usuario) : route('usuarios.store') }}"
              method="POST"
              class="space-y-6">
            @csrf
            @isset($usuario) @method('PUT') @endisset

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Nombre --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="name" required
                           value="{{ old('name', $usuario->name ?? '') }}"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required
                           value="{{ old('email', $usuario->email ?? '') }}"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Contraseña --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Contraseña
                        @if(isset($usuario))
                            <span class="text-xs text-gray-400">(dejar vacío para no cambiar)</span>
                        @endif
                    </label>
                    <input type="password" name="password" @if(!isset($usuario)) required @endif
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Confirmación --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                {{-- Rol --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                    <select name="role_id" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">— Seleccione —</option>
                        @foreach ($roles as $id => $nombre)
                            <option value="{{ $id }}"
                                {{ old('role_id', isset($usuario) ? ($usuario->roles->first()->id ?? '') : '') == $id ? 'selected' : '' }}>
                                {{ ucfirst($nombre) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('usuarios.index') }}"
                   class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
