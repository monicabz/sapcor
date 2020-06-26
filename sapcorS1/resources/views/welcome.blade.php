@extends('barraLateral')
@section('content')
    <div class="row col-12">
        <button type="button" class="btn btn-outline-dark my-3 col-4" id="buttonInicio1"><a href="{{ route('estudiante') }}">Estudiantes</a></button>
        <button type="button" class="btn btn-outline-dark my-3 col-4" id="buttonInicio"><a href="{{ route('nuevoEnfoque') }}">Agregar enfoque</a></button>
        <button type="button" class="btn btn-outline-dark my-3 col-4" id="buttonInicio2"><a href="{{ route('listaEstudiantes') }}">Estudiantes en el programa</a></button>
    </div>
@endsection