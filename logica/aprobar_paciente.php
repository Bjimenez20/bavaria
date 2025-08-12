<?php
require('../datos/parse_str.php');
require('../datos/conex.php');

// Recibir datos por GET
$id_paciente = base64_decode($_GET['artid']);
$id_gestion  = base64_decode($_GET['artge']);
$accion = $_GET['accion'] ?? '';
$razon = $_GET['razon'] ?? '';

if ($accion === 'aprobar') {
    $sql = "UPDATE ipsen_gestiones SET AUTORIZACION_EDUGESTOR = 'Aprobada' WHERE ID_GESTION = '$id_gestion'";
    mysqli_query($conex, $sql) or die(mysqli_error($conex));
    if ($sql) {
        require('../presentacion/email/mail_barreras_autorizada.php');
    }

    header("Location: ../presentacion/form_paciente_seguimiento.php");
} else {
    $sql = "UPDATE ipsen_gestiones SET AUTORIZACION_EDUGESTOR = 'rechazada', MOTIVO_RECHAZO = '" . $razon . "'  WHERE ID_GESTION = '$id_gestion'";
    mysqli_query($conex, $sql) or die(mysqli_error($conex));
    if ($sql) {
        require('../presentacion/email/mail_barreras_rechazada.php');
    }
}
exit;
