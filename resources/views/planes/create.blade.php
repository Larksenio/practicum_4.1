@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Crear Plan</h2>

<form method="POST" action="{{ route('planes.store') }}">
  @include('planes._form', ['plan' => null])
</form>
@endsection
