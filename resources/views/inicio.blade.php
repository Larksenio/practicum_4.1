@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<main class="space-y-6" role="main" aria-labelledby="page-title">

  {{-- Encabezado de página (estructura clara para lectores de pantalla) --}}
  <header>
    <h1 id="page-title" class="text-2xl font-bold">
      Bienvenido – SIPeIP
    </h1>
    <p class="text-sm text-gray-500">
      Resumen y accesos rápidos según tu rol.
    </p>
  </header>

  {{-- KPIs: usar sección + lista semántica --}}
  <section aria-labelledby="kpi-title">
    <h2 id="kpi-title" class="sr-only">Indicadores generales</h2>

    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" role="list">
      @php
        $kpis = [
          ['label' => 'Instituciones', 'value' => $kpiInstituciones, 'desc' => 'Registradas en el sistema'],
          ['label' => 'Usuarios', 'value' => $kpiUsuarios, 'desc' => 'Activos / gestionados'],
          ['label' => 'Proyectos', 'value' => $kpiProyectos, 'desc' => 'En cartera institucional'],
          ['label' => 'Programas', 'value' => $kpiProgramas, 'desc' => 'Registrados'],
          ['label' => 'Planes (POA)', 'value' => $kpiPlanes, 'desc' => 'Registrados'],
          ['label' => 'Objetivos', 'value' => $kpiObjetivos, 'desc' => 'Estratégicos'],
          ['label' => 'PND', 'value' => $kpiPnd, 'desc' => 'Registrados'],
          ['label' => 'ODS', 'value' => $kpiOds, 'desc' => 'Registrados'],
        ];
      @endphp

      @foreach ($kpis as $kpi)
        <li class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
          <article aria-label="Indicador: {{ $kpi['label'] }}">
            <p class="text-sm text-gray-500">{{ $kpi['label'] }}</p>

            {{-- El número es lo más importante: lo marcamos como "status" para anunciar cambios si se actualiza --}}
            <p class="text-3xl font-bold mt-1" aria-live="polite">
              {{ $kpi['value'] }}
            </p>

            <p class="text-xs text-gray-500 mt-2">{{ $kpi['desc'] }}</p>
          </article>
        </li>
      @endforeach
    </ul>
  </section>

  {{-- Contenido principal en dos columnas --}}
  <section class="grid grid-cols-1 lg:grid-cols-3 gap-4" aria-label="Resumen de planificación y accesos rápidos">

    {{-- Seguimiento --}}
    <article class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl p-6 shadow-sm"
             aria-labelledby="seguimiento-title">
      <header class="flex items-center justify-between mb-4">
        <h2 id="seguimiento-title" class="font-semibold">Seguimiento de planificación</h2>

        {{-- <time> semántico --}}
        <p class="text-xs text-gray-500">
          Corte:
          <time datetime="{{ now()->toDateString() }}">
            {{ now()->format('d/m/Y') }}
          </time>
        </p>
      </header>

      <p class="text-sm text-gray-600 mb-4">
        Las metas se están cumpliendo conforme a la planificación definida.
      </p>

      {{-- Progreso accesible: usar role=progressbar y aria-valuenow --}}
      @php
        $progress = [
          ['label' => 'Actividades en revisión', 'value' => 65],
          ['label' => 'Actividades aprobadas', 'value' => 48],
          ['label' => 'Actividades finalizadas', 'value' => 32],
        ];
      @endphp

      <div class="space-y-4" role="group" aria-label="Indicadores de avance">
        @foreach($progress as $p)
          <div>
            <div class="flex justify-between text-xs text-gray-500 mb-1">
              <span id="lbl-{{ Str::slug($p['label']) }}">{{ $p['label'] }}</span>
              <span aria-hidden="true">{{ $p['value'] }}%</span>
            </div>

            <div class="h-2 bg-gray-100 rounded-full"
                 role="progressbar"
                 aria-labelledby="lbl-{{ Str::slug($p['label']) }}"
                 aria-valuenow="{{ $p['value'] }}"
                 aria-valuemin="0"
                 aria-valuemax="100">
              <div class="h-2 rounded-full" style="width: {{ $p['value'] }}%"
                   aria-hidden="true"></div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Nota accesible para usuarios sin visión --}}
      <p class="sr-only">
        Los porcentajes de avance se presentan como barras de progreso con valores numéricos.
      </p>
    </article>

    {{-- Accesos rápidos --}}
    <nav class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm"
         aria-labelledby="quick-title">
      <h2 id="quick-title" class="font-semibold mb-4">Accesos rápidos</h2>

      {{-- Si no hay enlaces por rol, mostramos un mensaje (evita bloque vacío para lectores de pantalla) --}}
      @php $hasLinks = false; @endphp

      <ul class="space-y-2" role="list">
        @role('admin')
          @php $hasLinks = true; @endphp
          <li><a class="quick" href="{{ route('instituciones.index') }}">Instituciones</a></li>
          <li><a class="quick" href="{{ route('proyectos.index') }}">Proyectos</a></li>
          <li><a class="quick" href="{{ route('planes.index') }}">Planes (POA)</a></li>
          <li><a class="quick" href="{{ route('usuarios.index') }}">Usuarios</a></li>
          <li><a class="quick" href="{{ route('reportes.index') }}">Reportes</a></li>
        @endrole

        @role('planificador')
          @php $hasLinks = true; @endphp
          <li><a class="quick" href="{{ route('instituciones.index') }}">Instituciones</a></li>
          <li><a class="quick" href="{{ route('proyectos.index') }}">Proyectos</a></li>
          <li><a class="quick" href="{{ route('planes.index') }}">Planes (POA)</a></li>
          <li><a class="quick" href="{{ route('programas.index') }}">Programas</a></li>
          <li><a class="quick" href="{{ route('reportes.index') }}">Reportes</a></li>
        @endrole

        @role('auditor')
          @php $hasLinks = true; @endphp
          <li><a class="quick" href="{{ route('reportes.index') }}">Reportes</a></li>
          <li><a class="quick" href="{{ route('usuarios.index') }}">Usuarios</a></li>
        @endrole
      </ul>

      @if(!$hasLinks)
        <p class="text-sm text-gray-500">
          No tienes accesos rápidos asignados para tu rol.
        </p>
      @endif
    </nav>

  </section>
</main>

{{-- Estilos: separados y con focus visible (teclado) + tamaños relativos --}}
<style>
  .quick{
    display:block;
    padding:.6rem .8rem;
    border:1px solid #e5e7eb;
    border-radius:.75rem;
    background:#f9fafb;
    font-size:0.95rem; /* relativo */
    text-decoration:none;
  }
  .quick:hover{ background:#f3f4f6; }

  /* Accesibilidad teclado: foco visible */
  .quick:focus{
    outline: 3px solid rgba(79, 70, 229, 0.5);
    outline-offset: 2px;
  }
  .quick:focus-visible{
    outline: 3px solid rgba(79, 70, 229, 0.7);
    outline-offset: 2px;
  }
</style>
@endsection
