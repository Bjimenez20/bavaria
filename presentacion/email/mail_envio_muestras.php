<?php 

require_once('AttachMailer.php');

$fecha= date("Y-m-d");



	$PAP;

	$ESTATUS_PACIENTE;

	$DOSIS;

	$FECHA_SALIDA;

	$NO_LOTE;

	$ESTADO;		

	$FECHA_VENC;

	$OBSERVACION;



$body = "

Buen dia,

<br />

<br />

Confirmo respuesta del Apoyo solicitado para el paciente relacionado: 

<br />

<br />

Codigo del Paciente: PAP$PAP

<br />

Estatus Paciente: $ESTATUS_PACIENTE

<br />

Dosis: $DOSIS

<br />

Fecha Salida: $FECHA_SALIDA 

<br />

No Lote: $NO_LOTE

<br />

Fecha Vencimiento: $FECHA_VENC

<br />

Estado: $ESTADO.

<br />

Observacion: $OBSERVACION

<br />

<br />

Esta solicitud fue generada por: $usua.

<br />

<br />

Cualquier inquietud con gusto sera atendida.

<br />

<br />

Correo enviado de manera automatica.<br /><br />";

/*

$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", 

"soporte@peoplecontact.cc", "Respuesta Caso Adempas - PAP$PAP ",$body);

*/



$mailer = new AttachMailer("pspbayer@encontactopeoplemarketing.com", 

"luzfabiola.garcia@bayer.com,andrea.arango@bayer.com, forcabayer@encontactopeoplemarketing.com, coordinacion.pap@fundem-co.org, stefanypaola.penaloza@bayer.com, coordinacion@encontactopeoplemarketing.com", "Respuesta Caso Adempas - PAP$PAP ",$body);	







//$mailer->attachFile('../presentacion/PDF/Evento_Adverso_'.$ID_EVENTO_ADVERSO.'.pdf');

$mailer->send() ? "Enviado": "Problema al enviar";

?>