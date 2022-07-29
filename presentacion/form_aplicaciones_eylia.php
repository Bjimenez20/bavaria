<?php
header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
	<link rel="shortcut icon" href="../presentacion/imagenes/logo.png" />
	<script src="../presentacion/js/jquery.js"></script>
	<script>
		$(document).ready(function() {
			$("#span_aplicacion").css('display', 'none');
			$("#div_aplicacion").css('display', 'none');
			$("#span_no_aplicacion").css('display', 'none');
			$("#div_no_aplicacion").css('display', 'none');
			$("#aplicacion").change(function() {
				var aplicacion = $("#aplicacion").val();
				$('#causal option:first-child').attr("selected", "selected");
				$('#causal')[0].selectedIndex = 0;
				$('#fecha_aplicacion').val('');
				if (aplicacion == 'SI') {
					$("#span_aplicacion").css('display', 'block');
					$("#div_aplicacion").css('display', 'block');
					$("#span_no_aplicacion").css('display', 'none');
					$("#div_no_aplicacion").css('display', 'none');
				} else if (aplicacion == 'NO') {
					$("#span_aplicacion").css('display', 'none');
					$("#div_aplicacion").css('display', 'none');
					$("#span_no_aplicacion").css('display', 'block');
					$("#div_no_aplicacion").css('display', 'block');
				} else {
					$("#span_aplicacion").css('display', 'none');
					$("#div_aplicacion").css('display', 'none');
					$("#span_no_aplicacion").css('display', 'none');
					$("#div_no_aplicacion").css('display', 'none');
				}
			});
			$("#registrar").click(function() {
				var aplicacion = $("#aplicacion").val();
				if (aplicacion == 'SI') {
					var num_ojos = $("#num_ojos").val();
					if (num_ojos == 0) {
						alert('Cantidad de ojos esta en 0');
						$('#num_ojos').focus();
						return false;
					}
				}
			});
		});
	</script>
