<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    {{-- Institución --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Institución</label>
        <select name="institucion_id" required
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">— Seleccione —</option>
            @foreach($instituciones as $id => $nombre)
                <option value="{{ $id }}"
                    {{ (string) old('institucion_id', $prog->institucion_id ?? '') === (string) $id ? 'selected' : '' }}>
                    {{ $nombre }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Nombre --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
        <input type="text" name="nombre" required
               value="{{ old('nombre', $prog->nombre ?? '') }}"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                      focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    {{-- Descripción --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
        <textarea name="descripcion" rows="3"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                         focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  placeholder="Opcional">{{ old('descripcion', $prog->descripcion ?? '') }}</textarea>
    </div>

    {{-- Estado --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
        @php $estado = strtolower(old('estado', $prog->estado ?? 'activo')); @endphp
        <select name="estado" required
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="activo" {{ $estado === 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ $estado === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>

</div>
