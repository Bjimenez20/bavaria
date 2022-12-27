<?php
require_once('session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<style>
		.aviso3 {
			font-size: 130%;
			font-weight: bold;
			color: #11a9e3;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}

		.error {
			font-size: 130%;
			font-weight: bold;
			color: red;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}

		.btn_continuar {
			padding-top: 7px;
			width: 152px;
			height: 37px;
			color: transparent;
			background-color: transparent;
			border-radius: 5px;
			border: 1px solid transparent;
		}

		.btn_continuar:active {
			box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
			box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
				inset 0px 0px 20px #EEECEC;
		}

		.btn_continuar:hover {
			box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
			box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
				inset 0px 0px 20px #EEECEC;
		}
	</style>
</head>

<body>
	<?php
	require('../datos/parse_str.php');
	require_once("../datos/conex.php");
	if (isset($_POST['registrar'])) {
		$FECHA_NOTIFICA = $_POST['fecha_notificacion'];
		$DEPARTAMENTO = $_POST['departamento'];
		$MUNICIPIO = $_POST['municipio'];
		$NOMBRE_INSTITUCION = $_POST['institucion_evento'];
		$CODIGO_PNF = $_POST['codigo_pnf'];
		$NOMBRE_REPORTANTE = $_POST['nombre_usuario'];
		$PROFESION_REPORTANTE = $_POST['profecion_usuario'];
		$CORREO_REPORTANTE = $_POST['correo_usuario'];
		$FECHA_NACIMIENTO_PACIENTE = $_POST['fecha_nacimiento'];
		$EDAD_PACIENTE = $_POST['edad_paciente'];
		$TIPO_DOCUMENTO_PACIENTE = $_POST['tipo_documento_paciente'];
		$NUMERO_DOCUMENTO_PACIENTE = $_POST['documento_paciente'];
		$INICIALES_PACIENTE = $_POST['iniciales_pa'];
		$SEXO = $_POST['genero'];
		$PESO = $_POST['peso'];
		$TALLA = $_POST['talla'];
		$DIAGNOSTICO_PRINCIPAL = $_POST['diagnostico'];
		$SCI1 = $_POST['S_C_I1'];
		$MEDICAMENTO1 = $_POST['medicamento1'];
		$INDICACION1 = $_POST['indicacion1'];
		$DOSIS1 = $_POST['dosis1'];
		$UNIDAD_MEDIDA1 = $_POST['unidad_medida1'];
		$VIA_ADMINISTRACION1 = $_POST['via_administracion1'];
		$FRECUENCIA_ADMINISTRACION1 = $_POST['frecuencia_administracion1'];
		$FECHA_INICIO1 = $_POST['fecha_inicio1'];
		$FECHA_FIN1 = $_POST['fecha_fin1'];
		$SCI2 = $_POST['S_C_I2'];
		$MEDICAMENTO2 = $_POST['medicamento2'];
		$INDICACION2 = $_POST['indicacion2'];
		$DOSIS2 = $_POST['dosis2'];
		$UNIDAD_MEDIDA2 = $_POST['unidad_medida2'];
		$VIA_ADMINISTRACION2 = $_POST['via_administracion2'];
		$FRECUENCIA_ADMINISTRACION2 = $_POST['frecuencia_administracion2'];
		$FECHA_INICIO2 = $_POST['fecha_inicio2'];
		$FECHA_FIN2 = $_POST['fecha_fin2'];
		$SCI3 = $_POST['S_C_I3'];
		$MEDICAMENTO3 = $_POST['medicamento3'];
		$INDICACION3 = $_POST['indicacion3'];
		$DOSIS3 = $_POST['dosis3'];
		$UNIDAD_MEDIDA3 = $_POST['unidad_medida3'];
		$VIA_ADMINISTRACION3 = $_POST['via_administracion3'];
		$FRECUENCIA_ADMINISTRACION3 = $_POST['frecuencia_administracion3'];
		$FECHA_INICIO3 = $_POST['fecha_inicio3'];
		$FECHA_FIN3 = $_POST['fecha_fin3'];
		$TITULAR_REGISTRO = $_POST['titular_registro'];
		$NOMBRE_COMERCIAL = $_POST['nombre_comercial'];
		$REGISTRO_SANITARIO = $_POST['registro_sanitario'];
		$LOTE = $_POST['lote'];
		$FECHA_INICIO_EVENTO = $_POST['fecha_ini_evento'];
		$EVENTO_ADVERSO = $_POST['evento_adverso'];
		$DESCRIPCION_ANALISIS_EVENTO = $_POST['descripcion_evento'];
		$DESENLACE_EVENTO = $_POST['desenlace_evento'];
		$SERIEDAD = $_POST['seriedad'];
		$FECHA_MUERTE = $_POST['fecha_muerte'];
		$PREGUNTA1 = $_POST['pregunta1'];
		$PREGUNTA2 = $_POST['pregunta2'];
		$PREGUNTA3 = $_POST['pregunta3'];
		$PREGUNTA4 = $_POST['pregunta4'];
		$PREGUNTA5 = $_POST['pregunta5'];
		$ID_PACIENTE = $_POST['ID_PACIENTE'];

		$insertar = mysqli_query($conex, "INSERT INTO ipsen_evento_adverso(FECHA_NOTIFICA,DEPARTAMENTO,MUNICIPIO,NOMBRE_INSTITUCION,CODIGO_PNF,NOMBRE_REPORTANTE,PROFESION_REPORTANTE,CORREO_REPORTANTE,FECHA_NACIMIENTO_PACIENTE,EDAD_PACIENTE,TIPO_DOCUMENTO_PACIENTE,NUMERO_DOCUMENTO_PACIENTE,INICIALES_PACIENTE,SEXO,PESO,TALLA,DIAGNOSTICO_PRINCIPAL,SCI1,MEDICAMENTO1,INDICACION1,DOSIS1,UNIDAD_MEDIDA1,VIA_ADMINISTRACION1,FRECUENCIA_ADMINISTRACION1,FECHA_INICIO1,FECHA_FIN1,SCI2,MEDICAMENTO2,INDICACION2,DOSIS2,UNIDAD_MEDIDA2,VIA_ADMINISTRACION2,FRECUENCIA_ADMINISTRACION2,FECHA_INICIO2,FECHA_FIN2,SCI3,MEDICAMENTO3,INDICACION3,DOSIS3,UNIDAD_MEDIDA3,VIA_ADMINISTRACION3,FRECUENCIA_ADMINISTRACION3,FECHA_INICIO3,FECHA_FIN3,TITULAR_REGISTRO,NOMBRE_COMERCIAL,REGISTRO_SANITARIO,LOTE,FECHA_INICIO_EVENTO,EVENTO_ADVERSO,DESCRIPCION_ANALISIS_EVENTO,DESENLACE_EVENTO,SERIEDAD,FECHA_MUERTE,PREGUNTA1,PREGUNTA2,PREGUNTA3,PREGUNTA4,PREGUNTA5,ID_PACIENTE_FK) VALUES ('" . $FECHA_NOTIFICA . "','" . $DEPARTAMENTO . "','" . $MUNICIPIO . "','" . $NOMBRE_INSTITUCION . "','" . $CODIGO_PNF . "','" . $NOMBRE_REPORTANTE . "','" . $PROFESION_REPORTANTE . "','" . $CORREO_REPORTANTE . "','" . $FECHA_NACIMIENTO_PACIENTE . "','" . $EDAD_PACIENTE . "','" . $TIPO_DOCUMENTO_PACIENTE . "','" . $NUMERO_DOCUMENTO_PACIENTE . "','" . $INICIALES_PACIENTE . "','" . $SEXO . "','" . $PESO . "','" . $TALLA . "','" . $DIAGNOSTICO_PRINCIPAL . "','" . $SCI1 . "','" . $MEDICAMENTO1 . "','" . $INDICACION1 . "','" . $DOSIS1 . "','" . $UNIDAD_MEDIDA1 . "','" . $VIA_ADMINISTRACION1 . "','" . $FRECUENCIA_ADMINISTRACION1 . "','" . $FECHA_INICIO1 . "','" . $FECHA_FIN1 . "','" . $SCI2 . "','" . $MEDICAMENTO2 . "','" . $INDICACION2 . "','" . $DOSIS2 . "','" . $UNIDAD_MEDIDA2 . "','" . $VIA_ADMINISTRACION2 . "','" . $FRECUENCIA_ADMINISTRACION2 . "','" . $FECHA_INICIO2 . "','" . $FECHA_FIN2 . "','" . $SCI3 . "','" . $MEDICAMENTO3 . "','" . $INDICACION3 . "','" . $DOSIS3 . "','" . $UNIDAD_MEDIDA3 . "','" . $VIA_ADMINISTRACION3 . "','" . $FRECUENCIA_ADMINISTRACION3 . "','" . $FECHA_INICIO3 . "','" . $FECHA_FIN3 . "','" . $TITULAR_REGISTRO . "','" . $NOMBRE_COMERCIAL . "','" . $REGISTRO_SANITARIO . "','" . $LOTE . "','" . $FECHA_INICIO_EVENTO . "','" . $EVENTO_ADVERSO . "','" . $DESCRIPCION_ANALISIS_EVENTO . "','" . $DESENLACE_EVENTO . "','" . $SERIEDAD . "','" . $FECHA_MUERTE . "','" . $PREGUNTA1 . "','" . $PREGUNTA2 . "','" . $PREGUNTA3 . "','" . $PREGUNTA4 . "','" . $PREGUNTA5 . "','" . $ID_PACIENTE . "')");
		echo mysqli_error($conex);
		if ($insertar) {
			$select_ea = mysqli_query($conex, "SELECT * FROM ipsen_evento_adverso ORDER BY ID_EVENTO_ADVERSO DESC LIMIT 1");
			while ($fila = mysqli_fetch_array($select_ea)) {
				$ID_EVENTO_ADVERSO = $fila['ID_EVENTO_ADVERSO'];
				$ID = $fila['ID_PACIENTE_FK'];
	?>
				<span style="margin-top:5%;">
					<center>
						<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
					</center>
				</span>
				<p class="aviso3" style=" width:68.9%; margin:auto auto;">HA CREADO EXISITOSAMENTE EL EVENTO ADVERSO.</p>
				<br />
				<br />
				<center>
					<a href="../presentacion/pdf.php?ID=<?php echo $ID_EVENTO_ADVERSO ?>" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_AGREGAR2.png" style="width:152px; height:37px"></a>
				</center>
			<?php
			}
		} else {
			?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia2.png" width="68" height="78" style="width:70px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">
				<span style="border-left-color:#fff">ERROR VERIFIQUE LOS DATOS REGISTRADOS</span>
			</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/form_evento_adverso.php?ID_PACIENTE=<?php echo $ID_PACIENTE ?>" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_ROJO.png" style="width:152px; height:37px" /></a>
			</center>
	<?php
		}
	}
	?>
</body>

</html>