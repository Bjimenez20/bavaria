<?php
require_once("./../../../datos/conex.php");
require_once('PHPMailer.php');

// Recupera los datos enviados por Axios
$data = json_decode(file_get_contents('php://input'));

$sql_paciente_new = mysqli_query($conex, "SELECT * FROM ipsen_pacientes ORDER BY ID_PACIENTE DESC LIMIT 1");
while ($row_paciente_new = mysqli_fetch_array($sql_paciente_new)) {
    $ID_PACIENTE = $row_paciente_new['ID_PACIENTE'];
}

$subject = "BAYER PACIENTE NUEVO - $data->producto_tratamiento - PAP$ID_PACIENTE";

// Define el contenido del correo electrónico
// $mail->addAddress('claudiapatricia.rojas@bayer.com');
// $mail->addAddress('jessica.vera@litya.ec');
// $mail->addAddress('mayra.chipuqsi@litya.ec');
// $mail->addAddress('coordinacion@encontactopeoplemarketing.com');
$mail->addAddress('bjimenez@app-peoplemarketing.com');
$mail->Subject = $subject;
$mail->Body = "
Buen dia,
<br />
<br />
Ingreso al Programa
<br>
<br>
Terapia: " . $data->producto_tratamiento . "
<br>
<br>
Codigo del Paciente: PAP" . $ID_PACIENTE . "
<br>
<br>
Ciudad: " . $data->ciudad . "
<br>
<br>
Eps: " . $data->asegurador . "
<br>
<br>
Ips Que Atiende: Sin dato 
<br>
<br>
Dosis: " . $data->Dosis . $data->Dosis2 . $data->Dosis3 . $data->Dosis_ant . "
<br>
<br>
Indicacion: " . $data->clasificacion_patologica . "
<br>
<br>
Fecha de ingreso al Programa: " . $data->fecha_activacion . "
<br>
<br>
observacion: " . $data->nota . "
<br>
<br>
Cualquier inquietud con gusto sera atendida.
<br />
<br />
Correo enviado de manera automatica.
<br>
<br>
";

// Envía el correo electrónico
try {
    $mail->send();
    $response = ['success' => true];
} catch (Exception $e) {
    $response = ['error' => $mail->ErrorInfo];
}

// Devuelve la respuesta a Axios
header('Content-Type: application/json');
echo json_encode($response);
