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
"richard.lainez@bayer.com,  farmacovigilancia.peru@bayer.com, farmacovigilancia.mexhub@bayer.com, Anita.Talledo@consorciohbo.com.pe,laura.arciniegas@bayer.com, cordinacion@peoplecontac.cc, forcabayer@encontactopeoplemarketing.com,soporte@peoplecontact.cc", 
"Reporte Farmacovigilancia - ".$nombre." - ".$PRODUCTO." - ".$fecha."",$body);
$mailer->attachFile('../presentacion/PDF/Evento_Adverso_'.$ID_EVENTO_ADVERSO.'.pdf');
$mailer->send() ? "Enviado": "Problema al enviar";

/*"Anita.Talledo@consorciohbo.com.pe,Jessica.Richle@consorciohbo.com.pe,farmacovigilancia.peru@bayer.com,farmacovigilancia.mexhub@bayer.com,richard.lainez@bayer.com,jatorres@peoplemarketing.com,coordinacion@encontactopeoplemarketing.com,forcabayer@encontactopeoplemarketing.com,reportes_ea@encontactopeoplemarketing.com",*/
?>