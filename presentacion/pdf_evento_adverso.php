<?php
require('../datos/parse_str.php');
require("../datos/conex.php");
$consulta = mysqli_query($conex, "SELECT * FROM ipsen_evento_adverso AS EA
INNER JOIN ipsen_pacientes AS P ON P.ID_PACIENTE=EA.ID_PACIENTE_FK
INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
WHERE EA.ID_EVENTO_ADVERSO='8'");
echo mysqli_error($conex);
while ($fila1 = mysqli_fetch_array($consulta)) {
	$ID_EVENTO_ADVERSO = $fila1['ID_EVENTO_ADVERSO'];
	$FECHA_NOTIFICA = $fila1['FECHA_NOTIFICA'];
	$DEPARTAMENTO = $fila1['DEPARTAMENTO'];
	$MUNICIPIO = $fila1['MUNICIPIO'];
	$NOMBRE_INSTITUCION = $fila1['NOMBRE_INSTITUCION'];
	$CODIGO_PNF = $fila1['CODIGO_PNF'];
	$NOMBRE_REPORTANTE = $fila1['NOMBRE_REPORTANTE'];
	$PROFESION_REPORTANTE = $fila1['PROFESION_REPORTANTE'];
	$CORREO_REPORTANTE = $fila1['CORREO_REPORTANTE'];
	$FECHA_NACIMIENTO_PACIENTE = $fila1['FECHA_NACIMIENTO_PACIENTE'];
	$EDAD_PACIENTE = $fila1['EDAD_PACIENTE'];
	$TIPO_DOCUMENTO_PACIENTE = $fila1['TIPO_DOCUMENTO_PACIENTE'];
	$NUMERO_DOCUMENTO_PACIENTE = $fila1['NUMERO_DOCUMENTO_PACIENTE'];
	$INICIALES_PACIENTE = $fila1['INICIALES_PACIENTE'];
	$SEXO = $fila1['SEXO'];
	$PESO = $fila1['PESO'];
	$TALLA = $fila1['TALLA'];
	$DIAGNOSTICO_PRINCIPAL = $fila1['DIAGNOSTICO_PRINCIPAL'];
	$SCI1 = $fila1['SCI1'];
	$SCI2 = $fila1['SCI2'];
	$SCI3 = $fila1['SCI3'];
	$MEDICAMENTO1 = $fila1['MEDICAMENTO1'];
	$MEDICAMENTO2 = $fila1['MEDICAMENTO2'];
	$MEDICAMENTO3 = $fila1['MEDICAMENTO3'];
	$INDICACION1 = $fila1['INDICACION1'];
	$INDICACION2 = $fila1['INDICACION2'];
	$INDICACION3 = $fila1['INDICACION3'];
	$DOSIS1 = $fila1['DOSIS1'];
	$DOSIS2 = $fila1['DOSIS2'];
	$DOSIS3 = $fila1['DOSIS3'];
	$UNIDAD_MEDIDA1 = $fila1['UNIDAD_MEDIDA1'];
	$UNIDAD_MEDIDA2 = $fila1['UNIDAD_MEDIDA2'];
	$UNIDAD_MEDIDA3 = $fila1['UNIDAD_MEDIDA3'];
	$VIA_ADMINISTRACION1 = $fila1['VIA_ADMINISTRACION1'];
	$VIA_ADMINISTRACION2 = $fila1['VIA_ADMINISTRACION2'];
	$VIA_ADMINISTRACION2 = $fila1['VIA_ADMINISTRACION3'];
	$FRECUENCIA_ADMINISTRACION1 = $fila1['FRECUENCIA_ADMINISTRACION1'];
	$FRECUENCIA_ADMINISTRACION2 = $fila1['FRECUENCIA_ADMINISTRACION2'];
	$FRECUENCIA_ADMINISTRACION3 = $fila1['FRECUENCIA_ADMINISTRACION3'];
	$FECHA_INICIO1 = $fila1['FECHA_INICIO1'];
	$FECHA_INICIO2 = $fila1['FECHA_INICIO2'];
	$FECHA_INICIO3 = $fila1['FECHA_INICIO3'];
	$FECHA_FIN1 = $fila1['FECHA_FIN1'];
	$FECHA_FIN2 = $fila1['FECHA_FIN2'];
	$FECHA_FIN3 = $fila1['FECHA_FIN3'];
	$FECHA_INICIO_EVENTO = $fila1['FECHA_INICIO_EVENTO'];
	$EVENTO_ADVERSO = $fila1['EVENTO_ADVERSO'];
	$DESCRIPCION_ANALISIS_EVENTO = $fila1['DESCRIPCION_ANALISIS_EVENTO'];
	$DESENLACE_EVENTO = $fila1['DESENLACE_EVENTO'];
	$SERIEDAD = $fila1['SERIEDAD'];
	$FECHA_MUERTE = $fila1['FECHA_MUERTE'];
	$PREGUNTA1 = $fila1['PREGUNTA1'];
	$PREGUNTA2 = $fila1['PREGUNTA2'];
	$PREGUNTA3 = $fila1['PREGUNTA3'];
	$PREGUNTA4 = $fila1['PREGUNTA4'];
	$PREGUNTA5 = $fila1['PREGUNTA5'];
}
?>
<table style="width:100%; border:1px solid #000;" rules="all">
	<style>
		.titulos {
			background-color: #848484;
			font-family: Tahoma, Geneva, sans-serif;
			color: #FFF;
		}

		.obli {
			color: #ff0000;
		}

		.texto {
			font-weight: lighter;
			text-align: justify;
		}

		th {
			width: 25%;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
		}

		input[type=text] {
			width: 40%;
			height: 17px;
		}

		input[type=date] {
			width: 50%;
		}

		.btn_registrar {
			padding-top: 2%;
			background-image: url(imagenes/BTN_CONTINUAR2.png);
			background-image: url(../presentacion/imagenes/BTN_CONTINUAR2.png);
			background-repeat: no-repeat;
			width: 152px;
			height: 37px;
			color: transparent;
			background-color: transparent;
			border-radius: 5px;
			border: 1px solid transparent;
		}

		.btn_registrar:active {
			box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
			box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
				inset 0px 0px 20px #EEECEC;
		}

		.btn_registrar:hover {
			box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
			box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
				inset 0px 0px 20px #EEECEC;
		}

		.letra {
			font-family: Tahoma, Geneva, sans-serif;
		}
	</style>
	<tr>
		<th class="titulos" colspan="4">
			1. INFORMACION DEL REPORTANTE
		</th>
	</tr>
	<input type="text" name="ID_PACIENTE" id="ID_PACIENTE" value="<?php echo $ID_PACIENTE2 ?>" readonly="readonly" style="display:none;">
	<tr colspan="4">
		<td style="text-align: center;">
			<strong>Fecha de Notificacion:</strong><br><br>
			<span style=" font-weight:none"><?php echo $FECHA_NOTIFICA ?></span>
		</td>
		<td style="text-align: center;">
			<strong>Origen del reporte</strong>
			<hr>
			<strong>Departamento - Municipio:</strong><br><br>
			<span style=" font-weight:none"><?php echo $DEPARTAMENTO ?></span> - <span style=" font-weight:none"><?php echo $MUNICIPIO ?></span>
		</td>
		<td style="text-align: center;">
			<strong>Nombre de la Institucion donde ocurri&oacute; el evento:</strong><br><br>
			<span style=" font-weight:none"><?php echo $NOMBRE_INSTITUCION ?></span>
		</td>
		<td style="text-align: center;">
			<strong>C&oacute;digo PNF:</strong><br><br>
			<span style=" font-weight:none"><?php echo $CODIGO_PNF ?></span>
		</td>
	</tr>
	<tr colspan="4">
		<td colspan="2" style="text-align: center;">
			<strong>Nombre del Reportante primario:</strong><br><br>
			<span style=" font-weight:none"><?php echo $NOMBRE_REPORTANTE ?></span>
		</td>
		<td style="text-align: center;">
			<strong>Profesi&oacute;n del reportante primario:</strong><br><br>
			<span style=" font-weight:none"><?php echo $PROFESION_REPORTANTE ?></span>
		</td>
		<td style="text-align: center;">
			<strong>Correo electr&oacute;nico institucional del reportante primario:</strong><br><br>
			<span style=" font-weight:none"><?php echo $CORREO_REPORTANTE ?></span>
		</td>
	</tr>
	<tr>
		<th class="titulos" colspan="4">
			2. INFORMACION DEL PACIENTE
		</th>
	</tr>
	<tr>
		<td style="text-align: center;">
			<strong>Fecha de nacimiento del paciente:</strong><br><br>
			<span style=" font-weight:none"><?php echo $FECHA_NACIMIENTO_PACIENTE ?></span>
		</td>
		<td style="text-align: center;">
			<strong>Edad del paciente en el momento del EA</strong>
			<hr>
			<strong>Edad:</strong><br><br>
			<span style=" font-weight:none"><?php echo $EDAD_PACIENTE ?></span>
		</td>
		<td style="text-align: center;">
			<strong>Tipo de identificacion - Numero de identificacion del paciente:</strong><br><br>
			<span style=" font-weight:none"><?php echo $TIPO_DOCUMENTO_PACIENTE ?></span> - <span style=" font-weight:none"><?php echo $NUMERO_DOCUMENTO_PACIENTE ?></span>
		</td>
		<td style="text-align: center;">
			<strong>Iniciales del paciente:</strong><br><br>
			<span style=" font-weight:none"><?php echo $INICIALES_PACIENTE ?></span>
		</td>
	</tr>
	<tr>
		<td style="text-align: center;">
			<strong>Sexo:</strong><br><br>
			<span style=" font-weight:none"><?php echo $SEXO ?></span>
		</td>
		<td style="text-align: center;">
			<strong>Peso - Talla:</strong><br><br>
			<span style=" font-weight:none"><?php echo $PESO ?></span> - <span style=" font-weight:none"><?php echo $TALLA ?></span>
		</td>
		<td colspan="2" style="text-align: center;">
			<strong>Diagnostico principal y otros diagnosticos:</strong><br><br>
			<div style="text-align: left;">
				<span style=" font-weight:none"><?php echo $DIAGNOSTICO_PRINCIPAL ?></span>
			</div>
		</td>
	</tr>
	<tr>
		<th class="titulos" colspan="4">
			3. INFORMACION DE LOS MEDICAMENTOS
			<P>Registre todos los medicamentos utilizados y marque con una <span style="color:#000">(S)</span> el (los) sospechoso(s), con una <span style="color:#000">(C)</span> el (los) concomitantes y con una <span style="color:#000">(I)</span> las interacciones. </P>
		</th>
	</tr>
	<tr>
		<th style="text-align: left;">S/C/I</th>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $SCI1 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $SCI2 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $SCI3 ?></span> <br></td>
	</tr>
	<tr>
		<th style="text-align: left;"> Medicamento
			<p>(Denominacion Comun Internacional o Nombre generico)</p>
		</th>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $MEDICAMENTO1 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $MEDICAMENTO2 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $MEDICAMENTO3 ?></span> <br></td>
	</tr>
	<tr>
		<th style="text-align: left;"> Indicacion</th>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $INDICACION1 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $INDICACION2 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $INDICACION3 ?></span> <br></td>
	</tr>
	<tr>
		<th style="text-align: left;"> Dosis</th>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $DOSIS1 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $DOSIS2 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $DOSIS3 ?></span> <br></td>
	</tr>
	<tr>
		<th style="text-align: left;"> Unidad de medida</th>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $UNIDAD_MEDIDA1 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $UNIDAD_MEDIDA2 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $UNIDAD_MEDIDA3 ?></span> <br></td>
	</tr>
	<tr>
		<th style="text-align: left;"> VIa de administracion</th>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $VIA_ADMINISTRACION1 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $VIA_ADMINISTRACION2 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $VIA_ADMINISTRACION3 ?></span> <br></td>
	</tr>
	<tr>
		<th style="text-align: left;"> Frecuencia de administracion</th>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $FRECUENCIA_ADMINISTRACION1 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $FRECUENCIA_ADMINISTRACION2 ?></span> <br></td>
		<td style="text-align: center;"> <span style=" font-weight:none"><?php echo $FRECUENCIA_ADMINISTRACION3 ?></span> <br></td>
	</tr>
	<tr>
		<th style="text-align: left;">
			Fecha inicio<br />
		</th>
		<td style="text-align: center;">
			<span style=" font-weight:none"><?php echo $FECHA_INICIO1 ?></span> <br>
		</td>
		<td style="text-align: center;">
			<span style=" font-weight:none"><?php echo $FECHA_INICIO2 ?></span> <br>
		</td>
		<td style="text-align: center;">
			<span style=" font-weight:none"><?php echo $FECHA_INICIO3 ?></span> <br>
		</td>
	</tr>
	<tr>
		<th style="text-align: left;">
			Fecha de finalizacion<br />
		</th>
		<td style="text-align: center;">
			<span style=" font-weight:none"><?php echo $FECHA_FIN1 ?></span> <br>
		</td>
		<td style="text-align: center;">
			<span style=" font-weight:none"><?php echo $FECHA_FIN2 ?></span> <br>
		</td>
		<td style="text-align: center;">
			<span style=" font-weight:none"><?php echo $FECHA_FIN3 ?></span> <br>
		</td>
	</tr>
	<tr>
		<th class="titulos" colspan="4">
			4. INFORMACION DEL EVENTO ADVERSO
		</th>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
			<strong>Fecha de Inicio del Evento Adverso:</strong><br><br>
			<span style=" font-weight:none"><?php echo $FECHA_INICIO_EVENTO ?></span> <br>
		</td>
		<td colspan="2" style="text-align: center;">
			<strong>Evento adverso:</strong><br><br>
			<div style="text-align: left;">
				<span style=" font-weight:none"><?php echo $EVENTO_ADVERSO ?></span> <br>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
			<strong>Descripcion y analisis del Evento Adverso:</strong><br><br>
			<div style="text-align: left;">
				<span style=" font-weight:none"><?php echo $DESCRIPCION_ANALISIS_EVENTO ?></span> <br>
			</div>
		</td>
		<td style="text-align: center;">
			<strong>Desenlace del evento (Marcar con una X):</strong><br><br>
			<span style=" font-weight:none"><?php echo $DESENLACE_EVENTO ?></span> <br>
		</td>
		<td style="text-align: center;">
			<strong>Seriedad (Marcar con X):</strong><br><br>
			<?php
			if ($SERIEDAD == "Muerte") {
			?>
				<span style=" font-weight:none"><?php echo $SERIEDAD ?></span> <br> <span style=" font-weight:none">Fecha de la muerte: <?php echo $FECHA_MUERTE ?></span><br>
			<?php
			} else {
			?>
				<span style=" font-weight:none"><?php echo $SERIEDAD ?></span><br>
			<?php
			}
			?>
		</td>
	</tr>
	<tr colspan="4">
		<th colspan="1">
		</th>
		<th colspan="1" class="titulos">
			SI
		</th>
		<th colspan="1" class="titulos">
			NO
		</th>
		<th colspan="1" class="titulos">
			NO SABE
		</th>
	</tr>
	<tr>
		<th style="text-align: left;">
			El evento se presento despues de administrar el medicamento <br>
		</th>
		<?php
		if ($PREGUNTA1  == "SI") {
			$PREGUNTA1 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA1 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} elseif ($PREGUNTA1 == "NO") {
			$PREGUNTA1 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA1 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} else {
			$PREGUNTA1 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA1 ?></span> <br>
			</td>
		<?php
		}
		?>
	</tr>
	<tr>
		<th style="text-align: left;">
			Existen otros factores que puedan explicar el evento (medicamento, patologIas, etc.) <br>
		</th>
		<?php
		if ($PREGUNTA2  == "SI") {
			$PREGUNTA2 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA2 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} elseif ($PREGUNTA2 == "NO") {
			$PREGUNTA2 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA2 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} else {
			$PREGUNTA2 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA2 ?></span> <br>
			</td>
		<?php
		}
		?>
	</tr>
	<tr>
		<th style="text-align: left;">
			El evento desaparecio al disminuir o suspender el medicamento sospechoso <br>
		</th>
		<?php
		if ($PREGUNTA3  == "SI") {
			$PREGUNTA3 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA3 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} elseif ($PREGUNTA3 == "NO") {
			$PREGUNTA3 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA3 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} else {
			$PREGUNTA3 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA3 ?></span> <br>
			</td>
		<?php
		}
		?>
	</tr>
	<tr>
		<th style="text-align: left;">
			El paciente ya habIa presentado la misma reaccion al medicamento sospechoso <br>
		</th>
		<?php
		if ($PREGUNTA4  == "SI") {
			$PREGUNTA4 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA4 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} elseif ($PREGUNTA4 == "NO") {
			$PREGUNTA4 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA4 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} else {
			$PREGUNTA4 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA4 ?></span> <br>
			</td>
		<?php
		}
		?>
	</tr>
	<tr>
		<th style="text-align: left;">
			Se puede ampliar la informacion del paciente relacionando con el evento <br>
		</th>
		<?php
		if ($PREGUNTA5  == "SI") {
			$PREGUNTA5 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA5 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} elseif ($PREGUNTA5 == "NO") {
			$PREGUNTA5 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA5 ?></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
		<?php
		} else {
			$PREGUNTA5 = "X"
		?>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"></span> <br>
			</td>
			<td style="text-align: center;">
				<span style=" font-weight:none"><?php echo $PREGUNTA5 ?></span> <br>
			</td>
		<?php
		}
		?>
	</tr>
</table>