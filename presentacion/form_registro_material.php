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
	<script type="text/javascript">
		function materiales() {
			var REFERENCIA = $('#REFERENCIA').val();
			$.ajax({
				url: 'listado_producto.php',
				data: {
					REFERENCIA: REFERENCIA
				},
				type: 'post',
				beforeSend: function() {
					$("#producto").attr('disabled', 'disabled');
				},
				success: function(data) {
					$("#producto").removeAttr('disabled');
					$('#producto').html(data);
				}
			})
		}

		function serial() {
			var producto = $('#producto').val();
			$.ajax({
				url: 'opcion_serial.php',
				data: {
					producto: producto
				},
				type: 'post',
				beforeSend: function() {
					$("#span").html('<img src="imagenes/cargando.gif" />' + "  Procesando, espere por favor");
				},
				success: function(data) {
					$('#OPCION').html(data);
					var a = $('#OPCION').val();
					$('#OPCION2').val(a);
					var val = $('#OPCION2').val();
					$("#span").html("");
					if (val != 'SI') {
						$('#Agregar').css('display', 'none');
						$('#Continuar').css('display', 'block');
					} else if (val == 'SI') {
						$('#Agregar').css('display', 'block');
						$('#Continuar').css('display', 'none');
					} else if (val == '') {
						$('#Agregar').css('display', 'none');
						$('#Continuar').css('display', 'none');
					}
				}
			})
		}

		function tipo() {
			val = $('#TIPO_ENTRADA').val();
			if (val == 'DEVOLUCION') {
				$('#ESTADO_REM').css('display', 'none');
				$('#ESTADO_DEV').css('display', 'block');
				$('#ESTADO').css('display', 'block');
				$('#nd').css('display', 'none');
				$('#ESTADO_REM').val('');
				$("#ESTADO_DEV option[value='']").attr("SELECTed", "SELECTed");
				$("#ESTADO_DEV option[value='']").attr('disabled', 'disabled');
				$("#ESTADO_DEV option[value!='']").removeAttr('disabled', 'disabled');
				$('#NO_REMISION').val('');
				$("#NO_REMISION").attr('readonly', 'readonly');
			}
			if (val == 'REMISION') {
				$('#ESTADO_REM').css('display', 'block');
				$('#ESTADO_DEV').css('display', 'none');
				$('#nd').css('display', 'none');
				$('#ESTADO').css('display', 'block');
				$('#ESTADO_REM').val($('#ESTADO_REM').prop('defaultValue'));
				$("#ESTADO_DEV option[value='']").attr("SELECTed", "SELECTed");
				$("#ESTADO_DEV option[value!='']").attr('disabled', 'disabled');
				$("#NO_REMISION").removeAttr('readonly');
			}
			if (val == '') {
				$('#ESTADO_REM').css('display', 'none');
				$('#ESTADO_DEV').css('display', 'none');
				$('#nd').css('display', 'block');
				$('#ESTADO_REM').val('');
				$('#NO_REMISION').val('');
				$("#ESTADO_DEV option[value='']").attr("SELECTed", "SELECTed");
				$("#ESTADO_DEV option[value!='']").attr('disabled', 'disabled');
				$("#NO_REMISION").attr('readonly', 'readonly');
			}
		}
		$(document).ready(function() {
			tipo();
			$('#TIPO_ENTRADA').change(function() {
				tipo();
			});
			$('#REFERENCIA').change(function() {
				materiales();
				var val = $('#OPCION2').val();
			});
			$('#producto').change(function() {
				$('#Agregar').css('display', 'none');
				$('#Continuar').css('display', 'none');
				serial();
				var val = $('#OPCION2').val();
			});
			$('#miformulario').submit(function() {
				if (confirm('�ESTA SEGURO(A) DE ENVIAR LA INFORMACION?')) {
					document.tuformulario.submit()
					return (true)
				} else {
					return (false);
				}
			});
		});
	</script>
	<style>
		.aviso3 {
			font-size: 130%;
			font-weight: bold;
			color: #11a9e3;
			font-family: Tahoma, Geneva, sans-serif;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}
	</style>
