<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\DTM\transactions;

class sitio1Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function vistaEnfoque() {
        return view('registroEnfoque');
    }

    public function vistaEstudiante() {
        return view('loginEstudiante');
    }

    public function listaPacientes($idEst) {
        $idEstudiante = $idEst;
        $pacientes = (new transactions)->transaction17();
        $historiales = [];
        return view('listaPacientes', compact('pacientes','idEstudiante','historiales'));
    }

    public function vistaConsulta($idEst) {
        $idEstudiante = $idEst;
        $pacientes = (new transactions)->transaction17();
        return view('registroConsulta', compact('pacientes','idEstudiante'));
    }

    public function listaEstudiantes() {
        $estudiantes = (new transactions)->transaction2();
        return view('listaEstudiantes', compact('estudiantes'));
    }

    public function vistaMenu($idEst) {
        $idEstudiante = $idEst;
        return view('vistaMenu', compact('idEstudiante'));
    }

    public function agregaEnfoque(Request $request) {
        $nombreEnfoque = $request->get('inputNombre');

        $resultado = (new transactions)->transaction11($nombreEnfoque);
        return redirect()->route('nuevoEnfoque');
    }

    public function loginEstudiante(Request $request) {
        request()->validate([
            'inputID' => ['required','numeric'],
            'inputPasswd' => ['required','max:15']
        ], [
            'inputID.numeric' => 'El ID debe de ser numérico',
            'inputPasswd.max' => 'La contraseña debe ser menor a 15 caracteres'
        ]);

        $estudiante_id = $request->get('inputID');
        $resultado = (new transactions)->transaction15($estudiante_id);
        if( $resultado == $request->get('inputPasswd')) {
            return redirect()->route('vistaMenu',[$estudiante_id]);
        }
        else {
            return "diferentes".$request->get('inputPasswd').$resultado;
        }
    }

    public function verHistorial(Request $request) {
        $paciente_id = $request->get('inputPaciente');
        $pacientes = (new transactions)->transaction17();

        $historiales = (new transactions)->transaction8($paciente_id);
        return view('listaPacientes', compact('historiales','pacientes'));
    }

    public function agregaConsulta(Request $request) {
        $estudiante_id = $request->get('inputEstudiante');
        $fecha = $request->get('inputFecha');
        $hora = $request->get('inputHora');
        $notas = $request->get('inputNotas');
        $paciente_id = $request->get('inputPaciente');
        $datosConsulta = array($hora,  date("Y-m-d", strtotime($fecha)), $notas, $estudiante_id, $paciente_id);

        $resultado = (new transactions)->transaction9($datosConsulta);
        return redirect()->route('vistaMenu',[$estudiante_id]);
    }
}
