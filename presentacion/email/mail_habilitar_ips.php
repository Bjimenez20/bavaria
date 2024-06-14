<?php
require_once('PHPMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Se requiere Habilitar en el sistema la siguiente Ips:
<br>
<br>
Ips por habilitar: " . $ips_atiende . "
<br>
<br>
Asesor que solicita: " . $usua . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";

$subject = 'Habilitar Ips';

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress('bjimenez@app-peoplemarketing.com');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();