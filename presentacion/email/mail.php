<?php
require_once('PHPMailer.php');
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

$subject = "Reporte Farmacovigilancia - $nombre - $PRODUCTO - $fecha";

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress('bjimenez@app-peoplemarketing.com');
$mail->addAttachment('../presentacion/PDF/Evento_Adverso_' . $ID_EVENTO_ADVERSO . '.pdf');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
