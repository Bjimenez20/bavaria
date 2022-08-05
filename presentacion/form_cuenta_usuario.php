<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script type="text/javascript" src="js/jquery.js"></script>
	<link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
	<link href="css/estilo_form_paciente.css" type="text/css" />
</head>
<script language=javascript>
	function ventanaSecundaria(URL) {
		window.open(URL, "ventana1", "width=500,height=500,Top=100,Left=200")
	}
</script>
<?PHP
require('../datos/parse_str.php');
$NAME = $usua;
require_once('../datos/conex.php');
if ($privilegios != '' && $usua != '') {
	$CONSULTA_USU = mysqli_query($conex, "SELECT * from ipsen_usuario where USER='" . $NAME . "'");
	while ($DATOS = mysqli_fetch_array($CONSULTA_USU)) {
		$ID_USUARIO = $DATOS['ID_USUARIO'];
		$USER = $DATOS['USER'];
		$CONTRASENA = $DATOS['CONTRASENA'];
		$NOMBRES = $DATOS['NOMBRES'];
		$APELLIDOS = $DATOS['APELLIDOS'];
		$CELULAR = $DATOS['CELULAR'];
		$PROGRAMA = $DATOS['PROGRAMA'];
		$ESTADO = $DATOS['ESTADO'];
	}
?>

	<body class="body" style="width:100%; margin:auto auto; ">
		<form id="form1" name="tuformulario" method="post" action="../logica/actualizar_usuario.php" onkeydown="return filtro(2)" class="letra">
			<br />
			<br />
			<table width="100%">
				<tr>
					<td style="background-color:#848484;text-align:center">
						<span style="color:#FFF;">MI CUENTA</span>
					</td>
				</tr>
			</table>
			<br />
			<br />
			<table width="100%">
				<tr>
					<td>
						<span>USUARIO</span>
					</td>
					<td>
						<input type="text" name="OCUL" id="OCUL" placeholder="OCUL" maxlength="0" style=" display:none" value="<?php echo $ID_USUARIO ?>" />
						<input type="text" name="USURARIO" id="USURARIO" placeholder="USUARIO" readonly value="<?php echo $USER ?>" />
					</td>
					<td>
						<span>CONTRASE&Ntilde;A</span>
					</td>
					<td>
						<input type="password" name="CONTRASENA" id="CONTRASENA" placeholder="CONTRASE&Ntilde;A" value="<?php echo $CONTRASENA ?>" style="width:58%;" maxlength="16" readonly="readonly" />
						<a class="btn_gestiones" href="javascript:ventanaSecundaria('form_restablecer_clave2.php')"><img src="imagenes/BOTON_MODIFICAR.png" width="34%" height="25px" align="right" /> </a>
					</td>
				</tr>
				<tr>
					<td>
						<span>NOMBRE(S)</span>
					</td>
					<td>
						<input type="text" name="NOMBRES" id="NOMBRES" placeholder="NOMBRES" value="<?php echo $NOMBRES ?>" maxlength="50" />
					</td>
					<td>
						<span>APELLIDO(S)</span>
					</td>
					<td>
						<input type="text" name="APELLIDO" id="APELLIDO" placeholder="APELLIDO" value="<?php echo $APELLIDOS ?>" maxlength="50" />
					</td>
				</tr>
				<tr>
					<td>
						<span>NUMERO DE CONTACTO</span>
					</td>
					<td>
						<input type="text" name="NUM_TEL" id="NUM_TEL" placeholder="NUMERO DE CONTACTO" value="<?php echo $CELULAR ?>" maxlength="10" />
					</td>
					<td>
						<span>PERFIL</span>
					</td>
					<?php
					if ($privilegios == 1) {
						$PERFIL = 'ADMINISTRADOR(A)';
					}
					if ($privilegios == 2) {
						$PERFIL = 'ASESOR';
					}
					if ($privilegios == 3) {
						$PERFIL = 'BODEGA';
					}
					if ($privilegios == 4) {
						$PERFIL = 'FUNDEM';
					}
					if ($privilegios == 5) {
						$PERFIL = 'CLIENTE';
					}
					if ($privilegios == 6) {
						$PERFIL = 'ASEI';
					}
					?>
					<td>
						<input type="text" name="PERFIL" id="PERFIL" placeholder="PERFIL" readonly value="<?php echo $PERFIL ?>" />
					</td>
				</tr>
			</table>
			<br />
			<br />
			<br />
			<table width="100%">
				<tr>
					<td style="background-color:#848484;text-align:center">
						<center>
							<input id="MODIFICAR_USU" name="MODIFICAR_USU" type="submit" value="MODIFICAR" class="btn_actualizar" onclick="return validar(tuformulario,1)" />
						</center>
					</td>
				</tr>
			</table>
		</form>
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