@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <h2 class="text-2xl font-bold mb-4">
        Bienvenido al módulo de Planificación – SIPeIP
    </h2>

    <p class="mb-4">Seleccione la opción del menú para comenzar:</p>

    <ul class="list-disc ml-6 text-blue-700">

        {{-- ────────  ADMIN  ──────── --}}
        @role('admin')
            <li><a href="{{ route('instituciones.index') }}">Instituciones</a></li>
            <li><a href="{{ route('proyectos.index')     }}">Proyectos</a></li>
            <li><a href="{{ route('reportes.index')      }}">Reportes</a></li>
            <li><a href="{{ route('usuarios.index')      }}">Usuarios</a></li>
            <li><a href="{{ route('objetivos.index')     }}">Objetivos</a></li>
            <li><a href="{{ route('pnds.index')          }}">PND</a></li>
            <li><a href="{{ route('ods.index')           }}">ODS</a></li>
             <li><a href="{{ route('programas.index')           }}">Programas</a></li>
                <li><a href="{{ route('planes.index')           }}">Planes</a></li>
        @endrole

        {{-- ────────  AUDITOR  ──────── --}}
        @role('auditor')
            <li><a href="{{ route('reportes.index') }}">Reportes</a></li>
            <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
        @endrole

        {{-- ────────  USER  ──────── --}}
        @role('user')
            <li><a href="{{ route('instituciones.index') }}">Instituciones</a></li>
            <li><a href="{{ route('proyectos.index')     }}">Proyectos</a></li>
            <li><a href="{{ route('reportes.index')      }}">Reportes</a></li>
        @endrole
        {{-- ────────  planificador  ──────── --}}
        @role('planificador')
            <li><a href="{{ route('instituciones.index') }}">Instituciones</a></li>
            <li><a href="{{ route('proyectos.index')     }}">Proyectos</a></li>
        @endrole

        {{-- Si más adelante necesitas que otro rol comparta enlaces, 
             usa @hasanyrole('admin|auditor') … @endhasanyrole --}}
    </ul>
@endsection