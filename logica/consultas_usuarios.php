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
			$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_usuario WHERE ESTADO_APP = '1' ORDER BY ID_USUARIO ASC");
			echo mysqli_error($conex);
			$SELECT_USUARIO = "SELECT * FROM bayer_usuario WHERE ESTADO_APP = '1' ORDER BY ID_USUARIO ASC LIMIT";
		}
	}
	if (isset($_POST['buscar'])) {
		$NOMBRE = $_POST['nombre'];
		$PERFIL = $_POST['perfil'];
		if ($NOMBRE == '' && $PERFIL == '') {
			if ($privilegios == 1) {
				$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_usuario WHERE ESTADO_APP = '1' ORDER BY ID_USUARIO ASC");
				echo mysqli_error($conex);
				$SELECT_USUARIO = "SELECT * FROM bayer_usuario WHERE ESTADO_APP = '1' ORDER BY ID_USUARIO ASC LIMIT";
			}
		}
		if ($NOMBRE != '' && $PERFIL == '') {
			if ($privilegios == 1) {
				$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_usuario WHERE USER LIKE '%" . $NOMBRE . "%' AND ESTADO_APP = '1' ORDER BY ID_USUARIO ASC");
				echo mysqli_error($conex);
				$SELECT_USUARIO = "SELECT * FROM bayer_usuario WHERE USER LIKE '%" . $NOMBRE . "%' AND ESTADO_APP = '1' ORDER BY ID_USUARIO ASC LIMIT";
			}
		}
		if ($NOMBRE == '' && $PERFIL != '') {
			if ($privilegios == 1) {
				$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_usuario WHERE PRIVILEGIOS='" . $PERFIL . "' AND ESTADO_APP = '1' ORDER BY ID_USUARIO ASC");
				echo mysqli_error($conex);
				$SELECT_USUARIO = "SELECT * FROM bayer_usuario WHERE PRIVILEGIOS='" . $PERFIL . "' AND ESTADO_APP = '1' ORDER BY ID_USUARIO  ASC LIMIT";
			}
		}
		if ($NOMBRE != '' && $PERFIL != '') {
			if ($privilegios == 1) {
				$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_usuario WHERE USER LIKE '%" . $NOMBRE . "%' AND PRIVILEGIOS='" . $PERFIL . "' AND ESTADO_APP = '1'  ORDER BY ID_USUARIO ASC");
				echo mysqli_error($conex);
				$SELECT_USUARIO = "SELECT * FROM bayer_usuario WHERE USER LIKE '%" . $NOMBRE . "%' AND PRIVILEGIOS='" . $PERFIL . "' AND ESTADO_APP = '1'  ORDER BY ID_USUARIO ASC LIMIT";
			}
		}
	}
	function estado($val, $ID)
	{
		if ($val == 'ACTIVO') {
	?>
			<a href="../logica/cambio_estado_usu.php?ID=<?php echo base64_encode($ID); ?>&OK=<?PHP echo 1 ?>"><img src="../presentacion/imagenes/no.png" alt="" width="20" height="20" title="DESACTIVAR USUARIOS" /></a>
		<?php
		} else if ($val == 'INACTIVO') {
		?>
			<a href="../logica/cambio_estado_usu.php?ID=<?php echo base64_encode($ID) ?>&OK=<?PHP echo 2 ?>" style="width:112px;"><span><img src="../presentacion/imagenes/si.png" alt="" width="25" height="25" title="ACTIVAR USUARIOS" /></span></a>
		<?php
		}
	}
	function accion($ID, $NOM)
	{
		?>
		<a href="../presentacion/form_mi_cuenta.php?DATO=<?php echo base64_encode($NOM) ?>" target="usuarios"><img src="../presentacion/imagenes/lapiz 100.png" alt="" width="20" height="20" title="EDITAR INFORMACION USUARIO" /></a>
		<a href="../logica/cambio_estado_usu.php?ID=<?php echo base64_encode($ID) ?>&OK=<?PHP echo 3 ?>"><img src="../presentacion/imagenes/restable.png" alt="" width="25" height="25" title="RESTABLECER CONTRASE&Ntilde;A" /></a>
	<?php
	}
	?>