<?php
$enlace = $_POST['enlace'];
$file = file("$enlace");
$file2 = implode("", $file);
$porciones = explode("/", $enlace);
$nombre_archivo = $porciones[3];
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=$nombre_archivo");
echo $file2;
