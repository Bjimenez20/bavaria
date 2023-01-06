<?php
require('../../logica/session.php');
require_once('AttachMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Adjunto envio reporte de evento adverso para el paciente relacionado en el archivo.
<br />
<br />
Cordial saludo
<br />
<br />
Educador Call Center: $usua
Correo enviado de manera automatica.";
$mailer = new AttachMailer("reportesfarmacovigilancia@pspipsen.com", "pharmacovigilance.colombia@ipsen.com, diego.enrique.orjuela@ipsen.com, dmendoza@peoplemarketing.com.co, bjimenez@app-peoplemarketing.com", "Reporte Farmacovigilancia - PAP" . $ID_PAP . " - " . $PRODUCTO . " - " . $fecha . "", $body);
$mailer->attachFile($URL_PDF);
$mailer->send() ? "Enviado" : "Problema al enviar";
