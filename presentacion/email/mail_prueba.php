<?php
require_once('AttachMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Adjunto envio reporte de evento generado para el paciente.
<br />
<br />
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.";
$mailer = new AttachMailer("reportes_ea@encontactopeoplemarketing.com", "bjimenez@app-peoplemarketing.com", "Reporte Farmacovigilancia - nombre - PRODUCTO fecha", $body);
$mailer->send() ? "Enviado" : "Problema al enviar";
