<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link rel="stylesheet" type="text/css" href="../PRESENTACION/css/estilo_tablas.css" />
	<style>
		.aviso2 {
			font-size: 130%;
			font-weight: bold;
			color: #fff;
			text-transform: uppercase;
			font-family: "Trebuchet MS";
			border-radius: 10px;
			background: #024959;
			border: 0px;
			text-align: center;
		}
	</style>
</head>

<body>
	<?PHP
	require('../datos/parse_str.php');
	require('../datos/conex.php');
	$NOMBRE = $_POST['nombre'];
	$DOCUMENTO = $_POST['documento'];
	$TELEFONO = $_POST['telefono'];
	if (isset($_POST['buscar'])) {
		if ($NOMBRE == '' and $DOCUMENTO == '' and $TELEFONO == '') {
			require('../presentacion/listado_rec_residuos.php');
		}
		if ($NOMBRE != '') {
			require('../presentacion/listado_rec_residuos.php');
		}
		if ($DOCUMENTO != '') {
			require('../presentacion/listado_rec_residuos.php');
		}
		if ($TELEFONO != '') {
			require('../presentacion/listado_rec_residuos.php');
		}
	}
	if (isset($_POST['descargar'])) {
	}
	?>
</body>

</html>