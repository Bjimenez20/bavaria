<?php
require_once('PHPMailer.php');
$fecha = date("Y-m-d");
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

$subject = "Respuesta Caso Adempas - PAP$PAP";

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress('bjimenez@app-peoplemarketing.com');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
