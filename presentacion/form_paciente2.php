<?php
	include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IPSEN</title>
<link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
<script src="css/SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="css/SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/calcular_edad.js"></script>
<script type="text/javascript" src="js/direccion.js"></script>
<script type="text/javascript" src="js/validar_campos_pacientes.js"></script>
<script type="text/javascript" src="js/validaciones.js"></script>
<script type="text/javascript" src="js/validar_caracteres.js"></script>
<script src="../presentacion/js/jquery.js"></script>
<script language=javascript> 
function ventanaSecundaria (URL)
{ 
   window.open(URL,"ventana1","width=1300,height=500,Top=150,Left=50%") 
} 

</script> 

<style>
td
{
	padding: 3px;
	background-color:transparent;
}
</style>
<script type="text/javascript">
function status()
{
	var REFERENCIA=$('#MEDICAMENTO').val();
	var STATUS=$('#status_paciente').val();
	$.ajax(
	{
		url:'../presentacion/listado_producto_status_cargar.php',
		data:
		{
			REFERENCIA: REFERENCIA,
			STATUS: STATUS
		},
		type: 'post',
		beforeSend: function () 
		{
			$("#status_paciente").attr('disabled', 'disabled');
		},
		success: function(data)
		{
			$("#status_paciente").removeAttr('disabled');
			$('#status_paciente').html(data);
		}
	})
}
function mostrar_ciudades()
{
	var departamento=$('#departamento').val();	
	$("#ciudad").html('<img src="imgagenes/cargando.gif" />');
	$.ajax(
	{
		url:'../presentacion/ciudades.php',
		data:
		{
			dep: departamento,
		},
		type: 'post',
		beforeSend: function () 
		{
				$("#ciudad").html("Procesando, espere por favor"+'<img src="img/cargando.gif" />');
		},
		success: function(data)
		{
			$('#ciudad').html(data);
		}
	}
	)
}

