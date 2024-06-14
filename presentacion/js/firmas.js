document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var isDrawing = false;

    canvas.addEventListener('mousedown', function (event) {
        isDrawing = true;
        context.beginPath();
        context.moveTo(event.offsetX, event.offsetY);
    });

    canvas.addEventListener('mousemove', function (event) {
        if (isDrawing) {
            context.lineTo(event.offsetX, event.offsetY);
            context.stroke();
        }
    });

    canvas.addEventListener('mouseup', function () {
        isDrawing = false;
    });

    document.getElementById('clearBtn').addEventListener('click', function () {
        Swal.fire({
            icon: 'error',
            title: 'Firma eliminada',
            text: 'Campo sin firma'
        })
        context.clearRect(0, 0, canvas.width, canvas.height);
    });

    document.getElementById('saveBtn').addEventListener('click', function () {
        Swal.fire({
            icon: 'success',
            title: 'Firma guardada',
            text: 'Tu firma ya está preparada'
        });

        // Obtener la firma como imagen base64
        var signatureImage = canvas.toDataURL();

        // Establecer la firma en la plantilla HTML
        document.getElementById('firma').src = signatureImage;
    });

    var btnSubmitCreate = document.getElementById('btnSubmitCreate');
    btnSubmitCreate.addEventListener('click', function () {

        var signatureImage = canvas.toDataURL();

        var data = {
            nombre: document.getElementById('nombre').value,
            // filteredManagement: filteredManagement,
            // filteredTreatment: filteredTreatment,
            // structures: structures,
            // token: token,
            // patient_id: patient_id,
            // management_id: management_id,
            signatureImage: signatureImage,
        }


        showLoadingAlert()
        $(this).prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> CARGANDO...'
        ).addClass('btn btn-secondary');

        axios.post('../presentacion/pdf_ci.php', data)
            .then(response => {
                console.log(response)
                if (response.data.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: response.data.title,
                        text: response.data.message
                    }).then(() => {
                        window.location = "/"
                    })
                }
            })
            .catch(error => {
                console.log(error)
                Swal.fire({
                    icon: 'error',
                    title: "Error en el servidor",
                    text: "Por favor intenta más tarde"
                })
            });
    })

    function showLoadingAlert() {
        Swal.fire({
            type: 'info',
            html: '<span class="iconify me-3" data-icon="line-md:uploading-loop" data-width="150" style="color: rgb(87, 24, 176)"></span><span class="fw-bold h3">Cargando...</span>',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false
        });
    }