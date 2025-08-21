<?php
include('../logica/session.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>IPSEN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/estilo_form_paciente.css" />
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: trans;
			margin: 0;
			padding: 0;
		}

		.container {
			max-width: 1000px;
			margin: 40px auto;
			background: #fff;
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
		}

		.header {
			background-color: #2797d3;
			color: #fff;
			text-align: center;
			padding: 15px;
			font-size: 20px;
			font-weight: bold;
			letter-spacing: 1px;
		}

		form {
			padding: 20px;
		}

		.form-row {
			display: flex;
			flex-wrap: wrap;
			margin-bottom: 20px;
			gap: 20px;
		}

		.form-group {
			flex: 1;
			min-width: 220px;
		}

		.form-group span {
			display: block;
			font-size: 14px;
			font-weight: bold;
			color: #333;
			margin-bottom: 5px;
		}

		.form-group input {
			/* width: 100%; */
			padding: 8px 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 14px;
		}

		.password-group {
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.password-group input {
			flex: 1;
		}

		.password-group img {
			cursor: pointer;
			border-radius: 5px;
		}

		.footer {
			background-color: #fff;
			text-align: center;
			padding: 15px;
		}

		.footer:hover {
			background-color: #2797d3;
			text-align: center;
			padding: 15px;
		}

		.footer button {
			background: #2797d3;
			color: #fff;
			font-weight: bold;
			font-size: 18px;
			padding: 14px 40px;
			border: none;
			border-radius: 30px;
			cursor: pointer;
			transition: 0.3s;
		}

		.footer button:hover {
			background: #fff;
			color: #2797d3;
		}
	</style>

	<script language=javascript>
		function ventanaSecundaria(URL) {
			window.open(URL, "ventana1", "width=500,height=500,Top=100,Left=200")
		}
	</script>
</head>

<body>
	<?php
	require('../datos/parse_str.php');
	$NAME = $name_user;
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
		}
		if ($privilegios == 1) $PERFIL = 'ADMINISTRADOR(A)';
		if ($privilegios == 2) $PERFIL = 'ASESOR';
		if ($privilegios == 3) $PERFIL = 'BODEGA';
		if ($privilegios == 4) $PERFIL = 'CLIENTE';
	?>

		<div class="container">
			<div class="header">MI CUENTA</div>
			<form method="post" action="../logica/actualizar_usuario.php" onkeydown="return filtro(2)">

				<div class="form-row">
					<div class="form-group">
						<span>USUARIO</span>
						<input type="hidden" name="OCUL" value="<?php echo $ID_USUARIO ?>" />
						<input type="text" name="USURARIO" value="<?php echo $USER ?>" readonly />
					</div>
					<div class="form-group">
						<span>CONTRASEÑA</span>
						<div class="password-group">
							<input type="password" name="CONTRASENA" value="<?php echo $CONTRASENA ?>" maxlength="16" readonly />
							<a href="./form_restablecer_clave2.php">
								<img src="imagenes/BOTON_MODIFICAR.png" height="35px" />
							</a>
						</div>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group">
						<span>NOMBRE(S)</span>
						<input type="text" name="NOMBRES" value="<?php echo $NOMBRES ?>" maxlength="50" />
					</div>
					<div class="form-group">
						<span>APELLIDO(S)</span>
						<input type="text" name="APELLIDO" value="<?php echo $APELLIDOS ?>" maxlength="50" />
					</div>
				</div>

				<div class="form-row">
					<div class="form-group">
						<span>NÚMERO DE CONTACTO</span>
						<input type="text" name="NUM_TEL" value="<?php echo $CELULAR ?>" maxlength="10" />
					</div>
					<div class="form-group">
						<span>PERFIL</span>
						<input type="text" name="PERFIL" value="<?php echo $PERFIL ?>" readonly />
					</div>
				</div>

				<div class="footer">
					<button id="MODIFICAR_USU" name="MODIFICAR_USU" type="submit" onclick="return validar(tuformulario,1)">
						MODIFICAR
					</button>
				</div>
			</form>
		</div>

	<?php
	} else {
		echo '<script>window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";</script>';
	}
	?>
</body>

</html>