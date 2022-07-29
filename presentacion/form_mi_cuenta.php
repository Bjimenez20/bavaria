<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- JAVA SCRIPT NECESARIOS. -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<!-- Validaciones -->
	<link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
	<link href="css/estilo_form_paciente.css" type="text/css" />
</head>
<?PHP
require('../datos/parse_str.php');
$NAME = base64_decode($DATO);
require_once('../datos/conex.php');
if ($privilegios != '' && $usua != '') {
	$CONSULTA_USU = mysqli_query($conex, "SELECT * FROM ipsen_usuario WHERE USER='" . $NAME . "'");
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
		<form id="form1" name="tuformulario" method="post" action="../logica/actualizar_usuario.php" onkeydown="return filtro(2)">
			<br />
			<br />
			<center>
				<span style="font-weight:bold">DATOS DE USUAIO</span>
			</center>
			<br />
			<br />
			<div class="div2">
				<span>USUARIO</span>
			</div>
			<div class="div">
				<input type="text" name="OCUL" id="OCUL" placeholder="OCUL" maxlength="0" style=" display:none" value="<?php echo $ID_USUARIO ?>" />
				<input type="text" name="USURARIO" id="USURARIO" placeholder="USUARIO" readonly value="<?php echo $USER ?>" />
			</div>
			<div class="div2">
				<span>CONTRASE&Ntilde;A</span>
			</div>
			<div class="div" style="display:inline-block">
				<input type="password" name="CONTRASENA" id="CONTRASENA" placeholder="CONTRASE&Ntilde;A" value="<?php echo $CONTRASENA ?>" style="width:58%;" maxlength="16" readonly="readonly" />
				<input type="submit" class="btn_restablecer" name="restablecer" value="restablecer" title="RESTABLECER CONTRASE&Ntilde;A" style="width:36%;" />
			</div>
			<br />
			<br />
			<div class="div2">
				<span>NOMBRE(S)</span>
			</div>
			<div class="div">
				<input type="text" name="NOMBRES" id="NOMBRES" placeholder="NOMBRES" value="<?php echo $NOMBRES ?>" maxlength="50" />
			</div>
			<div class="div2">
				<span>APELLIDO(S)</span>
			</div>
			<div class="div">
				<input type="text" name="APELLIDO" id="APELLIDO" placeholder="APELLIDO" value="<?php echo $APELLIDOS ?>" maxlength="50" />
			</div>
			<br />
			<br />
			<div class="div2">
				<span>NUMERO DE CONTACTO</span>
			</div>
			<div class="div">
				<input type="text" name="NUM_TEL" id="NUM_TEL" placeholder="NUMERO DE CONTACTO" value="<?php echo $CELULAR ?>" maxlength="10" />
			</div>
			<div class="div2">
				<span>PERFIL</span>
			</div>
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
			?>
			<div class="div">
				<input type="text" name="PERFIL" id="PERFIL" placeholder="PERFIL" readonly value="<?php echo $PERFIL ?>" />
			</div>
			<br />
			<br />
			<br />
			<center>
				<input id="MODIFICAR_USU" name="MODIFICAR_USU" type="submit" value="MODIFICAR" class="btn_actualizar" onclick="return validar(tuformulario,1)" />
			</center>
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