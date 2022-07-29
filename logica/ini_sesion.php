<?PHP
session_start();
require('../datos/parse_str.php');
require('../datos/conex.php');
$conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
mysqli_select_db($conex, $basepaciente) or die("No se Puede conectar a la base de Datos");
$_SESSION['NAME'] = '';
$USER = addslashes($_POST['usuario']);
$CONTRASENA = addslashes($_POST['Contrasena']);
$sql = mysqli_query($conex, "SELECT `USER`, `CONTRASENA`, `PRIVILEGIOS`, `CONTRASENA_FECHA`,`ID_USUARIO` FROM `bayer_usuario` WHERE `USER` = '" . $USER . "' and `CONTRASENA` = MD5('" . $CONTRASENA . "') and `ESTADO` != '0' ") or die("No se Puede hacer la cosulta");
$conusuario = mysqli_query($conex, "SELECT `USER`, `INTENTOS`, `ESTADO` FROM `bayer_usuario` WHERE `USER` = '" . $USER . "' and `ESTADO` != '0' ") or die("No se Puede hacer la cosulta");
echo mysqli_error($conex);
mysqli_num_rows($sql);
if (mysqli_num_rows($sql) > 0) {
	$linea = mysqli_fetch_array($sql);
	$usua = $linea[0];
	$privilegios = $linea[2];
	$contra_fecha = $linea[3];
	$id_usuario = $linea[4];
	$hoy = date("Y-m-d H:i:s");
	$_SESSION["usuarios"] = $usua;
	$_SESSION["privilegios"] = $privilegios;
	$_SESSION["id"] = $id_usuario;
	$actu = mysqli_query($conex, "UPDATE bayer_usuario SET 
		INTENTOS = '0'
		WHERE USER='" . $usua . "';");
	if ($CONTRASENA == '1234' or $hoy >= $contra_fecha) {
		require("../presentacion/form_restablecer_clave.php");
	} else {
		switch ($privilegios) {
			case '1':
				require("../presentacion/inicio_admin.php");
				break;
			case '2':
				require("../presentacion/inicio_call.php");
				break;
			case '3':
				require("../presentacion/inicio_bodega.php");
				break;
			case '4':
				require("../presentacion/inicio_fundem.php");
				break;
			case '5':
				require("../presentacion/inicio_consultas.php");
				break;
			case '6':
				require("../presentacion/inicio_recoleccion.php");
				break;
		}
	}
} else {
	if (mysqli_num_rows($conusuario) > 0) {
		$linea2 = mysqli_fetch_array($conusuario);
		$usua2 = $linea2[0];
		$intentos = $linea2[1];
		$estado = $linea2[2];
		if ($intentos >= 3 or $estado == 0) {
?>
			<script>
				if (confirm('Usuario Bloqueado Comuniquese con el administrador')) {
					window.onload = window.top.location.href = "../index.php";
				} else {
					window.onload = window.top.location.href = "../index.php";
				}
			</script>
		<?php
			//echo "Contraseña Bloqueada";
			$actu = mysqli_query($conex, "UPDATE bayer_usuario SET 
				ESTADO = '0'
				WHERE USER='" . $usua2 . "';");
		} else {
			$NUM_INTENTOS = $intentos + 1;
			$actu = mysqli_query($conex, "UPDATE bayer_usuario SET 
				INTENTOS = '" . $NUM_INTENTOS . "'
				WHERE USER='" . $usua2 . "';");
		?>
			<script>
				if (confirm('Contrase&ntilde;a incorrecta')) {
					window.onload = window.top.location.href = "../index.php";
				} else {
					window.onload = window.top.location.href = "../index.php";
				}
			</script>
		<?php
		}
	} else {
		?>
		<script>
			if (confirm('Usuario Bloqueado Comuniquese con el administrador')) {
				window.onload = window.top.location.href = "../index.php";
			} else {
				window.onload = window.top.location.href = "../index.php";
			}
		</script>
<?php
		require("cerrar_sesion.php");
		exit();
	}
}
mysqli_close($conex);
/*    */
?>