@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Crear institución</h2>

<form method="POST" action="{{ route('instituciones.store') }}">
  @include('instituciones._form', ['inst' => null])
</form>
@endsection