// JavaScript Document
function validar(tuformulario,val)
{
	/*var ESTADO=$("#estado_paciente").val();
	if(ESTADO==''||ESTADO=='Seleccione...')
	{
		alert('El estado esta vacio');
		$('#estado_paciente').focus();
		return false;
	}
	
	var FECHA_ACTIVACION=$("#fecha_activacion").val();
	if(FECHA_ACTIVACION=='')
	{
		alert('La fecha de activacion esta vacia');
		$('#fecha_activacion').focus();
		return false;	
	}
	
	var STATUS=$("#status_paciente").val();
	if(STATUS==''||STATUS=='Seleccione...')
	{
		alert('El status esta vacio');
		$('#status_paciente').focus();
		return false;
	}
	
	//informacion seguimietno
	var ESTADO=$("#estado_paciente").val();
	if(ESTADO=='Abandono')
	{
		var fecha_retiro=$("#fecha_retiro").val();
		if(fecha_retiro=='')
		{
			alert('La fecha de retiro esta vacio');
			$('#fecha_retiro').focus();
			return false;
		}
	}
		
	var fecha_retiro=$("#fecha_retiro").val();
	if(fecha_retiro!='')
	{
		var motivo_retiro=$("#motivo_retiro").val();
		if(motivo_retiro==''||motivo_retiro=='Seleccione...')
		{
			alert('Seleccione motivo de retiro');
			$('#motivo_retiro').focus();
			return false;
		}
		var observacion_retiro=$("#observacion_retiro").val();
		if(observacion_retiro=='')
		{
			alert('La observacion de retiro esta vacia');
			$('#observacion_retiro').focus();
			return false;
		}
	}
		
	var NOMBRE=$("#nombre").val();
	if(NOMBRE=='')
	{
		alert('El nombre esta vacio');
		$('#nombre').focus();
		return false;
	}
	
	var APELLIDO=$("#apellidos").val();
	if(APELLIDO=='')
	{
		alert('El apellido esta vacio');
		$('#apellidos').focus();
		return false;
	}
	
	var IDENTIFICACION=$("#identificacion").val();
	if(IDENTIFICACION=='')
	{
		alert('La indentificacion esta vacia');
		$('#identificacion').focus();
		return false;
	}
	
	var TELEFONO1=$("#telefono1").val();
	if(TELEFONO1=='')
	{
		alert('El telefono 1 esta vacio');
		$('#telefono1').focus();
		return false;
	}
	
	var DEPARTAMENTO=$("#departamento").val();
	if(DEPARTAMENTO==''||DEPARTAMENTO=='Seleccione...')
	{
		alert('El departamento esta vacio');
		$('#departamento').focus();
		return false;
	}
	
	var CIUDAD=$("#ciudad").val();
	if(CIUDAD==''||CIUDAD=='Seleccione...')
	{
		alert('La ciudad esta vacia');
		$('#ciudad').focus();
		return false;
	}
	
	var BARRIO=$("#barrio").val();
	if(BARRIO=='')
	{
		alert('El barrio esta vacio');
		$('#barrio').focus();
		return false;
	}

	var DIRECCION=$("#direccion_act").val();
	if(DIRECCION=='')
	{
		var DIRECCION2=$("#DIRECCION").val();
		if(DIRECCION2=='')
		{
			alert('La direccion esta vacia');
			$('#DIRECCION').focus();
			return false;
		}
	}
	
	var FECHA_NACIMIENTO=$("#fecha_nacimiento").val();
	if(FECHA_NACIMIENTO=='')
	{
		alert('La fecha de nacimiento esta vacia');
		$('#fecha_nacimiento').focus();
		return false;
	}
	
	var CLASIFICACION_PATOLOGICA=$("#clasificacion_patologica").val();
	if(CLASIFICACION_PATOLOGICA=='')
	{
		alert('La clasificacion patologica esta vacia');
		$('#clasificacion_patologica').focus();
		return false;
	}
	
	var FECHA_INICIO_TERAPIA=$("#fecha_inicio_trt").val();
	if(FECHA_INICIO_TERAPIA=='')
	{
		alert('La fecha inicio de terapia esta vacia');
		$('#fecha_inicio_trt').focus();
		return false;
	}
	
	var ASEGURADOR=$("#asegurador").val();
	if(ASEGURADOR==''||ASEGURADOR=='Seleccione...')
	{
		alert('El asegurador esta vacio');
		$('#asegurador').focus();
		return false;
	}
	
	var IPS_ATIENDE=$("#ips_atiende").val();
	if(IPS_ATIENDE=='')
	{
		alert('La ips que atiende esta vacia');
		$('#ips_atiende').focus();
		return false;
	}
	
	var MEDICO=$("#medico").val();
	if(MEDICO==''||MEDICO=='Seleccione...')
	{
		alert('El medico esta vacio');
		$('#medico').focus();
		return false;
	}
	
	if(MEDICO=='Otro')
	{
		var MEDICO_NUEVO=$("#medico_nuevo").val();
		if(MEDICO_NUEVO=='')
		{
			alert('El medico nuevo esta vacio');
			$('#medico_nuevo').focus();
			return false;
		}
	}
	
	var OPERADOR_LOGISTICO=$("#operador_logistico").val();
	if(OPERADOR_LOGISTICO==''||OPERADOR_LOGISTICO=='Seleccione...')
	{
		alert('El operador logistico esta vacio');
		$('#operador_logistico').focus();
		return false;
	}
	
	if(OPERADOR_LOGISTICO=='Otro')
	{
		var OPERADOR_LOGISTICO_NUEVO=$("#operador_logistico_nuevo").val();
		if(OPERADOR_LOGISTICO_NUEVO=='')
		{
			alert('El operador logistico nuevo esta vacio');
			$('#operador_logistico_nuevo').focus();
			return false;
		}
	}*/
	
	var RECLAMO=$("#reclamo").val();
	if(RECLAMO==''||RECLAMO=='Seleccione...')
	{
		alert('El reclamo esta vacio');
		$('#reclamo').focus();
		return false;
	}
	
	if(RECLAMO=='SI')
	{
		var MEDICAMENTO=$("#MEDICAMENTO").val();
		if(MEDICAMENTO=='BETAFERON CMBP X 15 VPFS (3750 MCG) MM')
		{	
			var FECHA_RECLAMACION=$("#fecha_reclamacion").val();
			if(FECHA_RECLAMACION=='')
			{
				alert('La fecha de reclamacion esta vacia');
				$('#fecha_reclamacion').focus();
				return false;
			}
			
			var CONSECUTIVO_BETAFERON=$("#consecutivo_betaferon").val();
			if(CONSECUTIVO_BETAFERON=='')
			{
				alert('El consecutivo de betaferon esta vacio');
				$('#consecutivo_betaferon').focus();
				return false;
			}
		}
		else
		{
			var FECHA_RECLAMACION=$("#fecha_reclamacion").val();
			if(FECHA_RECLAMACION=='')
			{
				alert('La fecha de reclamacion esta vacia');
				$('#fecha_reclamacion').focus();
				return false;
			}
		}
	}
	else if(RECLAMO=='NO')
	{
		var CAUSA_NO_RECLAMACION=$("#causa_no_reclamacion").val();
		if(CAUSA_NO_RECLAMACION==''||CAUSA_NO_RECLAMACION=='Seleccione...')
		{
			alert('La causa de no reclamacion esta vacia');
			$('#causa_no_reclamacion').focus();
			return false;
		}
	}
	
	
	var crear=$("#crear").val();
	if(crear==''||crear=='Seleccione...')
	{
		alert('Crear gestion esta vacio');
		$('#crear').focus();
		return false;
	}
	
	/*var MEDICAMENTO=$("#MEDICAMENTO").val();
	if(MEDICAMENTO=='KOGENATE FS 2000 PLAN'||MEDICAMENTO=='Xofigo 1x6 ml CO')
	{
		var DOSIS2=$("#Dosis2").val();
		if(DOSIS2=='')
		{
			alert('La dosis esta vacia');
			$('#Dosis2').focus();
			return false;
		}
	}
	else
	{
		var DOSIS=$("#Dosis").val();
		if(DOSIS==''||DOSIS=='Seleccione...')
		{
			alert('La dosis esta vacia');
			$('#Dosis').focus();
			return false;
		}
	}*/
		
}