</head>
<?php
require('../datos/parse_str.php');
require_once('../datos/conex.php');
if ($privilegios != '' && $usua != '') {
?>

	<body class="body" style="width:100%;">
		<form name="miformulario" id="miformulario" method="post" action="form_registro_material.php" onKeyDown="return filtro(2)" class="letra">
			<br><br><br><br>
			<div style="width:100%; background-color:#224a81; height:80%"></div>
			<table width="100%">
				<tr>
					<td style="background-color:#224a81;text-align:center">
						<span style="color:#FFF;">REGISTRO MATERIAL</span>
					</td>
				</tr>
			</table>
			<br>
			<table width="100%">
				<tr>
					<td>
						<span>TIPO ENTRADA</span>
					</td>
					<td>
						<SELECT name="TIPO_ENTRADA" id="TIPO_ENTRADA" tabindex="1">
							<?PHP
							if (isset($_POST['TIPO_ENTRADA'])) {
								$TIPO_ENTRADA = $_POST['TIPO_ENTRADA'];
								if ($TIPO_ENTRADA == '') {
									$TIPO_ENTRADA = 'TIPO ENTRADA';
							?>
									<option value="" style="color:#999;"><?php echo $TIPO_ENTRADA ?></option>
								<?php
								} else {
								?>
									<option value="<?php echo $TIPO_ENTRADA ?>"><?php echo $TIPO_ENTRADA ?></option>
								<?php
								}
								if ($TIPO_ENTRADA == 'REMISION') {
								?>
									<option value="DEVOLUCION">DEVOLUCI&Oacute;N</option>
								<?php
								}
								if ($TIPO_ENTRADA == 'DEVOLUCION') {
								?>
									<option value="REMISION">REMISI&Oacute;N</option>
								<?php
								}
								if ($TIPO_ENTRADA == 'TIPO ENTRADA') {
								?>
									<option value="REMISION">REMISI&Oacute;N</option>
									<option value="DEVOLUCION">DEVOLUCI&Oacute;N</option>
								<?php
								}
							} else {
								?>
								<option style="color:#999" value="">TIPO ENTRADA</option>
								<option value="REMISION">REMISI&Oacute;N</option>
								<option value="DEVOLUCION">DEVOLUCI&Oacute;N</option>
							<?php
							}
							?>
						</SELECT>
					</td>
					<td>
						<span>REFERENCIA</span>
					</td>
					<td>
						<?PHP
						if (isset($_POST['REFERENCIA'])) {
							$REFERENCIA = $_POST['REFERENCIA'];
							$SELECT_refere2 = mysqli_query($conex, "SELECT * from ipsen_referencia where ID_REFERENCIA = '" . $REFERENCIA . "'");
							while ($fila = mysqli_fetch_array($SELECT_refere2)) {
								$ref = $fila['NOMBRE_REFERENCIA'];
							}
						?>
							<SELECT name="REFERENCIA" id="REFERENCIA">
								<option style="color:#999" value="<?php echo $REFERENCIA ?>"><?php echo $ref ?></option>
							</SELECT>
						<?php
						} else {
						?>
							<SELECT name="REFERENCIA" id="REFERENCIA">
								<option style="color:#999" value="">REFERENCIA</option>
								<?php
								$SELECT_refere = mysqli_query($conex, "SELECT DISTINCT(NOMBRE_REFERENCIA) from ipsen_referencia where NOMBRE_REFERENCIA != '' ORDER BY NOMBRE_REFERENCIA ASC");
								while ($fila = mysqli_fetch_array($SELECT_refere)) {
									echo "<option>" . $fila['NOMBRE_REFERENCIA'] . "</option>";
								}
								?>
							</SELECT>
						<?php
						}
						?>
					</td>
				</tr>
				<tr>
					<td>
						<span>ESTADO</span>
					</td>
					<td>
						<input type="text" name="nd" id="nd" readonly placeholder="ESTADO" />
						<?PHP
						if (isset($_POST['ESTADO_REM'])) {
							$ESTADO_REM = $_POST['ESTADO_REM'];
						?>
							<input type="text" name="ESTADO_REM" id="ESTADO_REM" placeholder="ESTADO_REM" readonly value="<?php echo $ESTADO_REM ?>" />
						<?php
						} else {
						?>
							<input type="text" name="ESTADO_REM" id="ESTADO_REM" placeholder="" value="NUEVO" style="display:none;" readonly />
						<?php
						}
						?>
						<SELECT name="ESTADO_DEV" id="ESTADO_DEV" style="display:none;">
							<?php
							if (isset($_POST['ESTADO_DEV'])) {
								$ESTADO_DEV = $_POST['ESTADO_DEV'];
							?>
								<option style="color:#999"><?php echo $ESTADO_DEV ?></option>
							<?php
							} else {
							?>
								<option style="color:#999" value=" ">ESTADO DEVOLUCION</option>
							<?php
							}
							?>
							<option>BUENO</option>
							<option value="DANADO">DA&Ntilde;ADO</option>
							<option>NUEVO</option>
						</SELECT>
					</td>
					<td>
						<span><label class="labeltitu">NO. REMISI&Oacute;N</label></span>
					</td>
					<td>
						<?PHP
						if (isset($_POST['NO_REMISION'])) {
							$NO_REMISION = $_POST['NO_REMISION'];
						?>
							<input type="text" name="NO_REMISION" id="NO_REMISION" placeholder="NO. REMISION" readonly value="<?php echo $NO_REMISION ?>" maxlength="20" />
						<?php
						} else {
						?>
							<input type="text" name="NO_REMISION" id="NO_REMISION" placeholder="NO. REMISION" readonly maxlength="20" tabindex="2" />
						<?php
						}
						?>
					</td>
				</tr>
				<tr>
					<td>
						<span>PRODUCTO</span>
					</td>
					<td>
						<?PHP
						if (isset($_POST['producto'])) {
							$producto = $_POST['producto'];
							$SELECT_prod = mysqli_query($conex, "SELECT MATERIAL,ID_REFERENCIA FROM ipsen_referencia WHERE ID_REFERENCIA='" . $producto . "'");
						?>
							<SELECT id="producto" name="producto">
								<?php
								while ($dato = mysqli_fetch_array($SELECT_prod)) {
									$ID_PRODUCTO = $dato['ID_REFERENCIA'];
									$MATERIAL = $dato['MATERIAL'];
								?>
									<option value="<?php echo $ID_PRODUCTO ?>"><?php echo $MATERIAL ?></option>
								<?php
								}
								?>
							</SELECT>
						<?php
						} else {
						?>
							<SELECT id="producto" name="producto">
							</SELECT>
						<?php
						}
						?>
					</td>
					<td>
						<span>CANTIDAD</span>
					</td>
					<td>
						<?PHP
						if (isset($_POST['CANTIDAD'])) {
							$CANTIDAD = $_POST['CANTIDAD'];
						?>
							<input type="text" name="CANTIDAD" id="CANTIDAD" required placeholder="CANTIDAD" value="<?php echo $CANTIDAD; ?>" maxlength="3" onKeyDown="return validarNumeros(event)" readonly />
						<?php
						} else {
						?>
							<input type="text" name="CANTIDAD" id="CANTIDAD" required placeholder="CANTIDAD" maxlength="3" onKeyDown="return validarNumeros(event)" title="La cantidad esta vacia" tabindex="4" />
						<?php
						}
						?>
					</td>
				</tr>
				<tr>
					<td>
						<span style="visibility:hidden">OPCION SERIAL</span>
					</td>
					<td style="visibility:hidden">
						<?php
						if (isset($_POST['OPCION']) && isset($_POST['OPCION2'])) {
							$OPCION = $_POST['OPCION'];
							$OPCION2 = $_POST['OPCION2'];
						?>
							<SELECT name="OPCION" id="OPCION">
								<option style="color:#999" value="<?php echo $OPCION ?>"><?php echo $OPCION ?></option>
							</SELECT>
							<input name="OPCION2" id="OPCION2" type="text" value="<?php echo $OPCION2 ?>" readonly="readonly" style="display:none" />
						<?php
						} else {
						?>
							<SELECT name="OPCION" id="OPCION">
							</SELECT>
							<input name="OPCION2" id="OPCION2" type="text" readonly="readonly" style="display:none" />
						<?php
						}
						?>
					</td>
				</tr>
			</table>
			<center>
				<input id="Agregar" name="Agregar" type="submit" value="INICIAR SESION" class="btn_agregar" Onclick="return validar(miformulario)" style="display:none" />
			</center>

			<center>
				<input id="Continuar" name="Continuar" type="submit" value="continuar" class="btn_continuar" formaction="../logica/ingresar_material.php?INSER_SERIAL=<?php echo 'NO'; ?>" style="display:none" Onclick="return validar(miformulario)" />
			</center>
			<?php
			if (isset($_POST['Agregar'])) {
				$OPCION_SERIAL = $_POST['OPCION'];
				if ($OPCION_SERIAL == 'SI') {
					$var = $_POST['CANTIDAD'];
					$var;
			?>
					<fieldset>
						<legend style="font-weight:bold; text-align:center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SERIALES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</legend>
						<div class="div">
							<?php
							for ($i = 1; $i <= $var; $i++) {
							?>
								<div class="divi1">
									<label class="labeltitu">SERIAL</label>
								</div>
								<div class="divi2">
									<input type="text" name="<?php echo "serial" . $i; ?>" maxlength="16" />
								</div>
							<?php
							}
							?>
						</div>
						<center>
							<input id="Continuar" name="Continuar" type="submit" value="continuar" class="btn_continuar" formaction="../logica/ingresar_material.php?INSER_SERIAL=<?php echo 'SI'; ?>" />
						</center>
				<?php
				}
			}
				?>
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