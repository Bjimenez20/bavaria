<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BAVARIA</title>
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
    <link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
    <link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
    <style>
        .error {
            font-size: 130%;
            font-weight: bold;
            color: red;
            text-transform: uppercase;
            background-color: transparent;
            text-align: center;
            padding: 10px;
        }

        html {
            background: url(../presentacion/imagenes/background.png) no-repeat fixed center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        @media screen and (max-width:1000px) {
            html {
                background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        }
    </style>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
?>

<body>
    <div>
        <img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
    </div>
    <form name="solicitud" id="solicitud" method="post" style="width:100%; margin-top:50px;">
        <?php
        $ID_PACIENTE = base64_decode($xxx);
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_historial_reclamacion WHERE ID_PACIENTE_FK='$ID_PACIENTE' ORDER BY ID_HISTORIAL_RECLAMACION ASC");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM ipsen_historial_reclamacion WHERE ID_PACIENTE_FK='$ID_PACIENTE' ORDER BY ID_HISTORIAL_RECLAMACION ASC LIMIT";
        $url = "../presentacion/form_historico_reclamacion.php";
        $num_total = mysqli_num_rows($SELECT_SOLICITUDES_TOTAL);
        if ($num_total > 0) {
        ?>
            <br><br><br><br><br><br><b></b><br>
            <table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
                <tr>
                    <th class="botones">A&Ntilde;O</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                    <th class="botones">MES</th>
                    <th class="botones">RECLAMACION</th>
                    <th class="botones">FECHA RECLAMACION</th>
                    <th class="botones">MOTIVO NO RECLAMACION</th>
                </tr>
                <?PHP
                $TAMANO_PAGINA = 10;
                $pagina = false;
                if (isset($_GET["pagina"]))
                    $pagina = $_GET["pagina"];
                if (!$pagina) {
                    $inicio = 0;
                    $pagina = 1;
                } else {
                    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
                }
                $total_paginas = ceil($num_total / $TAMANO_PAGINA);
                $consulta = "$SELECT_SOLICITUDES " . $inicio . "," . $TAMANO_PAGINA;
                $consulta_sol = mysqli_query($conex, $consulta);
                $x = 0;
                while ($fila1 = mysqli_fetch_array($consulta_sol)) {
                    $x = $x + 1;
                ?>
                    <tr align="center">
                        <td><?php echo date('Y'); ?></td>
                        <td><?php echo 'ENERO' ?></td>
                        <td><?php echo $fila1['RECLAMO1'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION1'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION1'] ?></td>
                        <td><?php echo 'FEBRERO' ?></td>
                        <td><?php echo $fila1['RECLAMO2'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION2'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION2'] ?></td>
                        <td><?php echo 'MARZO' ?></td>
                        <td><?php echo $fila1['RECLAMO3'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION3'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION3'] ?></td>
                        <td><?php echo 'ABRIL' ?></td>
                        <td><?php echo $fila1['RECLAMO4'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION4'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION4'] ?></td>
                        <td><?php echo 'MAYO' ?></td>
                        <td><?php echo $fila1['RECLAMO5'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION5'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION5'] ?></td>
                        <td><?php echo 'JUNIO' ?></td>
                        <td><?php echo $fila1['RECLAMO6'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION6'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION6'] ?></td>
                        <td><?php echo 'JULIO' ?></td>
                        <td><?php echo $fila1['RECLAMO7'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION7'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION7'] ?></td>
                        <td><?php echo 'AGOSTO' ?></td>
                        <td><?php echo $fila1['RECLAMO8'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION8'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION8'] ?></td>
                        <td><?php echo 'SEPTIEMBRE' ?></td>
                        <td><?php echo $fila1['RECLAMO9'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION9'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION9'] ?></td>
                        <td><?php echo 'OCTUBRE' ?></td>
                        <td><?php echo $fila1['RECLAMO10'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION10'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION10'] ?></td>
                        <td><?php echo 'NOVIEMBRE' ?></td>
                        <td><?php echo $fila1['RECLAMO11'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION11'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION11'] ?></td>
                        <td><?php echo 'DICIEMBRE' ?></td>
                        <td><?php echo $fila1['RECLAMO12'] ?></td>
                        <td><?php echo $fila1['FECHA_RECLAMACION12'] ?></td>
                        <td><?php echo $fila1['MOTIVO_NO_RECLAMACION12'] ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr bgcolor="#FFFFFF" class="titulo" align="center">
                    <td colspan="5" class="botones">Se encontraron Registros <?php echo $num_total; ?></td>
                    <td colspan="44" class="botones">
                        <?php
                        if ($total_paginas > 1) {
                            if ($pagina != 1)
                                echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '&xxx=' . base64_encode($ID_PACIENTE) . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
                            for ($i = 1; $i <= $total_paginas; $i++) {
                                if ($pagina == $i)
                                    echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
                                else
                                    echo '  <a href="' . $url . '?pagina=' . $i . '&xxx=' . base64_encode($ID_PACIENTE) . '" style="font-size:110%;">' . $i . '</a>  ';
                            }
                            if ($pagina != $total_paginas)
                                echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '&xxx=' . base64_encode($ID_PACIENTE) . '"><img src="../presentacion/imagenes/der.gif" border="0"></a>';
                        }
                        echo '</p>';
                        ?>
                    </td>
                </tr>
            <?php
        } else {
            ?>
                <span style="margin-top:1%;">
                    <center>
                        <img src="../presentacion/imagenes/advertencia2.png" style="width:70px; margin-top:1%;" />
                    </center>
                </span>
                <p class="error" style=" width:68.9%; margin:auto auto;">
                    <span style="border-left-color:#fff">NO SE ENCUENTRAR REGISTROR CON ESTA INFORMACI&Oacute;N.</span>
                </p>
            <?php
        }
            ?>
            </table>
    </form>
</body>

</html>