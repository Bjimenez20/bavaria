<?PHP
require('../datos/parse_str.php');
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
if ($TIPO == 'TODAS') {
    header("content-disposition: attachment;filename=MOVIMIENTO TODAS.xls");
}
if ($TIPO == 'SALIDA') {
    header("content-disposition: attachment;filename=MOVIMIENTO SALIDA.xls");
}
if ($TIPO == 'ENTRADA') {
    header("content-disposition: attachment;filename=MOVIMIENTO ENTRADA.xls");
}
require_once("../datos/conex.php");
?>
<table border="1px" bordercolor="#179066" width="100%;">
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
</table>
<?php
?>