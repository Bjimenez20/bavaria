<?php
require('../datos/parse_str.php');
require('../datos/conex.php');

// Recibir datos por GET
$id_paciente = base64_decode($_GET['artid']);
$id_gestion  = base64_decode($_GET['artge']);
$accion = $_GET['accion'] ?? '';
$razon = $_GET['razon'] ?? '';

if ($accion === 'Aprobado') {
    $sql = "UPDATE ipsen_gestiones SET AUTORIZACION_EDUGESTOR = '$accion' , OBSERVACION_ESCALAMIENTO = 'El cliente aprobo el escalamiento del PAP al edugestor de la zona' WHERE ID_GESTION = '$id_gestion'";
    mysqli_query($conex, $sql) or die(mysqli_error($conex));

    $sql = "INSERT INTO ipsen_observacio_escalados (ESTADO, OBSERVACION, GESTION_ID, FECHA_REGISTRO) VALUES ('$accion', 'El cliente aprobo el escalamiento del PAP al edugestor de la zona', '$id_gestion',  NOW())";
    mysqli_query($conex, $sql) or die(mysqli_error($conex));
    if ($sql) {
        require('../presentacion/email/mail_barreras_autorizada.php');
    }

    header("Location: ../presentacion/form_paciente_seguimiento.php");
} else if ($accion == 'Rechazado') {
    $sql = "UPDATE ipsen_gestiones SET AUTORIZACION_EDUGESTOR = '$accion', OBSERVACION_ESCALAMIENTO = '" . $razon . "'  WHERE ID_GESTION = '$id_gestion'";
    mysqli_query($conex, $sql) or die(mysqli_error($conex));

    $sql = "INSERT INTO ipsen_observacio_escalados (ESTADO, OBSERVACION, GESTION_ID,  FECHA_REGISTRO) VALUES ('$accion', '$razon', '$id_gestion', NOW())";
    mysqli_query($conex, $sql) or die(mysqli_error($conex));
    if ($sql) {
        require('../presentacion/email/mail_barreras_rechazada.php');
    }
} else {
    $sql = "UPDATE ipsen_gestiones SET AUTORIZACION_EDUGESTOR = '$accion', OBSERVACION_ESCALAMIENTO = '" . $razon . "' WHERE ID_GESTION = '$id_gestion'";
    mysqli_query($conex, $sql) or die(mysqli_error($conex));

    $sql = "INSERT INTO ipsen_observacio_escalados (ESTADO, OBSERVACION, GESTION_ID, FECHA_REGISTRO) VALUES ('$accion', '$razon', '$id_gestion',  NOW())";
    mysqli_query($conex, $sql) or die(mysqli_error($conex));
    if ($sql) {
        require('../presentacion/email/mail_barreras_respuesta.php');
    }
    header("Location: ../presentacion/form_paciente_seguimiento.php");
}
exit;
