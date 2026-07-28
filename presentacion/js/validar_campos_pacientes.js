document.addEventListener('DOMContentLoaded', function () {

	const formulario = document.getElementById('seguimiento');

	if (!formulario) return;

	function validarCampo(id, mensaje) {

		const campo = $('#' + id);

		console.log(id, campo.val());

		if (campo.length && campo.val().trim() === '') {

			Swal.fire({
				icon: 'warning',
				title: 'Campo obligatorio',
				text: mensaje
			});

			campo.focus();
			return false;
		}

		return true;
	}

	function validarRadio(nombre, mensaje) {

		if (!$(`input[name="${nombre}"]:checked`).val()) {

			Swal.fire({
				icon: 'warning',
				title: 'Campo obligatorio',
				text: mensaje
			});

			return false;
		}

		return true;
	}

	formulario.addEventListener('submit', function (e) {

		e.preventDefault();

		if (!validarRadio('codi_ba', 'Debe indicar si el código Bavaria es correcto')) return;

		if (!validarCampo('codigo_bavaria_nuevo', 'Debe ingresar el código Bavaria correcto')) return;

		if (!validarRadio('whatsApp', 'Debe indicar si el número tiene WhatsApp')) return;

		if (!validarCampo('num_WhatsApp', 'Debe ingresar el número de WhatsApp')) return;

		if (!validarRadio('negocio_funciona', 'Debe indicar si el negocio continúa funcionando')) return;

		if (!validarRadio('propietario', 'Debe indicar si sigue siendo el propietario o administrador')) return;

		if ($('input[name="propietario"]:checked').val() === 'NO') {

			if (!validarCampo('nombres_nuevo_pro', 'Debe ingresar los nombres del nuevo responsable')) return;

			if (!validarCampo('apellidos_nuevo_pro', 'Debe ingresar los apellidos del nuevo responsable')) return;
		}

		if (!validarCampo('horario_visita', 'Debe seleccionar un horario para la visita')) return;

		if (!validarCampo('dia_visita', 'Debe seleccionar una fecha para la visita')) return;

		if (!validarCampo('interes_programa', 'Debe indicar el interés en el programa')) return;

		if (!validarCampo('barrera', 'Debe seleccionar una barrera')) return;

		if (!validarCampo('hora_inicio', 'Debe ingresar la hora de apertura')) return;

		if (!validarCampo('hora_fin', 'Debe ingresar la hora de cierre')) return;

		if (!validarCampo('descanso', 'Debe indicar los días de descanso')) return;

		if (!validarCampo('nivel_interes', 'Debe seleccionar el nivel de interés')) return;

		if (!validarCampo('nota', 'Debe ingresar una nota de la llamada')) return;

		const formData = new FormData(formulario);

		const boton = document.getElementById('registrar');

		boton.disabled = true;

		console.trace("Antes del axios");

		axios.post('../../logica/actualizar_seguimiento.php', formData)
			.then(function (response) {

				console.log(response.data);

				if (response.data.success) {

					Swal.fire({
						icon: 'success',
						title: 'Registro exitoso',
						text: response.data.mensaje,
						timer: 2000,
						showConfirmButton: false
					}).then(() => {

						// Redirección cuando guarda correctamente
						window.location.href = '../presentacion/form_paciente_seguimiento.php';

					});

				} else {

					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'No fue posible realizar el registro' . response.data.mensaje
					});

					// No hace nada, se queda en la misma página
				}

			})
			.catch(function (error) {

				console.error(error);

				Swal.fire({
					icon: 'error',
					title: 'Error de conexión',
					text: 'No fue posible comunicarse con el servidor'
				});

			});

	});

});