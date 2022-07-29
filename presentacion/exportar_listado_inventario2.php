<?PHP
//session_start();
require('../datos/parse_str.php');
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
if ($LUGAR == 'TODOS') {
    header("content-disposition: attachment;filename=DETALLE INVENTARIO TODO.xls");
}
if ($LUGAR == 'BODEGA') {
    header("content-disposition: attachment;filename=DETALLE INVENTARIO BODEGA.xls");
}
if ($LUGAR == 'PACIENTE') {
    header("content-disposition: attachment;filename=DETALLE INVENTARIO PACIENTE.xls");
}
require_once("../datos/conex.php");
?>
<table border="1px" bordercolor="#179066" width="100%;">
    <tr>
        <th class="botones">ID INVENTARIO</th>
        <th class="botones">SERIAL PRODUCTO</th>
        <th class="botones">NOMBRE PRODUCTO</th>
        <th class="botones">PROVEEDOR</th>
        <th class="botones">LUGAR</th>
        <th class="botones"># REMICION</th>
        <th class="botones">CANTIDAD</th>
        <th class="botones">ESTADO</th>
    </tr>
    <?php
    while ($fila1 = mysqli_fetch_array($consulta_inv)) {
    ?>
        <tr align="center">
            <td><?php echo $fila1['ID_INVENTARIO'] ?></td>
            <td><?php echo $fila1['CODIGO_PRODUCTO'] ?></td>
            <?php
            $id_pro = $fila1['ID_REFERENCIA_FK'];
            $NOM = mysqli_query($conex, "SELECT NOMBRE_REFERENCIA FROM ipsen_inventario AS I
			INNER JOIN ipsen_referencia AS R ON I.ID_REFERENCIA_FK= R.ID_REFERENCIA
			WHERE I.ID_REFERENCIA_FK='$id_pro'");
            while ($con = mysqli_fetch_array($NOM)) {
                $nombre_producto = $con['NOMBRE_REFERENCIA'];
            }
            ?>
            <td><?php echo $nombre_producto ?></td>
            <td><?php echo $fila1['PROVEEDOR'] ?></td>
            <td><?php echo $fila1['LUGAR_MATERIAL'] ?></td>
            <td><?php echo $fila1['NO_REMICION_PROVE'] ?></td>
            <td><?php echo $fila1['STOCK'] ?></td>
            <td><?php echo $fila1['ESTADO'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>