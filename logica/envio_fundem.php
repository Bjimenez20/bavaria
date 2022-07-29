<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
	<script src="../presentacion/js/jquery.js"></script>
	<script language=javascript>
		function ventanaSecundaria(URL) {
			window.open(URL, "ventana1", "width=700,height=500,Top=100,Left=200")
		}
	</script>
	<style>
		td {
			padding: 3px;
			background-color: transparent;
		}
	</style>
	<script type="text/javascript">
		function mostrar_producto() {
			var ID_PRODUCTO = $('#tipo_envio').val();
			$.ajax({
				url: '../presentacion/mostrar_nombre_producto.php',
				data: {
					ID_PRODUCTO: ID_PRODUCTO,
				},
				type: 'post',
				beforeSend: function() {
					$('#div_agregar').css('visibility', 'hidden');
				},
				success: function(data) {
					$('#nombre_producto').html(data);
					var nom = $('#nombre_producto').val();
					//alert(nom);
					if (nom == 'Kit de bienvenida' || nom == '') {
						$('#div_agregar').css('visibility', 'hidden');
					} else {
						$('#div_agregar').css('visibility', 'visible');
					}
				}
			})
		}
		//AGREGAR PRODUCTO
		function agregar_producto() {
			var ID_PRODUCTO = $('#tipo_envio').val();
			var ID_PACIENTE = $('#codigo_usuario2').val();
			var NOMBRE_PRODUCTO = $('#nombre_producto').val();
			$.ajax({
				url: '../presentacion/ingresar_productos_temporal.php',
				data: {
					ID_PRODUCTO: ID_PRODUCTO,
					ID_PACIENTE: ID_PACIENTE,
					NOMBRE_PRODUCTO: NOMBRE_PRODUCTO
				},
				type: 'post',
				beforeSend: function() {
					$('#tabla_material_agregar').css('visibility', 'visible');
					$("#tabla_material_agregar").html("Procesando, espere por favor" + '<img src="imagenes/cargando.gif" />');
				},
				success: function(data) {
					//$('#div_tabla_productos').html('');
					$('#tabla_material_agregar').html(data);
				}
			})
		}
	</script>
	<script>
		$(document).ready(function() {
			$("#tipo_envio").change(function() {
				mostrar_producto();
			});
			$("#agregar").click(function() {
				$('#div_material_agregar').css('display', 'block');
				//$("#tipo_envio option:eq(0)").attr("selected", "selected");
				$('#div_agregar').css('visibility', 'hidden');
			});
		});
	</script>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
