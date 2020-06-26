@extends('barraLateral')
@section('content')
    <h1>Lista de consultas</h1>
    <form method="POST" action="{{ route('listaConsultas.ver') }}">
        @csrf
        <input value="{{$idPsicologoRegistrado}}" type="hidden" name="inputPsicologo">
        <div class="form-group row">
            <div class="col">
            <label>ID del estudiante:</label>
            <select class="form-control" name="inputEstudiante">
                @forelse ($estudiantes as $estudiante)
                    <option value="{{$estudiante['id']}}">{{ $estudiante['id'] }}</option>
                @empty
                    <option>---</option>
                @endforelse
            </select>
            </div>
        </div>
        <button type="submit" class="btn btn-black">Ver</button>
        <div class="mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Notas</th>
                        <th scope="col">#id Paciente</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($consultas as $consulta)
                        <tr>
                            <th scope="row" class="text-center">{{ $consulta['id'] }}</th>
                            <td class="text-center">{{ $consulta['fecha'] }}</td>
                            <td class="text-center">{{ $consulta['notas'] }}</td>
                            <td class="text-center">{{ $consulta['paciente_id'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">---</th>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>
@endsection