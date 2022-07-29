<?php
include('../datos/conex.php');
$ID_PRODUCTO = $_POST['ID_PRODUCTO'];
$NOMBRE_PRODUCTO = $_POST['NOMBRE_PRODUCTO'];
$ID_PACIENTE = $_POST['ID_PACIENTE'];
$insert = mysqli_query($conex,"INSERT INTO bayer_temporal_producto(ID_REFERENCIA_FK,
NOMBRE_MATERIAL,ID_PACIENTE_FK) VALUES ('" . $ID_PRODUCTO . "','" . $NOMBRE_PRODUCTO . "','" . $ID_PACIENTE . "')");
echo mysqli_error($conex);
$select = mysqli_query($conex,"SELECT * FROM bayer_temporal_producto WHERE ID_PACIENTE_FK='" . $ID_PACIENTE . "'");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($select);
echo "<tr>
            <th colspan='2'>
                PRODUCTOS PARA ENVIAR
            </th>
        </tr>
        <tr>
            <th>NOMBRE MATERIAL</th>
			<th>OTRO</th>
        </tr>";
while ($fila = (mysqli_fetch_array($select))) {
    echo "<tr><td><center>" . $fila['NOMBRE_MATERIAL'] . "</center></td>";
    echo "<td><input type='button' id='a'/></td>";
    echo "</tr>";
}
