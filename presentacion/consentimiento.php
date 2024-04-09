<?php
$ID_PACIENTE = $_POST['ID_PACIENTE'];
$ID_GESTION_ULT = $_POST['ID_GESTION_ULT'];
$time = strtotime("now +168 hours");
$dominio = 'http://localhost:8000';
$url = "{$dominio}/presentacion/plantilla_ci.php?pap={$ID_PACIENTE}&ges={$ID_GESTION_ULT}&expires={$time}";
$length = 32; // Longitud de la clave en bytes (ajusta según necesites)
$randomBytes = openssl_random_pseudo_bytes($length);
$secretKey = bin2hex($randomBytes); // Convierte los bytes aleatorios en una cadena hexadecimal
$signature = hash_hmac("sha256", $url, $secretKey);

// Crear la URL con la firma incluida
$url_with_signature = $url . "&signature=" . $signature;

echo '<input type="text" value=' . $url_with_signature . ' readonly id="url_consentimiento" style="display: none; width:100%;">';
?>
