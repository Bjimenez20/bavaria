<?php
require_once("./../../datos/conex.php");

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

$busqueda = $data['busqueda'];

if (empty($busqueda)) {
    $campos_vacios = array();

    if (empty($busqueda)) {
        array_push($campos_vacios, 'Numero de documento o teléfono');
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

    $sql = "SELECT ID_ASPIRANTE, ID_ULTIMA_GESTION FROM ipsen_aspirantes WHERE IDENTIFICACION_PACIENTE = '$busqueda' OR TELEFONO_PACIENTE = '$busqueda'";
    $resultado = mysqli_query($conex, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        $ID_ASPIRANTE = $row['ID_ASPIRANTE'];
        $ID_ULTIMA_GESTION = $row['ID_ULTIMA_GESTION'];
        $response = array(
            'mensaje' => 'El aspirante ya existe en el sistema',
            'tipo' => 'warning',
            'title' => 'Consulta realizada',
            'aspirante' => $ID_ASPIRANTE,
            'gestion' => $ID_ULTIMA_GESTION,
            'artid' => base64_encode($ID_ASPIRANTE),
            'artge' => base64_encode($ID_ULTIMA_GESTION)
        );

        echo json_encode($response);
    } else {
        $response = array(
            'mensaje' => 'El aspirante no existe en el sistema',
            'tipo' => 'success',
            'title' => 'Habilitando formulario...'
        );
        echo json_encode($response);
    }
}
