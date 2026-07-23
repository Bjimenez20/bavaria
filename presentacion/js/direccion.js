// JavaScript Document
function dir() {
	var via = $('#VIA').val();
	var dt_via = $('#detalle_via').val();
	var num1 = $('#numero').val();
	var num2 = $('#numero2').val();
	var interior = $('#interior').val();
	var dt_interior = $('#detalle_int').val();

	if (interior != '') {
		$("#detalle_int").removeAttr('readonly');
	}
	else if (interior == '') {
		$("#detalle_int").attr('readonly', 'readonly');
		$("#detalle_int").val('');
		var dt_interior = '';
	}

	if (num1 != '' || num2 != '') {
		$('#direccion').val(via + ' ' + dt_via + '  # ' + num1 + ' - ' + num2 + ' ' + interior + ' ' + dt_interior);
	}
	else {
		$('#direccion').val(via + ' ' + dt_via + ' ' + interior + ' ' + dt_interior);
	}
}

function direccion() {
	//alert('ok2');
	var via = $('#VIA').val();
	var dt_via = $('#detalle_via').val();
	$('#VIA').change(function () {
		dir();
	});
	$('#detalle_via').change(function () {
		dir();
	});
	$('#numero').change(function () {
		dir();
	});
	$('#numero2').change(function () {
		dir();
	});
	$('#interior').change(function () {
		dir();
	});
	$('#detalle_int').change(function () {
		dir();
	});
}