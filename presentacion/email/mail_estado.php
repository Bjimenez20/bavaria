<?php
require_once('AttachMailer.php');
$fecha = date("Y-m-d");
$estado_paciente;
$cambio_estado_paciente;
$asesor = $usua;
$nombrepaciente = $nombre . ' ' . $apellidos;
$pap = $codigo_usuario;
$body = "
Buen dia,
<br />
<br />
Solicito autorizaci&oacute;n para la modificaci&oacute;n de estado del paciente $nombrepaciente 
<br />
identificado con el $pap. 
<br />
<br />
Cambia del estado $estado_paciente a $cambio_estado_paciente
<br />
<br />
Asesor que solicita $asesor.
<br />
<br />
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.<br /><br />";
$body2 = "
Buen dia,
<br />
<br />
Solicito autorizaci&oacute;n para la modificaci&oacute;n de estado del pacientes $nombrepaciente 
<br />
identificado con el $pap. 
<br />
<br />
Cambia del estado $estado_paciente a $cambio_estado_paciente <br />
Fecha Retiro: $fecha_retiro <br />
Motivo Retiro: $motivo_retiro <br />
Tratamiento: $tratamiento_email <br />
Observacion Retiro: $observacion_retiro <br />
<br />
<br />
Asesor que solicita $asesor.
<br />
<br />
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica por psp bayer.<br /><br />";
if ($cambio_estado_paciente == 'Abandono') {
    $mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "bjimenez@app-peoplemarketing.com", "Solicitud cambio estado paciente - $pap - " . $fecha . "", $body2);
} else {
    $mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "bjimenez@app-peoplemarketing.com", "Solicitud cambio estado paciente - $pap - " . $fecha . "", $body);
}
$mailer->send() ? "Enviado" : "Problema al enviar";
