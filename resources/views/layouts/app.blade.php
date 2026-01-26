<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?? 'es') }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', config('app.name'))</title>

  {{-- Tailwind / Vite --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">
  {{-- Skip link (accesibilidad teclado) --}}
  <a href="#main-content" class="skip-link">Saltar al contenido principal</a>

  <div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside
      id="app-sidebar"
      class="w-64 bg-indigo-950 text-white hidden md:flex flex-col"
      aria-label="Menú principal"
    >
      <div class="h-16 flex items-center gap-3 px-6 border-b border-white/10">
        <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center" aria-hidden="true">
          <span class="font-bold">S</span>
        </div>
        <div>
          <div class="font-semibold leading-4">SIPeIP</div>
          <div class="text-xs text-white/70">Planificación</div>
        </div>
      </div>

      <nav class="px-4 py-4 space-y-1 text-sm" aria-label="Navegación">
        {{-- INICIO --}}
        <a
          href="{{ route('inicio') }}"
          class="side-link {{ request()->routeIs('inicio') ? 'bg-white/10' : '' }}"
          @if(request()->routeIs('inicio')) aria-current="page" @endif
        >
          <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 10.5L12 3l9 7.5" />
            <path d="M5 10v10h14V10" />
            <path d="M9 20v-6h6v6" />
          </svg>
          <span>Inicio</span>
        </a>

        {{-- ADMIN --}}
        @role('admin')
          <a
            href="{{ route('instituciones.index') }}"
            class="side-link {{ request()->routeIs('instituciones.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('instituciones.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 21h18" /><path d="M5 21V7l7-4 7 4v14" /><path d="M9 21v-6h6v6" />
            </svg>
            <span>Instituciones</span>
          </a>

          <a
            href="{{ route('proyectos.index') }}"
            class="side-link {{ request()->routeIs('proyectos.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('proyectos.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 7h18" /><path d="M3 7l2 14h14l2-14" /><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
            </svg>
            <span>Proyectos</span>
          </a>

          <a
            href="{{ route('programas.index') }}"
            class="side-link {{ request()->routeIs('programas.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('programas.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 6h16" /><path d="M4 12h16" /><path d="M4 18h16" />
            </svg>
            <span>Programas</span>
          </a>

          <a
            href="{{ route('planes.index') }}"
            class="side-link {{ request()->routeIs('planes.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('planes.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M8 6h13" /><path d="M8 12h13" /><path d="M8 18h13" /><path d="M3 6h.01" /><path d="M3 12h.01" /><path d="M3 18h.01" />
            </svg>
            <span>Planes (POA)</span>
          </a>

          <a
            href="{{ route('objetivos.index') }}"
            class="side-link {{ request()->routeIs('objetivos.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('objetivos.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 20V10" /><path d="M18 20V4" /><path d="M6 20v-6" />
            </svg>
            <span>Objetivos Estratégicos</span>
          </a>

          <a
            href="{{ route('pnds.index') }}"
            class="side-link {{ request()->routeIs('pnds.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('pnds.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 4h16v16H4z" /><path d="M8 8h8" /><path d="M8 12h8" /><path d="M8 16h5" />
            </svg>
            <span>PND</span>
          </a>

          <a
            href="{{ route('ods.index') }}"
            class="side-link {{ request()->routeIs('ods.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('ods.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 3v18" /><path d="M3 12h18" /><path d="M6 6l12 12" /><path d="M18 6L6 18" />
            </svg>
            <span>ODS</span>
          </a>

          <a
            href="{{ route('reportes.index') }}"
            class="side-link {{ request()->routeIs('reportes.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('reportes.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 19V5" /><path d="M8 19V9" /><path d="M12 19v-4" /><path d="M16 19V7" /><path d="M20 19V11" />
            </svg>
            <span>Reportes</span>
          </a>

          <a
            href="{{ route('usuarios.index') }}"
            class="side-link {{ request()->routeIs('usuarios.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('usuarios.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            <span>Usuarios</span>
          </a>
        @endrole

        {{-- PLANIFICADOR --}}
        @php $roles = auth()->user()->getRoleNames(); @endphp
        @if($roles->contains('planificador'))
          <a
            href="{{ route('instituciones.index') }}"
            class="side-link {{ request()->routeIs('instituciones.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('instituciones.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 21h18" /><path d="M5 21V7l7-4 7 4v14" /><path d="M9 21v-6h6v6" />
            </svg>
            <span>Instituciones</span>
          </a>

          <a
            href="{{ route('proyectos.index') }}"
            class="side-link {{ request()->routeIs('proyectos.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('proyectos.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 7h18" /><path d="M3 7l2 14h14l2-14" /><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
            </svg>
            <span>Proyectos</span>
          </a>

          <a
            href="{{ route('programas.index') }}"
            class="side-link {{ request()->routeIs('programas.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('programas.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 6h16" /><path d="M4 12h16" /><path d="M4 18h16" />
            </svg>
            <span>Programas</span>
          </a>

          <a
            href="{{ route('planes.index') }}"
            class="side-link {{ request()->routeIs('planes.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('planes.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M8 6h13" /><path d="M8 12h13" /><path d="M8 18h13" /><path d="M3 6h.01" /><path d="M3 12h.01" /><path d="M3 18h.01" />
            </svg>
            <span>Planes (POA)</span>
          </a>

          <a
            href="{{ route('reportes.index') }}"
            class="side-link {{ request()->routeIs('reportes.*') ? 'bg-white/10' : '' }}"
            @if(request()->routeIs('reportes.*')) aria-current="page" @endif
          >
            <svg class="side-ico" aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 19V5" /><path d="M8 19V9" /><path d="M12 19v-4" /><path d="M16 19V7" /><path d="M20 19V11" />
            </svg>
            <span>Reportes</span>
          </a>
        @endif
      </nav>
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 flex flex-col min-w-0">

      {{-- TOPBAR --}}
      <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-6">
        <div class="flex items-center gap-3">
          {{-- Botón real (teclado + lectores de pantalla) --}}
          <button
            type="button"
            class="md:hidden p-2 rounded-lg border border-gray-200 btn-menu"
            aria-controls="app-sidebar"
            aria-expanded="false"
          >
            <span class="sr-only">Abrir menú</span>
            <span aria-hidden="true">☰</span>
          </button>

          <span class="text-sm text-gray-600" aria-live="polite">
            @yield('title','Inicio')
          </span>
        </div>

        {{-- USER MENU --}}
        <details class="relative">
          <summary class="list-none cursor-pointer flex items-center gap-3 select-none" aria-label="Menú de usuario">
            <div class="text-right leading-4">
              <div class="text-sm font-semibold">{{ auth()->user()->name ?? 'Usuario' }}</div>
              <div class="text-xs text-gray-500">{{ optional(auth()->user())->getRoleNames()->first() }}</div>
            </div>
            <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center" aria-hidden="true">
              <span class="text-sm font-semibold text-gray-600">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
              </span>
            </div>
          </summary>

          <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg p-2 z-50" role="menu" aria-label="Opciones de usuario">
            <a href="{{ route('profile.edit') }}"
               class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-100"
               role="menuitem">
              Mi perfil
            </a>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
                      class="w-full text-left px-3 py-2 rounded-lg text-sm hover:bg-gray-100 text-red-600"
                      role="menuitem">
                Cerrar sesión
              </button>
            </form>
          </div>
        </details>
      </header>

      {{-- CONTENT --}}
      <main id="main-content" class="p-4 md:p-6" role="main">
        @yield('content')
      </main>
    </div>

  </div>

  {{-- estilos utilitarios --}}
  <style>
    /* Skip link visible al enfocar */
    .skip-link{
      position:absolute;
      left:-9999px;
      top:auto;
      width:1px;
      height:1px;
      overflow:hidden;
    }
    .skip-link:focus{
      left:1rem;
      top:1rem;
      width:auto;
      height:auto;
      padding:.5rem .75rem;
      background:#111827;
      color:#fff;
      border-radius:.5rem;
      z-index:9999;
      outline:3px solid rgba(255,255,255,.35);
      outline-offset:2px;
    }

    .side-link{
      display:flex;
      align-items:center;
      gap:.75rem;
      padding:.55rem .75rem;
      border-radius:.65rem;
      color:rgba(255,255,255,.92);
      text-decoration:none;
    }
    .side-link:hover{
      background: rgba(255,255,255,.10);
    }
    .side-link:focus-visible{
      outline:3px solid rgba(255,255,255,.45);
      outline-offset:2px;
    }

    /* uniformidad de íconos */
    .side-ico{
      width: 20px;
      height: 20px;
      flex: 0 0 20px;
      opacity: .9;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    /* botones icono existentes */
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
    .btn-edit { color: #4f46e5; }
    .btn-edit:hover { background: #eef2ff; }

    .btn-delete { color: #dc2626; }
    .btn-delete:hover { background: #fee2e2; }

    .btn-create {
      display: inline-flex;
      align-items: center;
      gap: .4rem;
      padding: .45rem .75rem;
      border-radius: .6rem;
      background: #4f46e5;
      color: white;
      font-size: .85rem;
      text-decoration:none;
    }
    .btn-create:hover { background: #4338ca; }

    /* foco visible para el botón del menú */
    .btn-menu:focus-visible{
      outline: 3px solid rgba(79, 70, 229, 0.45);
      outline-offset: 2px;
    }
  </style>
</body>
</html>
