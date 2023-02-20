<?php
include "../../logica/registrar_usuario.php";
require_once('AttachMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen día,
<br />
<br />
$email
Bienvenid@ al sistema de Bayer Contigo.
<br>
<br>
Su contrase&ntilde;a es: " . $password . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";
$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "$email", "Registro usuario nuevo", $body);
$mailer->send() ? "Enviado" : "Problema al enviar";
