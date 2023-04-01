<?php
require_once('../logica/session.php');
require_once("../datos/conex.php");

http_response_code(200);
header('Content-Type: text/plain');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$fecha_notificacion = $data['fecha_notificacion'];
$departamento = $data['departamento'];
$municipio = $data['municipio'];
$institucion_evento = $data['institucion_evento'];
$nombre_usuario = $data['nombre_usuario'];
$nombre_paciente_acudiente = $data['nombre_paciente_acudiente'];
$consecutivo = $data['consecutivo'];
$profecion_usuario = $data['profecion_usuario'];
$correo_usuario = $data['correo_usuario'];
$fecha_nacimiento = $data['fecha_nacimiento'];
$edad_paciente = $data['edad_paciente'];
$tipo_documento_paciente = $data['tipo_documento_paciente'];
$documento_paciente = $data['documento_paciente'];
$iniciales_pa = $data['iniciales_pa'];
$genero = $data['genero'];
$diagnostico = $data['diagnostico'];
$titular_registro = $data['titular_registro'];
$nombre_comercial = $data['nombre_comercial'];
$registro_sanitario = $data['registro_sanitario'];
$lote = $data['lote'];
$fecha_ini_evento = $data['fecha_ini_evento'];
$evento_adverso = $data['evento_adverso'];
$descripcion_evento = $data['descripcion_evento'];
$desenlace_evento = $data['desenlace_evento'];
$lugar_distribucion = $data['lugar_distribucion'];
$codigo_paciente = $data['codigo_paciente'];

if (
    empty($institucion_evento) ||
    empty($profecion_usuario) ||
    empty($fecha_ini_evento) ||
    empty($evento_adverso) ||
    empty($descripcion_evento)
) {
    $campos_vacios = array();

    if (empty($institucion_evento)) {
        array_push($campos_vacios, 'Nombre de la Institución donde ocurrió el evento');
    }
    if (empty($profecion_usuario)) {
        array_push($campos_vacios, 'Profesión del reportante primario');
    }

    if (empty($fecha_ini_evento)) {
        array_push($campos_vacios, 'Fecha de Inicio del Reporte');
    }
    if (empty($evento_adverso)) {
        array_push($campos_vacios, 'Queja técnica /Reclamos Técnicos de Producto');
    }
    if (empty($descripcion_evento)) {
        array_push($campos_vacios, 'Descripción y análisis del Reclamo');
    }

    if (count($campos_vacios) > 0) {

        $titulo = 'Error de validación';
        $icono = 'error';
        $mensaje = 'Por favor completa los siguientes campos:';
        $lista = '<ul class="my-3">';
        foreach ($campos_vacios as $campo) {
            $lista .= '<li class="text-start">' . $campo . '</li>';
        }
        $lista .= '</ul>';
        $mensaje .= $lista;

        echo $titulo . ',' . $icono . ',' . $mensaje;
    }
} else {
    $insertar = mysqli_query($conex, "INSERT INTO ipsen_evento_adverso(FECHA_NOTIFICA,DEPARTAMENTO,MUNICIPIO,NOMBRE_INSTITUCION,CODIGO_PNF,NOMBRE_REPORTANTE,NOMBRE_PACIENTE_ACUDIENTE,CONSECUTIVO,PROFESION_REPORTANTE,CORREO_REPORTANTE,FECHA_NACIMIENTO_PACIENTE,EDAD_PACIENTE,TIPO_DOCUMENTO_PACIENTE,NUMERO_DOCUMENTO_PACIENTE,INICIALES_PACIENTE,SEXO,PESO,TALLA,DIAGNOSTICO_PRINCIPAL,TITULAR_REGISTRO,NOMBRE_COMERCIAL,REGISTRO_SANITARIO,LOTE,FECHA_INICIO_EVENTO,EVENTO_ADVERSO,DESCRIPCION_ANALISIS_EVENTO,DESENLACE_EVENTO,SERIEDAD,LUGAR_DISTRIBUCION,FECHA_MUERTE,PREGUNTA1,PREGUNTA2,PREGUNTA3,PREGUNTA4,PREGUNTA5,ID_PACIENTE_FK) VALUES ('$fecha_notificacion','$departamento','$municipio','$institucion_evento','','$nombre_usuario','$nombre_paciente_acudiente','$consecutivo','$profecion_usuario','$correo_usuario','$fecha_nacimiento','$edad_paciente','$tipo_documento_paciente','$documento_paciente','$iniciales_pa','$genero','','','$diagnostico','$titular_registro','$nombre_comercial','$registro_sanitario','$lote','$fecha_ini_evento','$evento_adverso','$descripcion_evento','$desenlace_evento','','$lugar_distribucion','','','','','','','$codigo_paciente')");
    if ($insertar) {
        $titulo = 'Datos cargados';
        $icono = 'success';
        $mensaje = 'El evento ha sido creado';

        echo $titulo . ',' . $icono . ',' . $mensaje;
    }
}
