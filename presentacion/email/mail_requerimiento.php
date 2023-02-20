<?php
require_once('PHPMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Solicito de su colaboracion con el paciente que relaciono a continuacion el cual se encuentra presentando barreras administrativas para acceder al tratamiento o requiere reentrenamiento.
<br>
<br>
Codigo del Paciente: " . $codigo_usuario2 . "
<br />
Ciudad: " . $ciudad . "
<br>
Causal de No Reclamacion: " . $causa_no_reclamacion . "
<br>
<br>
Observacion gestion: " . $descripcion_comunicacion . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";

$subject = "Solicitud Apoyo Terapia - $MEDICAMENTO - $pais - PAP$codigo_usuario2";

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress('bjimenez@app-peoplemarketing.com, hugalde@alter-pharma.com, oscar.ragua@bayer.com, coordinacion@encontactopeoplemarketing.com');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
