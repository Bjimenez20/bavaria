<?php

require_once("./../../datos/conex.php");

$SELECT_GES = mysqli_query($conex, "SELECT ID_GESTION FROM ipsen_gestiones_aspirante ORDER BY ID_GESTION DESC LIMIT 1");
while ($fila2 = mysqli_fetch_array($SELECT_GES)) {
    $ID_GES = $fila2['ID_GESTION'];
}
$CARPETA = "../../ADJUNTOS_BAYER/$ID_GES";
if (!is_dir($CARPETA)) {
    mkdir("../../ADJUNTOS_BAYER/$ID_GES", 0777);
}
move_uploaded_file($_FILES['archivo']['tmp_name'], "../../ADJUNTOS_BAYER/$ID_GES/" . $_FILES['archivo']['name']);
