@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Editar Plan</h2>

<form method="POST" action="{{ route('planes.update', $plan) }}">
  @csrf
  @method('PUT')
  @include('planes._form', ['plan' => $plan])
</form>
@endsection
