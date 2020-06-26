@extends('barraLateral')
@section('content')
    <h1>Registro de enfoque</h1>
    <form method="POST" action="{{ route('nuevoEnfoque.agregar') }}">
        @csrf
        <div class="form-group">
            <label>Nombre del enfoque:</label>
            <input type="text" class="form-control" name="inputNombre">
        </div>
        <button type="submit" class="btn btn-black">Guardar</button>
    </form>
@endsection