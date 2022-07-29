<?php
require_once('AttachMailer.php');
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
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";
$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "bjimenez@app-peoplemarketing.com, datamarshall@peoplecontact.cc", "Habilitar Ips", $body);
$mailer->send() ? "Enviado" : "Problema al enviar";
