
@extends('barraLateral')
@section('content')
  <div class="row">
      <button type="button" class="btn btn-outline-dark m-3 col-10"><a href="{{ route('registroEstudiante',[$idPsicologoRegistrado]) }}">Registrar estudiante</a></button>
      <button type="button" class="btn btn-outline-dark m-3 col-10"><a href="{{ route('listaConsultas',[$idPsicologoRegistrado]) }}">Ver consultas de estudiante</a></button>
      <button type="button" class="btn btn-outline-dark m-3 col-10"><a href="{{ route('registroReporte',[$idPsicologoRegistrado]) }}">Registrar reportes</a></button>
      <button type="button" class="btn btn-outline-dark m-3 col-10"><a href="{{ route('listaReportes',[$idPsicologoRegistrado]) }}">Ver reportes</a></button>
  </div>
@endsection