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

$subject = "Prueba reporte Farmacovigilancia - PAP$ID_PACIENTE_FK - $fecha";

$mail->Body = $body;
$mail->Subject = $subject;
// $mail->addAddress('pharmacovigilance.colombia@ipsen.com');
// $mail->addAddress('diego.enrique.orjuela@ipsen.com');
// $mail->addAddress('dmendoza@peoplemarketing.com.co');
$mail->addAddress('bjimenez@app-peoplemarketing.com');
// $mail->addAddress('bjimenez@overall.com.co');
// $mail->addAddress('amendozap@overall.com.co');
// $mail->addAddress('mramirez@overall.com.co');
$mail->addAttachment('../EVENTO_ADVERSO/' . $ID_EVENTO_ADVERSO . '/Evento_Adverso_' . $ID_PACIENTE_FK . '.docx');
$mail->addAttachment('../EVENTO_ADVERSO/' . $ID_EVENTO_ADVERSO . '/Evento_Adverso_' . $ID_PACIENTE_FK . '.pdf');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
