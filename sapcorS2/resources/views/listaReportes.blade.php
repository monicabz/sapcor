@extends('barraLateral')
@section('content')
    <h1>Lista de reportes</h1>
    <form method="POST" action="{{ route('listaReportes.ver') }}">
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
                        <th scope="col">Fecha inicio</th>
                        <th scope="col">Fecha fin</th>
                        <th scope="col">Horas reportadas</th>
                        <th scope="col">Programa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reportes as $reporte)
                        <tr>
                            <td class="text-center">{{ $reporte['fechaInicio'] }}</td>
                            <td class="text-center">{{ $reporte['fechaFin'] }}</td>
                            <td class="text-center">{{ $reporte['horasReportadas'] }}</td>
                            @if ($reporte['programa'] == 1 )
                                <td class="text-center">Servicio social</td>
                            @else
                                <td class="text-center">Prácticas profesionales</td>
                            @endif
                            <td class="text-center"></td>
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