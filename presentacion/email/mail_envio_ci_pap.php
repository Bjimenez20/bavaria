<?php
require_once('PHPMailer.php');
$select_ci_pap = mysqli_query($conex, "SELECT * FROM ipsen_informacion_ci ORDER BY ID DESC LIMIT 1");
while ($datos_ci_pap = mysqli_fetch_array($select_ci_pap)) {
    $ID = $datos_ci_pap['ID'];
    $NOMBRE_PACIENTE = $datos_ci_pap['NOMBRE_PACIENTE'];
    $PAP = $datos_ci_pap['ID_PACIENTE_FK'];
    $CORREO = $datos_ci_pap['CORREO'];
}
$select_tra = mysqli_query($conex, "SELECT * FROM ipsen_tratamiento WHERE ID_PACIENTE_FK = '$PAP'");
while ($datos_tra = mysqli_fetch_array($select_tra)) {
    $PROGRAMA_TRA = $datos_tra['PROGRAMA_TRA'];
}
$mail->isSMTP();
$mail->SMTPAuth = true;
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Con el fin de confirmar la recepción de la firma de su consentimiento queremos informarle, que, a su correo electrónico, le llegara el formato que usted acaba de firma, esto con el fin de garantizar el recibido del documento.
<br />
<br />
Que tenga un feliz día, le desea el programa de soporte a pacientes " . $PROGRAMA_TRA . ".
<br />
<br />
Correo enviado de manera automatica.";

$subject = "Consentimiento informado - Programa de soporte a pacientes - " . $PROGRAMA_TRA . "";
$mail->isHTML(true);
$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress($CORREO);
$mail->addAddress('bjimenez@app-peoplemarketing.com');
$mail->addAttachment('../PDF_CI/' . $ID . '/' . $NOMBRE_PACIENTE . '_' . $PAP . '.pdf');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
