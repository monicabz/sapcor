<?php

namespace App\Http\DTM;
/*require_once("connection.php");*/
use Illuminate\Http\Request;
use App\Http\DTM\MyConnection;

class transactions
{
    function transaction1($nombre, $primerApellido, $segundoApellido, $semestre, $passwd,$enfoque,$fechaInicio,$horasSumadas, $programa,$estudiante_id, $psicologo_id){
        //tablas estudiante y proceso, ambas en sitio2
        $conS2 = MyConnection::createConnectionS2();

        $query1 = "INSERT INTO estudiante (id, nombre, primerApellido, segundoApellido, semestre, passwd, enfoque_id)
            VALUES (?,?,?,?,?,?,?);";

        $query2 = "INSERT INTO proceso (fechaInicio, horasSumadas, programa, estudiante_id, psicologo_id)
            VALUES (?,?,?,?,?);";

        try{
            $conS2->beginTransaction();

            $stmt = $conS2->prepare($query1);
            $stmt->execute(array(
                $estudiante_id,
                $nombre,
                $primerApellido,
                $segundoApellido,
                $semestre,
                $passwd,
                $enfoque,
            ));

            $stmt = $conS2->prepare($query2);
            $stmt->execute(array(
                $fechaInicio,
                $horasSumadas,
                $programa,
                $estudiante_id,
                $psicologo_id
            ));
            $conS2->commit();

        }catch(Exception $e){
            echo $e->getMessage();
            $conS2->rollBack();
        }
        $conS2 = null;
    }

    function transaction2(){
        //tabla estudiante ->sitio2
        $conS2 = MyConnection::createConnectionS2();

        $obtenerEstudiantes = $conS2->prepare("SELECT estudiante.id, estudiante.nombre, primerApellido, segundoApellido, semestre FROM estudiante WHERE estudiante.id IN (SELECT estudiante_id FROM proceso WHERE fechaFin IS NULL);");

        $obtenerEstudiantes->execute();

        $resultado = $obtenerEstudiantes->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;

    }

