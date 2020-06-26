<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\DTM\transactions;

class sitio3Controller extends Controller
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

    public function vistaPaciente() {
        return view('registroPaciente');
    }

    public function vistaNuevoPaciente() {
        return view('nuevoPaciente');
    }

    public function login(Request $request) {
        request()->validate([
            'inputID' => ['required'],
            'inputPasswd' => ['required','max:15']
        ], [
            'inputPasswd.max' => 'La contraseña debe ser menor a 15 caracteres'
        ]);

        $idP = $request->get('inputID');
        $resultado = (new transactions)->transaction14($idP);
        if( $resultado == $request->get('inputPasswd')) {
            return redirect()->route('registroPaciente');
        }
        else {
            return "diferentes".$request->get('inputPasswd').$resultado;
        }
    }

    public function altaPaciente(Request $request) {
        /*request()->validate([
            'inputNombre' => ['required'],
            'inputPrimerApe' => ['required'],
            'inputSegundoApe',
            'inputFchaNac' => ['required'],
            'inputPrimerCont' => ['required'],
            'inputEstudios' => ['required'],
            'inputNecesidad',
            'inputCalle' => ['required'],
            'inputNumero' => ['required', 'numeric'],
            'inputColonia' => ['required'],
            'inputCP' => ['required', 'numeric'],
            'inputLugar',
            'inputPuesto',
            'inputHE',
            'inputHS',
            'inputAtecedente',
            'inputEnfC',
            'inputMed',
            'inputFIMed',
            'inputFFMed',
            'inputDosisMed',
            'inputFrecMed',
            'inputDroga',
            'inputFIDroga',
            'inputFFDroga',
            'inputDosisDroga',
            'inputFrecDroga',
            'inputNombreC' => ['required'],
            'inputPrimerApeC' => ['required'],
            'inputSegundoApeC',
            'inputTelC' => ['required', 'numeric'],
            'inputCorreoC' => ['required'],
            'inputCalleC' => ['required'],
            'inputNumeroC' => ['required', 'numeric'],
            'inputColoniaC' => ['required'],
            'inputCPC' => ['required', 'numeric'],
            'inputRelC' => ['required'],
            'inputMotivos' => ['required'],
            'inputEnfoque' => ['required']
        ]);*/

        $nombrePaciente = $request->get('inputNombre');
        $primerApellidoPaciente = $request->get('inputPrimerApe');
        $segundoApellidoPaciente = $request->get('inputSegundoApe');
        $fechaNacimiento = $request->get('inputFchaNac');
        $primerContacto = $request->get('inputPrimerCont');
        $estudios = $request->get('inputEstudios');
        $necesidadEspecial = $request->get('inputNecesidad');
        $callePaciente = $request->get('inputCalle');
        $numeroPaciente = $request->get('inputNumero');
        $coloniaPaciente = $request->get('inputColonia');
        $codigoPostalPaciente = $request->get('inputCP');
        $lugarTrabajo = $request->get('inputLugar');
        $puestoTrabajo = $request->get('inputPuesto');
        $horaEntrada = $request->get('inputHE');
        $horaSalida = $request->get('inputHS');
        $motivoAntecedente = $request->get('inputAtecedente');
        $enfermedadCronica = $request->get('inputEnfC');
        $medicamento = $request->get('inputMed');
        $fechaInicioMedicina = $request->get('inputFIMed');
        $fechaFinMedicina = $request->get('inputFFMed');
        $dosisMedicina = $request->get('inputDosisMed');
        $frecuenciaMedicina = $request->get('inputFrecMed');
        $droga = $request->get('inputDroga');
        $fechaInicioDroga = $request->get('inputFIDroga');
        $fechaFinDroga = $request->get('inputFFDroga');
        $dosisDroga = $request->get('inputDosisDroga');
        $frecuenciaDroga = $request->get('inputFrecDroga');
        $nombreContacto = $request->get('inputNombreC');
        $primerApellidoContacto = $request->get('inputPrimerApeC');
        $segundoApellidoContacto = $request->get('inputSegundoApeC');
        $telefono = $request->get('inputTelC');
        $correo = $request->get('inputCorreoC');
        $calleContacto = $request->get('inputCalleC');
        $numeroContacto = $request->get('inputNumeroC');
        $coloniaContacto = $request->get('inputColoniaC');
        $codigoPostalContacto = $request->get('inputCPC');
        $relacionContacto = $request->get('inputRelC');
        $motivo = $request->get('inputMotivos');
        $enfoque = $request->get('inputEnfoque');
        $activo = 1;

        $datosDomicilio = array($callePaciente, $numeroPaciente, $coloniaPaciente, $codigoPostalPaciente);
        $datosPaciente = array($nombrePaciente, $primerApellidoPaciente, $segundoApellidoPaciente, date("Y-m-d", strtotime($fechaNacimiento)), $primerContacto, $estudios, $necesidadEspecial, $activo);
        $datosEmpleos = array();
        $datosAntecedentes = array();
        $datosPadecimientosCronicos = array(array($enfermedadCronica));
        $datosMedicamentos = array(array($medicamento, $fechaInicioMedicina, $fechaFinMedicina, $frecuenciaMedicina, $dosisMedicina));
        $datosDrogas = array();
        $datosContactos = array(
            array(
                "datosDomicilio" => array($calleContacto, $numeroContacto, $coloniaContacto, $codigoPostalContacto),
                "datosContacto" => array($nombreContacto, $primerApellidoContacto, $segundoApellidoContacto, $telefono, $correo),
                "relacion" => $relacionContacto
            )
        );
        $nombreEnfoque = $enfoque;

        $resultado = (new transactions)->transaction7($datosDomicilio, $datosPaciente, $datosEmpleos, $datosAntecedentes, $datosPadecimientosCronicos, $datosMedicamentos, $datosDrogas, $datosContactos, $nombreEnfoque, $motivo);
        return redirect()->route('nuevoPaciente');
    }
}
