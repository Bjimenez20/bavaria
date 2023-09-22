<?php
require_once("./../../../datos/conex.php");

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$phone = $data['phone'];

if (empty($phone)) {
    $campos_vacios = array();

    if (empty($phone)) {
        array_push($campos_vacios, 'Numero de telefono');
    }

    if (count($campos_vacios) > 0) {
        $mensaje = 'Por favor completa los siguientes campos:';
        $lista = '<ul class="my-3">';
        foreach ($campos_vacios as $campo) {
            $lista .= '<li class="text-start">' . $campo . '</li>';
        }
        $lista .= '</ul>';
        $mensaje .= $lista;
        $response = array(
            'mensaje' => $mensaje,
            'tipo' => 'error',
            'title' => 'Campos vacios'
        );
        echo json_encode($response);
    }
} else {

    $sql = "SELECT ID_ASPIRANTE, ID_ULTIMA_GESTION, IDENTIFICACION_PACIENTE, ESTADO_PACIENTE ,PRODUCTO_TRATAMIENTO FROM ipsen_aspirantes INNER JOIN ipsen_tratamiento_aspirante ON ID_ASPIRANTE_FK = ID_ASPIRANTE WHERE TELEFONO_PACIENTE = '$phone'";
    $resultado = mysqli_query($conex, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        $ID_ASPIRANTE = $row['ID_ASPIRANTE'];
        $ID_ULTIMA_GESTION = $row['ID_ULTIMA_GESTION'];
        $IDENTIFICACION_PACIENTE = $row['IDENTIFICACION_PACIENTE'];
        $ESTADO_PACIENTE = $row['ESTADO_PACIENTE'];
        $PRODUCTO_TRATAMIENTO = $row['PRODUCTO_TRATAMIENTO'];
        $response = array(
            'mensaje' => 'El aspirante ya existe en el sistema <br><br>
            <P style="color: bold;">Terapia: ' . $PRODUCTO_TRATAMIENTO . ' </P>
            <P style="color: bold;">Estado:  ' . $ESTADO_PACIENTE . '</P>',
            'tipo' => 'warning',
            'title' => 'Consulta realizada',
            'aspirante' => $ID_ASPIRANTE,
            'identificacion' => $IDENTIFICACION_PACIENTE,
            'gestion' => $ID_ULTIMA_GESTION,
            'artid' => base64_encode($ID_ASPIRANTE),
            'artge' => base64_encode($ID_ULTIMA_GESTION)
        );

        echo json_encode($response);
    } else {
        $response = array(
            'mensaje' => 'No hemos podidos encontrar el telefono, el aspirante no existe en el sistema',
            'tipo' => 'warning',
            'title' => 'Habilitando formulario...',
            'validation' => 'phone_error'
        );
        echo json_encode($response);
    }
}
