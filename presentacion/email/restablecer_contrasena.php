<?php
include "../../logica/session.php";
require_once('PHPMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
$NOMBRES $APELLIDOS
<br>
<br>
Se restablecio tu Contraseña: " . $CONTRASENA_NU . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";

$subject = 'Restablecer contraseña';

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress($EMAIL);
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
