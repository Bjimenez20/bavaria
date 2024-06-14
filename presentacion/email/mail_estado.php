<?php
require_once('PHPMailer.php');
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
Solicito autorización para la modificación de estado del paciente $nombrepaciente 
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
Solicito autorización para la modificación de estado del pacientes $nombrepaciente 
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
Correo enviado de manera automatica por psp ipsen.<br /><br />";
if ($cambio_estado_paciente == 'Abandono') {

    $subject = "Solicitud cambio estado paciente - $pap - $fecha";

    $mail->Body = $body2;
    $mail->Subject = $subject;
    $mail->addAddress('dmendoza@peoplemarketing.com.co, bjimenez@app-peoplemarketing.com');
    $mail->Send() ? "Enviado" : "Problema al enviar";
    $mail->smtpClose();
} else {
    $subject = "Solicitud cambio estado paciente - $pap - $fecha";

    $mail->Body = $body;
    $mail->Subject = $subject;
    $mail->addAddress('dmendoza@peoplemarketing.com.co, bjimenez@app-peoplemarketing.com');
    $mail->Send() ? "Enviado" : "Problema al enviar";
    $mail->smtpClose();
}