</head>
<style>
	.error {
		font-size: 130%;
		font-weight: bold;
		color: #fb8305;
		text-transform: uppercase;
		background-color: transparent;
		text-align: center;
		padding: 10px;
	}
	html {
		background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	/*form 
{
    background:url(../presentacion/imagenes/LOGIN.png) top center no-repeat;
}*/
	@media screen and (max-width:1000px) {
		html {
			background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
	}
</style>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
if (isset($xxx))
	$ID_PACIENTE = base64_decode($xxx);
if (isset($xxxx))
	$producto = base64_decode($xxxx);
echo mysqli_error($conex);
$consulta = mysqli_query($conex,"SELECT * FROM bayer_aplicaciones_eylia
WHERE ID_PACIENTE_FK=$ID_PACIENTE ORDER BY FECHA_REGISTRO DESC LIMIT 1");
echo mysqli_error($conex);
$nreg = mysqli_num_rows($consulta);
while ($con = mysqli_fetch_array($consulta)) {
	$NUM_OJOS = $con['NUMERO_OJOS'];
}
?>
<body>
	<div>
		<img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
	</div>
	<form action="../logica/guardar_aplicaciones.php" method="post">
		<input type="hidden" value="<?php echo $ID_PACIENTE ?>" name="id_paciente" id="id_paciente" />
		<input type="hidden" value="<?php echo $producto ?>" name="producto" id="producto" />
		<div style="margin:auto auto; width:81%; height:120px;">
			<iframe scrolling="yes" style="width:99%; height:119px; border:1px solid transparent;" src="../presentacion/form_consulta_aplicaciones.php?xxx=<?php echo base64_encode($ID_PACIENTE) ?>">
			</iframe>
		</div>
		<fieldset style="border:1px solid #000; border-radius:5px; margin:auto auto; width:80%;">
			<legend style="font-size:120%; text-align:center">Informaci&oacute;n</legend>
			<table style="width:100%">
				<tr>
					<td style="width:10%;">
						<span>Cual ojo<span class="asterisco">*</span></span>
					</td>
					<td style="width:40%;">
						<select name="num_ojos" id="num_ojos" style="width:90%" required>
							<?php
							if ($nreg == 0) {
							?>
								<option value="NINGUNO">NINGUNO</option>
								<option>DERECHO</option>
								<option>IZQUIERDO</option>
								<option>AMBOS</option>
								<?php
							}
							if ($nreg > 0) {
								if ($NUM_OJOS == 'NINGUNO') {
								?>
									<option><?php echo $NUM_OJOS ?></option>
									<option>DERECHO</option>
									<option>IZQUIERDO</option>
									<option>AMBOS</option>
								<?php
								} else if ($NUM_OJOS == 'DERECHO') {
								?>
									<option><?php echo $NUM_OJOS ?></option>
									<option value="NINGUNO">NINGUNO</option>
									<option>IZQUIERDO</option>
									<option>AMBOS</option>
								<?php
								} else if ($NUM_OJOS == 'IZQUIERDO') {
								?>
									<option><?php echo $NUM_OJOS ?></option>
									<option value="NINGUNO">NINGUNO</option>
									<option>DERECHO</option>
									<option>AMBOS</option>
								<?php
								} else if ($NUM_OJOS == 'AMBOS') {
								?>
									<option><?php echo $NUM_OJOS ?></option>
									<option value="NINGUNO">NINGUNO</option>
									<option>DERECHO</option>
									<option>IZQUIERDO</option>
							<?php
								}
							}
							?>
						</select>
					</td>
					<td style="width:10%;">
						<span>Cuenta con aplicaci&oacute;n<span class="asterisco">*</span></span>
					</td>
					<td style="width:40%;">
						<select name="aplicacion" id="aplicacion" style="width:90%" required>
							<option value="">Seleccione...</option>
							<option>SI</option>
							<option>NO</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<div  id="span_aplicacion">
							<span>Fecha Aplicaci&oacute;n<span class="asterisco">*</span></span>
						</div>
						<div  id="span_no_aplicacion">
							<span>Causal no Aplicaci&oacute;n<span class="asterisco">*</span></span>
						</div>
					</td>
					<td>
						<div  id="div_aplicacion">
							<input type="date" name="fecha_aplicacion" id="fecha_aplicacion" max="<?php echo date('Y-m-d'); ?>" />
						</div>
						<div  id="div_no_aplicacion">
							<select type="text" name="causal" id="causal" style="width:95%">
								<option value="">Seleccione...</option>
								<option> Autorizacion radicada para Cita </option>
								<option> Autorizacion radicada para Examenes </option>
								<option> Autorizacion radicada para Medicamento </option>
								<option> Demora en la Autorizacion Prescripcion </option>
								<option> Demora en la Autorizacion Cita Medica </option>
								<option> Demora en la autorizacion de medicamento </option>
								<option> Error en Papeleria </option>
								<option> Falta de medicamento en el punto </option>
								<option> Falta cita para examenes </option>
								<option> Pendiente Solicitar Cita </option>
								<option> Pendiente Subir Formula A Mipres </option>
								<option> Sin red prestadora </option>
								<option> Cita inoportuna </option>
								<option> Falta de cita medica </option>
								<option> Pago Anticipado </option>
								<option> En proceso de cita </option>
								<option> En proceso de entrega </option>
								<option> No remision a entidad licenciada </option>
								<option> Desafiliacion Al sistema de Salud </option>
								<option> Falta de contacto </option>
								<option> ILocalizable </option>
								<option> Suspendido temporalmente </option>
								<option> Titulacion </option>
								<option> Voluntario </option>
								<option> Abandono </option>
								<option> Stock </option>
								<option> Falta de pago anticipado de EPS a IPS / OPL </option>
								<option> A demanda </option>
								<option> Traslado de Asegurador </option>
								<option> Pendiente Radicar Formula en Farmacia </option>
								<!--<option>Abandono</option>
                        <option>Compra de medicamento</option>
                        <option>Demora en la autorizacion</option>
                        <option>Demora en la entrega</option>
                        <option>Demora en la respuesta de ctc</option>
                        <option>Desafiliacion eps</option>
                        <option>En proceso de autorizacion</option>
                        <option>En proceso de cita</option>
                        <option>En proceso de entrega</option>
                        <option>Error en papeleria</option>
                        <option>Falta de cita medica</option>
                        <option>Falta de contacto</option>
                        <option>Falta de medicamento en el punto</option>
                        <option>Hospitalizado</option>
                        <option>Ilocalizable</option>
                        <option>Interrumpido por examenes</option>
                        <option>Stock</option>
                        <option>Suspendido temporalmente</option>
                        <option>Titulacion</option>
                        <option>Voluntario</option>-->
							</select>
						</div>
					</td>
					<td>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<th colspan="4">
						<br />
						<input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(seguimiento,2)" />
					</th>
				</tr>
			</table>
		</fieldset>
	</form>
</body>
</html>