<?php
require('../datos/parse_str.php');
require_once("../dompdf/dompdf_config.inc.php");
require("../datos/conex.php");
$ID_EVENTO_ADVERSO = $ID_EA;
include("../logica/consulta_pdf_ea.php");
$codigoHTML = '
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
		<th>
			Fecha de Notificacion:<br><br>
			<span style=" font-weight:none">' . $FECHA_NOTIFICA . '</span>
		</th>
		<th>Origen del reporte
			<hr>
			Departamento - Municipio:<br><br>
			<span style=" font-weight:none">' . $DEPARTAMENTO . '</span> - <span style=" font-weight:none">' . $MUNICIPIO . '</span>
		</th>
		<th>
			Nombre de la Institucion donde ocurri&oacute; el evento:<br><br>
			<span style=" font-weight:none">' . $NOMBRE_INSTITUCION . '</span>
		</th>
		<th>
			C&oacute;digo PNF:<br><br>
			<span style=" font-weight:none">' . $CODIGO_PNF . '</span>
		</th>
	</tr>
	<tr colspan="4">
		<th colspan="2">
			Nombre del Reportante primario:<br><br>
			<span style=" font-weight:none">' . $NOMBRE_REPORTANTE . '</span>
		</th>
		<th>
			Profesi&oacute;n del reportante primario:<br><br>
			<span style=" font-weight:none">' . $PROFESION_REPORTANTE . '</span>
		</th>
		<th>
			Correo electr&oacute;nico institucional del reportante primario:<br><br>
			<span style=" font-weight:none">' . $CORREO_REPORTANTE . '</span>
		</th>
	</tr>
	<tr>
		<th class="titulos" colspan="4">
			2. INFORMACION DEL PACIENTE
		</th>
	</tr>
	<tr>
		<th>
			Fecha de nacimiento del paciente:<br><br>
			<span style=" font-weight:none">' . $FECHA_NACIMIENTO_PACIENTE . '</span>
		</th>
		<th>
			Edad del paciente en el momento del EA
			<hr>
			Edad:<br><br>
			<span style=" font-weight:none">' . $EDAD_PACIENTE . '</span>
		</th>
		<th>
			Tipo de identificacion - Numero de identificacion del paciente:<br><br>
			<span style=" font-weight:none">' . $TIPO_DOCUMENTO_PACIENTE . '</span> - <span style=" font-weight:none">' . $NUMERO_DOCUMENTO_PACIENTE . '</span>
		</th>
		<th>
			Iniciales del paciente:<br><br>
			<span style=" font-weight:none">' . $INICIALES_PACIENTE . '</span>
		</th>
	</tr>
	<tr>
		<th>
			Sexo:<br><br>
			<span style=" font-weight:none">' . $SEXO . '</span>
		</th>
		<th>
			Peso - Talla:<br><br>
			<span style=" font-weight:none">' . $PESO . '</span> - <span style=" font-weight:none">' . $TALLA . '</span>
		</th>
		<th colspan="2">
			Diagnostico principal y otros diagnosticos:<br><br>
			<span style=" font-weight:none">' . $DIAGNOSTICO_PRINCIPAL . '</span>
		</th>
	</tr>
	<tr>
		<th class="titulos" colspan="4">
			3. INFORMACION DE LOS MEDICAMENTOS
			<P>Registre todos los medicamentos utilizados y marque con una <span style="color:#000">(S)</span> el (los) sospechoso(s), con una <span style="color:#000">(C)</span> el (los) concomitantes y con una <span style="color:#000">(I)</span> las interacciones. </P>
		</th>
	</tr>
	<tr>
		<th>S/C/I</th>
		<th><span style=" font-weight:none">' . $SCI1 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $SCI2 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $SCI3 . '</span> <br></th>
	</tr>
	<tr>
		<th>Medicamento
			<p>(Denominacion Comun Internacional o Nombre generico)</p>
		</th>
		<th><span style=" font-weight:none">' . $MEDICAMENTO1 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $MEDICAMENTO2 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $MEDICAMENTO3 . '</span> <br></th>
	</tr>
	<tr>
		<th>Indicacion</th>
		<th><span style=" font-weight:none">' . $INDICACION1 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $INDICACION2 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $INDICACION3 . '</span> <br></th>
	</tr>
	<tr>
		<th>Dosis</th>
		<th><span style=" font-weight:none">' . $DOSIS1 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $DOSIS2 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $DOSIS3 . '</span> <br></th>
	</tr>
	<tr>
		<th>Unidad de medida</th>
		<th><span style=" font-weight:none">' . $UNIDAD_MEDIDA1 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $UNIDAD_MEDIDA2 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $UNIDAD_MEDIDA3 . '</span> <br></th>
	</tr>
	<tr>
		<th>VIa de administracion</th>
		<th><span style=" font-weight:none">' . $VIA_ADMINISTRACION1 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $VIA_ADMINISTRACION2 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $VIA_ADMINISTRACION3 . '</span> <br></th>
	</tr>
	<tr>
		<th>Frecuencia de administracion</th>
		<th><span style=" font-weight:none">' . $FRECUENCIA_ADMINISTRACION1 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $FRECUENCIA_ADMINISTRACION2 . '</span> <br></th>
		<th><span style=" font-weight:none">' . $FRECUENCIA_ADMINISTRACION3 . '</span> <br></th>
	</tr>
	<tr>
		<th>
			Fecha inicio<br />
		</th>
		<th>
			<span style=" font-weight:none">' . $FECHA_INICIO1 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $FECHA_INICIO2 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $FECHA_INICIO3 . '</span> <br>
		</th>
	</tr>
	<tr>
		<th>
			Fecha de finalizacion<br />
		</th>
		<th>
			<span style=" font-weight:none">' . $FECHA_FIN1 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $FECHA_FIN2 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $FECHA_FIN3 . '</span> <br>
		</th>
	</tr>
	<tr>
		<th class="titulos" colspan="4">
			4. INFORMACION DEL EVENTO ADVERSO
		</th>
	</tr>
	<tr>
		<th colspan="2">
			Fecha de Inicio del Evento Adverso:<br><br>
			<span style=" font-weight:none">' . $FECHA_INICIO_EVENTO . '</span> <br>
		</th>
		<th colspan="2">
			Evento adverso:<br><br>
			<span style=" font-weight:none">' . $EVENTO_ADVERSO . '</span> <br>
		</th>
	</tr>
	<tr>
		<th colspan="2">
			Descripcion y analisis del Evento Adverso:<br><br>
			<span style=" font-weight:none">' . $DESCRIPCION_ANALISIS_EVENTO . '</span> <br>
		</th>
		<th>
			Desenlace del evento (Marcar con una X):<br><br>
			<div style="text-align: left;">
				<span style=" font-weight:none">' . $DESENLACE_EVENTO . '</span> <br>
			</div>
		</th>
		<th>
			Seriedad (Marcar con X):<br><br>
			<div style="text-align: left;">
				<span style=" font-weight:none">' . $SERIEDAD . '</span> <span style=" font-weight:none">' . $FECHA_MUERTE . '</span><br>
			</div>
		</th>
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
		<th>
			<span style=" font-weight:none">' . $PREGUNTA1 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA2 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA3 . '</span> <br>
		</th>
	</tr>
	<tr>
		<th style="text-align: left;">
			Existen otros factores que puedan explicar el evento (medicamento, patologIas, etc.) <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA4 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA5 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA6 . '</span> <br>
		</th>
	</tr>
	<tr>
		<th style="text-align: left;">
			El evento desaparecio al disminuir o suspender el medicamento sospechoso <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA7 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA8 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA9 . '</span> <br>
		</th>
	</tr>
	<tr>
		<th style="text-align: left;">
			El paciente ya habIa presentado la misma reaccion al medicamento sospechoso <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA10 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA11 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA12 . '</span> <br>
		</th>
	</tr>
	<tr>
		<th style="text-align: left;">
			Se puede ampliar la informacion del paciente relacionando con el evento <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA13 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA14 . '</span> <br>
		</th>
		<th>
			<span style=" font-weight:none">' . $PREGUNTA15 . '</span> <br>
		</th>
	</tr>
</table>';
$codigoHTML = utf8_encode($codigoHTML);
$dompdf = new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit", "128M");
$dompdf->render();
$output = $dompdf->output();
file_put_contents('../presentacion/PDF/Evento_Adverso_' . $ID_EVENTO_ADVERSO . '.pdf', $output);
if ($COMPANIA == "GRUPO ASEI") {
	include("../presentacion/email/mail_asei.php");
} else {
	include("../presentacion/email/mail.php");
}
