<?php 
require_once('AttachMailer.php');
$fecha= date("Y-m-d");
$ciudad=$ciudad;
$asegurador=$asegurador;
$ips_atiende=$ips_atiende;
$operador_logistico=$operador_logistico;
$punto_entrega=$punto_entrega;
$dosis=$dosis;
$asesor = $usua;
$nombrepaciente = $nombre.' '.$apellidos;
$pap = $codigo_usuario;
$causa_no_reclamacion=$causa_no_reclamacion;
$body = "
Buen dia,
<br />
<br />
solicito de su colaboracion para proporcionar apoyo con muestra para el paciente: 
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
Dosis Actual: $dosis.
<br />
Estatus Paciente: $status_paciente
<br />
<br />
Medico Tratante: $medico
<br />
<br />
Observacion: $descripcion_comunicacion
<br />
<br />
Esta solicitud fue generada por: $asesor.
<br />
<br />
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.<br /><br />";
$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", 
"bjimenez@app-peoplemarketing.com", "Apoyo Paciente Adempas - $pap ",$body);	
$mailer->send() ? "Enviado": "Problema al enviar";
?>