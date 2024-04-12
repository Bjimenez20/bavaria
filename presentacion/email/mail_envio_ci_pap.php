<?php
require_once('PHPMailer.php');
$select_ci_pap = mysqli_query($conex, "SELECT * FROM ipsen_informacion_ci ORDER BY ID DESC LIMIT 1");
while ($datos_ci_pap = mysqli_fetch_array($select_ci_pap)) {
    $NOMBRE_PACIENTE = $datos_ci_pap['NOMBRE_PACIENTE'];
    $PAP = $datos_ci_pap['PAP'];
}
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Adjunto envio Consentimiento informado con la firma incorporada.
<br />
$NOMBRE_PACIENTE - $PAP
<br />
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.";


$subject = "PROGRAMA DE PACIENTES IPSEN $NOMBRE_PACIENTE - $PAP";

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress('bjimenez@overall.com.co');
$mail->addAttachment('../../EVENTO_ADVERSO/' . $PAP . '.pdf');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();