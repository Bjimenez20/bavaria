<?php
require_once('PHPMailer_EA.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Adjunto envio reporte de evento generado para el paciente.
<br />
<br />
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.";

$subject = "Reporte Farmacovigilancia - PAP$ID_PACIENTE - $fecha";

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress('pharmacovigilance.colombia@ipsen.com');
$mail->addAddress('diego.enrique.orjuela@ipsen.com');
$mail->addCC('dmendoza@peoplemarketing.com.co');
$mail->addBCC('bjimenez@app-peoplemarketing.com');
$mail->addAttachment('../EVENTO_ADVERSO/' . $ID_EVENTO_ADVERSO . '/Evento_Adverso_' . $ID_PACIENTE . '.pdf');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
