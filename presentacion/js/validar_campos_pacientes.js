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

		if (!validarCampo('nombres', 'Debe ingresar los nombres')) return;
		if (!validarCampo('apellidos', 'Debe ingresar los apellidos')) return;
		if (!validarCampo('tipo_identificacion', 'Debe seleccionar un tipo de identificacion')) return;
		if (!validarCampo('identificacion', 'Debe ingresar el numero de identificacion')) return;
		if (!validarCampo('telefono', 'Debe ingresar el numero de telefono o celular')) return;
		if (!validarCampo('direccion', 'Debe ingresar la direccion')) return;
		if (!validarRadio('logro_comunicacion', 'Debe indicar si la comunicacion fue efectiva')) return;
		if (!validarCampo('estado', 'Debe seleccionar un estado de la visita')) return;
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
						text: 'No fue posible realizar el registro'.response.data.mensaje
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