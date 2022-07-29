<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
</head>
<?PHP
require('../datos/parse_str.php');
if ($privilegios != '' && $usua != '') {
?>
    <body>
        <table width="100%;">
            <tr>
                <!--<th class="botones">ID MOVIMIENTOS</th>-->
                <th class="botones">SERIAL PRODUCTO</th>
                <th class="botones">NOMBRE PRODUCTO</th>
                <th class="botones">NOMBRE MEDICAMENTO</th>
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
                    <td>
                        <?php $fila1['ID_MOVIMIENTOS'] ?>
                        <?php echo $fila1['CODIGO_PRODUCTO'] ?>
                    </td>
                    <?php
                    /*$id_pro=$fila1['ID_REFERENCIA_FK'];
                $NOM=mysql_query("SELECT NOMBRE_REFERENCIA,MATERIAL FROM bayer_inventario AS I
                INNER JOIN bayer_referencia AS R ON I.ID_REFERENCIA_FK= R.ID_REFERENCIA
                WHERE I.ID_REFERENCIA_FK=$id_pro",$conex);
                while($con= mysql_fetch_array($NOM))
                {
                    $nombre_producto=$con['MATERIAL'];
                    $nombre_medicamento=$con['NOMBRE_REFERENCIA'];
                }*/
                    ?>
                    <td><?php echo $fila1['MATERIAL'] ?></td>
                    <td><?php echo $fila1['NOMBRE_REFERENCIA'] ?></td>
                    <td><?php echo $fila1['PROVEEDOR'] ?></td>
                    <td>
                        <?php
                        if ($fila1['LUGAR_MATERIAL'] != 'BODEGA') {
                            echo 'PAP' . $fila1['LUGAR_MATERIAL'];
                        } else {
                            echo $fila1['LUGAR_MATERIAL'];
                        }
                        ?></td>
                    <td><?php echo $fila1['NO_REMICION_PROVE'] ?></td>
                    <td><?php echo $fila1['STOCK'] ?></td>
                    <td><?php echo $fila1['ESTADO_MOVIMIENTO'] ?></td>
                </tr>
            <?php
            }
            ?>
            <tr bgcolor="#FFFFFF" class="titulo" align="center">
                <td colspan="12" class="botones">Se encontraron <?php echo $nreg = mysqli_num_rows($consulta_inv); ?> Registros
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