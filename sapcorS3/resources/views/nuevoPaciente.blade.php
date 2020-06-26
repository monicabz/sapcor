@extends('barraLateral')
@section('content')
    <h1 style="color: green">Paciente insertado</h4>
    <button type="button" class="btn btn-outline-dark m-3 col-10"><a href="{{ route('registroPaciente.altaPaciente') }}">Insertar nuevo paciente</a></button>
@endsection