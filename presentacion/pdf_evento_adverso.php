<?php
//include("../logica/session.php");
require('../datos/parse_str.php');
require_once("../dompdf/dompdf_config.inc.php");
require("../datos/conex.php");
$ID_EVENTO_ADVERSO = $ID_EA;
include("../logica/consulta_pdf_ea.php");
$codigoHTML = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.letra
{
	font-family: Tahoma, Geneva, sans-serif;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>IPSEN</title>
</head>
<body>
<table style="width:100%; border:1px solid #000;" rules="all" class="letra">
	<tr>
    	<th colspan="4" style="background-color:#ececec; padding:5px">
        	Informaci&oacute;n General
        </th>
    </tr>
    <tr>
    	<th colspan="2">
        	PSP / CRS(Producto)<span style="color:#ff0000;" >*</span>
			<br />
            <span style=" font-weight:none">' . $PRODUCTO . '</span>
        </th>
        <th>
        	Pa&iacute;s<span style="color:#ff0000;" >*</span>
			<br />
            <span style=" font-weight:none">' . $PAIS . '</span>
        </th>
        <th>
        	Ciudad<span style="color:#ff0000;" >*</span>
			<br />
            <span style=" font-weight:none">' . $CIUDAD . '</span>
        </th>
    </tr>
    <tr>
    	<th colspan="2">
        	Tipo de Reporte<span style="color:#ff0000;" >*</span>
			<br />
            <span style=" font-weight:none">' . $TIPO_REPORTE . '</span>
        </th>
        <th colspan="2">
        	Fecha cuando el staff del PSP recibe el AE/PTC/UI <span style="color:#ff0000;" >*</span>
			(aplica s&oacute;lo para PSP)
			<br />
            <span style=" font-weight:none">' . $FECHA_STAFF . '</span>
        </th>
    </tr>
    <tr>
    	<th style="background-color:#ececec; padding:5px" colspan="4">
        	Informaci&oacute;n paciente
        </th>
    </tr>
    <tr>
    	<th>
        	Identificaci&oacute;n  paciente <span style="color:#ff0000;" >*</span>
			<br />
			<span style=" font-weight:none">' . $IDENTIFICACION_PACIENTE_EA . '</span>
			<br />
			<br />
            <span >N&uacute;mero paciente</span>
			<br />
			' . "PAP" . $ID_PACIENTE_FK . '</span>
			<br />
			<br />
			<span >Nombre Completo</span>
			<br />
            <span style=" font-weight:none">' . $nombre . '</span>
        </th>
        <th>
        	G&eacute;nero<span style="color:#ff0000;" >*</span>
			<br />
            <span style=" font-weight:none">' . $GENERO . '</span>
		</th>
        <th>
        	Fecha nacimiento
			<br />
            <span style=" font-weight:none">' . $FECHA_NACIMIENTO . '</span>
        </th>
        <th>
        	<span >Para ser diligenciado en caso que paciente sea femenino</span>
			<br />
			Embarazo?
			<br />
			<span style=" font-weight:none">' . $EMBARAZO . '</span>
            <br />
            <br />
            <span >Si es s&iacute;: </span>
			<br />
			Fecha esperada de parto:
			<br />
			<span style=" font-weight:none">' . $FECHA_PARTO . '</span>
			<br />
			<br />
			Desenlace:<br />
			<span style=" font-weight:none">' . $DESENLACE . '</span>
			<br />
			<br />
   			<span >Other - specify:</span>
			<br />
			<span style=" font-weight:none">' . $CUALES_DESENLACES . '</span>
        </th>
    </tr>
    <tr>
    	<th colspan="2" style="text-align:left;" rowspan="4">
			Paciente permite contacto directo de la compa&ntilde;ia con su m&eacute;dico?
			<br />
			<br />
			<span style=" font-weight:none">' . $CONTACTO_DIRECTO . '</span>
		    <br />
		    <br />
			Si lo permite, por favor informe los detalles de contacto de su m&eacute;dico
			<br />
        </th>
        <th colspan="2" style="text-align:left;">
            <span >Nombre m&eacute;dico:</span>
            <span style=" font-weight:none">' . $NOMBRE_MEDICO . '</span>
            <br />
        </th>
    </tr>
    <tr>
    	<th colspan="2" style="text-align:left;">
        	<span >Tel&eacute;fono:</span>
        	<span style=" font-weight:none">' . $TELEFONO_MEDICO . '</span>
            <br />
        </th>
    </tr>
     <tr>
    	<th colspan="2" style="text-align:left;">
            <span >Fax:</span>
            <span style=" font-weight:none">' . $FAX_MEDICO . '</span>
            <br />
        </th>
    </tr>
     <tr>
    	<th colspan="2" style="text-align:left;">
            <span >Correo electr&oacute;nico:</span>
            <span style=" font-weight:none">' . $EMAIL_MEDICO . '</span>
			<br />
        </th>
    </tr>
    <tr>
    	<th colspan="4">
        	Informaci&oacute;n producto m&eacute;dico sospechoso Bayer (medicamento/dispositivo m&eacute;dico/ cosm&eacute;tico/ suplemento) <span style="color:#ff0000;" >*</span>
        </th>
    </tr>
    <tr>
    	<th>Nombre comercial / Gen&eacute;rico <span style="color:#ff0000;" >*</span></th>
        <th>1.&nbsp;<span style=" font-weight:none">' . $MEDICAMENTO1 . '</span></th>
        <th>2.&nbsp;<span style=" font-weight:none">' . $MEDICAMENTO2 . '</span></th>
        <th>3.&nbsp;<span style=" font-weight:none">' . $MEDICAMENTO3 . '</span></th>
    </tr>
    <tr>
    	<th>Indicaci&oacute;n</th>
        <th><span style=" font-weight:none">' . $INDICACION1 . '</span></th>
        <th><span style=" font-weight:none">' . $INDICACION2 . '</span></th>
        <th><span style=" font-weight:none">' . $INDICACION3 . '</span></th>
    </tr>
    <tr>
    	<th>Formulaci&oacute;n</th>
        <th><span style=" font-weight:none">' . $FORMULACION1 . '</span></th>
        <th><span style=" font-weight:none">' . $FORMULACION2 . '</span></th>
        <th><span style=" font-weight:none">' . $FORMULACION3 . '</span></th>
    </tr>
    <tr>
    	<th>R&eacute;gimen de dosis</th>
        <th><span style=" font-weight:none">' . $REGIMEN_DOSIS1 . '</span></th>
        <th><span style=" font-weight:none">' . $REGIMEN_DOSIS2 . '</span></th>
        <th><span style=" font-weight:none">' . $REGIMEN_DOSIS3 . '</span></th>
    </tr>
    <tr>
    	<th>Ruta de administraci&oacute;n</th>
        <th><span style=" font-weight:none">' . $RUTA_ADMINISTRACION1 . '</span></th>
        <th><span style=" font-weight:none">' . $RUTA_ADMINISTRACION2 . '</span></th>
        <th><span style=" font-weight:none">' . $RUTA_ADMINISTRACION3 . '</span></th>
    </tr>
    <tr>
    	<th>N&uacute;mero de lote <span style="color:#ff0000;" >*</span></th>
        <th><span style=" font-weight:none">' . $NUMERO_LOTE1 . '</span></th>
        <th><span style=" font-weight:none">' . $NUMERO_LOTE2 . '</span></th>
        <th><span style=" font-weight:none">' . $NUMERO_LOTE3 . '</span></th>
    </tr>
    <tr>
    	<th>Fecha de expiraci&oacute;n</th>
        <th><span style=" font-weight:none">' . $FECHA_EXPIRACION1 . '</span></th>
        <th><span style=" font-weight:none">' . $FECHA_EXPIRACION2 . '</span></th>
        <th><span style=" font-weight:none">' . $FECHA_EXPIRACION3 . '</span></th>
    </tr>
    <tr>
    	<th>
        	Fecha inicio <span style="color:#ff0000;" >*</span><br />
            <span >(dd/mmm/aaaa)</span>
        </th>
        <th>
        	<span style=" font-weight:none">' . $FECHA_INICIO1 . '</span>
        </th>
        <th>
        	<span style=" font-weight:none">' . $FECHA_INICIO2 . '</span>
        </th>
        <th>
        	<span style=" font-weight:none">' . $FECHA_INICIO3 . '</span>
        </th>
    </tr>
    <tr>
    	<th>
        	Tratamiento contin&uacute;o? <span style="color:#ff0000;" >*</span>
			<br />
        </th>
        <th>
        	<span style=" font-weight:none">' . $TRATAMIENTO_CONTINUA1 . '</span>
		   <br />
		   <span >Si es No, fecha de <br />suspensi&oacute;n:</span>
		   <br />
        	<span style=" font-weight:none">' . $FECHA_SUSPENCION1 . '</span>
        </th>
        <th>
        	<span style=" font-weight:none">' . $TRATAMIENTO_CONTINUA2 . '</span>
		   <br />
		   <span >Si es No, fecha de <br />suspensi&oacute;n:</span>
		   <br />
        	<span style=" font-weight:none">' . $FECHA_SUSPENCION2 . '</span>
        </th>
        <th>
        	<span style=" font-weight:none">' . $TRATAMIENTO_CONTINUA3 . '</span>
	   <br />
   <span >Si es No, fecha de<br /> suspensi&oacute;n:</span>
   <br />
        	<span style=" font-weight:none">' . $FECHA_SUSPENCION3 . '</span>
        </th>
    </tr>
    <tr>
    	<th>
        	En caso de PTC, esta la muestra disponible?
        </th>
        <th colspan="3" style="text-align:left;">  
        	<span style=" font-weight:none">' . $MUESTRA_DISPONIBLE . '</span>
   <br />
        	<span >En caso de S&iacute;, por favor indique informaci&oacute;n de contacto para recoger la muestra:</span><br />
			<span style=" font-weight:none">' . $INFORMACION_MUESTRA . '</span>
        </th>
    </tr>
	<tr>
    	<th style="background-color:#ececec; padding:5px" colspan="4">
        	Informaci&oacute;n de Evento Adverso / Reclamo T&eacute;cnico de Producto / Problemas de Uso 
        </th>
    </tr>
    <tr>
    	<th>AE / PTC / UI <span style="color:#ff0000;" >*</span></th>
        <th>1.&nbsp;<span style=" font-weight:none">' . $INFORMACION_EA1 . '</span></th>
        <th>2.&nbsp;<span style=" font-weight:none">' . $INFORMACION_EA2 . '</span></th>
        <th>3.&nbsp;<span style=" font-weight:none">' . $INFORMACION_EA3 . '</span></th>
    </tr>
    <tr>
    	<th>Relacionado al medicamento sospechoso (si aplica) **</th>
        <th>
            <span style=" font-weight:none">' . $RELACION_MEDICAMENTO1 . '</span>
            <br />
        </th>
        <th>
        	<span style=" font-weight:none">' . $RELACION_MEDICAMENTO2 . '</span>
            <br />
        </th>
        <th>
        	<span style=" font-weight:none">' . $RELACION_MEDICAMENTO3 . '</span>
            <br />
        </th>
    </tr>
    <tr>
    	<th>Relacionado al dispositivo sospechoso (si aplica) **</th>
        <th>
        	<span style=" font-weight:none">' . $RELACIONADO_DISPOSITIVO1 . '</span>
            <br />
        </th>
        <th>
        	<span style=" font-weight:none">' . $RELACIONADO_DISPOSITIVO2 . '</span>
            <br />
        </th>
        <th>
        	<span style=" font-weight:none">' . $RELACIONADO_DISPOSITIVO3 . '</span>
            <br />
        </th>
    </tr>
    <tr>
    	<th>Fecha de inicio del evento <span style="color:#ff0000;" >*</span>
			<br />
			<span >(dd/mmm/aaaa)</span>
		</th>
		<th><span style=" font-weight:none">' . $FECHA_INICIO_EVENTO1 . '</span></th>
		<th><span style=" font-weight:none">' . $FECHA_INICIO_EVENTO2 . '</span></th>
		<th><span style=" font-weight:none">' . $FECHA_INICIO_EVENTO3 . '</span></th>
    </tr>
    <tr>
    	<th>
			Desenlace <span style="color:#ff0000;" >*</span>
			<br />
			<span >(fecha en dd/mmm/aaaa)</span>
		</th>
        <th>
        	<span style=" font-weight:none">' . $DESENLACE1 . '</span>
			<br />
            <span >Fecha de recuperaci&oacute;n</span>
			<br />
            <span style=" font-weight:none">' . $FECHA_RECUPERACION1 . '</span>
			<br />
            <span >Fecha de la muerte </span>
			<br />
            <span style=" font-weight:none">' . $FECHA_MUERTE1 . '</span>
			<br />
        </th>
        <th>
        	<span style=" font-weight:none">' . $DESENLACE2 . '</span>
			<br />
            <span >Fecha de recuperaci&oacute;n</span>
			<br />
            <span style=" font-weight:none">' . $FECHA_RECUPERACION2 . '</span>
			<br />
            <span >Fecha de la muerte </span>
			<br />
            <span style=" font-weight:none">' . $FECHA_MUERTE2 . '</span>
			<br />
        </th>
        <th>
        	<span style=" font-weight:none">' . $DESENLACE3 . '</span>
			<br />
            <span >Fecha de recuperaci&oacute;n</span>
			<br />
            <span style=" font-weight:none">' . $FECHA_RECUPERACION3 . '</span>
			<br />
            <span >Fecha de la muerte </span>
			<br />
            <span style=" font-weight:none">' . $FECHA_MUERTE3 . '</span>
			<br />
        </th>
    </tr>
    <tr>
    	<th>
       		Criterio de seriedad del AE / PTC / UI  <span style="color:#ff0000;" >*</span>
    	</th>
        <th>
        	<span style=" font-weight:none">' . $CRITERIO_SERIEDAD1 . '</span>
			<br />
            Muerte? 
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_MUERTE1 . '</span>
			<br />
            <span > No reportado Hospitalizaci&oacute;n?</span>
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_HOSPITALIZACION1 . '</span>
			<br />
            Amenaza la vida?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_AMENAZA1 . '</span>
			<br />
            Incapacidad?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_INCAPACIDAD1 . '</span>
			<br />
            Anormalidad cong&eacute;nita?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_ANORMALIDAD1 . '</span>
			<br />
            Evento medico importante?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_EVENTO1 . '</span>
			<br />
            Intervenci&oacute;n m&eacute;dica o quir&uacute;rgica? (Dispositivo)
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_QUIRURGICA1 . '</span>
			<br />
			Causa de la muerte:
			<br />
			<span style=" font-weight:none">' . $CAUSA_MUERTE1 . '</span> 
        </th>
        <th>
        	<span style=" font-weight:none">' . $CRITERIO_SERIEDAD2 . '</span>
			<br />
            Muerte? 
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_MUERTE2 . '</span>
			<br />
            <span > No reportado Hospitalizaci&oacute;n?</span>
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_HOSPITALIZACION2 . '</span>
			<br />
            Amenaza la vida?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_AMENAZA2 . '</span>
			<br />
            Incapacidad?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_INCAPACIDAD2 . '</span>
			<br />
            Anormalidad cong&eacute;nita?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_ANORMALIDAD2 . '</span>
			<br />
            Evento medico importante?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_EVENTO2 . '</span>
			<br />
            Intervenci&oacute;n m&eacute;dica o quir&uacute;rgica? (Dispositivo)
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_QUIRURGICA2 . '</span>
			<br />
			Causa de la muerte:
			<br />
			<span style=" font-weight:none">' . $CAUSA_MUERTE2 . '</span>  
        </th>
        <th>
        	<span style=" font-weight:none">' . $CRITERIO_SERIEDAD3 . '</span>
			<br />
            Muerte? 
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_MUERTE3 . '</span>
			<br />
            <span > No reportado Hospitalizaci&oacute;n?</span>
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_HOSPITALIZACION3 . '</span>
			<br />
            Amenaza la vida?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_AMENAZA3 . '</span>
			<br />
            Incapacidad?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_INCAPACIDAD3 . '</span>
			<br />
            Anormalidad cong&eacute;nita?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_ANORMALIDAD3 . '</span>
			<br />
            Evento medico importante?
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_EVENTO3 . '</span>
			<br />
            Intervenci&oacute;n m&eacute;dica o quir&uacute;rgica? (Dispositivo)
			<br />
            <span style=" font-weight:none">' . $CRITERIO_SERIEDAD_QUIRURGICA3 . '</span>
			<br />
			Causa de la muerte:
			<br />
			<span style=" font-weight:none">' . $CAUSA_MUERTE3 . '</span> 
        </th>
    </tr>
    <tr>
    	<th>
       		Detalles del AE / PTC / UI  <span style="color:#ff0000;" >*</span>
    	</th>
        <th>
        	<span style=" font-weight:none">' . $DETALLES_EA1 . '</span> 
        </th>
        <th>
        	<span style=" font-weight:none">' . $DETALLES_EA2 . '</span> 
        </th>
        <th>
        	<span style=" font-weight:none">' . $DETALLES_EA3 . '</span> 
        </th>
    </tr>
    <tr>
    	<th style="background-color:#ececec; padding:5px" colspan="4">
			Informaci&oacute;n adicional (antecedentes m&eacute;dicos, explicaci&oacute;n alternativa, medicamentos concomitantes, datos de laboratorio, etc.)
        </th>
    </tr>
    <tr>
    	<th colspan="4">
        	<span style=" font-weight:none">' . $INFORMACION_ADICIONAL . '</span>
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
        </th>
    </tr>
<!--    <tr>
    	<th style="background-color:#ececec; padding:5px" colspan="4">
        	Reportante Primario
        </th>
    </tr>
    <tr>
    	<th align="left" colspan="1">
            Nombre:
		</th>
		<th align="left" colspan="3">
            <span style=" font-weight:none">' . $NOMBRE_REPORTANTE_PRIMARIO . '</span>
        </th>
    </tr>
    <tr>
        <th align="left" colspan="1">
			Direcci&oacute;n:
		</th>
		<th align="left" colspan="3">
		   <span style=" font-weight:none">' . $DIRECCION_PACIENTE . '</span>
		</th>
	</tr>
    <tr>  
		<th align="left" colspan="1">
			Ciudad:
		</th>
		<th align="left" colspan="3">
			<span style=" font-weight:none">' . $CIUDAD_PACIENTE . '</span>
        </th>
    </tr>
    <tr>
		<th align="left" colspan="1">
			Tel&eacute;fono / Fax:
		</th>
		<th align="left" colspan="3">
			<span style=" font-weight:none">' . $TELEFONO_REPORTANTE_PRIMARIO . '</span>
		</th>
    </tr>
    <tr>
		<th align="left" colspan="1">
			E-Mail:
		</th>
		<th align="left" colspan="3">
			<span style=" font-weight:none">' . $CORREO_PACIENTE . '</span>
		</th>
    </tr> -->
    <tr>
    	<th style="background-color:#ececec; padding:5px" colspan="4">
        	Informaci&oacute;n del Reportante (Staff PSP)<span style="color:#ff0000;" >*</span>
        </th>
    </tr>
    <tr>
    	<th align="left" colspan="1">
			Nombre:
		</th>
		<th align="left" colspan="3">
			<span style=" font-weight:none">' . $NOMBRE_REPORTE . '</span>
		</th>
    </tr>
    <tr>
		<th align="left" colspan="1">
			Compa&ntilde;ia:
		</th>
		<th align="left" colspan="3">
			<span style=" font-weight:none">' . $COMPANIA . '</span>
		</th>
    </tr>
    <tr>
		<th align="left" colspan="1">
			Direcci&oacute;n:
		</th>
		<th align="left" colspan="3">
			<span style=" font-weight:none">' . $DIRECCION_COMPANIA . '</span>
		</th>
    </tr>
	<tr>
		<th align="left" colspan="1">
			Tel&eacute;fono:
		</th>
		<th align="left" colspan="3">
			<span style=" font-weight:none">' . $TELEFONO_COMPANIA . '</span>
		</th>
	</tr>
	<tr>
		<th align="left" colspan="1">
			E-Mail:
		</th>
		<th align="left" colspan="3">
			<span style=" font-weight:none">reportes_ea@encontactopeoplemarketing.com</span>
			<br />
		</th>
	</tr>
	<tr>
		<th align="left" colspan="1">
			Tipo de Reportante:
		</th>
		<th align="left" colspan="3">
			<span style=" font-weight:none">' . $TIPO_REPORTANTE . '</span>
			<br />
		</th>
	</tr>
	<tr>
		<th align="left">
			<span style=" font-weight:none">PVCH LOCAL: Juan S Franco, MD</span>
		</th>
		<th align="left">
			Telefono:
			<br />
			<span style=" font-weight:bold">571 4234607</span>
			<br />
			<span style=" font-weight:bold">57 3182821316</span>
			<br />
		</th>
		<th align="left" colspan="2">
			E-Mail:
			<br />
			<span style=" font-weight:bold;color:#00F"><u>farmacovigilancia.colombia@bayer.com</u></span>
			<br />
		</th>
	</tr>
</table>
</body>
</html>';
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
