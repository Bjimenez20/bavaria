<?php
require_once('AttachMailer.php');
$fecha = date("Y-m-d");
$ciudad = $ciudad;
$asegurador = $asegurador;
$ips_atiende = $ips_atiende;
$operador_logistico = $operador_logistico;
$punto_entrega = $punto_entrega;
$dosis = $dosis;
$asesor = $usua;
$nombrepaciente = $nombre . ' ' . $apellidos;
$pap = $codigo_usuario;
$causa_no_reclamacion = $causa_no_reclamacion;
$body = "
Buen dia,
<br />
<br />
se genero una nueva noveda el dia " . $fecha . " con la siguiente informacion:
<br />
<br />
Codigo del Paciente: $pap
<br />
Ciudad: $ciudad
<br />
Eps: $asegurador
<br />
Ips Que Atiende: $ips_atiende 
<br />
Operador Logistico: $operador_logistico
<br />
Punto de Entrega: $punto_entrega
<br />
Dosis: $dosis.
<br />
<br />
Esta solicitud fue generada por: $asesor.
<br />
<br />
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.<br /><br />";
if ($causa_no_reclamacion == 'Solicitud Muestra Medica') {
	$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "bjimenez@app-peoplemarketing.com", "$causa_no_reclamacion - $pap ", $body);
} else {
	$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", "bjimenez@app-peoplemarketing.com", "$causa_no_reclamacion - $pap ", $body);
}
$mailer->send() ? "Enviado" : "Problema al enviar";
