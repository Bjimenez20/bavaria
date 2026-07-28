<?php
include('../logica/session.php');
?>
<?php
require('../datos/parse_str.php');
require_once("../datos/conex.php");
?>

<body>
	<?php
	if (!isset($_POST['buscar']) && !isset($_POST['descargar'])) {
		if ($privilegios == 1) {
			$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM usuario WHERE ESTADO_APP = '1' ORDER BY ID_USUARIO ASC");
			echo mysqli_error($conex);
			$SELECT_USUARIO = "SELECT * FROM usuario WHERE ESTADO_APP = '1' ORDER BY ID_USUARIO ASC LIMIT";
		}
	}
	if (isset($_POST['buscar'])) {
		$NOMBRE = $_POST['nombre'];
		$PERFIL = $_POST['perfil'];
		if ($NOMBRE == '' && $PERFIL == '') {
			if ($privilegios == 1) {
				$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM usuario WHERE ESTADO_APP = '1' ORDER BY ID_USUARIO ASC");
				echo mysqli_error($conex);
				$SELECT_USUARIO = "SELECT * FROM usuario WHERE ESTADO_APP = '1' ORDER BY ID_USUARIO ASC LIMIT";
			}
		}
		if ($NOMBRE != '' && $PERFIL == '') {
			if ($privilegios == 1) {
				$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM usuario WHERE USER LIKE '%" . $NOMBRE . "%' AND ESTADO_APP = '1' ORDER BY ID_USUARIO ASC");
				echo mysqli_error($conex);
				$SELECT_USUARIO = "SELECT * FROM usuario WHERE USER LIKE '%" . $NOMBRE . "%' AND ESTADO_APP = '1' ORDER BY ID_USUARIO ASC LIMIT";
			}
		}
		if ($NOMBRE == '' && $PERFIL != '') {
			if ($privilegios == 1) {
				$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM usuario WHERE PRIVILEGIOS='" . $PERFIL . "' AND ESTADO_APP = '1' ORDER BY ID_USUARIO ASC");
				echo mysqli_error($conex);
				$SELECT_USUARIO = "SELECT * FROM usuario WHERE PRIVILEGIOS='" . $PERFIL . "' AND ESTADO_APP = '1' ORDER BY ID_USUARIO  ASC LIMIT";
			}
		}
		if ($NOMBRE != '' && $PERFIL != '') {
			if ($privilegios == 1) {
				$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM usuario WHERE USER LIKE '%" . $NOMBRE . "%' AND PRIVILEGIOS='" . $PERFIL . "' AND ESTADO_APP = '1'  ORDER BY ID_USUARIO ASC");
				echo mysqli_error($conex);
				$SELECT_USUARIO = "SELECT * FROM usuario WHERE USER LIKE '%" . $NOMBRE . "%' AND PRIVILEGIOS='" . $PERFIL . "' AND ESTADO_APP = '1'  ORDER BY ID_USUARIO ASC LIMIT";
			}
		}
	}
	function estado($val, $ID)
	{
		if ($val == 'ACTIVO') {
	?>
			<a href="../logica/cambio_estado_usu.php?ID=<?php echo base64_encode($ID); ?>&OK=<?PHP echo 1 ?>"><i class="fa-solid fa-toggle-on" style="color:green;"></i></a>
		<?php
		} else if ($val == 'INACTIVO') {
		?>
			<a href="../logica/cambio_estado_usu.php?ID=<?php echo base64_encode($ID) ?>&OK=<?PHP echo 2 ?>"><i class="fa-solid fa-toggle-off" style="color:red;"></i></a>
		<?php
		}
	}
	function accion($ID, $NOM)
	{
		?>
		<a href="../presentacion/form_mi_cuenta.php?DATO=<?php echo base64_encode($NOM) ?>" target="usuarios"><i class="fa-solid fa-pen-to-square" style="color:#B58735;"></i></a>
		<a href="../logica/cambio_estado_usu.php?ID=<?php echo base64_encode($ID) ?>&OK=<?PHP echo 3 ?>"><i class="fa-solid fa-arrows-rotate" style="color:#B58735;"></i></a>
	<?php
	}
	?>