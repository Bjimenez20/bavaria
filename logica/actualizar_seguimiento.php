<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: text/html;charset=utf-8");
require_once('session.php');

require_once("../datos/conex.php");
mysqli_query($conex, "SET NAMES utf8");
$responsable_id = $_POST['codigo_responsable'];
$logro_comunicacion = $_POST['logro_comunicacion'];
$autor = $_POST['autor'];
$codigo_bavaria = $_POST['codigo_bavaria'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$tipo_identificacion = $_POST['tipo_identificacion'];
$identificacion = $_POST['identificacion'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$establecimiento = $_POST['establecimiento'];
$sub_canal = $_POST['sub_canal'];
$departamento = $_POST['departamento'];
$ciudad = $_POST['ciudad'];
$codi_ba = $_POST['codi_ba'];
$codigo_bavaria_nuevo = $_POST['codigo_bavaria_nuevo'];
$whatsApp = $_POST['whatsApp'];
$num_WhatsApp = $_POST['num_WhatsApp'];
$negocio_funciona = $_POST['negocio_funciona'];
$propietario = $_POST['propietario'];
$nombres_nuevo_pro = $_POST['nombres_nuevo_pro'];
$apellidos_nuevo_pro = $_POST['apellidos_nuevo_pro'];
$horario_visita = $_POST['horario_visita'];
$dia_visita = $_POST['dia_visita'];
$interes_programa = $_POST['interes_programa'];
$barrera = $_POST['barrera'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fin = $_POST['hora_fin'];
$descanso = $_POST['descanso'];
$nivel_interes = $_POST['nivel_interes'];
$estado = $_POST['estado'];
$nota = $_POST['nota'];
$numero_registros = mysqli_query($conex, "SELECT * FROM responsable WHERE IDENTIFICACION ='" . $identificacion . "'");
echo mysqli_error($conex);
$coincidencias = mysqli_num_rows($numero_registros);

date_default_timezone_set('America/Bogota');

$fecha = date('Y-m-d');


$update_all_responsable = mysqli_query($conex, "UPDATE `responsable` SET `CODIGO_BAVARIA` = '$codigo_bavaria', `CODIGO_BAVARIA_NUEVO` = '$codigo_bavaria_nuevo', `NOMBRES` = '$nombres', `APELLIDOS` = '$apellidos', `TIPO_IDENTIFICACION` = '$tipo_identificacion', `IDENTIFICACION` = '$identificacion', `TELEFONO` = '$telefono', `DIRECCION` = '$direccion', `ESTABLECIMIENTO` = '$establecimiento', `SUB_CANAL` = '$sub_canal', DEPARTAMENTO = '$departamento', CIUDAD = '$ciudad' WHERE `ID_RESPONSABLE` = '$responsable_id'");

if (!$update_all_responsable) {
    die("Error al actualizar los datos: " . mysqli_error($conex));
}

$insert_visita = mysqli_query($conex, "INSERT INTO visitas (`LOGRO_COMUNICACION`, `ESTADO` ,`WHATSAPP`, `NUMERO_WHATSAPP`, `NEGOCIO_FUNCIONA`, `HORA_VISITA`, `FECHA_VISITA`, `INTERES_PROGRAMA`, `BARRERA`, `HORA_INICIO`, `HORA_FIN`, `DESCANSO`, `NIVEL_INTERES_PROGRAMA`, `OBSERVACION`, `FECHA_REGISTRO`, `RESPONSABLE_ID`, `AUTOR`) VALUES ('" . $logro_comunicacion . "', '" . $estado . "' ,'" . $whatsApp . "', '" . $num_WhatsApp . "', '" . $negocio_funciona . "', '" . $horario_visita . "', '" . $dia_visita . "', '" . $interes_programa . "', '" . $barrera . "', '" . $hora_inicio . "', '" . $hora_fin . "', '" . $descanso . "', '" . $nivel_interes . "', '" . $nota . "', '" . $fecha . "', '" . $responsable_id . "', '" . $autor . "')");

if (!$insert_visita) {
    die("Error al registrar visita: " . mysqli_error($conex));
}

if ($propietario == 'NO') {
    $update_responsable = mysqli_query($conex, "UPDATE `responsable` SET `NOMBRES` = '$nombres_nuevo_pro', `APELLIDOS` = '$apellidos_nuevo_pro' WHERE `ID_RESPONSABLE` = ' $responsable_id '");

    if (!$update_responsable) {
        die("Error al actualizar el responsable: " . mysqli_error($conex));
    }
}

if ($insert_visita) {
    header('Content-Type: application/json');

    echo json_encode([
        'success' => true,
        'mensaje' => 'La información fue guardada correctamente'
    ]);

    exit;
} else {
    header('Content-Type: application/json');

    echo json_encode([
        'success' => false,
        'mensaje' => mysqli_error($conex)
    ]);

    exit;
}
