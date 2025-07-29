@extends('layouts.app')
@section('content')
<h2 class="text-xl font-bold mb-4">{{ $title }}</h2>
<form method="POST" action="{{ $action }}">
  @isset($method) @method($method) @endisset
  @include('instituciones._form',['inst'=>$institucion??null])
</form>
@endsection

