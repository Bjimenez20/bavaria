<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin título</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
</head>
<?PHP
require('../datos/parse_str.php');
require('../datos/conex.php');
$consulta_PACIENTES;
$hoy = date('Y-m-d');
if ($privilegios != '' && $usua != '') {
    if (!isset($_POST['buscar'])) {
        if ($privilegios == 1 || $privilegios == 3) {
            $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE INNER JOIN ipsen_gestiones_aspirante WHERE ID_GESTION = ID_ULTIMA_GESTION ORDER BY ID_ASPIRANTE");
            echo mysqli_error($conex);
            $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE INNER JOIN ipsen_gestiones_aspirante WHERE ID_GESTION = ID_ULTIMA_GESTION ORDER BY ID_ASPIRANTE LIMIT";
        }
        if ($privilegios == 2) {
            $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
			INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
			INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE
			WHERE G.ESTADO_GESTION!='GESTIONADO' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
            echo mysqli_error($conex);
            $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
			INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
			INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE
			WHERE G.ESTADO_GESTION!='GESTIONADO' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
        }
        if ($privilegios == 4) {
            $consulta_ref = 0;
            echo mysqli_error($conex);
            $consulta_PACIENTES = 0;
            $num_total_registros = 0;
        }
    }
    if (isset($_POST['buscar'])) {
        $privilegios;
        if ($privilegios == 1 || $privilegios == 2 || $privilegios == 3) {
            $NOMBRE = $_POST['nombre'];
            $DOCUMENTO = $_POST['documento'];
            $TELEFONO = $_POST['telefono'];
            $PAP = $_POST['PAP'];
        }
        if ($privilegios == 4) {
            $NOMBRE = '';
            $DOCUMENTO = '';
            $TELEFONO = '';
            $PAP = $_POST['PAP'];
        }
        if ($NOMBRE == '' and $DOCUMENTO == '' and $TELEFONO == '' and $PAP == '') {
            if ($privilegios == 1 || $privilegios == 3) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                echo mysqli_error($conex);
                $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
            }
            if ($privilegios == 2) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE
				WHERE G.ESTADO_GESTION!='GESTIONADO' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                echo mysqli_error($conex);
                $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE
				WHERE G.ESTADO_GESTION!='GESTIONADO' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
            }
        }
        if ($NOMBRE != '' and $DOCUMENTO == '' and $TELEFONO == '' and $PAP == '') {
            if ($privilegios == 1 || $privilegios == 3) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE CONCAT(P.NOMBRE_PACIENTE,' ',P.APELLIDO_PACIENTE) LIKE '%" . $NOMBRE . "%' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE CONCAT(P.NOMBRE_PACIENTE,' ',P.APELLIDO_PACIENTE) LIKE '%" . $NOMBRE . "%'GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
            }
            if ($privilegios == 2) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE CONCAT(P.NOMBRE_PACIENTE,' ',P.APELLIDO_PACIENTE) LIKE '%" . $NOMBRE . "%' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE CONCAT(P.NOMBRE_PACIENTE,' ',P.APELLIDO_PACIENTE) LIKE '%" . $NOMBRE . "%'GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
            }
        }
        if ($DOCUMENTO != '' and $NOMBRE == '' and $TELEFONO == '' and $PAP == '') {
            if ($privilegios == 1 || $privilegios == 3) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                echo mysqli_error($conex);
                if (mysqli_num_rows($consulta_ref) > 0) {
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                } else {
                    $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                    echo mysqli_error($conex);
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                }
            }
            if ($privilegios == 2) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                echo mysqli_error($conex);
                if (mysqli_num_rows($consulta_ref) > 0) {
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                } else {
                    $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                    echo mysqli_error($conex);
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                }
            }
        }
        if ($TELEFONO != '' and $NOMBRE == '' and $DOCUMENTO == '' and $PAP == '') {
            if ($privilegios == 1 || $privilegios == 3) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE TELEFONO_PACIENTE='" . $TELEFONO . "' OR TELEFONO2_PACIENTE='" . $TELEFONO . "'  OR TELEFONO3_PACIENTE='" . $TELEFONO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE TELEFONO_PACIENTE='" . $TELEFONO . "' OR TELEFONO2_PACIENTE='" . $TELEFONO . "'  OR TELEFONO3_PACIENTE='" . $TELEFONO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
            }
            if ($privilegios == 2) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE TELEFONO_PACIENTE='" . $TELEFONO . "' OR TELEFONO2_PACIENTE='" . $TELEFONO . "'  OR TELEFONO3_PACIENTE='" . $TELEFONO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE TELEFONO_PACIENTE='" . $TELEFONO . "' OR TELEFONO2_PACIENTE='" . $TELEFONO . "'  OR TELEFONO3_PACIENTE='" . $TELEFONO . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
            }
        }
        if ($TELEFONO == '' and $NOMBRE == '' and $DOCUMENTO == '' and $PAP != '') {
            if ($privilegios == 1 || $privilegios == 3) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN(SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                echo mysqli_error($conex);
                if (mysqli_num_rows($consulta_ref) > 0) {
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                } else {
                    $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                    echo mysqli_error($conex);
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                }
            }
            if ($privilegios == 2) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                echo mysqli_error($conex);
                if (mysqli_num_rows($consulta_ref) > 0) {
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                } else {
                    $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                    echo mysqli_error($conex);
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                }
            }
            if ($privilegios == 4) {
                $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
				INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
				INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                echo mysqli_error($conex);
                if (mysqli_num_rows($consulta_ref) > 0) {
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					INNER JOIN (SELECT * FROM ipsen_gestiones_aspirante ORDER BY ID_GESTION DESC) AS G ON G.ID_ASPIRANTE_FK2=P.ID_ASPIRANTE WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                } else {
                    $consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC");
                    echo mysqli_error($conex);
                    $consulta_PACIENTES = "SELECT * FROM ipsen_aspirantes AS P
					INNER JOIN ipsen_tratamiento_aspirante AS T ON T.ID_ASPIRANTE_FK=P.ID_ASPIRANTE
					WHERE ID_ASPIRANTE='" . $PAP . "' GROUP BY P.ID_ASPIRANTE  ORDER BY P.ID_ASPIRANTE ASC LIMIT";
                }
            }
        }
    }
