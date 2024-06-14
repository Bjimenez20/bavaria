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

$subject = "Prueba reporte Farmacovigilancia - PAP$ID_PAP - $fecha";

$mail->Body = $body;
$mail->Subject = $subject;
// $mail->addAddress('diego.enrique.orjuela@ipsen.com');
// $mail->addAddress('quality.colombia@ipsen.com');
// $mail->addAddress('mauricio.duque@ipsen.com,');
// $mail->addCC('marcela.angarita@ipsen.com');
// $mail->addCC('dmendoza@peoplemarketing.com.co');
$mail->addAddress('bjimenez@app-peoplemarketing.com');
$mail->addAttachment('../EVENTO_ADVERSO/' . $ID_EVENTO_ADVERSO . '/Evento_Adverso_' . $ID_PAP . '.pdf');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
