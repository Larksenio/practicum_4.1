@extends('layouts.app')
@section('content')
<h2 class="text-xl font-bold mb-4">Editar programa</h2>
<form method="POST" action="{{ route('programas.update',$programa) }}">
  @csrf @method('PUT')
  @include('programas._form', ['prog'=>$programa])
</form>
@endsection
