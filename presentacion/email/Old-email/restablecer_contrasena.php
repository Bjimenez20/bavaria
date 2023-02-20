<?php
include "../../logica/session.php";
require_once('AttachMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
$EMAIL
<br>
<br>
Contrase&ntilde;a: " . $CONTRASENA_NU . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";
$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "$EMAIL", "Restablecer contraseña", $body);
$mailer->send() ? "Enviado" : "Problema al enviar";
