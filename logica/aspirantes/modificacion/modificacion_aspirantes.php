<?php
require_once('./../../session.php');
require_once("./../../../datos/conex.php");

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

// PACIENTE
$session = $nombre . ' ' . $apellido;
$codigo_usuario2 = $data['codigo_usuario2'];
$estado_paciente = $data['estado_paciente'];
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
$direccion_nueva = $data['DIRECCION'];
if ($direccion_nueva != '') {
    $direccion = $direccion_nueva;
}
if ($direccion_nueva == '') {
    $direccion = $data['direccion_act'];
}
$acudiente  = $data['acudiente'];
$telefono_acudiente = $data['telefono_acudiente'];
$barrio = $data['barrio'];
$genero = $data['genero'];
$edad = $data['edad'];
$regimen = $data['regimen'];
$especialidad = $data['especialidad'];
$canal_contacto = $data['canal_contacto'];

// GENERAL
$fecha_nacimiento = $data['fecha_nacimiento'];

if ($data['producto_tratamiento'] == '' && $data['Dosis'] == '' && $data['clasificacion_patologica'] == '') {
    $producto_tratamiento = $data['producto_tratamiento_ant'];
    $Dosis = $data['Dosis_ant'];
    $clasificacion_patologica = $data['clasificacion_patologica_ant'];
} else {
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
}

$consentimiento = $data['consentimiento'];

$asegurador = $data['asegurador'];
if ($asegurador == 'NO ENCONTRADO') {
    $asegurador_otro = $data['asegurador_otro'];
    if ($asegurador_otro != '') {
        $insert_eps = mysqli_query($conex, "INSERT INTO ipsen_asegurador (ASEGURADOR,ESTADO) VALUES ('$asegurador_otro','OUT')");
    }
}
$medico_tratante = $data['medico_tratante'];
if ($medico_tratante == 'NO ENCONTRADO') {
    $medico_t_otro = $data['medico_t_otro'];
    if ($medico_t_otro != '') {
        $INSERT_MEDICO = mysqli_query($conex, "INSERT INTO ipsen_listas (MEDICO,ESTADO) VALUES ('$medico_t_otro','OUT')");
    }
}

$fecha_proxima_llamada = $data['fecha_proxima_llamada'];
$nota = $data['nota'];
$nota_new = $data['nota_new'];

