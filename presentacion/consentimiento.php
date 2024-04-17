<?php
$ID_PACIENTE = $_POST['ID_PACIENTE'];
$ID_GESTION_ULT = $_POST['ID_GESTION_ULT'];
// $PAP = base64_encode($ID_PACIENTE);
// $GES = base64_encode($ID_GESTION_ULT);
$time = strtotime("now +168 hours");
$dominio = 'http://ec2-34-233-161-124.compute-1.amazonaws.com:8007';
$url = "{$dominio}/presentacion/plantilla_ci.php?pap={$ID_PACIENTE}&ges={$ID_GESTION_ULT}&expires={$time}";
$key = "base64:yv051saGBdRpua6fS3ec5gR8jeymLoIfnejGQSzj70g=";
$signature = hash_hmac("sha256", $url, $key);

// Crear la URL con la firma incluida
$url_with_signature = $url . "&signature=" . $signature;

echo '<input type="text" value=' . $url_with_signature . ' readonly id="url_consentimiento" style="display: none; width:100%;">';
