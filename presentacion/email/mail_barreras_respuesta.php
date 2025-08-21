<?php
require_once('PHPMailer.php');
$fecha = date("Y-m-d");
$select_id = mysqli_query($conex, "SELECT ID_PACIENTE, CLASIFICACION_PATOLOGICA_TRATAMIENTO, ASEGURADOR_TRATAMIENTO, OPERADOR_LOGISTICO_TRATAMIENTO, PUNTO_ENTREGA, CIUDAD_PACIENTE,PRODUCTO_TRATAMIENTO, DOSIS_TRATAMIENTO,CAUSA_NO_RECLAMACION_GESTION, MEDICO_TRATAMIENTO, NUMERO_PENDIENTE, FECHA_PENDIENTE, AUTOR_GESTION, ASIGNADO_EDUGESTOR, OBSERVACION_ESCALAMIENTO FROM ipsen_pacientes INNER JOIN ipsen_gestiones ON ipsen_pacientes.ID_PACIENTE = ipsen_gestiones.ID_PACIENTE_FK2 INNER JOIN ipsen_tratamiento ON ipsen_pacientes.ID_PACIENTE = ipsen_tratamiento.ID_PACIENTE_FK WHERE ID_PACIENTE_FK2 = '$id_paciente' ORDER BY FECHA_COMUNICACION DESC LIMIT 1");
while ($dato = mysqli_fetch_array($select_id)) {
    $PAP = $dato['ID_PACIENTE'];
    $CLASIFICACION = $dato['CLASIFICACION_PATOLOGICA_TRATAMIENTO'];
    $ASEGURADOR = $dato['ASEGURADOR_TRATAMIENTO'];
    $OPL = $dato['OPERADOR_LOGISTICO_TRATAMIENTO'];
    $PUNTO_ENTREGA = $dato['PUNTO_ENTREGA'];
    $CIUDAD = $dato['CIUDAD_PACIENTE'];
    $TRATAMIENTO = $dato['PRODUCTO_TRATAMIENTO'];
    $DOSIS = $dato['DOSIS_TRATAMIENTO'];
    $CAUSAL = $dato['CAUSA_NO_RECLAMACION_GESTION'];
    $MEDICO_TRATAMIENTO = $dato['MEDICO_TRATAMIENTO'];
    $NUMERO_PENDIENTE = $dato['NUMERO_PENDIENTE'];
    $FECHA_PENDIENTE = $dato['FECHA_PENDIENTE'];
    $AUTOR = $dato['AUTOR_GESTION'];
    $ASIGNADO_EDUGESTOR = $dato['ASIGNADO_EDUGESTOR'];
    $OBSERVACION_ESCALAMIENTO = $dato['OBSERVACION_ESCALAMIENTO'];
}
$body = "
Buen dia,
<br />
<br />
Solicito tu amable colaboración con el caso del paciente que relaciono a continuación, quien actualmente enfrenta una barrera administrativa que le ha impedido acceder oportunamente a su tratamiento. Agradecemos nos autorices para que la edugestora de la zona pueda gestionar la situación y dar continuidad al proceso. Cabe resaltar que ya se radicó la queja correspondiente, pero hasta la fecha no hemos obtenido respuesta.
<br>
<br>
ID PACIENTE:<b> $PAP </b>
<br>
DIAGNÓSTICO:<b> $CLASIFICACION </b>
<br />
ASEGURADOR:<b> $ASEGURADOR </b>
<br>
OPL:<b> $OPL </b>
<br>
PUNTO DE ENTREGA:<b> $PUNTO_ENTREGA </b>
<br>
CIUDAD:<b> $CIUDAD </b>
<br>
MEDICAMENTO:<b> $TRATAMIENTO </b>
<br>
DOSIS TRATAMIENTO:<b> $DOSIS </b>
<br>
CAUSAL DE NO RECLAMACIÓN:<b> $CAUSAL </b>
<br>
NUMERO DE PENDIENTE:<b> $NUMERO_PENDIENTE </b>
<br>
FECHA PENDIENTE:<b> $FECHA_PENDIENTE </b>
<br>
MEDICO TRATANTE:<b> $MEDICO_TRATAMIENTO </b>
<br>
<br>
<b>RESPUESTA DEL RECHAZO:</b> $OBSERVACION_ESCALAMIENTO
<br>
<br>
Cordial Saludo
<br>
<br>
<b> Paola Gonzalez </b>
<br>
<br>";

$subject = "$PAP - $CAUSAL - $TRATAMIENTO - $fecha";

$mail->Body = $body;
$mail->Subject = $subject;
// $mail->addAddress('ygonzalez@overall.com.co');
$mail->addAddress('bjimenez@overall.com.co');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->clearAddresses();
$mail->clearAttachments();
$mail->smtpClose();
