<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BAVARIA</title>
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
if ($privilegios != '' && $usua != '') {
?>

    <body>
        <?php
        $url = "../presentacion/listado_usuario.php";
        $SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_operador_logistico ORDER BY ID_OPERADOR_LOGISTICO ASC");
        $num_total = mysqli_num_rows($SELECT_USUARIO_TOTAL);
        if ($num_total > 0) {
        ?>
            <table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
                <tr>
                    <th class="botones">#</th>
                    <th class="botones">OPERADOR LOGISTICO</th>
                    <th class="botones">ACCION</th>
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
                $consulta = "$SELECT_USUARIO " . $inicio . "," . $TAMANO_PAGINA;
                $consulta_ref = mysqli_query($conex, $consulta);
                while ($fila1 = mysqli_fetch_array($consulta_ref)) {
                ?>
                    <tr align="center">
                        <td><?php echo $fila1['ID_OPERADOR_LOGISTICO'] ?></td>
                        <td><?php echo $fila1['OPERADOR_LOGISTICO'] ?></td>
                        <td>
                            <?php
                            if ($privilegios == '1') {
                                $NOM = $fila1['USER'];
                                $ESTA = $ESTADO;
                                $ID = $fila1['ID_USUARIO'];
                                accion($ID, $NOM);
                                estado($ESTA, $ID);
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr bgcolor="#FFFFFF" class="titulo" align="center">
                    <td colspan="2" class="botones">Se encontraron Registros <?php echo $num_total; ?></td>
                    <td colspan="8" class="botones">
                        <?php
                        if ($total_paginas > 1) {
                            if ($pagina != 1)
                                echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
                            for ($i = 1; $i <= $total_paginas; $i++) {
                                if ($pagina == $i)
                                    echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
                                echo '  <a href="' . $url . '?pagina=' . $i . '" style="font-size:110%;">' . $i . '</a>  ';
                            }
                            if ($pagina != $total_paginas)
                                echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '"><img src="../presentacion/imagenes/der.gif" border="0"></a>';
                        }
                        echo '</p>';
                        ?>
                    </td>
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
                <span style="border-left-color:#fff">NO SE ENCUENTRAN REGISTROS CON ESTA INFORMACION.</span>
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