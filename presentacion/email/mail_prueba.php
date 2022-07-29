<?php 
require_once('AttachMailer.php');
$fecha= date("Y-m-d");
//$ID_EVENTO_ADVERSO = "8984";
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
$mailer = new AttachMailer("reportes_ea@encontactopeoplemarketing.com", "soporte@peoplecontact.cc", "Reporte Farmacovigilancia - nombre - PRODUCTO fecha",$body);
//$mailer->attachFile('../presentacion/PDF/Evento_Adverso_'.$ID_EVENTO_ADVERSO.'.pdf');
$mailer->send() ? "Enviado": "Problema al enviar";
?>