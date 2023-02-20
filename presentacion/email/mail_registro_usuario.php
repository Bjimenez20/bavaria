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
Bienvenid@ al sistema de Bayer Contigo Colombia.
<br>
<br>
Puedes ingresar al aplicativo desde la siguiente url: <a href='https://app-peoplemarketing.com/bayers/'>https://app-peoplemarketing.com/bayers/</a>
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
