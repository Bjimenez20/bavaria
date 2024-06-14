<?php
require_once('PHPMailer.php');
$fecha = date("Y-m-d");
$body = "
Buen dia,
<br />
<br />
Se requiere Habilitar en el sistema el siguiente Operador logistico:
<br>
<br>
Operador logistico por habilitar: " . $operador_logistico . "
<br>
<br>
Asesor que solicita: " . $usua . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>";

$subject = 'Habilitar Operador Logistico';

$mail->Body = $body;
$mail->Subject = $subject;
$mail->addAddress('bjimenez@app-peoplemarketing.com');
$mail->Send() ? "Enviado" : "Problema al enviar";
$mail->smtpClose();
