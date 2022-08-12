<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
    <link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
</head>
<?PHP
require('../datos/parse_str.php');
if ($privilegios != '' && $usua != '') {
?>

    <body>
        <table style="border:0px solid transparent;" width="100%;">
            <tr>
                <th class="botones">TIPO MOVIMIENTO</th>
                <th class="botones"># REMISION</th>
                <th class="botones">REFERENCIA</th>
                <th class="botones">PRODUCTO</th>
                <th class="botones">CANTIDAD</th>
                <th class="botones">RESPONSABLE</th>
                <th class="botones">DESTINATARIO</th>
                <th class="botones">DIRECCION DESTINATARIO</th>
                <th class="botones">CIUDAD ENVIO</th>
                <th class="botones">FECHA MOVIMIENTO</th>
                <th class="botones">OBSERVACIONES</th>
                <th class="botones">ESTADO</th>
            </tr>
            <?php
            while ($fila1 = mysqli_fetch_array($consulta_inv)) {
            ?>
                <tr align="center">
                    <?PHP
                    $TIPO_MO = $fila1['TIPO_MOVIMIENTO'];
                    if ($TIPO_MO == '1')
                        $TIPO_MO = 'ENTRADA';
                    if ($TIPO_MO == '2')
                        $TIPO_MO = 'SALIDA';
                    ?>
                    <td><?php echo $TIPO_MO ?></td>
                    <td><?php echo $fila1['NO_REMICION'] ?></td>
                    <?php
                    $id_pro = $fila1['ID_INVENTARIO_FK'];
                    $NOM = mysqli_query($conex, "SELECT NOMBRE_REFERENCIA,MATERIAL FROM ipsen_movimientos AS M
                INNER JOIN ipsen_inventario AS I ON M.ID_INVENTARIO_FK= I.ID_INVENTARIO
                INNER JOIN ipsen_referencia AS R ON I.ID_REFERENCIA_FK= R.ID_REFERENCIA
                WHERE M.ID_INVENTARIO_FK='" . $id_pro . "'");
                    echo (mysqli_error($conex));
                    while ($con = mysqli_fetch_array($NOM)) {
                        $nombre_producto = $con['NOMBRE_REFERENCIA'];
                        $MATERIAL = $con['MATERIAL'];
                    }
                    ?>
                    <td><?php echo $nombre_producto ?></td>
                    <td><?php echo $MATERIAL ?></td>
                    <td><?php echo $fila1['CANTIDAD'] ?></td>
                    <td><?php echo $fila1['RESPONSABLE'] ?></td>
                    <td><?php echo $fila1['DESTINATARIO'] ?></td>
                    <td><?php echo $fila1['DIRECCION_DESTINATARIO'] ?></td>
                    <td><?php echo $fila1['CIUDAD_ENVIO'] ?></td>
                    <td><?php echo $fila1['FECHA_MOVIMIENTO'] ?></td>
                    <td><?php echo $fila1['OBSERVACIONES'] ?></td>
                    <td><?php echo $fila1['ESTADO_MOVIMIENTO'] ?></td>
                </tr>
            <?php
            }
            ?>
            <tr bgcolor="#FFFFFF" class="titulo" align="center">
                <td colspan="12" class="botones">
                    Se encontraron <?php echo $nreg = mysqli_num_rows($consulta_inv); ?> Registros
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