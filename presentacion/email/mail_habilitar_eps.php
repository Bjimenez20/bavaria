<?php
require_once('AttachMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Se requiere Habilitar en el sistema el siguiente Asegurador:
<br>
<br>
Asegurador por habilitar: " . $asegurador . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";
$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "bjimenez@app-peoplemarketing.com", "Prueba Habilitar Asegurador", $body);
$mailer->send() ? "Enviado" : "Problema al enviar";
