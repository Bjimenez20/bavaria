<?php 
require_once('AttachMailer.php');
$fecha= date("Y-m-d");

$body = "
Buen dia,
<br />
<br />
Solicito de su colaboracion con el paciente que relaciono a continuacion el cual se encuentra presentando barreras administrativas para acceder al tratamiento.
<br>
<br>
Codigo del Paciente: ".$codigo_usuario."
<br />
Ciudad: $ciudad
<br>
Causal de No Reclamacion: ".$causa_no_reclamacion."
<br>
<br>
Observacion gestion: ".$descripcion_comunicacion."
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";
$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "andrea.arango@bayer.com,  andreanathalie.bulla@bayer.com, coordinacion.bayer@PSPSOLUTIONS-CO.COM, coordinacion@encontactopeoplemarketing.com, lider.adherencia3@PSPSOLUTIONS-CO.COM, soporte@peoplecontact.cc", "Solicitud Apoyo PAAP - ". $tratamiento_email ." - ".$codigo_usuario."",$body);
$mailer->send() ? "Enviado": "Problema al enviar";
?>