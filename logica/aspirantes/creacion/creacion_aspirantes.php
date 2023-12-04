<?php
require_once('./../../session.php');
require_once("./../../../datos/conex.php");

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);


// GENERAL
$session = $usua;
$fecha = date('Y-m-d');
$estado_paciente = $data['estado_paciente'];
$fecha_activacion = $data['fecha_activacion'];
$correo = $data['correo'];
$remitente = $data['remitente'];
$nombre_paciente = $data['nombre'];
$apellidos_paciente = $data['apellidos'];
$tipo_identificacion = $data['tipo_identificacion'];
$identificacion = $data['identificacion'];
$telefono1 = $data['telefono1'];
$telefono2 = $data['telefono2'] <= 0 ? '0' : $data['telefono2'];
$telefono3 = $data['telefono3'] <= 0 ? '0' : $data['telefono3'];
$telefono4 = $data['telefono4'] <= 0 ? '0' : $data['telefono4'];
$departamento = $data['departamento'];
$ciudad = $data['ciudad'];
//todo: se agregaron campos para la tabla de aspirante los cuales fueron: Barrio, Genero, y Edad
$barrio = $data['barrio'];
$genero = $data['genero'];
$edad = $data['edad'];
$pais = $data['pais'];
$regimen = $data['regimen'];
$especialidad = $data['especialidad'];
$canal_contacto = $data['canal_contacto'];
$DIRECCION = $data['DIRECCION'];
$acudiente  = $data['acudiente'];
$telefono_acudiente = $data['telefono_acudiente'];

// INFORMACION DE TRATAMIENTO
$fecha_nacimiento = $data['fecha_nacimiento'];
$producto_tratamiento = $data['producto_tratamiento'];
if ($producto_tratamiento == 'JIVI') {
    $Dosis = $data['Dosis2'];
}
if ($producto_tratamiento == 'KOGENATE') {
    $Dosis = $data['Dosis3'];
}
if ($producto_tratamiento == 'KOVALTRY') {
    $Dosis = $data['Dosis2'];
}
if ($producto_tratamiento == 'XOFIGO') {
    $Dosis = $data['Dosis2'];
}
if ($producto_tratamiento != 'XOFIGO' && $producto_tratamiento != 'KOGENATE' && $producto_tratamiento != 'KOVALTRY' && $producto_tratamiento != 'JIVI') {
    $Dosis = $data['Dosis'];
}
$clasificacion_patologica = $data['clasificacion_patologica'];
$consentimiento = $data['consentimiento'];
$asegurador = $data['asegurador'];
$medico_tratante = $data['medico_tratante'];
$fecha_proxima_llamada = $data['fecha_proxima_llamada'];


// NOTAS Y ADJUNTOS
$nota = $data['nota'];

