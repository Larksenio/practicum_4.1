<form action="{{ route('pnds.update',$pnd) }}" method="POST">
    @csrf @method('PUT')
    {{-- y rellena value="{{ old('nombre', $pnd->nombre) }}" --}}
</form>