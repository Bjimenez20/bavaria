<?php
include('../datos/conex.php');
$usuario = $_POST['usuario'];
?>
<input type="hidden" value="<?php echo $usuario ?>" id="usu" name="usu" />
<?php
$actualizar = mysqli_query($conex, "UPDATE usuario SET
ESTADO_LOGIN='IN'
WHERE USER='" . $usuario . "'
AND ESTADO_LOGIN='OUT'");
echo mysqli_error($conex);
$select = mysqli_query($conex, "select USER,NOMBRES,APELLIDOS,ESTADO,PRIVILEGIOS,ESTADO_LOGIN FROM usuario WHERE ESTADO='1' AND PRIVILEGIOS='2'");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($select);
echo "<tr>
            <th colspan='4'>
                USUARIOS DISPONIBLES
            </th>
        </tr>
        <tr>
            <th>
        		USUARIO(S)
			</th>
			<th>
				NOMBRE(S) Y APELLIDO(S)
			</th>
			<th>
				ESTADO LOGIN
			</th>
        </tr>";
while ($fila = (mysqli_fetch_array($select))) {
	$estado = $fila['ESTADO_LOGIN'];
	echo "<tr><td>" . $fila['USER'] . "</td>";
	echo "<td>" . $fila['NOMBRES'] . ' ' . $fila['APELLIDOS'] . "</td>";
	echo "<td style='color:transparent;'>" . $estado2 = '';
	if ($estado == 'OUT') {
?>
		<img id="btn" src="imagenes/OFF.png" style="width:100PX" />
	<?PHP
	}
	if ($estado == 'IN') {
	?>
		<img id="btn2" src="imagenes/ON.png" style="width:100PX" />
<?PHP
	}
	"</td>";
	echo "</tr>";
}
function estado($estado)
{
}
?>