<?php 
require_once('PHPMailer.php');
$select = mysqli_query($conex, "SELECT CORREO_PACIENTE, ID_ULTIMA_GESTION FROM ipsen_pacientes WHERE ID_PACIENTE ='" . $codigo_usuario2 . "'");
while ($datos = mysqli_fetch_array($select)) {
$ID_ULTIMA_GESTION = $datos['ID_ULTIMA_GESTION'];
$CORREO_PACIENTE = $datos['CORREO_PACIENTE'];
}
$time = strtotime("now +168 hours");
$dominio = 'http://localhost:8000';
$url = "{$dominio}/presentacion/plantilla_ci.php/{$ID_PACIENTE}/{$ID_GESTION_ULT}?expires={$time}";
$length = 32; // Longitud de la clave en bytes (debes ajustarla según tus necesidades)
$randomBytes = openssl_random_pseudo_bytes($length);
$secretKey = bin2hex($randomBytes); // Convierte los bytes aleatorios en una cadena hexadecimal
// $key = "base64:yv051saGBdRpua6fS3ec5gR8jeymLoIfnejGQSzj70g=";
$signature = hash_hmac("sha256", $url, $secretKey);
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Estimado Paciente
<br />
<br />
Con el fin de legalizar su ingreso al programa y de acuerdo mencionado durante su llamada de registro es necesario realizar la firma de los consentimientos informados, por lo cual le hago llegar el documento por este medio con el fin de que pueda revisarlo y diligenciar los campos correspondientes de forma digital sin necesidad de imprimir el documento a través del siguiente link:
<br />
<br />
$url&signature=$signature
<br />
<br />
Que tenga un feliz día, le desea el programa de apoyo a pacientes Bayer contigo.
<br>
<br>";

$subject = "Firma consentimiento informado - Programa de soporte a pacientes Bayer Contigo";

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress($CORREO_PACIENTE);
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->clearAddresses();
$mail->clearAttachments();
$mail->smtpClose();
?>