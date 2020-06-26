
@extends('barraLateral')
@section('content')
  <div class="row">
      <button type="button" class="btn btn-outline-dark m-3 col-10"><a href="{{ route('listaPacientes',[$idEstudiante]) }}">Ver pacientes disponibles</a></button>
      <button type="button" class="btn btn-outline-dark m-3 col-10"><a href="{{ route('registroConsulta',[$idEstudiante]) }}">Registrar consulta</a></button>
  </div>
@endsection