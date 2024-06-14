<?php 
require_once('AttachMailer.php');
$fecha= date("Y-m-d");
$body = "
Eps:
Dosis:
Indicacion:
Fecha de ingreso al Programa:

Buen dia,
<br />
<br />
Reporto Ingreso al Programa del paciente que relaciono a continuacion
<br>
<br>
Terapia: ".$producto_tratamiento."
<br>
<br>
Codigo del Paciente: PAP".$ID_PACIENTE."
<br>
<br>
Ciudad: ".$ciudad."
<br>
<br>
Eps: ".$asegurador."
<br>
<br>
Dosis: ".$dosis."
<br>
<br>
Ips Que Atiende: ".$ips_atiende."
<br>
<br>
Fecha de ingreso al Programa: ".$fecha_activacion."
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";
$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "maria.alfaro@lifeandhope.pe, keyla.hipolito@litya.pe, coordinacion@encontactopeoplemarketing.com, andrea.arango@bayer.com, oscar.ragua@bayer.com, soporte@peoplecontact.cc", 
"BAYER PACIENTE NUEVO PAP – PERU".$ID_PACIENTE."",$body);
$mailer->send() ? "Enviado": "Problema al enviar";
?>