function mostrar_producto()
{
	var ID_PRODUCTO=$('#tipo_envio').val();	
	$.ajax(
	{
		url:'../presentacion/mostrar_nombre_producto.php',
		data:
		{
			ID_PRODUCTO: ID_PRODUCTO,
		},
		type: 'post',
		beforeSend: function () 
		{
			$('#div_agregar').css('visibility','hidden');
		},
		success: function(data)
		{
			$('#nombre_producto').html(data);
			
			var nom=$('#nombre_producto').val();
			//alert(nom);
			if(nom=='Kit de bienvenida'||nom=='')
			{
				$('#div_agregar').css('visibility','hidden');
			}
			else
			{
				$('#div_agregar').css('visibility','visible');
			}
		}
	}
	)
}
//AGREGAR PRODUCTO
function agregar_producto()
{
	var ID_PRODUCTO=$('#tipo_envio').val();
	var ID_PACIENTE=$('#codigo_usuario2').val();
	var NOMBRE_PRODUCTO=$('#nombre_producto').val();
	$.ajax(
	{
		url:'../presentacion/ingresar_productos_temporal.php',
		data:
		{
			ID_PRODUCTO: ID_PRODUCTO,
			ID_PACIENTE: ID_PACIENTE,
			NOMBRE_PRODUCTO:NOMBRE_PRODUCTO
		},
		type: 'post',
		beforeSend: function () 
		{
			$('#tabla_material_agregar').css('visibility','visible');
				$("#tabla_material_agregar").html("Procesando, espere por favor"+'<img src="imagenes/cargando.gif" />');
		},
		success: function(data)
		{
			
			//$('#div_tabla_productos').html('');
			
			$('#tabla_material_agregar').html(data);
		}
	}
	)
}
/*ASEGURADOR*/
function asegurador()
{
	var DEPT=$('#departamento').val();
	
	$.ajax(
	{
		url:'../presentacion/listado_asegurador.php',
		data:
		{
			DEPT: DEPT
		},
		type: 'post',
		beforeSend: function () 
		{
			$("#asegurador").attr('disabled', 'disabled');
			$('#operador_logistico').html('');
			$("#operador_logistico").attr('disabled', 'disabled');
		},
		success: function(data)
		{
			$("#asegurador").removeAttr('disabled');
			$('#asegurador').html(data);
		}
	})
}
/*OPERADOR*/
function operador()
{
	var DEPT=$('#departamento').val();
	var asegurador=$('#asegurador').val();
	$.ajax(
	{
		url:'../presentacion/listado_operador_logistico.php',
		data:
		{
			DEPT: DEPT,
			asegurador: asegurador
		},
		type: 'post',
		beforeSend: function () 
		{
			$("#operador_logistico").attr('disabled', 'disabled');
		},
		success: function(data)
		{
			$("#operador_logistico").removeAttr('disabled');
			$('#operador_logistico').html(data);
		}
	})
}
</script>
<script>
/*DIRECCION*/
$(document).ready(function()
{
	$("input[name=evento_adverso]").change(function()
	{
		$("input[name=tipo_evento_adverso]").prop("checked", false); 
		$('#tipo_evento_adverso').prop("checked", true); 
		
		var evento_adverso=$('#evento_adverso:checked').val();
		if(evento_adverso=='SI')
		{
			$('#envio_evento_adverso_span').css('display','inline');
			$('#envio_evento_adverso_div').css('display','inline');
			
		}
		if(evento_adverso!='SI')
		{
			$('#envio_evento_adverso_span').css('display','none');
			$('#envio_evento_adverso_div').css('display','none');
		}

	});
	
	$("#medico").change(function()
	{
		$("#medico_nuevo").val('');
		
		var medico=$('#medico').val();
		if(medico=='Otro')
		{
			$('#medico_nuevo').css('display','inline-block');
			$('#cual_medico').css('display','inline-block');
		}
		if(medico!='Otro')
		{
			$('#medico_nuevo').css('display','none');
			$('#cual_medico').css('display','none');
		}

	});
	
	function mostrar_nebu()
	{	
		$("#nebulizaciones").val('');
		var MEDICAMENTO=$('#MEDICAMENTO').val();
		if(MEDICAMENTO=='VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM')
		{
			$('#span_nebulizaciones').css('display','inline-block');
			$('#div_nebulizaciones').css('display','inline-block');
		}
		if(MEDICAMENTO!='VENTAVIS 10 1SOL/2ML X30AMP(Conse) MM')
		{
			$('#span_nebulizaciones').css('display','none');
			$('#div_nebulizaciones').css('display','none');
		}
	}
	mostrar_nebu();
	
	$('#cambio').click(function()
	{
		$('#cambio_direccion').toggle();
		$('#DIRECCION').val('');		
		$("#VIA option:eq(0)").attr("selected", "selected");
		$("#interior option:eq(0)").attr("selected", "selected");
		$("#interior2 option:eq(0)").attr("selected", "selected");
		$("#interior3 option:eq(0)").attr("selected", "selected");
		$("#TERAPIA option:eq(0)").attr("selected", "selected");
		$('#detalle_via').val('');
		$('#detalle_int').val('');
		$('#detalle_int2').val('');
		$('#detalle_int3').val('');
		$('#numero').val('');
		$('#numero2').val('');

	});
	var via=$('#VIA').val();
	var dt_via=$('#detalle_via').val();
	$('#VIA').change(function()
	{
		dir();
	});
	
	$('#detalle_via').change(function()
	{
		dir();
	});
	$('#numero').change(function()
	{
		dir();
	});
	$('#numero2').change(function()
	{
		dir();
	});
	$('#interior').change(function()
	{
		dir();		
	});
	$('#detalle_int').change(function()
	{
		dir();
	});
	$('#interior2').change(function()
	{
		dir();		
	});
	$('#detalle_int2').change(function()
	{
		dir();
	});
	$('#interior3').change(function()
	{
		dir();		
	});
	$('#detalle_int3').change(function()
	{
		dir();
	});
});
/*FIN DIRECCIOn*/
$(document).ready(function()
{
	status();
	var fecha=$('input[name=fecha_nacimiento]').val();
	if(fecha!='')
	{
		var edad=nacio(fecha);
		$("#edad").val(edad);
	}
	$("input[name=fecha_nacimiento]").change(function()
	{
		var fecha=$('input[name=fecha_nacimiento]').val();
		var edad=nacio(fecha);
		$("#edad").val(edad);
	});
	function reclamo()
	{
		$("#causa_no_reclamacion option:eq(0)").attr("selected", "selected");
		$("#fecha_reclamacion").val('');
		
		var reclamo=$('#reclamo').val();
		//alert(reclamo);
		var MEDICAMENTO=$('#MEDICAMENTO').val();
		if(reclamo=='')
		{
			$("#causa").css('display','none');
			$('#causa_no_reclamacion').css('display','none');
			
			$("#fecha_reclamacion_span").css('display','none');
			$('#fecha_reclamacion').css('display','none');
			
			$("#consecutivo_betaferon_span").css('display','none');
			$('#consecutivo_betaferon').css('display','none');
			
			$('#numero_cajas option:eq(0)').attr('selected','selected');
			$('#tipo_numero_cajas option:eq(0)').attr('selected','selected');
			
			$('#numero_cajas').attr('disabled','disabled');
			$('#tipo_numero_cajas').attr('disabled','disabled');
			
			$('#span_tabletas_diarias').css('display','none');
			$('#div_tabletas_diarias').css('display','none');
		}
		if(reclamo=='NO')
		{
			$("#causa").css('display','block');
			$('#causa_no_reclamacion').css('display','block');
			
			$("#fecha_reclamacion_span").css('display','none');
			$('#fecha_reclamacion').css('display','none');
			
			$("#consecutivo_betaferon_span").css('display','none');
			$('#consecutivo_betaferon').css('display','none');
			
			$('#numero_cajas option:eq(0)').attr('selected','selected');
			$('#tipo_numero_cajas option:eq(0)').attr('selected','selected');
			$('#causa_no_reclamacion option:eq(1)').attr('selected','selected');
			
			$('#numero_cajas').attr('disabled','disabled');
			$('#tipo_numero_cajas').attr('disabled','disabled');
			
			$('#span_tabletas_diarias').css('display','none');
			$('#div_tabletas_diarias').css('display','none');
			
		}
		if(reclamo=='SI'&& MEDICAMENTO=='BETAFERON CMBP X 15 VPFS (3750 MCG) MM')
		{
			$("#fecha_reclamacion").val($('#fecha_reclamacion').prop('defaultValue'));
			$("#consecutivo").val($('#consecutivo').prop('defaultValue'));
			$("#consecutivo_betaferon_span").css('display','block');
			$('#consecutivo_betaferon').css('display','block');
			
			$("#fecha_reclamacion_span").css('display','block');
			$('#fecha_reclamacion').css('display','block');
			
			$("#causa").css('display','none');
			$('#causa_no_reclamacion').css('display','none');
			$('#numero_cajas').removeAttr('disabled');
			$('#tipo_numero_cajas').removeAttr('disabled');
			
			$('#span_tabletas_diarias').css('display','none');
			$('#div_tabletas_diarias').css('display','none');
		}
		else
		{
			if(reclamo=='SI')
			{
				$("#fecha_reclamacion_span").css('display','block');
				$('#fecha_reclamacion').css('display','block');
				
				$("#causa").css('display','none');
				$('#causa_no_reclamacion').css('display','none');
				$('#numero_cajas').removeAttr('disabled');
				$('#tipo_numero_cajas').removeAttr('disabled');
				$("#fecha_reclamacion").val($('#fecha_reclamacion').prop('defaultValue'));
				
				$("#numero_tabletas_diarias").val('');
				var MEDICAMENTO=$('#MEDICAMENTO').val();
				if(MEDICAMENTO=='NEXAVAR 200MGX60C(12000MG)INST'||MEDICAMENTO=='ADEMPAS'||MEDICAMENTO=='ADEMPAS 0.5MG 42TABL'||MEDICAMENTO=='ADEMPAS 1.5MG 42TABL'||MEDICAMENTO=='ADEMPAS 1MG 42TABL'||MEDICAMENTO=='ADEMPAS 2.5MG 84TABL'||MEDICAMENTO=='ADEMPAS 2MG 42TABL')
				{
					$('#span_tabletas_diarias').css('display','inline-block');
					$('#div_tabletas_diarias').css('display','inline-block');
				}
				if(MEDICAMENTO!='NEXAVAR 200MGX60C(12000MG)INST'&&MEDICAMENTO!='ADEMPAS'&&MEDICAMENTO!='ADEMPAS 0.5MG 42TABL'&&MEDICAMENTO!='ADEMPAS 1.5MG 42TABL'&&MEDICAMENTO!='ADEMPAS 1MG 42TABL'&&MEDICAMENTO!='ADEMPAS 2.5MG 84TABL'&&MEDICAMENTO!='ADEMPAS 2MG 42TABL')
				{
					$('#span_tabletas_diarias').css('display','none');
					$('#div_tabletas_diarias').css('display','none');
				}
			}
		}
	}
	reclamo();
	$("#reclamo").change(function()
	{
		reclamo();
	});
	$("#departamento").change(function()
	{
		asegurador();
	});
	$("#asegurador").change(function()
	{
		operador();
	});
	
	$("#operador_logistico").change(function()
	{
		$("#operador_logistico_nuevo").val('');
		
		var operador_logistico=$('#operador_logistico').val();
		if(operador_logistico=='Otro')
		{
			$('#operador_logistico_nuevo').css('display','inline-block');
			$('#cual_operador').css('display','inline-block');
			
		}
		if(operador_logistico!='Otro')
		{
			$('#operador_logistico_nuevo').css('display','none');
			$('#cual_operador').css('display','none');
		}

	});
	$("#tipo_envio").change(function()
	{
		mostrar_producto();
	});
	$("#agregar_seg").click(function()
	{
		$('#div_material_agregar').css('display','block');
		//$("#tipo_envio option:eq(0)").attr("selected", "selected");
		$('#div_agregar').css('visibility','hidden');
	});
	
	$("input[name=logro_comunicacion]").change(function()
	{
		var LOGRO_COMUNICACION=$('input:radio[name=logro_comunicacion]:checked').val();
		//alert(LOGRO_COMUNICACION);
		$('#motivo_comunicacion option:eq(0)').attr('selected','selected');
		$('#motivo_no_comunicacion option:eq(0)').attr('selected','selected');
		if(LOGRO_COMUNICACION=='SI')
		{	
			$('#motivo_no_comunicacion').attr("disabled","disabled");
			$('#motivo_comunicacion').removeAttr("disabled","disabled");
		}
		if(LOGRO_COMUNICACION=='NO')
		{	
			$('#motivo_comunicacion').attr("disabled","disabled");
			$('#motivo_no_comunicacion').removeAttr("disabled","disabled");
		}
	});
	$("#agregar_seg").click(function()
	{
		$('#div_material_agregar').css('display','block');
		//$("#tipo_envio option:eq(0)").attr("selected", "selected");
		$('#div_agregar').css('visibility','hidden');
	});
});
</script>
</head>
<?php
require('../datos/parse_str.php');

