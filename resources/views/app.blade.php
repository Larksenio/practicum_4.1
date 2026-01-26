<!doctype html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', config('app.name'))</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">
  <div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-indigo-950 text-white hidden md:flex flex-col">
      <div class="h-16 flex items-center gap-3 px-6 border-b border-white/10">
        <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center">
          <span class="font-bold">S</span>
        </div>
        <div>
          <div class="font-semibold leading-4">SIPeIP</div>
          <div class="text-xs text-white/70">Planificación</div>
        </div>
      </div>

      <nav class="px-4 py-4 space-y-1 text-sm">
<div class="text-xs text-white/70 px-3 py-2">
  DEBUG Roles: {{ auth()->user()->getRoleNames()->join(', ') }}
</div>


        <a href="{{ route('inicio') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 {{ request()->routeIs('inicio') ? 'bg-white/10' : '' }}">
          <span>🏠</span> <span>Inicio</span>
        </a>

        {{-- ADMIN --}}
        @role('admin')
          <a href="{{ route('instituciones.index') }}" class="side-link">Instituciones</a>
          <a href="{{ route('proyectos.index') }}" class="side-link">Proyectos</a>
          <a href="{{ route('programas.index') }}" class="side-link">Programas</a>
          <a href="{{ route('planes.index') }}" class="side-link">Planes (POA)</a>
          <a href="{{ route('objetivos.index') }}" class="side-link">Objetivos Estratégicos</a>
          <a href="{{ route('pnds.index') }}" class="side-link">PND</a>
          <a href="{{ route('ods.index') }}" class="side-link">ODS</a>
          <a href="{{ route('reportes.index') }}" class="side-link">Reportes</a>
          <a href="{{ route('usuarios.index') }}" class="side-link">Usuarios</a>
        @endrole

        {{-- AUDITOR --}}
        @role('auditor')
          <a href="{{ route('reportes.index') }}" class="side-link">Reportes</a>
          <a href="{{ route('usuarios.index') }}" class="side-link">Usuarios</a>
        @endrole

        {{-- USER --}}
        @role('user')
          <a href="{{ route('instituciones.index') }}" class="side-link">Instituciones</a>
          <a href="{{ route('proyectos.index') }}" class="side-link">Proyectos</a>
          <a href="{{ route('reportes.index') }}" class="side-link">Reportes</a>
        @endrole

      
      </nav>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col min-w-0">

      {{-- TOPBAR --}}
      <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-6">
        <div class="flex items-center gap-3">
          <button class="md:hidden p-2 rounded-lg border border-gray-200">☰</button>
          <span class="text-sm text-gray-600">@yield('title','Inicio')</span>
        </div>

        <div class="flex items-center gap-3">
          <div class="text-right leading-4">
            <div class="text-sm font-semibold">{{ auth()->user()->name ?? 'Usuario' }}</div>
            <div class="text-xs text-gray-500">{{ optional(auth()->user())->getRoleNames()->first() }}</div>
          </div>
          <div class="w-9 h-9 rounded-full bg-gray-200"></div>
        </div>
      </header>

      {{-- CONTENT --}}
      <main class="p-4 md:p-6">
        @yield('content')
      </main>
    </div>

  </div>

  <style>
    .side-link{
      display:flex; gap:.75rem; align-items:center;
      padding:.5rem .75rem; border-radius:.5rem;
      color:rgba(255,255,255,.92);
    }
    .side-link:hover{ background: rgba(255,255,255,.10); }
    .btn-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
    background: #ffffff;
    transition: all .15s ease;
  }

  .btn-icon svg {
    width: 16px;
    height: 16px;
  }

  .btn-edit {
    color: #4f46e5; /* indigo */
  }
  .btn-edit:hover {
    background: #eef2ff;
  }

  .btn-delete {
    color: #dc2626; /* red */
  }
  .btn-delete:hover {
    background: #fee2e2;
  }

  .btn-create {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .45rem .75rem;
    border-radius: .6rem;
    background: #4f46e5;
    color: white;
    font-size: .85rem;
  }
  .btn-create:hover {
    background: #4338ca;
  }
  </style>
</body>
</html>