if (
    empty($estado_paciente) ||
    empty($correo) ||
    empty($remitente) ||
    empty($nombre_paciente) ||
    empty($apellidos_paciente) ||
    empty($tipo_identificacion) ||
    empty($identificacion) ||
    empty($telefono1) ||
    empty($acudiente) ||
    empty($telefono_acudiente) ||
    empty($fecha_nacimiento) ||
    empty($producto_tratamiento) ||
    empty($consentimiento) ||
    empty($asegurador) ||
    empty($medico_tratante) ||
    empty($fecha_proxima_llamada) ||
    empty($nota) ||
    empty($nota_new)
) {
    $campos_vacios = array();

    if (empty($estado_paciente)) {
        array_push($campos_vacios, 'Estado paciente');
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

    if (empty($departamento)) {
        array_push($campos_vacios, 'Departamento');
    }

    if (empty($ciudad)) {
        array_push($campos_vacios, 'Ciudad');
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

    if (empty($medico_tratante)) {
        array_push($campos_vacios, 'Medico tratante');
    }

    if (empty($fecha_proxima_llamada)) {
        array_push($campos_vacios, 'Fecha proxima llamada');
    }

    if (empty($nota)) {
        array_push($campos_vacios, 'Nota');
    }

    if (empty($nota_new)) {
        array_push($campos_vacios, 'Descripcion y justificacion del cambio');
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

    // PRIMER NIVEL DE UPDATE

    $sql_general = "UPDATE ipsen_aspirantes SET ESTADO_PACIENTE = '$estado_paciente', TIPO_IDENTIFICACION_PACIENTE = '$tipo_identificacion', IDENTIFICACION_PACIENTE = '$identificacion', NOMBRE_PACIENTE = '$nombre_paciente', APELLIDO_PACIENTE = '$apellidos_paciente', TELEFONO_PACIENTE = '$telefono1', TELEFONO2_PACIENTE = '$telefono2', TELEFONO3_PACIENTE = '$telefono3', TELEFONO4_PACIENTE = '$telefono4', CORREO_PACIENTE = '$correo', DIRECCION_PACIENTE = '$direccion', DEPARTAMENTO_PACIENTE = '$departamento', CIUDAD_PACIENTE = '$ciudad', BARRIO_PACIENTE = '$barrio', GENERO_PACIENTE = '$genero', FECHA_NACIMIENTO_PACIENTE = '$fecha_nacimiento', EDAD_PACIENTE = '$edad' , ACUDIENTE_PACIENTE = '$acudiente', TELEFONO_ACUDIENTE_PACIENTE = '$telefono_acudiente', USUARIO_CREACION = '$session', REMITENTE = '$remitente' WHERE ID_ASPIRANTE = '$codigo_usuario2'";
    $execution_general = mysqli_query($conex, $sql_general);

    if ($execution_general) {

        // SEGUNDO NIVEL DE UPDATE

        $sql_tratamiento = "UPDATE ipsen_tratamiento_aspirante SET PRODUCTO_TRATAMIENTO = '$producto_tratamiento', DOSIS_TRATAMIENTO = '$Dosis', CLASIFICACION_PATOLOGICA_TRATAMIENTO = '$clasificacion_patologica', CONSENTIMIENTO_TRATAMIENTO = '$consentimiento', REGIMEN_TRATAMIENTO = '$regimen', ASEGURADOR_TRATAMIENTO = '$asegurador', MEDICO_TRATAMIENTO = '$medico_tratante', ESPECIALIDAD_TRATAMIENTO = '$especialidad' WHERE ID_ASPIRANTE_FK = '$codigo_usuario2'";
        $execution_tratamiento = mysqli_query($conex, $sql_tratamiento);

        if ($execution_tratamiento) {

            // TRAEMOS LOS ULTIMOS DATOS DE LA ULTIMA GESTION

            $sql_gestion = mysqli_query($conex, "SELECT * FROM ipsen_gestiones_aspirante WHERE ID_ASPIRANTE_FK2 ='$codigo_usuario2' ORDER BY ID_GESTION DESC LIMIT 1");
            while ($row_gestion_id = mysqli_fetch_array($sql_gestion)) {
                $reclamo = $row_gestion_id['RECLAMO_GESTION'];
                $causa_no_reclamacion = $row_gestion_id['CAUSA_NO_RECLAMACION_GESTION'];
                $fecha_reclamacion = $row_gestion_id['FECHA_RECLAMACION_GESTION'];
            }

            // INSERCION DE LA NUEVA GESTION

            $sql_gestion_new = "INSERT INTO ipsen_gestiones_aspirante (MOTIVO_COMUNICACION_GESTION, RECLAMO_GESTION, CAUSA_NO_RECLAMACION_GESTION, FECHA_PROXIMA_LLAMADA, MEDICAMENTOS_GESTION, FECHA_RECLAMACION_GESTION, AUTOR_GESTION, NOTA, DESCRIPCION_COMUNICACION_GESTION, FECHA_PROGRAMADA_GESTION, ID_ASPIRANTE_FK2, FECHA_COMUNICACION, ESTADO_GESTION, CANAL_CONTACTO)
            VALUES ('GESTION COORDINADOR','$reclamo','$causa_no_reclamacion','$fecha_proxima_llamada','$producto_tratamiento','$fecha_reclamacion','$session','$nota_new','$nota_new','$fecha_proxima_llamada','$codigo_usuario2',CURRENT_TIMESTAMP,'GESTIONADO', '$canal_contacto')";
            $execution_gestion_new = mysqli_query($conex, $sql_gestion_new);

            if ($execution_gestion_new) {

                // TRAEMOS EL ID DE LA ULTIMA GESTION

                $sql_gestion_id = mysqli_query($conex, "SELECT * FROM ipsen_gestiones_aspirante WHERE ID_ASPIRANTE_FK2 ='$codigo_usuario2' ORDER BY ID_GESTION DESC LIMIT 1");
                while ($row_gestion_id = mysqli_fetch_array($sql_gestion_id)) {
                    $ID_ULTIMA_GESTION = $row_gestion_id['ID_GESTION'];
                }

                // ACTUALIZACION PARA EL ID_ULTIMA_GESTION

                $update_codigo_gestion = "UPDATE ipsen_aspirantes SET ID_ULTIMA_GESTION = '$ID_ULTIMA_GESTION' WHERE ID_ASPIRANTE = '$codigo_usuario2'";
                $execution_update_codigo_gestion = mysqli_query($conex, $update_codigo_gestion);

                if ($execution_update_codigo_gestion) {
                    $response = array(
                        'mensaje' => 'El aspirante ha sido actualizado',
                        'tipo' => 'success',
                        'title' => 'Datos cargados'
                    );

                    echo json_encode($response);
                }
            }
        }
    }
}