require('../datos/conex.php');

$ID_PACIENTE=base64_decode($artid);
$ID_GESTION=base64_decode($artge);

include('../logica/consulta_paciente.php');
$DIAS_ANTES= date('Y-m-d', strtotime('-31 day')) ; // resta 7 día
if($privilegios!=''&&$usua!='')
{
?>
<body class="body" style="width:80.9%;margin-left:12%;">
<form id="seguimiento" name="seguimiento" method="post" action="../logica/actualizar_seguimiento.php" onkeydown="return filtro(2)" enctype="multipart/form-data" class="letra">
<div id="Accordion1" class="Accordion" tabindex="0" style="height:100%;">

  <div class="AccordionPanel">
    <div class="AccordionPanelTab">PACIENTE</div>
    <div class="AccordionPanelContent">
<table width="100%" border="0">
 <?php  
		$Seleccion = mysqli_query($conex, "SELECT * FROM `bayer_pacientes` AS P
		INNER JOIN bayer_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
		WHERE ID_PACIENTE = '".$ID_PACIENTE."'");			
		while($fila=mysqli_fetch_array($Seleccion))
			{
				$ID_PACIENTE2 = $fila['ID_PACIENTE'];
				$ID_PA = $fila['ID_PACIENTE'];
				function Zeros($numero, $largo) 
				{ 
				$resultado = $numero;
				while(strlen($resultado) < $largo) 
				{ 
				$resultado = "0".$resultado;  
				} 
				return $resultado;
				} 
				$ID_PACIENTE = Zeros($ID_PA, 5);
  	?>
  <tr>
  	<td width="20%">
	<span>Codigo de Usuario</span>
<?php
if($fila['PRODUCTO_TRATAMIENTO']=='Xofigo 1x6 ml CO')
{
?>
    <br />
    <span>Codigo Xofigo</span>
<?php
}
?>
    </td>
    <td width="30%">
    <input name="codigo_gestion" type="text" id="codigo_gestion" max="10" readonly="readonly" value="<?php echo $ID_GESTION; ?>" style="display:none"/>
    <input name="codigo_usuario" type="text" id="codigo_usuario" max="10" readonly="readonly"  value="<?php echo 'PAP'.$ID_PACIENTE; ?>"/>
<?php
if($fila['PRODUCTO_TRATAMIENTO']=='Xofigo 1x6 ml CO')
{
?>
<br />
    <input name="codigo_xofigo" type="text" id="codigo_xofigo" max="10" readonly="readonly"  value="<?php echo 'X'.$fila['CODIGO_XOFIGO']; ?>"/>
<?php
}
?>
    <input name="codigo_usuario2" type="text" id="codigo_usuario2" max="10" readonly="readonly" value="<?php echo $fila['ID_PACIENTE'];?>" style="display:none"/>            
    </td>
    <td width="20%">
	    <span>Estado del Paciente<span class="asterisco">*</span></span>
    </td>
    <td width="30%">
<?php
	if($privilegios==1)
	{
?>
		    <select type="text" name="estado_paciente" id="estado_paciente" >
    	<option><?php echo $fila['ESTADO_PACIENTE'];?></option>
        <option>Abandono</option>
        <option>Activo</option>
        <option>En servicio</option>
        <option>Fase 2</option>
        <option>Interrumpido</option>
        <option>Proceso</option>
        <option>Suspendido</option>
 	</select>
<?php
	}
	else
	{
?>
		<input name="estado_paciente" type="text" id="estado_paciente"readonly="readonly" value="<?php echo $fila['ESTADO_PACIENTE'];?>"/>
        
<?php
	}
?>
    </td>
    </tr>    
    <tr>
  	<td width="20%">
<span>Fecha de Activacion<span class="asterisco">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </td>
    <td width="30%">
<input type="date" name="fecha_activacion" id="fecha_activacion" value="<?php echo $fila['FECHA_ACTIVACION_PACIENTE'];?>" readonly="readonly"/>
    </td>
    <td width="20%">
<span>Solicitar cambio de estado Paciente</span>
    </td>
    <td width="30%">
  <select type="text" name="cambio_estado_paciente" id="cambio_estado_paciente" >
    	<option>No</option>
        <option>Abandono</option>
        <option>Activo</option>
        <option>En servicio</option>
        <option>Fase 2</option>
        <option>Interrumpido</option>
        <option>Proceso</option>
        <option>Suspendido</option>
 	</select>
    </td>
    <tr>
        <td width="20%">
        	<span>Fecha de Retiro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <td width="30%">
        	<input type="date" name="fecha_retiro" id="fecha_retiro" max="10" value="<?php echo $fila['FECHA_RETIRO_PACIENTE'];?>"/>
        </td>
        <td width="20%">
        	<span>Motivo de Retiro</span>
        </td>
        <td>
            <select type="text" name="motivo_retiro" id="motivo_retiro">
                <option><?php echo $fila['MOTIVO_RETIRO_PACIENTE'];?></option>
                <option>Embarazo</option>
                <option>Evento adverso</option>
                <option>Falta de contacto</option>
                <option>Fuera del pais</option>
                <option>Muerte</option>
                <option>No interesado</option>
                <option>Off label</option>
                <option>Orden medica</option>
                <option>Otro</option>
                <option>Progresion de da enfermedad</option>
                <option>Terminacion del tratamiento</option>
                <option>Voluntario</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <span>Observaciones Motivo de Retiro</span>
        </td>
        <td colspan="3">
        	<textarea name="observacion_retiro" id="observacion_retiro" style="width:98%; height:100px"><?php echo $fila['OBSERVACION_MOTIVO_RETIRO_PACIENTE'];?></textarea>
        </td>
    </tr>
  <tr>
  <td>
  <span>Nombre<span class="asterisco">*</span></span>
  </td>  
  <td>
  <input type="text" name="nombre" id="nombre" value="<?php echo $fila['NOMBRE_PACIENTE'];?>" readonly="readonly"/>
  </td>
  <td>
  <span>Apellidos<span class="asterisco">*</span></span>
  </td>
  <td>
  <input type="text" name="apellidos" id="apellidos" value="<?php echo $fila['APELLIDO_PACIENTE'];?>" readonly="readonly"/> 
  </td>
  </tr>
     
  <tr>
  <td>
  <span>Identificacion<span class="asterisco">*</span></span>
  </td>  
  <td>
  <input type="text" name="identificacion" id="identificacion" value="<?php echo $fila['IDENTIFICACION_PACIENTE'];?>" readonly="readonly"/>
  </td>
  <td>
  <span>Telefono 1<span class="asterisco">*</span></span>
  </td>
  <td>
  <input type="text" name="telefono1" id="telefono1" value="<?php echo $fila['TELEFONO_PACIENTE'];?>"/> 
  </td>
  </tr>
  
  <tr>
  <td>
  <span>Telefono 2</span>
  </td>  
  <td>
  <input type="text" name="telefono2" id="telefono2" value="<?php echo $fila['TELEFONO2_PACIENTE'];?>"/>  
  </td>
  <td>
  <span>Telefono 3</span>
  </td>
  <td>
  <input type="text" name="telefono3" id="telefono3" value="<?php echo $fila['TELEFONO3_PACIENTE'];?>"/> 
  </td>
  </tr>	
  
  <tr>
      <td>
      	<span>Correo Electronico</span>
      </td>  
      <td>
      	<input type="text" name="correo" id="correo" value="<?php echo $fila['CORREO_PACIENTE'];?>"/>
      </td>
      <td>
  <span>Departamento<span class="asterisco">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
  </td>
      <td>
        <select type="text" name="departamento" id="departamento" onchange = "mostrar_ciudades()">
        <option><?php echo $fila['DEPARTAMENTO_PACIENTE'];?></option>
        <?php
		$DEPT=$fila['DEPARTAMENTO_PACIENTE'];
        $Seleccionar = mysqli_query($conex, "SELECT nombre FROM `bayer_departamento` WHERE nombre != '' AND nombre != '$DEPT' ORDER BY nombre ASC");			
        while($fila3=mysqli_fetch_array($Seleccionar))
        {
			$DEPARTAMENTO = $fila3['nombre'];
			echo "<option>".$DEPARTAMENTO."</option>";
        } 
        ?>
        </select>   
      </td>
      </tr>
      <tr>
      <td>
      	<span>Ciudad<span class="asterisco">*</span></span>
      </td>
      <td>
      	<select type="text" name="ciudad" id="ciudad">
             <option><?php echo $fila['CIUDAD_PACIENTE'];?></option>         
        <?php  
            $Selecciones = mysqli_query($conex, "SELECT c.nombre FROM bayer_ciudad AS c
            INNER JOIN bayer_departamento AS d ON d.id=c.departamento_id
            WHERE d.nombre='$DEPT' ORDER BY c.nombre ASC");			
            while($fila2=mysqli_fetch_array($Selecciones))
                {
                    $CIUDAD = $fila2['nombre'];
                    echo "<option>".$CIUDAD."</option>";
                } 
        ?>
        </select>    
      </td>
  <td>
  <span>Barrio<span class="asterisco">*</span></span>
  </td>  
  <td>
  <input type="text" name="barrio" id="barrio" value="<?php echo $fila['BARRIO_PACIENTE'];?>"/>
  </td>
  
  </tr>
  
  <tr>
  <td>
  <span>Direccion<span class="asterisco">*</span></span>
  </td>  
  <td colspan="3">
  <input name="direccion_act" id="direccion_act" style="width:93%" value="<?php echo $fila['DIRECCION_PACIENTE'];?>" readonly="readonly"/>
  <img src="imagenes/lapiz 100.png"
id="cambio" name="cambio" title="Editar" style="width:4%; height:20px; margin-left:-10%;" align="right"/>
  </td>
  </tr>
  <tr style="padding:3%;">
<td colspan="4" width="90%">
<div id="cambio_direccion" style="display:none; border:#F00 1px solid;"> 
<table width="99%">
        <tr style="padding:3%;">
        <td style="width:10%;"><span>Direccion<span class="asterisco">*</span></span></td>
         <td bgcolor="#FFFFFF" colspan="3">
    <input type="text" name="DIRECCION" id="DIRECCION" readonly style="width:99.8%;"/>
    </td>
</tr>
<tr style="padding:3%;">
	<td><span>Via:</span></td>
    <td style="width:35%"><span>
    <select id="VIA" name="VIA" style="width:96%">
        <option value="">Seleccione...</option>
        <option>ANILLO VIAL</option>
        <option>AUTOPISTA</option>
        <option>AVENIDA</option>
        <option>BOULEVAR</option>
        <option>CALLE</option>
        <option>CALLEJON</option>
        <option>CARRERA</option>
        <option>CIRCUNVALAR</option>
        <option>CONDOMINIO</option>
        <option>DIAGONAL</option>
        <option>KILOMETRO</option>
        <option>LOTE</option>
        <option>SALIDA</option>
        <option>SECTOR</option>
        <option>TRANSVERSAL</option>
        <option>VEREDA</option>
        <option>VIA</option>
    </select>
    </span></td>
    <td style="width:10%;"><span>Detalle via:</span></td>
    <td width="177" bgcolor="#FFFFFF"><span>
    	<input name="detalle_via" id="detalle_via" type="text" maxlength="15" style="width:99%"/>
    </span>
    </td>
	</tr>
        <tr>
    <td width="96"><span>N&uacute;mero:</span></td>
    <td bgcolor="#FFFFFF">
    <span>
      <input name="numero" id="numero" type="text" maxlength="5" style=" width:45%"/>
      -
  <input name="numero2" id="numero2" type="text" maxlength="5" style=" width:45%"/>
    </span>
    </td>
    <td></td>
    <td bgcolor="#FFFFFF"></td>
    </tr>
	<tr style="padding:3%;">
    
    <td><span>Interior:</span></td>
    <td bgcolor="#FFFFFF"><span>
    <select id="interior" name="interior" style="width:96%">
    	<option value="">Seleccione...</option>
        <option>APARTAMENTO</option>
        <option>BARRIO</option>
<option>BLOQUE</option>
        <option>CASA</option>
        <option>CIUDADELA</option>
        <option>CONJUNTO</option>
        <option>CONJUNTO RESIDENCIAL</option>
        <option>EDIFICIO</option>
        <option>ENTRADA</option>
        <option>ETAPA</option>
        <option>INTERIOR</option>
        <option>MANZANA</option>
        <option>NORTE</option>
        <option>OCCIDENTE</option>
        <option>ORIENTE</option>
        <option>PENTHOUSE</option>
        <option>PISO</option>
        <option>PORTERIA</option>
        <option>SOTANO</option>
        <option>SUR</option>
        <option>TORRE</option>
    </select>
    </span></td>
    <td><span>Detalle Interior:</span></td>
    <td bgcolor="#FFFFFF"><span>
    	<input name="detalle_int" id="detalle_int" type="text" maxlength="15" readonly style="width:99%"/>
    </span></td>
    
    </tr>
    <tr style="padding:3%;">
    <td><span>Interior:</span></td>
    <td bgcolor="#FFFFFF"><span>
    <select id="interior2" name="interior2" style="width:96%">
    	<option value="">Seleccione...</option>
        <option>APARTAMENTO</option>
        <option>BARRIO</option>
		<option>BLOQUE</option>
        <option>CASA</option>
        <option>CIUDADELA</option>
        <option>CONJUNTO</option>
        <option>CONJUNTO RESIDENCIAL</option>
        <option>EDIFICIO</option>
        <option>ENTRADA</option>
        <option>ETAPA</option>
        <option>INTERIOR</option>
        <option>MANZANA</option>
        <option>NORTE</option>
        <option>OCCIDENTE</option>
        <option>ORIENTE</option>
        <option>PENTHOUSE</option>
        <option>PISO</option>
        <option>PORTERIA</option>
        <option>SOTANO</option>
        <option>SUR</option>
        <option>TORRE</option>
    </select>
    </span></td>
    <td><span>Detalle Interior:</span></td>
    <td bgcolor="#FFFFFF"><span>
    	<input name="detalle_int2" id="detalle_int2" type="text" maxlength="15" readonly style="width:99%"/>
    </span></td>
    
    </tr>
    <tr style="padding:3%;">
    <td><span>Interior:</span></td>
    <td bgcolor="#FFFFFF"><span>
    <select id="interior3" name="interior3" style="width:96%">
    	<option value="">Seleccione...</option>
        <option>APARTAMENTO</option>
        <option>BARRIO</option>
		<option>BLOQUE</option>
        <option>CASA</option>
        <option>CIUDADELA</option>
        <option>CONJUNTO</option>
        <option>CONJUNTO RESIDENCIAL</option>
        <option>EDIFICIO</option>
        <option>ENTRADA</option>
        <option>ETAPA</option>
        <option>INTERIOR</option>
        <option>MANZANA</option>
        <option>NORTE</option>
        <option>OCCIDENTE</option>
        <option>ORIENTE</option>
        <option>PENTHOUSE</option>
        <option>PISO</option>
        <option>PORTERIA</option>
        <option>SOTANO</option>
        <option>SUR</option>
        <option>TORRE</option>
    </select>
    </span></td>
    <td><span>Detalle Interior:</span></td>
    <td bgcolor="#FFFFFF"><span>
    	<input name="detalle_int3" id="detalle_int3" type="text" maxlength="15" style="width:99%" readonly/>
    </span></td>
    
    </tr>       
</table>
</div>
</td>
</tr> 

  
  <tr>
  <td width="20%">
	<span>Fecha de Nacimiento<span class="asterisco">*</span></span>
    </td>  
  <td width="30%">
	<input type="date" name="fecha_nacimiento" id="fecha_nacimiento"  max="<?php echo date('Y-m-d'); ?>" value="<?php echo $fila['FECHA_NACIMINETO_PACIENTE'];?>"/>
    </td>  
    <td>
	    <span>Edad</span>
    </td>  
    <td>
	<input type="text" name="edad" id="edad" readonly="readonly"/>
    </td> 
    </tr>  
    <tr>
        <td>
			<span>Acudiente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    	</td>  
    	<td>
			<input type="text" name="acudiente" id="acudiente" readonly="readonly" value="<?php echo $fila['ACUDIENTE_PACIENTE'] ?>"/>
    	</td>
        <td>
        <span>Telefono del Acudiente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>  
        <td>
        <input type="text" name="telefono_acudiente1" id="telefono_acudiente1" value="<?php echo $fila['TELEFONO_ACUDIENTE_PACIENTE']?>" readonly="readonly"/>
        </td> 
        </tr>
        <tr>
        <td>
    		<span>Clasificacion Patologica<span class="asterisco">*</span></span>
        </td>
        <td>
            <span style="width:30%;">
            <input type="text" name="clasificacion_patologicas" id="clasificacion_patologicas" value="<?php echo $fila['CLASIFICACION_PATOLOGICA_TRATAMIENTO']?>" readonly="readonly">
            </span>
        </td>
    	<td>
    		<span>Fecha Inicio Terapia<span class="asterisco">*</span></span>
        </td>
        <td>
			<input type="date" name="fecha_ini_terapia" id="fecha_ini_terapia" readonly="readonly" value="<?php echo $fila['FECHA_INICIO_TERAPIA_TRATAMIENTO'] ?>"/>
    	</td>
    </tr>
    <tr>
        <td colspan="2">
        <input type="button" name="historico" id="historico" title="Historico reclamacion" style="width:100%; height:50px" value="Historico Reclamaciones" onclick="javascript:ventanaSecundaria('form_historico_reclamacion.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')"/>
        </td>
    	<td colspan="2">
        <input type="button" name="pedidos" id="pedidos" title="Mis Pedidos" style="width:100%; height:50px" value="Mis Pedidos" onclick="javascript:ventanaSecundaria('form_productos_paciente.php?xxx=<?php echo base64_encode($fila['ID_PACIENTE']) ?>')"/>
        </td>
    </tr>
</table> 
    
    </div>
  </div>

  <div class="AccordionPanel">
    <div class="AccordionPanelTab">GENERAL</div>
    <div class="AccordionPanelContent">
    <br />
<table width="93.5%">
	<?php
		$fecha_actual=date('Y-m-d');
		$fecha_rec_act = explode("-", $fecha_actual);
		$anio_act=$fecha_rec_act[0]; // año
		$mes_act=$fecha_rec_act[1]; // mes
		$dia_act=$fecha_rec_act[2]; // dia
		 $dato=((int)$mes_act);
		$ID=$fila['ID_PACIENTE'];
		$select_historial_pri=mysqli_query($conex, "SELECT * FROM bayer_historial_reclamacion WHERE ID_PACIENTE_FK='$ID'");
        echo mysqli_error($conex);
		$reg_hist=mysqli_num_rows($select_historial_pri);
		if($reg_hist>0)
		{
			$select_historial=mysqli_query($conex, "SELECT MES$dato as 'MES',RECLAMO$dato as 'RECLAMO',FECHA_RECLAMACION$dato as 'FECHA_RECLAMACION',MOTIVO_NO_RECLAMACION$dato as 'MOTIVO_NO_RECLAMACION' FROM bayer_historial_reclamacion WHERE ID_PACIENTE_FK='".$ID."' AND MES$dato='".$mes_act."'");
			echo mysqli_error($conex);
			
		
			while($inf=mysqli_fetch_array($select_historial))
			{
				$reclamo=$inf['RECLAMO'];
				$MES=$inf['MES'];
				$MOTIVO_NO_RECLAMACION=$inf['MOTIVO_NO_RECLAMACION'];
				$FECHA_RECLAMACION=$inf['FECHA_RECLAMACION'];
			}
		}
		else
		{
			$INSERT_HISTORIAL=mysqli_query($conex, "INSERT INTO bayer_historial_reclamacion(ID_PACIENTE_FK) VALUES('".$fila['ID_PACIENTE']."')");
			echo mysqli_error($conex);
		}
    ?>
   <tr>
    	<td>
            <span>Reclamo<span class="asterisco">*</span></span>
        </td>
        <td>
            <select type="text" name="reclamo" id="reclamo">
                <option><?php echo $reclamo ?></option>
                <?php
					if($reclamo=='NO')
					{
						?>
							<option>SI</option>
						<?php
					}
					if($reclamo=='SI')
					{
						?>
							<option>NO</option>
						<?php
					}
					if($reclamo=='')
					{
						?>
							<option>SI</option>
							<option>NO</option>
						<?php
					}
				?>
                
            </select>
        </td>
        <td>
            <span style=" display:none" id="causa">Causa No Reclamacion<span class="asterisco">*</span></span>
            <span style=" display:none" id="fecha_reclamacion_span">Fecha de Reclamaci&oacute;n<span class="asterisco">*</span></span>
        </td>
        <td>
            <select type="text" name="causa_no_reclamacion" id="causa_no_reclamacion" style=" display:none">
            	<option></option>
                <option><?php echo $MOTIVO_NO_RECLAMACION ?></option>
                <option value="">Seleccione...</option>
                <option>Abandono</option>
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
                <option>Voluntario</option>
            </select>
            <input type="date" name="fecha_reclamacion" id="fecha_reclamacion" style=" display:none" max="<?php echo date('Y-m-d'); ?>" min="<?php echo $DIAS_ANTES ?>" value="<?php echo $FECHA_RECLAMACION ?>"/>
        </td>
  </tr>
  <tr>
  	<td>
		<span style=" display:none" id="consecutivo_betaferon_span">Consecutivo Betaferon<span class="asterisco">*</span></span>
  	</td>
  	<td>
		<input type="text" name="consecutivo_betaferon" id="consecutivo_betaferon" style=" display:none"/>
  	</td>
  </tr>
  <tr>
      <td>
        <span>Se Logro la Comunicacion<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
    	<input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%; display:none" value="" checked="checked"/>
    	<input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%;" value="SI"/>SI
    	<input type="radio" name="logro_comunicacion" id="logro_comunicacion" style=" width:20%;" value="NO"/>NO
    <br />
    <br />
    </td>
  	<td class="tit">
    	<span>Motivo de Comunicaci&oacute;n<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td style="width:30%;">
    	<select type="text" name="motivo_comunicacion" id="motivo_comunicacion">
    	<option value="">Seleccione...</option>
        <option>Actualizacion de Datos</option>
        <option>Campana</option>
        <option>Cumpleanos</option>
        <option>Egreso</option>
        <option>Encuesta</option>
        <option>Ingreso</option>
        <option>Reclamacion</option>
        <option>Remision de Caso</option>
        <option>Respuesta de Caso</option>
        <option>Seguimiento</option>
        <option>Solicitud</option>
 		</select>
        <br />
        <br />
    </td>
  </tr>
  <tr>
<td class="tit">
        <span>Medio de Contacto<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td style="width:30%;">
    	<select type="text" name="medio_contacto" id="medio_contacto">
    	<option value="">Seleccione...</option>
        <option>Electronico</option>
        <option>Telefonico</option>
		<option>Visita</option>
 		</select>
    <br />
    <br />
    </td>
  	<td>
        <span>Tipo de Llamada<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
    	<select type="text" name="tipo_llamada" id="tipo_llamada">
    	<option value="">Seleccione...</option>
        <option>Entrada</option>
        <option>Salida</option>
 		</select>
        <br />
        <br />
    </td>
  </tr>
  <tr>
  	<td>
        <span>Motivo de  No Comunicaci&oacute;n</span>
        <br />
        <br />
    </td>
    <td>
    	<select type="text" name="motivo_no_comunicacion" id="motivo_no_comunicacion">
    	<option value="">Seleccione...</option>
        <option>Apagado</option>
        <option>No Esta</option>
        <option>No Contesta</option>
        <option>No Vive Ahi</option>
        <option>Numero Equivocado</option>
        <option>Telefono Ocupado</option>
        <option>Telefono Fuera de Servicio</option>
        <option>Otro</option>
 		</select>
        <br />
        <br />
    </td>
    <td>
        <span>Numero de Intentos<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
    	<input type="text" name="via_recepcion" id="via_recepcion"/>
    <br />
    <br />
    </td>
  </tr>
  <tr>
    <td>
    	<span>Asegurador<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
        <select type="text" name="asegurador" id="asegurador" >
         <option><?php echo $fila['ASEGURADOR_TRATAMIENTO']?></option>
    <?php
		$Seleccion = mysqli_query($conex, "SELECT ASEGURADOR FROM `bayer_asegurador_operador_logistico` WHERE DEPARTAMENTO='".$fila['DEPARTAMENTO_PACIENTE']."' GROUP BY ASEGURADOR ORDER BY ASEGURADOR  ASC");	
		while($fil=mysqli_fetch_array($Seleccion))
			{
				$ASEGURADOR = $fil['ASEGURADOR'];
				echo "<option>".$ASEGURADOR."</option>";
			} 
  	?>
    </select>
        <br />
        <br />
    </td>
     <td>
    	<span>Ips que Atiende<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
        <input type="text" name="ips_atiende" id="ips_atiende" value="<?php echo $fila['IPS_ATIENDE_TRATAMIENTO']?>">
        <br />
        <br />
	</td>
    </tr>
    <tr>
        <td><span>Medico<span class="asterisco">*</span></span><br />
        	<br />
        </td>
        <td>
        	<select type="text" name="medico" id="medico">
         <option><?php echo $fila['MEDICO_TRATAMIENTO']?></option>         
    <?php 
		$medico=$fila['MEDICO_TRATAMIENTO'];
		$Seleccion = mysqli_query($conex, "SELECT MEDICO FROM `bayer_listas` WHERE MEDICO != '' AND MEDICO != '".$medico."' ORDER BY MEDICO ASC");			
		while($datos_m=mysqli_fetch_array($Seleccion))
		{
			$MEDICO = $datos_m['MEDICO'];
			echo "<option>".$MEDICO."</option>";
		} 
  	?>
    </select>
    <span id="cual_medico" style="display:none;">Cual</span>
            <input type="text" name="medico_nuevo" id="medico_nuevo" style="display:none; width:84%"/>
            <br />
       	 	<br />
        </td>
        <td><span>Operador Logistico<span class="asterisco">*</span></span><br />
            <br />
        </td>
        <td><select type="text" name="operador_logistico" id="operador_logistico" >
          <option><?php echo $fila['OPERADOR_LOGISTICO_TRATAMIENTO']?></option>
          <?php
				$Seleccion = mysqli_query($conex, "SELECT OPERADOR FROM bayer_asegurador_operador_logistico WHERE DEPARTAMENTO='".$fila['DEPARTAMENTO_PACIENTE']."' AND ASEGURADOR='".$fila['ASEGURADOR_TRATAMIENTO']."' GROUP BY OPERADOR ORDER BY OPERADOR  ASC");			
				while($filas=mysqli_fetch_array($Seleccion))
				{
					$OPERADOR_LOGISTICO = $filas['OPERADOR'];
					echo "<option>".$OPERADOR_LOGISTICO."</option>";
				} 
            ?>
        </select>
          <br />
            <br />
        </td>
        </tr>
     <tr>
        <td><span>Punto De Entrega</span><br />
            <br />
        </td>
        <td>
        	<input type="text" name="punto_entrega" id="punto_entrega" value="<?php echo $fila['PUNTO_ENTREGA'] ?>"/>
        	<br />
            <br />
        </td>
        <td>
            <span>Estado CTC</span>
            <br />
            <br />
        </td>
        <td>
            <select type="text" name="estado_ctc" id="estado_ctc">
                <option value="">Seleccione...</option>
                <option>Aprobado</option>
                <option>Negado</option>
                <option>Pendiente Radicar</option>
                <option>Radicado</option>
            </select>
            <br />
            <br />
        </td>
    </tr>
    <tr>
        <td>
            <span>Estado Farmacia</span>
            <br />
            <br />
        </td>
        <td>
            <select type="text" name="estado_farmacia" id="estado_farmacia">
                <option value="">Seleccione...</option>
                <option>Aprobado</option>
                <option>Pendiente Radicar</option>
                <option>Radicado</option>
            </select>
            <br />
            <br />
        </td>
        <td>
        <span>Dificultad en el Acceso</span>
        <br />
        <br />
    </td>
    <td>
    	<input type="radio" name="dificultad_acceso" id="dificultad_acceso" style=" width:20%;" value="SI"/>SI
    <input type="radio" name="dificultad_acceso" id="dificultad_acceso" style=" width:20%;" value="NO"/>NO
        <br />
        <br />
    </td>
    </tr>
   
  <tr>
    <td>
    	<span>Tipo de Dificultad</span>
    	<br />
        <br />
    </td>
    <td colspan="3">
    	<textarea style="width:98%; height:72.5px;" id="tipo_dificultad" name="tipo_dificultad"></textarea>
    	<br />
        <br />
    </td>
  </tr>
  <tr>
  <td>
        <span>Autor</span>
        <br />
        <br />
    </td>
    <td>
	    <input type="text" name="autor" id="autor" readonly="readonly" value="<?php echo $usua ?>"/>
        <br />
        <br />
    </td>
    <td>
        <span>Genera Solicitud<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
    	<input type="radio" name="genera_solicitud" id="genera_solicitud" style=" width:20%; display:none" value="" checked="checked"/>
    	<input type="radio" name="genera_solicitud" id="genera_solicitud" style=" width:20%;" value="SI"/>SI
    <input type="radio" name="genera_solicitud" id="genera_solicitud" style=" width:20%;" value="NO"/>NO
        <br />
        <br />
    </td>
    </tr>
    <TR>
    <td>
        <span>Evento Adverso<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
    	<input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%; display:none" value="" checked="checked"/>
    	<input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%;" value="SI"/>SI
    <input type="radio" name="evento_adverso" id="evento_adverso" style=" width:20%;" value="NO"/>NO
    <br />
    <br />
    </td>

    <td>
        <span id="envio_evento_adverso_span" style="display:none">Tipo de Evento<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
    <div id="envio_evento_adverso_div" style="display:none">
    <input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%; display:none" value="" checked="checked"/>
    <input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Farmacovigilancia"/>Farmacovigilancia
    <br />
    <input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Tecnovigilancia Betaconnet/ Omrron"/>Tecnovigilancia Betaconnet/ Omrron
    <br />
	<input type="radio" name="tipo_evento_adverso" id="tipo_evento_adverso" style=" width:20%" value="Tecnovigilancia I-neb"/>Tecnovigilancia I-neb
    </div>
    <br />
    <br />
    </td>
  	
    </tr>
  	<tr>
    <td>
        <span>Fecha de la Pr&oacute;xima Llamada<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
    	<input type="date" name="fecha_proxima_llamada" id="fecha_proxima_llamada" min="<?php echo date('Y-m-d'); ?>"/>
    <br />
    <br />
    </td>
  	<td>
        <span>Motivo de Proxima Llamada<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
    	<select type="text" name="motivo_proxima_llamada" id="motivo_proxima_llamada">
    	<option value="">Seleccione...</option>
        <option>Actualizacion de Datos</option>
        <option>Campanas</option>
        <option>Cumpleanos</option>
        <option>Egreso</option>
        <option>Encuestas</option>
        <option>Ingreso</option>
        <option>Reclamacion</option>
        <option>Remision de Caso</option>
        <option>Respuesta de Caso</option>
        <option>Seguimiento</option>
 		</select>
        <br />
        <br />
    </td>
    </tr>
  	<tr>
    <td>
        <span>Observaciones Proxima Llamada</span>
        <br />
        <br />
    </td>
    <td>
    	<input type="text" name="observacion_proxima_llamada" id="observacion_proxima_llamada" />
    <br />
    <br />
    </td>
  	<td>
        <span>Consecutivo</span>
        <br />
        <br />
    </td>
    <td>
	    <input type="text" name="consecutivo" id="consecutivo"/>
        <br />
        <br />
    </td>
    </tr>
  	<tr>
    <td>
        <span>Numero cajas/ Unidades</span>
        <br />
        <br />
    </td>
    <td>
        <select name="numero_cajas" id="numero_cajas" style="width:30%;">
        	<option></option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
        </select>
        <select name="tipo_numero_cajas" id="tipo_numero_cajas" style="width:60%;">
        	<option></option>
            <option>Ampoya(s)</option>
            <option>Aplicacion</option>
            <option>Caja(s)</option>
        </select>
    <br />
    <br />
    </td>
    <td>
        <div style="display:none" id="span_nebulizaciones">
            <span>Numero Nebulizaciones</span>
            <br />
            <br />
        </div>
    </td>
    <td>
        <div style="display:none" id="div_nebulizaciones">
            <input type="text" name="nebulizaciones" id="nebulizaciones"/>
            <br />
            <br />
        </div>
    </td>
    </tr>
    <tr>
      	<td>
            <span style="text-transform:capitalize;">Tratamiento Previo</span>
            <br />
            <br />
        </td>
        <td>
            <input style="text-transform:capitalize;" type="text" readonly="readonly" name="PREVIO" id="PREVIO" value="<?php echo $fila['TRATAMIENTO_PREVIO'] ?>" />
            
            <br />
            <br />
        </td>
        <td>
        </td>
        <td>
        </td>
    </tr>
    <tr>
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
        
        <span style="text-transform:capitalize;">Dosis Tratamiento<span class="asterisco">*</span></span>
        <br />
        <br />
    </td>
    <td>
    	<?php
		$producto_tratamiento=$fila['PRODUCTO_TRATAMIENTO'];
		$dosis_bd=$fila['DOSIS_TRATAMIENTO'];
		if($producto_tratamiento=='ADEMPAS 1MG 42TABL'||$producto_tratamiento=='ADEMPAS 2.5MG 84TABL'||$producto_tratamiento=='ADEMPAS 1.5MG 42TABL'||$producto_tratamiento=='ADEMPAS 0.5MG 42TABL'||$producto_tratamiento=='ADEMPAS 2MG 42TABL'||$producto_tratamiento=='ADEMPAS')
		{
			$producto_tratamiento='ADEMPAS';
		}
		if($producto_tratamiento=='KOGENATE FS 2000 PLAN')
		{
			?>
            <input type="text" maxlength="6" name="Dosis3" id="Dosis3" onKeyDown="return validarNumeros(event)" value="<?php echo $fila['DOSIS_TRATAMIENTO'] ?>" />
            <?PHP
		}
		if($producto_tratamiento=='Xofigo 1x6 ml CO')
		{
			?>
            <input style="text-transform:capitalize;" type="text" name="Dosis2" id="Dosis2" value="<?php echo $fila['DOSIS_TRATAMIENTO'] ?>" />
            <?PHP
		}
		if($producto_tratamiento!='Xofigo 1x6 ml CO'&&$producto_tratamiento!='KOGENATE FS 2000 PLAN')
		{
			
			?>
            <select name="Dosis" id="Dosis">
            	<option><?php echo $fila['DOSIS_TRATAMIENTO']?></option>
                <?php
				$producto=$fila['PRODUCTO_TRATAMIENTO'];
				$select = mysqli_query($conex, "SELECT DOSIS FROM  bayer_dosis WHERE NOMBRE_REFERENCIA LIKE '".$producto_tratamiento."%' AND DOSIS!='$dosis_bd'");
                echo mysqli_error($conex);
				while($filass=(mysqli_fetch_array($select)))
				{
					?>
					<option value="<?php echo $filass['DOSIS'] ?>"><?php echo $filass['DOSIS'] ?></option>
                    <?php
				}
				?>
            </select>
            <?php
		}
		?>
    	
    	
        <br />
        <br />
    </td>
    </tr>
    <tr>
    <td width="20%">
	    <span>Status del Paciente</span>
        <br />
        <br />
    </td>
    <td width="30%">
        <select type="text" name="status_paciente" id="status_paciente" >
        	<option><?php echo $fila['STATUS_PACIENTE'];?></option>
        </select>
        <br />
        <br />
    </td>
    <td>
        <span>Envios</span>
        <br />
        <br />
    </td>
    <td>
    	<input type="radio" name="envios" id="envios" style=" width:20%;" value="SI"/>SI
    <input type="radio" name="envios" id="envios" style=" width:20%;" value="NO"/>NO
        <br />
        <br />
    </td>
    </tr>
	<tr>
        <td>
            <div style="display:none" id="span_tabletas_diarias">
                <span>Numero Tabletas Diarias</span>
                <br />
                <br />
            </div>
        </td>
        <td>
            <div style="display:none; width:100%;" id="div_tabletas_diarias">
                <input type="text" name="numero_tabletas_diarias" id="numero_tabletas_diarias"/>
                <br />
                <br />
            </div>
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
        while($opcion=mysqli_fetch_array($listado_envio))
		{
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
            <input type="submit" name="agregar_seg" id="agregar_seg" formaction="form_productos_envio.php" formtarget="registro_productos_form" style="background-image:url(imagenes/agregar.png); background-repeat:no-repeat;  width:41px; height:38px; border:1px solid transparent; background-color:transparent" value=""/>
        </div>
    </td>
    <?php
			}
?>
  </tr>
  <tr>
  	<td colspan="4">
    <div id="div_material_agregar" style="width:50%; margin:auto auto; display:none">
  		<iframe name="registro_productos_form" style="width:100%; height:250px; border:1px solid #000;" scrolling="auto"></iframe>
    </div>
    </td>
  </tr>
  <tr>
  <td>
    	<span>Descripcion de Comunicaci&oacute;n</span>
    	<br />
        <br />
    </td>
    <td colspan="3">
    	<textarea style="width:98%; height:72.5px;" id="descripcion_comunicacion" name="descripcion_comunicacion" onKeyDown="return filtro(1)"></textarea>
    	<br />
        <br />
    </td>
  </tr>
</table>
<br />
<br />
</div>
</div>

<div class="AccordionPanel">
<div class="AccordionPanelTab" style="padding:5px">COMUNICACIONES</div>
<div class="AccordionPanelContent">
  
    <?PHP
  
///////////////////////////////////////////////////////
  
 $gestion = mysqli_query($conex, "SELECT * FROM `bayer_gestiones` WHERE `ID_PACIENTE_FK2` = '".$ID_PACIENTE2."' ORDER BY `FECHA_COMUNICACION` DESC");
 echo mysqli_error($conex);
    echo "<table width=100% border=1 rules=all  align=left class=Estilo2 >";  	
    echo "<tr style='border:1px solid #fff'>";
	echo "<th class=AccordionPanelTab><strong>FECHA DE GESTION</strong></th>";
	echo "<th class=AccordionPanelTab><strong>DESCRIPCION</strong></th>";
	echo "<th class=AccordionPanelTab><strong>FECHA PROXIMO CONTACTO</strong></th>";
	echo "<th class=AccordionPanelTab><strong>AUTOR</strong></th>";
	echo "<th class=AccordionPanelTab><strong>MOTIVO COMUNICACION GESTION</strong></th>";

		echo "<td class=AccordionPanelTab><strong>CODIGO ARGUS</strong></td>";
		echo "<td class=AccordionPanelTab><strong>CARCHIVO ADJUNTO</strong></td>";
    echo "</tr>";

$numges = 1;
	while ($fila2 = mysqli_fetch_array($gestion))
{  //echo $fila2['ID_PACIENTE_FK2'];
   /* echo "<tr bgcolor=#5C9DD1 rules=cols>";
	echo "<td colspan=5 height=15><strong>Gestion : ".$numges."</strong></td>";
	echo "</tr>";*/
	
	

    echo "<tr>";
	echo "<td>".$fila2['FECHA_COMUNICACION']."</td>";
	//echo "<td>".$fila2['DESCRIPCION_COMUNICACION_GESTION']."</td>";
	echo "<td>";		
	?>
<textarea name="observaciones" cols="60" rows="2" readonly="readonly" id="observaciones" class="letra" style="text-transform:uppercase"><?php echo $fila2['DESCRIPCION_COMUNICACION_GESTION']; ?></textarea>
  <?PHP
    echo "</td>";
	echo "<td>".$fila2['FECHA_PROGRAMADA_GESTION']."</td>";
	echo "<td>".$fila2['AUTOR_GESTION']."</td>";
	echo "<td>".$fila2['MOTIVO_COMUNICACION_GESTION']."</td>";
	if($privilegios=='1')
	{
		$evento=$fila2['EVENTO_ADVERSO_GESTION'];
		if($evento=='SI'||$evento=='Si')
		{
			?>
			<td>
			<input name="CODIGO_ARGUS" id="CODIGO_ARGUS" type="text" maxlength="25" style="width:80%" value="<?php echo $fila2['CODIGO_ARGUS']; ?>" readonly="readonly"/>        
			<a  class="btn_gestiones" href="javascript:ventanaSecundaria('../presentacion/codigo_ar.php?xx=<?php echo base64_encode($fila2['ID_GESTION']) ?>&xxp=<?php echo base64_encode($ID_PACIENTE)?>')" ><img src="imagenes/CHULO.png" width="17%" height="25px" title="Agregar Codigo" align="right"/> </a>
			</td>
			<?php
		}
		else
		{
			?>
			<td>
			</td>
			<?php
		}
	}
	else if($privilegios=='2')
	{
		$evento=$fila2['EVENTO_ADVERSO_GESTION'];
		if($evento=='SI'||$evento=='Si')
		{
			?>
			<td>
			<input name="CODIGO_ARGUS" id="CODIGO_ARGUS" type="text" maxlength="25" style="width:80%" value="<?php echo $fila2['CODIGO_ARGUS']; ?>" readonly="readonly"/>        
			</td>
			<?php
		}
		else
		{
			?>
			<td>
			</td>
			<?php
		}
	}
///////////////////////////////////////////////////////
	$ID_GES=$fila2['ID_GESTION'];
	$dir = "../ADJUNTOS_BAYER/$ID_GES";
	if (file_exists($dir))
	{
		$directorio=opendir($dir);
		while ($archivo = readdir($directorio))
		{ 
			if($archivo=='.' or $archivo=='..')
			{
				
			}
			else
			{ 
				
				$enlace = $dir."/".$archivo;
		?>
		<td>
			<a class="highslide" onclick="return hs.expand(this)">
			<img src="<?php echo $enlace; ?>" alt="" title="Click to enlarge" height="100" width="100" onclick="javascript:this.width=500;this.height=500" ondblclick="javascript:this.width=100;this.height=100"/></a>
		<br />
		<br />
		</td>
		<?php
			}
		}
		closedir($directorio);
	}
	else
	{
		?>
		<td>
		</td>
        <?php
		//echo "El fichero $dir no existe";
	}
	
	echo "</tr>";
	$numges = $numges + 1;
}
echo "</table>";   
echo "<br />";
?>
</div>
</div>

<div class="AccordionPanel">
<div class="AccordionPanelTab">NOTAS Y ADJUNTOS</div>
<div class="AccordionPanelContent">
<br />
<br />
<div style="width:91.4%;">
<textarea name="nota" id="nota" style="width:100%; height:100px" title="Escriba una Nota" placeholder="Escriba una Nota"></textarea>
</div>
<br />
<br />
<div style="width:91.4%;">
<input type="file" name="archivo" id="archivo" class="aceptar"></input>
</div>
<center>
<input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(seguimiento,2)"/>
<br />
<br />
<br />
<br />
<br />
<br />    
</div>
</div>
</div>
</form>
<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
</body>
<?php
}
else
{
	?>
	<script type="text/javascript">
		window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
	</script>
	<?php
}
?>
</html>