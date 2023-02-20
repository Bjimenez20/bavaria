<?php
require_once('PHPMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen día,
<br>
<br>
$name  $last_name
<br>
<br>
Bienvenid@ al sistema PSP IPSEN.
<br>
<br>
Puedes ingresar al aplicativo desde la siguiente url: <a href='https://pspipsen.com/'>https://pspipsen.com/</a>
<br>
<br>
Usuario: " . $email . "
<br>
Contraseña: " . $password . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";

$subject = 'Registro usuario nuevo';

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress($email);
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
