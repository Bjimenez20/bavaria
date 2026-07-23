<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BAVARIA</title>
    <link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
</head>
<?PHP
require('../datos/parse_str.php');
if ($privilegios != '' && $usua != '') {
?>

    <body>
        <table width="100%" rules="all">
            <tr>
                <th class="botones">ID MOVIMIENTO</th>
                <th class="botones">NOMBRE PRODUCTO</th>
                <th class="botones">NOMBRE MEDICAMENTO</th>
                <th class="botones">CANTIDAD DISPONIBLE</th>
                <th class="botones">STOCK MINIMO</th>
            </tr>
            <?php
            while ($fila1 = mysqli_fetch_array($consulta_ref)) {
            ?>
                <tr align="center">
                    <td><?php echo $fila1['ID_REFERENCIA'] ?></td>
                    <td><?php echo $fila1['MATERIAL'] ?></td>
                    <td><?php echo $fila1['NOMBRE_REFERENCIA'] ?></td>
                    <td><?php echo $fila1['CANTIDAD'] ?></td>
                    <td><?php echo $fila1['STOCK_MINIMO'] ?></td>
                </tr>
            <?php
            }
            ?>
            <tr bgcolor="#FFFFFF" class="titulo" align="center">
                <td colspan="12" class="botones">Se encontraron <?php echo $nreg = mysqli_num_rows($consulta_ref); ?> Registros
                </td>
            </tr>
        </table>
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