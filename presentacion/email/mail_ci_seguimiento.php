<?php
require_once('PHPMailer.php');
$select = mysqli_query($conex, "SELECT CORREO_PACIENTE, ID_ULTIMA_GESTION FROM ipsen_pacientes WHERE ID_PACIENTE ='" . $codigo_usuario2 . "'");
while ($datos = mysqli_fetch_array($select)) {
    $ID_PACIENTE = $datos['ID_PACIENTE'];
    $ID_ULTIMA_GESTION = $datos['ID_ULTIMA_GESTION'];
    $CORREO_PACIENTE = $datos['CORREO_PACIENTE'];
}
$time = strtotime("now +168 hours");
$dominio = 'http://localhost:8000';
$url = "{$dominio}/presentacion/plantilla_ci.php?pap={$codigo_usuario2}&ges={$ID_ULTIMA_GESTION}&expires={$time}";
$length = 32; // Longitud de la clave en bytes (ajusta según necesites)
$randomBytes = openssl_random_pseudo_bytes($length);
$secretKey = bin2hex($randomBytes); // Convierte los bytes aleatorios en una cadena hexadecimal
$signature = hash_hmac("sha256", $url, $secretKey);

// Crear la URL con la firma incluida
$url_with_signature = $url . "&signature=" . $signature;
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Estimado Paciente
<br />
<br />
Con el fin de legalizar su ingreso al programa y de acuerdo con lo mencionado durante su llamada de registro, es necesario realizar la firma del consentimiento informado, por lo cual le hago llegar el documento por este medio con el fin de que pueda revisarlo, confirmar su información y firmar de forma digital, sin necesidad de imprimir el documento, con solo dibujar su firma.
<br />
<br />
$url_with_signature
<br />
<br />
Que tenga un feliz día, le desea el programa de soporte a pacientes " . $programa . ".
<br>
<br>";

$subject = "Firma consentimiento informado - Programa de soporte a pacientes " . $programa . " - IPSEN";

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress($CORREO_PACIENTE);
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->clearAddresses();
$mail->clearAttachments();
$mail->smtpClose();
