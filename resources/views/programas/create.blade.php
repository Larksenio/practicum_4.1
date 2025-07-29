@extends('layouts.app')
@section('content')
<h2 class="text-xl font-bold mb-4">Crear programa</h2>
<form method="POST" action="{{ route('programas.store') }}">
  @include('programas._form', ['prog'=>null])
</form>
@endsection
