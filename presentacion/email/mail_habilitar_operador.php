<?php
require_once('AttachMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Se requiere Habilitar en el sistema el siguiente Operador logistico:
<br>
<br>
Operador logistico por habilitar: " . $operador_logistico . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";
$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "bjimenez@app-peoplemarketing.com", "Habilitar Operador Logistico", $body);
$mailer->send() ? "Enviado" : "Problema al enviar";
