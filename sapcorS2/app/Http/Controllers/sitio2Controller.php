<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\DTM\transactions;

class sitio2Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $idPsicologoRegistrado = '';
    public function __invoke(Request $request)
    {
        //
    }

    public function vistaMenu($idPsi) {
        $idPsicologoRegistrado = $idPsi;
        return view('vistaMenuS2', compact('idPsicologoRegistrado'));
    }

    public function registroEstudiante($idPsi) {
        $idPsicologoRegistrado = $idPsi;
        $especialidades = (new transactions)->transaction16();
        return view('registroEstudiante', compact('especialidades','idPsicologoRegistrado'));
    }

    public function registroReporte($idPsi) {
        $idPsicologoRegistrado = $idPsi;
        $estudiantes = (new transactions)->transaction2();
        return view('registroReporte', compact('estudiantes','idPsicologoRegistrado'));
    }

    public function listaReportes($idPsi) {
        $idPsicologoRegistrado = $idPsi;
        $estudiantes = (new transactions)->transaction2();
        $reportes = [];
        return view('listaReportes', compact('estudiantes','idPsicologoRegistrado','reportes'));
    }

    public function listaConsultas($idPsi) {
        $idPsicologoRegistrado = $idPsi;
        $estudiantes = (new transactions)->transaction2();
        $consultas = [];
        return view('listaConsultas', compact('estudiantes','idPsicologoRegistrado','consultas'));
    }

    public function login(Request $request) {

        request()->validate([
            'inputID' => ['required','numeric'],
            'inputPasswd' => ['required','max:15']
        ], [
            'inputID.numeric' => 'El ID debe de ser numérico',
            'inputPasswd.max' => 'La contraseña debe ser menor a 15 caracteres'
        ]);

        $idP = $request->get('inputID');
        $resultado = (new transactions)->transaction14($idP);
        if( $resultado == $request->get('inputPasswd')) {
            return redirect()->route('vistaMenu',[$idP]);
        }
        else {
            return "diferentes".$request->get('inputPasswd').$resultado;
        }
    }

    public function altaEstudiante(Request $request) {
        $id = $request->get('inputID');
        $nombre = $request->get('inputNombre');
        $primerApellido = $request->get('inputPrimerApe');
        $segundoApellido = $request->get('inputSegundoApe');
        $semestre = $request->get('inputSemestre');
        $enfoque = $request->get('inputEnfoque');
        $passwd = $request->get('inputPasswd');
        $fechaInicio = date("Y-m-d");
        $programa = $request->get('inputPrograma');
        $psicologo_id = $request->get('inputPsicologo');

        $resultado = (new transactions)->transaction1($nombre, $primerApellido, $segundoApellido, $semestre, $passwd,$enfoque,$fechaInicio, 0, $programa,$id, $psicologo_id);
        return redirect()->route('vistaMenu',[$psicologo_id]);
    }

    public function altaReporte(Request $request) {
        $estudiante_id = $request->get('inputEstudiante');
        $programa = $request->get('inputPrograma');
        $fechaInicio = $request->get('inputFechaInicio');
        $fechaFin = $request->get('inputFechaFin');
        $horasReportadas = $request->get('inputHoras');
        $psicologo_id = $request->get('inputPsicologo');

        $resultado = (new transactions)->transaction5($estudiante_id, $programa, date("Y-m-d", strtotime($fechaInicio)), date("Y-m-d", strtotime($fechaFin)), $horasReportadas);
        return redirect()->route('vistaMenu',[$psicologo_id]);
    }

    public function verListaReportes(Request $request) {
        $estudiante_id = $request->get('inputEstudiante');
        $idPsicologoRegistrado = $request->get('inputPsicologo');

        $reportes = (new transactions)->transaction6($estudiante_id);
        $estudiantes = (new transactions)->transaction2();
        return view('listaReportes', compact('estudiantes','idPsicologoRegistrado','reportes'));
    }

    public function verListaConsultas(Request $request) {
        $idPsicologoRegistrado = $request->get('inputPsicologo');

        $consultas = (new transactions)->transaction10();
        $estudiantes = (new transactions)->transaction2();
        return view('listaConsultas', compact('estudiantes','idPsicologoRegistrado','consultas'));
    }
}
