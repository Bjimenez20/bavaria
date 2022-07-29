<?php 

require_once('AttachMailer.php');

$fecha= date("Y-m-d");

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

$mailer = new AttachMailer("reportes_ea@encontactopeoplemarketing.com", 

"farmacovigilancia.mexhub@bayer.com, farmacovigilancia.colombia@bayer.com, consumomasivo@aseiltda.com, coordinacion@encontactopeoplemarketing.com, forcabayer@encontactopeoplemarketing.com,andrea.arango@bayer.com, soporte@peoplecontact.cc", 

"Reporte Farmacovigilancia - ".$nombre." - ".$PRODUCTO." - ".$fecha."",$body);

$mailer->attachFile('../presentacion/PDF/Evento_Adverso_'.$ID_EVENTO_ADVERSO.'.pdf');

$mailer->send() ? "Enviado": "Problema al enviar";



/*"coordinacion.pap@fundem-co.org,farmacovigilancia.mexhub@bayer.com,laura.arciniegas@bayer.com,coordinacion@encontactopeoplemarketing.com,farmacovigilancia.colombia@bayer.com, consumomasivo@aseiltda.com, alejandra.gaviria@aseiltda.com, forcabayer@encontactopeoplemarketing.com, reportes_ea@encontactopeoplemarketing.com",*/

?>