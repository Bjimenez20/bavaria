<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
if ($privilegios != '' && $usua != '') {
?>

    <body>
        <?php
        include('../logica/consulta_medicos.php');
        $url = "../presentacion/form_listado_medicos.php";
        $num_total = mysqli_num_rows($SELECT_USUARIO_TOTAL);
        if ($num_total > 0) {
        ?>
            <table border="0" align="center" bordercolor="#A1A1A1" width="100%" rules="cols">
                <tr>
                    <th class="botones">#</th>
                    <th class="botones">MEDICO</th>
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
                        <td><?php echo $fila1['ID_LISTA'] ?></td>
                        <td><?php echo $fila1['MEDICO'] ?></td>
                        <td>
                            <a href="../presentacion/actualizar_medico.php?artid=<?php echo $fila1['ID_LISTA'] ?>" target="info"><img src="../presentacion/imagenes/button_edicion-y-agregado.png" alt="" width="135px" height="35px" title="EDITAR INFORMACION USUARIO" /></a>
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
                                else
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
                <br><br><br><br><br><br><br><br>
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