if (
    empty($estado_paciente) ||
    empty($fecha_activacion) ||
    empty($correo) ||
    empty($remitente) ||
    empty($nombre_paciente) ||
    empty($apellidos_paciente) ||
    empty($tipo_identificacion) ||
    empty($identificacion) ||
    empty($telefono1) ||
    empty($DIRECCION) ||
    empty($pais) ||
    empty($acudiente) ||
    empty($telefono_acudiente) ||
    empty($fecha_nacimiento) ||
    empty($producto_tratamiento) ||
    empty($consentimiento) ||
    empty($asegurador) ||
    empty($medico_tratante) ||
    empty($fecha_proxima_llamada) ||
    empty($nota)
) {
    $campos_vacios = array();

    if (empty($estado_paciente)) {
        array_push($campos_vacios, 'Estado paciente');
    }

    if (empty($fecha_activacion)) {
        array_push($campos_vacios, 'Fecha de activación');
    }

    if (empty($correo)) {
        array_push($campos_vacios, 'Correo');
    }

    if (empty($remitente)) {
        array_push($campos_vacios, 'Remitente');
    }

    if (empty($nombre_paciente)) {
        array_push($campos_vacios, 'Nombre paciente');
    }

    if (empty($apellidos_paciente)) {
        array_push($campos_vacios, 'Apellidos paciente');
    }

    if (empty($tipo_identificacion)) {
        array_push($campos_vacios, 'Tipo de identificación');
    }

    if (empty($identificacion)) {
        array_push($campos_vacios, 'Identificación');
    }

    if (empty($telefono1)) {
        array_push($campos_vacios, 'Teléfono 1');
    }

    if (empty($pais)) {
        array_push($campos_vacios, 'Pais');
    }

    if (empty($DIRECCION)) {
        array_push($campos_vacios, 'Dirección');
    }

    if (empty($acudiente)) {
        array_push($campos_vacios, 'Acudiente');
    }

    if (empty($telefono_acudiente)) {
        array_push($campos_vacios, 'Teléfono acudiente');
    }

    if (empty($fecha_nacimiento)) {
        array_push($campos_vacios, 'Fecha de nacimiento');
    }

    if (empty($producto_tratamiento)) {
        array_push($campos_vacios, 'Producto');
    }

    if (empty($consentimiento)) {
        array_push($campos_vacios, 'Consentimiento');
    }

    if (empty($asegurador)) {
        array_push($campos_vacios, 'Asegurador');
    }

    if ($asegurador == 'NO ENCONTRADO') {
        if (empty($asegurador_otro)) {
            if (empty($asegurador_otro)) {
                array_push($campos_vacios, 'Por favor ingrese el asegurador no encontrado en el campo habilitado');
            }
        }
    }

    if (empty($medico_tratante)) {
        array_push($campos_vacios, 'Medico tratante');
    }

    if ($medico_tratante == 'NO ENCONTRADO') {
        if (empty($medico_t_otro)) {
            if (empty($medico_t_otro)) {
                array_push($campos_vacios, 'Por favor ingrese el medico no encontrado en el campo habilitado');
            }
        }
    }

    if (empty($fecha_proxima_llamada)) {
        array_push($campos_vacios, 'Fecha proxima llamada');
    }

    if (empty($nota)) {
        array_push($campos_vacios, 'Nota');
    }

    if (count($campos_vacios) > 0) {
        $mensaje = 'Por favor completa los siguientes campos:';
        $lista = '<ul class="my-3">';
        foreach ($campos_vacios as $campo) {
            $lista .= '<li class="text-start">' . $campo . '</li>';
        }
        $lista .= '</ul>';
        $mensaje .= $lista;
        $response = array(
            'mensaje' => $mensaje,
            'tipo' => 'error',
            'title' => 'Campos vacios'
        );
        echo json_encode($response);
    }
} else {

    if ($asegurador == 'NO ENCONTRADO') {
        $asegurador_otro = $data['asegurador_otro'];
        if ($asegurador_otro != '') {
            $insert_eps = mysqli_query($conex, "INSERT INTO ipsen_asegurador (ASEGURADOR,ESTADO) VALUES ('" . $asegurador_otro . "','OUT')");
        }
    }

    if ($medico_tratante == 'NO ENCONTRADO') {
        $medico_t_otro = $data['medico_t_otro'];
        if ($medico_t_otro != '') {
            $INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_listas (MEDICO,ESTADO) VALUES ('" . $medico_t_otro . "','OUT')");
        }
    }

    //todo: se agregaron campos para la tabla de aspirante los cuales fueron: Barrio, Genero, y Edad
    $sql_general = "INSERT INTO ipsen_aspirantes (ESTADO_PACIENTE, FECHA_ACTIVACION_ASPIRANTE, TIPO_IDENTIFICACION_PACIENTE, IDENTIFICACION_PACIENTE, NOMBRE_PACIENTE, APELLIDO_PACIENTE, TELEFONO_PACIENTE, TELEFONO2_PACIENTE, TELEFONO3_PACIENTE, TELEFONO4_PACIENTE, CORREO_PACIENTE, DIRECCION_PACIENTE, DEPARTAMENTO_PACIENTE, CIUDAD_PACIENTE, BARRIO_PACIENTE, PAIS_PACIENTE, GENERO_PACIENTE, FECHA_NACIMIENTO_PACIENTE, EDAD_PACIENTE, ACUDIENTE_PACIENTE, TELEFONO_ACUDIENTE_PACIENTE, USUARIO_CREACION, REMITENTE)
        VALUES ('$estado_paciente','$fecha_activacion','$tipo_identificacion','$identificacion','$nombre_paciente','$apellidos_paciente','$telefono1','$telefono2','$telefono3','$telefono4','$correo','$DIRECCION','$departamento','$ciudad','$barrio','$pais','$genero','$fecha_nacimiento','$edad','$acudiente','$telefono_acudiente','$session','$remitente')";
    $execution_general = mysqli_query($conex, $sql_general);

    if ($execution_general) {
        $ultimo_id = mysqli_insert_id($conex);
        $sql_aspirantes = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes WHERE ID_ASPIRANTE = '$ultimo_id'");


        while ($row_aspirantes = mysqli_fetch_array($sql_aspirantes)) {
            $ID_ASPIRANTE_FK = $row_aspirantes['ID_ASPIRANTE'];
            $ESTADO_PACIENTE = $row_aspirantes['ESTADO_PACIENTE'];
            $FECHA_ACTIVACION_ASPIRANTE = $row_aspirantes['FECHA_ACTIVACION_ASPIRANTE'];
            $TIPO_IDENTIFICACION_PACIENTE = $row_aspirantes['TIPO_IDENTIFICACION_PACIENTE'];
            $IDENTIFICACION_PACIENTE = $row_aspirantes['IDENTIFICACION_PACIENTE'];
            $NOMBRE_PACIENTE = $row_aspirantes['NOMBRE_PACIENTE'];
            $APELLIDO_PACIENTE = $row_aspirantes['APELLIDO_PACIENTE'];
            $TELEFONO_PACIENTE = $row_aspirantes['TELEFONO_PACIENTE'];
            $TELEFONO2_PACIENTE = $row_aspirantes['TELEFONO2_PACIENTE'];
            $TELEFONO3_PACIENTE = $row_aspirantes['TELEFONO3_PACIENTE'];
            $TELEFONO4_PACIENTE = $row_aspirantes['TELEFONO4_PACIENTE'];
            $CORREO_PACIENTE = $row_aspirantes['CORREO_PACIENTE'];
            $DIRECCION_PACIENTE = $row_aspirantes['DIRECCION_PACIENTE'];
            $DEPARTAMENTO_PACIENTE = $row_aspirantes['DEPARTAMENTO_PACIENTE'];
            $CIUDAD_PACIENTE = $row_aspirantes['CIUDAD_PACIENTE'];
            $PAIS_PACIENTE = $row_aspirantes['PAIS_PACIENTE'];
            $FECHA_NACIMIENTO_PACIENTE = $row_aspirantes['FECHA_NACIMIENTO_PACIENTE'];
            $ACUDIENTE_PACIENTE = $row_aspirantes['ACUDIENTE_PACIENTE'];
            $TELEFONO_ACUDIENTE_PACIENTE = $row_aspirantes['TELEFONO_ACUDIENTE_PACIENTE'];
            $ID_ULTIMA_GESTION = 0;
            $USUARIO_CREACION = $row_aspirantes['USUARIO_CREACION'];
            $REMITENTE = $row_aspirantes['REMITENTE'];
        }

        $sql_tratamiento = "INSERT INTO ipsen_tratamiento_aspirante (PRODUCTO_TRATAMIENTO, DOSIS_TRATAMIENTO, CLASIFICACION_PATOLOGICA_TRATAMIENTO, CONSENTIMIENTO_TRATAMIENTO, REGIMEN_TRATAMIENTO, ASEGURADOR_TRATAMIENTO, MEDICO_TRATAMIENTO, ESPECIALIDAD_TRATAMIENTO, NOTAS_ADJUNTOS_TRATAMIENTO, ID_ASPIRANTE_FK)
        VALUES ('$producto_tratamiento','$Dosis','$clasificacion_patologica','$consentimiento','$regimen','$asegurador','$medico_tratante','$especialidad','$nota','$ID_ASPIRANTE_FK')";
        $execution_tratamiento = mysqli_query($conex, $sql_tratamiento);

        if ($execution_tratamiento) {

            // TERCER NIVEL DE INSERCION

            if ($ESTADO_PACIENTE != "Se ingresa paciente") {
                $sql_gestion = "INSERT INTO ipsen_gestiones_aspirante (MOTIVO_COMUNICACION_GESTION, RECLAMO_GESTION, CAUSA_NO_RECLAMACION_GESTION, FECHA_PROXIMA_LLAMADA, MEDICAMENTOS_GESTION, FECHA_RECLAMACION_GESTION, AUTOR_GESTION, NOTA, DESCRIPCION_COMUNICACION_GESTION, FECHA_PROGRAMADA_GESTION, ID_ASPIRANTE_FK2, FECHA_COMUNICACION, ESTADO_GESTION, CANAL_CONTACTO)
                VALUES ('Ingreso','NO','$estado_paciente','$fecha_proxima_llamada','$producto_tratamiento','','$session','$nota','$nota','$fecha_proxima_llamada','$ID_ASPIRANTE_FK',CURRENT_TIMESTAMP,'','$canal_contacto')";
                $execution_gestion = mysqli_query($conex, $sql_gestion);
            } else {
                $sql_gestion = "INSERT INTO ipsen_gestiones_aspirante (MOTIVO_COMUNICACION_GESTION, RECLAMO_GESTION, CAUSA_NO_RECLAMACION_GESTION, FECHA_PROXIMA_LLAMADA, MEDICAMENTOS_GESTION, FECHA_RECLAMACION_GESTION, AUTOR_GESTION, NOTA, DESCRIPCION_COMUNICACION_GESTION, FECHA_PROGRAMADA_GESTION, ID_ASPIRANTE_FK2, FECHA_COMUNICACION, ESTADO_GESTION, CANAL_CONTACTO)
                VALUES ('Ingreso','SI','','$fecha_proxima_llamada','$producto_tratamiento','$FECHA_ACTIVACION_ASPIRANTE','$session','$nota','$nota','$fecha_proxima_llamada','$ID_ASPIRANTE_FK',CURRENT_TIMESTAMP,'','$canal_contacto')";
                $execution_gestion = mysqli_query($conex, $sql_gestion);
            }

            if ($execution_gestion) {

                // ACTUALIZACION PARA EL ID_ULTIMA_GESTION

                $sql_gestion_id = mysqli_query($conex, "SELECT ID_GESTION FROM ipsen_gestiones_aspirante ORDER BY ID_GESTION DESC LIMIT 1");
                while ($row_gestion_id = mysqli_fetch_array($sql_gestion_id)) {
                    $ID_ULTIMA_GESTION = $row_gestion_id['ID_GESTION'];
                }

                $update_codigo_gestion = "UPDATE ipsen_aspirantes SET ID_ULTIMA_GESTION = '$ID_ULTIMA_GESTION' WHERE ID_ASPIRANTE = '$ID_ASPIRANTE_FK'";
                $execution_update_codigo_gestion = mysqli_query($conex, $update_codigo_gestion);


                if ($ESTADO_PACIENTE == 'Se ingresa paciente' && $execution_update_codigo_gestion) {

                    $sql_insert_paciente = "INSERT INTO ipsen_pacientes (ESTADO_PACIENTE, STATUS_PACIENTE, FECHA_ACTIVACION_PACIENTE, FECHA_RETIRO_PACIENTE, MOTIVO_RETIRO_PACIENTE, OBSERVACION_MOTIVO_RETIRO_PACIENTE, TIPO_IDENTIFICACION_PACIENTE, IDENTIFICACION_PACIENTE, NOMBRE_PACIENTE, APELLIDO_PACIENTE, TELEFONO_PACIENTE, TELEFONO2_PACIENTE, TELEFONO3_PACIENTE, TELEFONO4_PACIENTE, TELEFONO5_PACIENTE, CORREO_PACIENTE, DIRECCION_PACIENTE, BARRIO_PACIENTE, DEPARTAMENTO_PACIENTE, CIUDAD_PACIENTE, PAIS_PACIENTE, GENERO_PACIENTE, FECHA_NACIMINETO_PACIENTE, EDAD_PACIENTE, ACUDIENTE_PACIENTE, TELEFONO_ACUDIENTE_PACIENTE, CODIGO_XOFIGO, ID_ULTIMA_GESTION, ID_ASPIRANTE_FK, USUARIO_CREACION, PROVEEDOR) VALUES ('Proceso','','$fecha','','','','$TIPO_IDENTIFICACION_PACIENTE','$IDENTIFICACION_PACIENTE','$NOMBRE_PACIENTE','$APELLIDO_PACIENTE','$TELEFONO_PACIENTE','$TELEFONO2_PACIENTE','$TELEFONO3_PACIENTE','$TELEFONO4_PACIENTE','0','$CORREO_PACIENTE','$DIRECCION_PACIENTE','$barrio','$DEPARTAMENTO_PACIENTE','$CIUDAD_PACIENTE','$PAIS_PACIENTE','$genero','$FECHA_NACIMIENTO_PACIENTE','$edad','$ACUDIENTE_PACIENTE','$TELEFONO_ACUDIENTE_PACIENTE','0','$ID_ULTIMA_GESTION','$ID_ASPIRANTE_FK','$session','PSP Solutions')";
                    $execute_paciente = mysqli_query($conex, $sql_insert_paciente);

                    if ($execute_paciente) {

                        // SEGUNDO NIVEL DE INSERCION (ASPIRANTE > PACIENTE)

                        $sql_paciente_new = mysqli_query($conex, "SELECT * FROM ipsen_pacientes WHERE ID_ASPIRANTE_FK = '$ID_ASPIRANTE_FK'");
                        while ($row_paciente_new = mysqli_fetch_array($sql_paciente_new)) {
                            $ID_PACIENTE = $row_paciente_new['ID_PACIENTE'];
                        }

                        $update_codigo_pap = "UPDATE ipsen_aspirantes SET ID_PACIENTE_FK = '$ID_PACIENTE' WHERE ID_ASPIRANTE = '$ID_ASPIRANTE_FK'";
                        $execution_update_codigo_pap = mysqli_query($conex, $update_codigo_pap);

                        $sql_tratamiento_aspirante = mysqli_query($conex, "SELECT * FROM ipsen_tratamiento_aspirante WHERE ID_ASPIRANTE_FK = '$ID_ASPIRANTE_FK'");
                        while ($row_tratamiento_aspirantes = mysqli_fetch_array($sql_tratamiento_aspirante)) {
                            $PRODUCTO_TRATAMIENTO = $row_tratamiento_aspirantes['PRODUCTO_TRATAMIENTO'];
                            $DOSIS_TRATAMIENTO = $row_tratamiento_aspirantes['DOSIS_TRATAMIENTO'];
                            $CLASIFICACION_PATOLOGICA_TRATAMIENTO = $row_tratamiento_aspirantes['CLASIFICACION_PATOLOGICA_TRATAMIENTO'];
                            $CONSENTIMIENTO_TRATAMIENTO = $row_tratamiento_aspirantes['CONSENTIMIENTO_TRATAMIENTO'];
                            $REGIMEN_TRATAMIENTO = $row_tratamiento_aspirantes['REGIMEN_TRATAMIENTO'];
                            $ASEGURADOR_TRATAMIENTO = $row_tratamiento_aspirantes['ASEGURADOR_TRATAMIENTO'];
                            $MEDICO_TRATAMIENTO = $row_tratamiento_aspirantes['MEDICO_TRATAMIENTO'];
                            $ESPECIALIDAD_TRATAMIENTO = $row_tratamiento_aspirantes['ESPECIALIDAD_TRATAMIENTO'];
                            $NOTAS_ADJUNTOS_TRATAMIENTO = $row_tratamiento_aspirantes['NOTAS_ADJUNTOS_TRATAMIENTO'];
                        }

                        $sql_insert_tratamiento_paciente = "INSERT INTO ipsen_tratamiento (PRODUCTO_TRATAMIENTO, NOMBRE_REFERENCIA, DOSIS_TRATAMIENTO, FRECUENCIA_MEDICAMENTO, CLASIFICACION_PATOLOGICA_TRATAMIENTO, TRATAMIENTO_PREVIO, CONSENTIMIENTO_TRATAMIENTO, FECHA_INICIO_TERAPIA_TRATAMIENTO, FECHA_PRESCRIPCION, REGIMEN_TRATAMIENTO, ASEGURADOR_TRATAMIENTO, OPERADOR_LOGISTICO_TRATAMIENTO, PUNTO_ENTREGA, FECHA_ULTIMA_RECLAMACION_TRATAMIENTO, OTROS_OPERADORES_TRATAMIENTO, MEDIOS_ADQUISICION_TRATAMIENTO, IPS_ATIENDE_TRATAMIENTO, MEDICO_TRATAMIENTO, MEDICO_PRESCRIPTOR, ESPECIALIDAD_TRATAMIENTO, PARAMEDICO_TRATAMIENTO, ZONA_ATENCION_PARAMEDICO_TRATAMIENTO, CIUDAD_BASE_PARAMEDICO_TRATAMIENTO, NOTAS_ADJUNTOS_TRATAMIENTO, ID_PACIENTE_FK, PAAP, SUB_PAAP, BARRERA, NUM_LOTES_DISPOSITIVOS, FECHA_FORMULACION, CIUDAD_RECLAMACION, VISI_INI_EFEC, PROGRA_VIS_EDU, RESPU_VISI_EFECTI) VALUES ('$PRODUCTO_TRATAMIENTO','$PRODUCTO_TRATAMIENTO','$DOSIS_TRATAMIENTO','','$CLASIFICACION_PATOLOGICA_TRATAMIENTO','','$CONSENTIMIENTO_TRATAMIENTO','0000-00-00','','$regimen','$ASEGURADOR_TRATAMIENTO','','','0000-00-00','','','','$MEDICO_TRATAMIENTO','','$especialidad','','','','$NOTAS_ADJUNTOS_TRATAMIENTO','$ID_PACIENTE','','','','','0000-00-00','','N/A','N/A','N/A')";
                        $execute_tratamiento_paciente = mysqli_query($conex, $sql_insert_tratamiento_paciente);

                        if ($execute_tratamiento_paciente) {

                            // TERCER NIVEL DE INSERCION (ASPIRANTE > PACIENTE)

                            $sql_gestiones_aspirante = mysqli_query($conex, "SELECT * FROM ipsen_gestiones_aspirante WHERE ID_ASPIRANTE_FK2 = '$ID_ASPIRANTE_FK' ORDER BY ID_GESTION DESC LIMIT 1");
                            while ($row_gestiones_aspirantes = mysqli_fetch_array($sql_gestiones_aspirante)) {
                                $MOTIVO_COMUNICACION_GESTION = $row_gestiones_aspirantes['MOTIVO_COMUNICACION_GESTION'];
                                $RECLAMO_GESTION = $row_gestiones_aspirantes['RECLAMO_GESTION'];
                                $CAUSA_NO_RECLAMACION_GESTION = $row_gestiones_aspirantes['CAUSA_NO_RECLAMACION_GESTION'];
                                $FECHA_PROXIMA_LLAMADA = $row_gestiones_aspirantes['FECHA_PROXIMA_LLAMADA'];
                                $MEDICAMENTOS_GESTION = $row_gestiones_aspirantes['MEDICAMENTOS_GESTION'];
                                $FECHA_RECLAMACION_GESTION = $row_gestiones_aspirantes['FECHA_RECLAMACION_GESTION'];
                                $AUTOR_GESTION = $row_gestiones_aspirantes['AUTOR_GESTION'];
                                $NOTA = $row_gestiones_aspirantes['NOTA'];
                                $DESCRIPCION_COMUNICACION_GESTION = $row_gestiones_aspirantes['DESCRIPCION_COMUNICACION_GESTION'];
                                $FECHA_PROGRAMADA_GESTION = $row_gestiones_aspirantes['FECHA_PROGRAMADA_GESTION'];
                                $FECHA_COMUNICACION = $row_gestiones_aspirantes['FECHA_COMUNICACION'];
                                $CANAL_CONTACTO = $row_gestiones_aspirantes['CANAL_CONTACTO'];
                                $ESTADO_GESTION = $row_gestiones_aspirantes['ESTADO_GESTION'];
                            }

                            $sql_insert_gestiones_paciente = "INSERT INTO ipsen_gestiones (MOTIVO_COMUNICACION_GESTION, MEDIO_CONTACTO_GESTION, TIPO_LLAMADA_GESTION, LOGRO_COMUNICACION_GESTION, MOTIVO_NO_COMUNICACION_GESTION, NUMERO_INTENTOS_GESTION, ESPERADO_GESTION, ESTADO_CTC_GESTION, FECHA_AUTORIZACION, ESTADO_FARMACIA_GESTION, RECLAMO_GESTION, APLICACION, CONSECUTIVO_BETAFERON, CAUSA_NO_RECLAMACION_GESTION, DIFICULTAD_ACCESO_GESTION, TIPO_DIFICULTAD_GESTION, ENVIOS_GESTION, MEDICAMENTOS_GESTION, TIPO_ENVIO_GESTION, EVENTO_ADVERSO_GESTION, TIPO_EVENTO_ADVERSO, GENERA_SOLICITUD_GESTION, FECHA_PROXIMA_LLAMADA, MOTIVO_PROXIMA_LLAMADA, OBSERVACION_PROXIMA_LLAMADA, FECHA_RECLAMACION_GESTION, FECHA_APLICACION, LUGAR_APLICACION, FECHA_CITA_PROGRAMADA, FECHA_MEDICAMENTO_HASTA, NUMERO_CAJAS, CONSECUTIVO_GESTION, AUTOR_GESTION, NOTA, DESCRIPCION_COMUNICACION_GESTION, FECHA_PROGRAMADA_GESTION, USUARIO_ASIGANDO, ID_PACIENTE_FK2, FECHA_COMUNICACION, ESTADO_GESTION, CODIGO_ARGUS, AUTOR_MODIFICACION, NUMERO_NEBULIZACIONES, FECHA_SUBIDO, NUMERO_TABLETAS_DIARIAS, BRINDO_APOYO, PAAP, SUB_PAAP, BARRERA, INFORMACION_APLICACIONES, FECHA_ULT_RECOLECCION, FECHA_PRO_RECOLECCION, FECHA_INI_PAAP, FECHA_FIN_PAAP, EVENTO_ADVERSO_FK) VALUES ('Ingreso','','','','','','','','','','','','','','','','','$MEDICAMENTOS_GESTION','','','','','$FECHA_PROXIMA_LLAMADA','','','0000-00-00','','','','','','','$session','$NOTA','$DESCRIPCION_COMUNICACION_GESTION','$FECHA_PROGRAMADA_GESTION','','$ID_PACIENTE','$FECHA_COMUNICACION','','','$session','','','0','','','','','','','','','','0')";
                            $execute_gestiones_paciente = mysqli_query($conex, $sql_insert_gestiones_paciente);

                            if ($execute_gestiones_paciente) {

                                // ACTUALIZACION PARA EL ID_ULTIMA_GESTION

                                $sql_gestion_id = mysqli_query($conex, "SELECT ID_GESTION FROM ipsen_gestiones ORDER BY ID_GESTION DESC LIMIT 1");
                                while ($row_gestion_id = mysqli_fetch_array($sql_gestion_id)) {
                                    $ID_ULTIMA_GESTION = $row_gestion_id['ID_GESTION'];
                                }

                                $update_codigo_gestion = "UPDATE ipsen_pacientes SET ID_ULTIMA_GESTION = '$ID_ULTIMA_GESTION' WHERE ID_PACIENTE = '$ID_PACIENTE'";
                                $execution_update_codigo_gestion = mysqli_query($conex, $update_codigo_gestion);

                                if ($execution_update_codigo_gestion) {

                                    $response = array(
                                        'mensaje' => 'El aspirante ha sido creado y transferido a paciente',
                                        'tipo' => 'success',
                                        'title' => 'Datos cargados',
                                        'state' => $ESTADO_PACIENTE,
                                        'artid' => base64_encode($ID_PACIENTE),
                                        'artge' => base64_encode($ID_ULTIMA_GESTION)
                                    );

                                    echo json_encode($response);
                                }
                            }
                        }
                    }
                } else if ($ESTADO_PACIENTE != 'Se ingresa paciente' && $execution_update_codigo_gestion) {
                    $response = array(
                        'mensaje' => 'El aspirante ha sido creado',
                        'tipo' => 'success',
                        'title' => 'Datos correctos',
                        'state' => $ESTADO_PACIENTE,
                    );

                    echo json_encode($response);
                }
            }
        }
    }
}
