// JavaScript Document
$(document).ready(function()
{
	$( "#btn2" ).click(function()
	{
			cambio_activo();
	});
	$( "#btn" ).click(function()
	{
			cambio_inactivo();
	});
	$( "#btn3" ).click(function()
	{
			alert('ok');
	});
});
function cambio_activo()
{
	var usuario=$('#usu').val();
	//alert(CODIGO_PRODUCTO);
	//$("#LOTE").html('<img src="img/cargando.gif" />');
	//.html("Procesando, espere por favor...")
	$.ajax(
	{
		url:'cambio_estado_logeo_desc.php',
		data:
		{
			usuario: usuario
		},
		type: 'post',
		beforeSend: function () {
				$("#tabla").html("Procesando, espere por favor"+'<img src="imagenes/cargando.gif" />');
		},
		success: function(data)
		{
			$('#tabla').html(data);
		}
	}
	)
}
function cambio_inactivo()
{
	var usuario=$('#usu').val();
	$.ajax(
	{
		url:'cambio_estado_logeo_act.php',
		data:
		{
			usuario: usuario
		},
		type: 'post',
		beforeSend: function () {
				$("#tabla").html("Procesando, espere por favor"+'<img src="imagenes/cargando.gif" />');
		},
		success: function(data)
		{
			$('#tabla').html(data);
		}
	}
	)
}
