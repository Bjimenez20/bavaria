<?PHP
//session_start();
require('../datos/parse_str.php');
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=INVENTARIO.xls");
require_once("../datos/conex.php");
?>
<table border="1px" bordercolor="#179066" width="100%;">
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
</table>
<?php
?>