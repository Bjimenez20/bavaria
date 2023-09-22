<?php

require_once("./../../../datos/conex.php");

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$document = $data['documento'];

$sql = "SELECT ID_ASPIRANTE, ID_ULTIMA_GESTION, TELEFONO_PACIENTE, ESTADO_PACIENTE ,PRODUCTO_TRATAMIENTO FROM ipsen_aspirantes INNER JOIN ipsen_tratamiento_aspirante ON ID_ASPIRANTE_FK = ID_ASPIRANTE WHERE IDENTIFICACION_PACIENTE = '$document'";
$resultado = mysqli_query($conex, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $row = mysqli_fetch_assoc($resultado);
    $ID_ASPIRANTE = $row['ID_ASPIRANTE'];
    $ID_ULTIMA_GESTION = $row['ID_ULTIMA_GESTION'];
    $TELEFONO_PACIENTE = $row['TELEFONO_PACIENTE'];
    $ESTADO_PACIENTE = $row['ESTADO_PACIENTE'];
    $PRODUCTO_TRATAMIENTO = $row['PRODUCTO_TRATAMIENTO'];
    $response = array(
        'mensaje' => 'El aspirante ya existe en el sistema <br><br>
            <P style="color: bold;">Terapia: ' . $PRODUCTO_TRATAMIENTO . ' </P>
            <P style="color: bold;">Estado:  ' . $ESTADO_PACIENTE . '</P>',
        'tipo' => 'warning',
        'title' => 'Consulta realizada',
        'aspirante' => $ID_ASPIRANTE,
        'telefono' => $TELEFONO_PACIENTE,
        'gestion' => $ID_ULTIMA_GESTION,
        'artid' => base64_encode($ID_ASPIRANTE),
        'artge' => base64_encode($ID_ULTIMA_GESTION)
    );

    echo json_encode($response);
} else {
    $response = array(
        'mensaje' => 'Este documento es correcto para continuar con la tipificación',
        'tipo' => 'success',
        'title' => 'Verificación exitosa'
    );
    echo json_encode($response);
}