    function transaction3($psicologo_id, $nombre, $primerApellido, $segundoApellido,$correo,$telefono,$horaEntrada,$horaSalida,$passwd,$rol,$calle,$numero,$colonia,$codigoPostal){
        //tablas domicilio, psicologo

        $conS3 = MyConnection::createConnectionS3();//domicilio
        $conS2 = MyConnection::createConnectionS2();//psicologo

        //CHECAR DOMICILIO E INSERTAR EN CASO DE SER NECESARIO
        try{
            $conS3->beginTransaction();
            $buscarDomicilio = $conS3->prepare("SELECT id FROM domicilio WHERE calle=? AND numero=? AND colonia=? AND codigoPostal=?");

            $datosDomicilio = array($calle, $numero, $colonia, $codigoPostal);

            $buscarDomicilio->execute($datosDomicilio);

            $domicilioId = -1;

            if($buscarDomicilio->rowCount()>0){
                $domicilioId = $buscarDomicilio->fetch()[0];
            }
            else{
                $insertarDomicilio = $conS3->prepare("INSERT INTO domicilio (calle, numero, colonia, codigoPostal) VALUES (?,?,?,?)");
                $insertarDomicilio->execute($datosDomicilio);
                $buscarDomicilio->execute($datosDomicilio);
                $domicilioId = $buscarDomicilio->fetch()[0];
            }

            //INSERTAR PSICOLOGO

            $datosPsicologo = array($psicologo_id, $nombre, $primerApellido, $segundoApellido,$correo,$telefono, $horaEntrada,$horaSalida,$passwd,$rol,$domicilioId );
            $success = false;
            try{
                $conS2->beginTransaction();
                $insertarPsicologo = $conS2->prepare("INSERT INTO psicologo
                (id,nombre, primerApellido, segundoApellido, correo, telefono, horaEntrada, horaSalida, passwd, rol, domicilio_id)
                VALUES(?,?,?,?,?,?,?,?,?,?,?)");

                $insertarPsicologo->execute($datosPsicologo);
                $conS2->commit();
                $success = true;

            }catch(Exception $e){
                echo $e->getMessage();
                $conS2->rollBack();
            }

            if($success == true){
                $conS3->commit();
            }
            else{
                $conS3->rollBack();
            }

        }catch(Exception $e){
            echo $e->getMessage();
            $conS3->rollBack();
        }
        $conS2 = null;
        $conS3 = null;

    }

    function transaction4($fechaInicio, $horasSumadas, $programa, $estudiante_id, $psicologo_id){
        //tabla proceso, sitio2

        $conS2 = MyConnection::createConnectionS2();

        $datosProceso = array($fechaInicio, $horasSumadas, $programa, $estudiante_id, $psicologo_id);

        try{
            $conS2->beginTransaction();
            $insertarProceso = $conS2->prepare("INSERT INTO proceso (fechaInicio, horasSumadas, programa, estudiante_id, psicologo_id) VALUES (?,?,?,?,?);");

            $insertarProceso->execute(datosProceso());
            $conS2->commit();

        }catch(Exception $e){
            echo $e->getMessage();
            $conS2->rollBack();
        }

    }

    function transaction5($estudiante_id, $programa, $fechaInicio, $fechaFin, $horasReportadas){
        //tablas proceso y reporte, sitio2

        $conS2 = MyConnection::createConnectionS2();
        $datosProceso = array($estudiante_id, $programa);

        try{
            $obtenerProcesoId = $conS2->prepare("SELECT id from proceso WHERE estudiante_id=? and programa = ? and fechaFin is null;");
            $obtenerProcesoId->execute($datosProceso);

            if($obtenerProcesoId->rowCount()>0){
                $procesoId = $obtenerProcesoId->fetch()[0];
                $datosReporte = array($fechaInicio,$fechaFin,$horasReportadas,$procesoId);
                $insertarReporte = $conS2->prepare("INSERT INTO reporte (fechaInicio, fechaFin, horasReportadas, proceso_id) VALUES (?,?,?,?);");
                $insertarReporte->execute($datosReporte);
                $conS2->commit();
            }
            else{
                throw new Exception("No hay un proceso correspondiente");
            }

        }catch(Exception $e){
            echo $e->getMessage();
            $conS2->rollBack();
        }


    }


    function transaction6($estudiante_id){
        $conS2 = MyConnection::createConnectionS2();
        $datosEstudiante = array($estudiante_id);
        $obtenerReportes = $conS2->prepare("SELECT estudiante_id, reporte.fechaInicio, reporte.fechaFin, horasReportadas, programa
            FROM reporte, proceso WHERE estudiante_id=? AND proceso.fechaFin is null AND proceso_id = proceso.id;");

        $obtenerReportes->execute($datosEstudiante);

        return $obtenerReportes->fetchAll();
    }

    function transaction7($datosDomicilio, $datosPaciente, $datosEmpleos, $datosAntecedentes, $datosPadecimientosCronicos, $datosMedicamentos, $datosDrogas, $datosContactos, $nombreEnfoque, $motivo){
        //tabla pacientes, sitio3 y sitio1, empleo en sitio1, antecedente en s1, padecimientocronico s3,paciente_padecimientocronico s1,
            //medicamento s3, paciente_medicamento s1,droga s3,paciente_droga s1, historial s1
            //contacto en sitio2, paciente_contacto en sitio2
        //DatosDomicilio ya es un array
        $conS1 = MyConnection::createConnectionS1();
        $conS2 = MyConnection::createConnectionS2();
        $conS3 = MyConnection::createConnectionS3();

        $obtenerUltimoId = $conS3->prepare("SELECT IFNULL( MAX( id ) , 0 ) FROM paciente");
        $obtenerUltimoId->execute();
        $nuevoPacienteId =$obtenerUltimoId->fetch()[0]+1;

        try{
            $conS1->beginTransaction();
            $conS2->beginTransaction();
            $conS3->beginTransaction();
            $buscarDomicilio = $conS3->prepare("SELECT id FROM domicilio WHERE calle=? AND numero=? AND colonia=? AND codigoPostal=?");
            $buscarDomicilio->execute($datosDomicilio);
            $domicilioId = -1;
            if($buscarDomicilio->rowCount()>0){
                $domicilioId = $buscarDomicilio->fetch()[0];
            }
            else{
                $insertarDomicilio = $conS3->prepare("INSERT INTO domicilio (calle, numero, colonia, codigoPostal) VALUES (?,?,?,?)");
                $insertarDomicilio->execute($datosDomicilio);
                $buscarDomicilio->execute($datosDomicilio);
                $domicilioId = $buscarDomicilio->fetch()[0];
            }

            array_push($datosPaciente, $domicilioId, $nuevoPacienteId);

            $insertarPacienteS3 = $conS3->prepare("INSERT INTO paciente (nombre, primerApellido, segundoApellido, fechaNacimiento, primerContacto, estudios, necesidadEspecial, activo, domicilio_id, id)
                VALUES(?,?,?,?,?,?,?,?,?,?)");
            $insertarPacienteS3->execute($datosPaciente);

            $insertarPacienteS1 = $conS1->prepare("INSERT INTO paciente (nombre, primerApellido, segundoApellido, fechaNacimiento, primerContacto, estudios, necesidadEspecial, activo, domicilio_id, id)
            VALUES(?,?,?,?,?,?,?,?,?,?)");
            $insertarPacienteS1->execute($datosPaciente);

            foreach($datosEmpleos as &$datosEmpleo){
                array_push($datosEmpleo, $nuevoPacienteId);
                $insertarEmpleo = $conS1->prepare("INSERT INTO empleo (puesto, lugar, horarioEntrada, horarioSalida, paciente_id) VALUES(?,?,?,?,?)");
                $insertarEmpleo->execute($datosEmpleo);
            }

            foreach($datosAntecedentes as &$datosAntedecente){
                array_push($datosAntecedente, $nuevoPacienteId);
                $insertarAntecedente = $conS1->prepare("INSERT INTO antecedente (motivo, paciente_id) VALUES(?,?)");
                $insertarAntecedente->execute($datosAntecedente);
            }

            foreach($datosPadecimientosCronicos as &$datosPadecimientoCronico){
                $insertarPadecimiento = $conS3->prepare("INSERT INTO padecimientocronico (nombre) SELECT * FROM (SELECT :nombrePadecimiento) AS tmp
                WHERE NOT EXISTS (SELECT nombre FROM padecimientocronico WHERE nombre = :nombrePadecimiento) LIMIT 1;");
                $insertarPadecimiento->execute(array(':nombrePadecimiento' => $datosPadecimientoCronico[0]));

                $buscarPadecimiento = $conS3->prepare("SELECT id FROM padecimientocronico WHERE nombre=:nombrePadecimiento;");
                $buscarPadecimiento->execute(array(':nombrePadecimiento' => $datosPadecimientoCronico[0]));
                $padecimientoId = $buscarPadecimiento->fetch()[0];

                $insertarPacientePadecimiento = $conS1->prepare("INSERT INTO paciente_padecimientocronico (paciente_id, padecimientocronico_id) VALUES (?,?);");
                $insertarPacientePadecimiento->execute(array($nuevoPacienteId, $padecimientoId));
            }

            foreach($datosMedicamentos as &$datosMedicamento){
                //para cada arreglo el indice cero que sea el nombre
                $insertarMedicamento = $conS3->prepare("INSERT INTO medicamento (nombre) SELECT * FROM (SELECT :nombreMedicamento) AS tmp
                WHERE NOT EXISTS (SELECT nombre FROM medicamento WHERE nombre = :nombreMedicamento) LIMIT 1;");
                $insertarMedicamento->execute(array(':nombreMedicamento' => $datosMedicamento[0]));

                $buscarMedicamento = $conS3->prepare("SELECT id FROM medicamento WHERE nombre=:nombreMedicamento;");
                $buscarMedicamento->execute(array(':nombreMedicamento' => $datosMedicamento[0]));
                $medicamentoId = $buscarMedicamento->fetch()[0];

                $insertarPacienteMedicamento = $conS1->prepare("INSERT INTO paciente_medicamento (paciente_id, medicamento_id, fechaInicio, fechaFin, frecuencia, dosis) VALUES (?,?,?,?,?,?)");
                $insertarPacienteMedicamento->execute(array($nuevoPacienteId, $padecimientoId, $datosMedicamento[1], $datosMedicamento[2], $datosMedicamento[3], $datosMedicamento[4]));
            }

            foreach($datosDrogas as &$datosDroga){
                $insertarDroga = $conS3->prepare("INSERT INTO droga (nombre) SELECT * FROM (SELECT :nombreDroga) AS tmp
                WHERE NOT EXISTS (SELECT nombre FROM droga WHERE nombre = :nombreDroga) LIMIT 1;");
                $insertarDroga->execute(array(':nombreDroga' => $datosDroga[0]));

                $buscarDroga = $conS3->prepare("SELECT id FROM droga WHERE nombre=:nombreDroga;");
                $buscarDroga->execute(array(':nombreDroga' => $datosDroga[0]));
                $drogaId = $buscarDroga->fetch()[0];

                $insertarPacienteDroga = $conS1->prepare("INSERT INTO paciente_droga (paciente_id, droga_id, fechaInicio, fechaFin, dosis, frecuencia) VALUES (?,?,?,?,?,?)");
                $insertarPacienteDroga->execute(array($nuevoPacienteId, $drogaId, $datosDroga[1], $datosDroga[2], $datosDroga[3], $datosDroga[4]));
            }


            foreach($datosContactos as &$datosContacto){
                //Cada arreglo que este adentro de datosContacto va a tener tres llaves
                //la primera se llama "datosDomicilio"
                //la segunda se llama "datosContacto"
                //la tercera llave s llama "relacion" y ya no es un arreglo, es una cadena
                $buscarDomicilioContacto = $conS3->prepare("SELECT id FROM domicilio WHERE calle=? AND numero=? AND colonia=? AND codigoPostal=?");
                $buscarDomicilioContacto->execute($datosContacto["datosDomicilio"]);
                $domicilioContactoId = -1;
                if($buscarDomicilioContacto->rowCount()>0){
                    $domicilioContactoId = $buscarDomicilioContacto->fetch()[0];
                }
                else{
                    $insertarDomicilioContacto = $conS3->prepare("INSERT INTO domicilio (calle, numero, colonia, codigoPostal) VALUES (?,?,?,?)");
                    $insertarDomicilioContacto->execute($datosContacto["datosDomicilio"]);
                    $buscarDomicilioContacto->execute($datosContacto["datosDomicilio"]);
                    $domicilioContactoId = $buscarDomicilioContacto->fetch()[0];
                }


                $insertarContacto = $conS2->prepare("INSERT INTO contacto (nombre, primerApellido, segundoApellido, telefono, correo, domicilio_id)
                VALUES(?,?,?,?,?,?)");

                array_push($datosContacto["datosContacto"],$domicilioContactoId);
                $insertarContacto->execute($datosContacto["datosContacto"]);

                $obtenerUltimoIdContacto = $conS2->prepare("SELECT IFNULL( MAX( id ) , 0 ) FROM contacto");
                $obtenerUltimoIdContacto->execute();
                $nuevoContactoId =$obtenerUltimoIdContacto->fetch()[0];

                $insertarPacienteContacto = $conS2->prepare("INSERT INTO paciente_contacto (paciente_id, contacto_id, relacion) VALUES (?,?,?);");
                $insertarPacienteContacto->execute(array($nuevoPacienteId, $nuevoContactoId, $datosContacto["relacion"]));
            }


            $buscarEnfoqueId = $conS3->prepare("SELECT id from enfoque WHERE nombre='$nombreEnfoque'");
            $buscarEnfoqueId->execute();

            $enfoqueId = $buscarEnfoqueId->fetch()[0];


            $insertarHistorial = $conS1->prepare("INSERT INTO historial (motivo, paciente_id, enfoque_id) VALUES (?,?,?);");
            $insertarHistorial->execute(array($motivo, $nuevoPacienteId ,$enfoqueId));


            $conS1->commit();
            $conS2->commit();
            $conS3->commit();

        }catch(Exception $e){
            return $e->getMessage();
            $conS1->rollBack();
            $conS2->rollBack();
            $conS3->rollBack();
        }
    }

    function transaction10(){
        $conS3 = MyConnection::createConnectionS3();

        $obtenerConsultas = $conS3->prepare("SELECT * FROM consulta");
        $obtenerConsultas->execute;
        $result = $obtenerConsultas->fetchAll();
        $sonS3 = null;
        return $result;
    }

    function transaction11($nombreEnfoque){
        //tabla enfoque, en sitios 1 y 3
        $conS1 = MyConnection::createConnectionS1();
        $conS3 = MyConnection::createConnectionS3();
        $datosEnfoque = array($nombreEnfoque);

        try{
            $conS1->beginTransaction();
            $insertarEnfoqueS1 = $conS1->prepare("INSERT INTO enfoque (id,nombre) VALUES ((SELECT IFNULL( MAX( id ) , 0 ) FROM (SELECT * FROM enfoque AS enfoqueAux) AS maxval)+1,?)");
            $insertarEnfoqueS1->execute($datosEnfoque);
            $success = false;
            try{
                $conS3->beginTransaction();
                $insertarEnfoqueS3 = $conS3->prepare("INSERT INTO enfoque (id,nombre) VALUES ((SELECT IFNULL( MAX( id ) , 0 ) FROM (SELECT * FROM enfoque AS enfoqueAux) AS maxval)+1,?)");
                $insertarEnfoqueS3->execute($datosEnfoque);
                $conS3->commit();
                $success=true;

            }catch(Exception $e){
                echo $e->getMessage();
                $conS3->commit();
            }

            if($success == true){
                $conS1->commit();
            }else{
                $conS1->rollBack();
            }

        }catch(Exception $e){
            echo $e->getMessage();
            $conS1->rollBack();
        }

        $conS1 = null;
        $conS3 = null;
    }

    function transaction12(){
        //tablas enfoque y

    }

    function transaction13(){
        //Tablas enfoque en sitio 3 y estudiante en sitio2
        $conS2 = MyConnection::createConnectionS2();
        $conS3 = MyConnection::createConnectionS3();

        $obtenerEstudiantes = $conS2->prepare("SELECT id, nombre AS nombre_estudiante, primerApellido, segundoApellido, semestre,enfoque_id FROM estudiante");
        $obtenerEstudiantes->execute();
        $estudiantes = $obtenerEstudiantes->fetchAll(PDO::FETCH_ASSOC);

        $obtenerEnfoques = $conS3->prepare("SELECT id AS enfoque_id, nombre AS nombre_enfoque FROM enfoque");
        $obtenerEnfoques->execute();
        $enfoques = $obtenerEnfoques->fetchAll(PDO::FETCH_ASSOC);


        foreach($estudiantes as &$estudiante){
            foreach($enfoques as $enfoque){

                if($estudiante["enfoque_id"]===$enfoque["enfoque_id"]){
                    $estudiante["enfoque_nombre"] = $enfoque["nombre_enfoque"];
                }
            }
        }

        print_r($estudiantes);
    }

    function transaction14($psicologo_id){
        $conS2 = MyConnection::createConnectionS2();

        $buscarPasswd = $conS2->prepare("SELECT passwd FROM psicologo WHERE id = ?");
        $buscarPasswd->execute(array($psicologo_id));
        $passwd = $buscarPasswd->fetch()[0];

        return $passwd;

    }

    function transaction15($estudiante_id){
        $conS2 = MyConnection::createConnectionS2();

        $buscarPasswd = $conS2->prepare("SELECT passwd FROM estudiante WHERE id = ?");
        $buscarPasswd->execute(array($estudiante_id));
        $passwd = $buscarPasswd->fetch()[0];
        return $passwd;

    }
}
//transaction1("Carlos alumno", "Aranda", "Ochoa",8,"123",1, date('Y/m/d'),0,1,221560,"CED12345");
//transaction3("CED12348","Monica Psicologa", "Barrios", "Zavala", "monica@psicologos.com", "3968116", "11:30 AM", "3:00 PM", "contra123", 2, "una calle en el barrio de la estacion", 111, "Barrio de la estacion", 20000);
//transaction2();