if ($privilegios != '' && $usua != '') {
	$ID_PACIENTE = base64_decode($artid);
	include('../logica/consulta_paciente.php');
?>

	<body class="body" style="width:80.9%;margin-left:12%;">
		<form id="seguimiento" name="seguimiento" method="post" action="../logica/insertar_envio_fundem.php" onkeydown="return filtro(2)" enctype="multipart/form-data">
			<table width="100%" border="0">
				<?php
				$Seleccion = mysqli_query($conex, "SELECT * FROM `ipsen_pacientes` AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				WHERE ID_PACIENTE = '" . $ID_PACIENTE . "'");
				while ($fila = mysqli_fetch_array($Seleccion)) {
					$ID_PACIENTE2 = $fila['ID_PACIENTE'];
					$ID_PA = $fila['ID_PACIENTE'];
					function Zeros($numero, $largo)
					{
						$resultado = $numero;
						while (strlen($resultado) < $largo) {
							$resultado = "0" . $resultado;
						}
						return $resultado;
					}
					$ID_PACIENTE = Zeros($ID_PA, 5);
				?>
					<br />
					<br />
					<tr>
						<td width="20%">
							<span>Codigo de Usuario</span>
							<br />
							<br />
						</td>
						<td width="30%">
							<input name="codigo_gestion" type="text" id="codigo_gestion" max="10" readonly="readonly" value="<?php echo $ID_GESTION; ?>" style="display:none" />
							<input name="codigo_usuario" type="text" id="codigo_usuario" max="10" readonly="readonly" value="<?php echo 'PAP' . $ID_PACIENTE; ?>" />
							<br />
							<br />
							<input name="codigo_usuario2" type="text" id="codigo_usuario2" max="10" readonly="readonly" value="<?php echo $fila['ID_PACIENTE']; ?>" style="display:none" />
						</td>
						<td>
							<span style="text-transform:capitalize;">Medicamento</span>
							<br />
							<br />
						</td>
						<td>
							<input style="text-transform:capitalize;" type="text" readonly="readonly" name="MEDICAMENTO" id="MEDICAMENTO" value="<?php echo $fila['PRODUCTO_TRATAMIENTO'] ?>" />
							<br />
							<br />
						</td>
						<td>
							<span style="display:none">Nombre<span class="asterisco">*</span></span>
						</td>
						<td>
							<input type="text" name="nom" id="nom" value="<?php echo $fila['NOMBRE_PACIENTE'] . ' ' . $fila['APELLIDO_PACIENTE']; ?>" readonly="readonly" style="display:none" />
						</td>
					</tr>
					<br />
					<tr>
						<td>
							<input type="text" name="nombre" id="nombre" value="<?php echo $fila['NOMBRE_PACIENTE']; ?>" readonly="readonly" style="display:none" />
						</td>
						<td>
							<input type="text" name="apellidos" id="apellidos" value="<?php echo $fila['APELLIDO_PACIENTE']; ?>" readonly="readonly" style="display:none" />
						</td>
						<td>
							<input name="direccion_act" id="direccion_act" style="width:93%;display:none" value="<?php echo $fila['DIRECCION_PACIENTE']; ?>" readonly="readonly" />
						</td>
						<td>
							<select type="text" name="ciudad" id="ciudad" style="display:none">
								<option><?php echo $fila['CIUDAD_PACIENTE']; ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<span>Tipo de Envio</span>
							<br />
							<br />
						</td>
						<td>
							<select name="tipo_envio" id="tipo_envio">
								<option value="">Seleccione...</option>
								<?php
								while ($opcion = mysqli_fetch_array($listado_envio)) {
								?>
									<option value="<?php echo $opcion['ID_REFERENCIA'] ?>"><?php echo $opcion['MATERIAL'] ?></option>
								<?php
								}
								?>
							</select>
							<select name="nombre_producto" id="nombre_producto" style="display:none">
							</select>
							<br />
							<br />
						</td>
						<td>
							<div id="div_agregar" style="visibility:hidden">
								<input type="submit" name="agregar" id="agregar" formaction="form_productos_envio.php" formtarget="registro_productos" style="background-image:url(imagenes/agregar.png); background-repeat:no-repeat;  width:41px; height:38px; border:1px solid transparent; background-color:transparent" value="" />
							</div>
						</td>
						<td>
							<span style="text-transform:capitalize;display:none">Dosis Tratamiento<span class="asterisco">*</span></span>
							<br />
							<br />
						</td>
						<td>
							<input style="text-transform:capitalize; display:none" type="text" name="Dosis" id="Dosis" value="<?php echo $fila['DOSIS_TRATAMIENTO'] ?>" readonly="readonly" />
							<br />
							<br />
						</td>
					</tr>
					<tr>
					<?php
				}
					?>
					</tr>
					<tr>
						<td colspan="4">
							<div id="div_material_agregar" style="width:50%; margin:auto auto; display:none">
								<iframe name="registro_productos" style="width:100%; height:250px; border:1px solid transparent;" scrolling="auto"></iframe>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<br />
							<center>
								<input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(seguimiento,2)" />
							</center>
							<br />
						</td>
					</tr>
			</table>
			<br />
			<br />
		</form>
		<script type="text/javascript">
			var Accordion1 = new Spry.Widget.Accordion("Accordion1");
		</script>
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