?>

    <body>
        <?php
        $url = "../presentacion/listado_aspirantes.php";
        if ($privilegios == 1 || $privilegios == 2 || $privilegios == 3) {
            $num_total_registros = mysqli_num_rows($consulta_ref);
        }
        if (isset($_POST['buscar']) && $privilegios == 4) {
            $num_total_registros = mysqli_num_rows($consulta_ref);
        }
        if ($num_total_registros > 0) {
        ?>
            <table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
                <tr>
                    <th width="9%" class="botones">CODIGO</th>
                    <?php
                    if ($privilegios != 4) {
                    ?>
                        <th width="31%" class="botones">NOMBRE</th>
                        <th width="12%" class="botones">DOCUMENTO</th>
                    <?php } ?>
                    <th width="7%" class="botones">GENERO</th>
                    <th width="12%" class="botones">CIUDAD</th>
                    <th width="12%" class="botones">PRODUCTO</th>
                    <?php
                    if ($privilegios == 1 || $privilegios == 2 || $privilegios == 3) {
                    ?>
                        <th width="11%" class="botones">PROXIMO CONTACTO</th>
                        <th width="11%" class="botones">ESTADO GESTION</th>
                        <th width="6%" class="botones">EDITAR</th>
                        <th width="6%" class="botones">MODIFICAR</th>
                    <?php
                    }
                    if ($privilegios == 1 and $usua != 'AArango' and $usua != 'ORagua' and $usua != 'ABulla' and $usua != 'brayan') {
                    ?>
                        <!-- <th width="6%" class="botones">MODIFICAR</th> -->
                    <?php
                    }
                    if ($privilegios == 4) {
                    ?>
                        <th width="6%" class="botones">GESTION</th>
                        <th width="6%" class="botones">ENVIO</th>
                    <?php
                    }
                    ?>
                </tr>
                <?PHP
                $TAMANO_PAGINA = 15;
                $pagina = false;
                if (isset($_GET["pagina"]))
                    $pagina = $_GET["pagina"];
                if (!$pagina) {
                    $inicio = 0;
                    $pagina = 1;
                } else {
                    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
                }
                $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
                $consulta = "$consulta_PACIENTES " . $inicio . "," . $TAMANO_PAGINA;
                $consulta_ref = mysqli_query($conex, $consulta);
                while ($fila1 = mysqli_fetch_array($consulta_ref)) {
                ?>
                    <tr align="center">
                        <td><?php echo 'PAP' . $fila1['ID_ASPIRANTE'] ?></td>
                        <?php
                        if ($privilegios == '7') {
                            if ($privilegios == '7') {
                        ?>
                                <td align="left"><?php echo $fila1['NOMBRE_PACIENTE'] . ' ' . $fila1['APELLIDO_PACIENTE'] ?></td>
                                <td><?php echo $fila1['IDENTIFICACION_PACIENTE'] ?></td>
                            <?php } ?>
                            <td><?php echo $fila1['GENERO_PACIENTE'] ?></td>
                            <td><?php echo $fila1['CIUDAD_PACIENTE'] ?></td>
                        <?php } else { ?>
                            <td>****</td>
                            <td>****</td>
                            <td>****</td>
                            <td>****</td>
                        <?php } ?>
                        <td><?php echo $fila1['PRODUCTO_TRATAMIENTO'] ?></td>
                        <?php
                        if ($privilegios == 1 || $privilegios == 2 || $privilegios == 3) {
                        ?>
                            <?php
                            $gestion = mysqli_query($conex, "SELECT * FROM `ipsen_gestiones_aspirante` WHERE `ID_ASPIRANTE_FK2` = '" . $fila1['ID_ASPIRANTE'] . "' ORDER BY `FECHA_COMUNICACION` DESC LIMIT 1");
                            while ($fila2 = mysqli_fetch_array($gestion)) {
                                echo "<td>" . $fila2['FECHA_PROGRAMADA_GESTION'] . "</td>";
                                echo "<td>" . $fila2['ESTADO_GESTION'] . "</td>";
                            }
                            ?>
                            <td>
                                <?php
                                $sqlusu = mysqli_query($conex, "SELECT PROGRAMA FROM ipsen_usuario WHERE USER = '" . $usua . "' ");
                                echo mysqli_error($conex);
                                while ($row1 = mysqli_fetch_array($sqlusu)) {
                                    $PROGRAMA = $row1['PROGRAMA'];
                                }
                                if ($PROGRAMA == "PAAP") { ?>
                                    <a href="../presentacion/form_aspirante.php?artid=<?php echo base64_encode($fila1['ID_ASPIRANTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="20" height="20" /></a>
                                <?php } else { ?>
                                    <a href="../presentacion/form_aspirante.php?artid=<?php echo base64_encode($fila1['ID_ASPIRANTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="20" height="20" /></a>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="../presentacion/form_aspirante_modificacion.php?artid=<?php echo base64_encode($fila1['ID_ASPIRANTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="20" height="20" /></a>
                            </td>
                        <?php
                        }
                        ?>
                        <?php
                        if ($privilegios == 4) {
                        ?>
                            <td><a href="../presentacion/form_aspirante.php?artid=<?php echo base64_encode($fila1['ID_ASPIRANTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="20" height="20" /></a></td>
                            <td><a href="../presentacion/envio_fundem.php?artid=<?php echo base64_encode($fila1['ID_ASPIRANTE']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="20" height="20" /></a></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
                <tr bgcolor="#FFFFFF" class="titulo" align="center">
                    <td colspan="3" class="botones">Se encontraron Registros <?php echo $num_total_registros; ?></td>
                    <td colspan="8" class="botones">
                        <?php
                        if ($total_paginas > 1) {
                            if ($pagina != 1)
                                echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
                            for ($i = 1; $i <= $total_paginas; $i++) {
                                if ($pagina == $i)
                                    echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
                                else
                                    echo '  <a href="' . $url . '?pagina=' . $i . '" style="font-size:110%;">' . $i . '</a>  ';
                            }
                            if ($pagina != $total_paginas)
                                echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '"><img src="../presentacion/imagenes/der.gif" border="0"></a>';
                        }
                        echo '</p>';
                        ?></td>
                </tr>
            </table>
        <?php
        } else {
        ?>
            <span style="margin-top:1%;">
                <center>
                    <img src="../presentacion/imagenes/advertencia2.png" style="width:70px; margin-top:1%;" />
                </center>
            </span>
            <p class="error" style=" width:68.9%; margin:auto auto;">
                <span style="border-left-color:#fff">NO SE ENCUENTRAN REGISTROS CON ESTA INFORMACI&Oacute;N.</span>
            </p>
        <?php
        }
        ?>
    </body>
<?php
} else {
?>
    <script type="text/javascript">
        window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
    </script>
<?php
}
?>

</html>