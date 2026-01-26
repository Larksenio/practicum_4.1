@extends('layouts.app')

@section('title', 'Nuevo usuario')

@section('content')
<div class="max-w-4xl mx-auto py-8">

  <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
    <div class="mb-6">
      <h1 class="text-xl font-semibold text-gray-900">Nuevo usuario</h1>
      <p class="text-sm text-gray-500">Completa la información del usuario y guarda los cambios.</p>
    </div>

    {{-- Errores --}}
    @if ($errors->any())
      <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Nombre --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
          <input type="text"
                 name="name"
                 required
                 value="{{ old('name') }}"
                 class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        {{-- Email --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
          <input type="email"
                 name="email"
                 required
                 value="{{ old('email') }}"
                 class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        {{-- Contraseña --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
          <input type="password"
                 name="password"
                 required
                 class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        {{-- Confirmación --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
          <input type="password"
                 name="password_confirmation"
                 required
                 class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        {{-- Rol --}}
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
          <select name="role_id"
                  required
                  class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">— Seleccione —</option>
            @foreach ($roles as $id => $nombre)
              <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>
                {{ ucfirst($nombre) }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <a href="{{ route('usuarios.index') }}" class="btn-secondary">Cancelar</a>
        <button type="submit" class="btn-primary">Guardar</button>
      </div>
    </form>
  </div>

</div>
@endsection
