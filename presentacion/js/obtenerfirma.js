// plantilla_pdf.js
document.addEventListener('DOMContentLoaded', function () {
    // Obtener la firma del almacenamiento local
    var dataURL = localStorage.getItem('firma');

    // Si hay una firma guardada
    if (dataURL) {
        // Crear un nuevo objeto jsPDF
        var doc = new jsPDF();

        // Añadir la firma al PDF
        var img = new Image();
        img.onload = function () {
            doc.addImage(this, 'PNG', 10, 10, 100, 50);
        };
        img.src = dataURL;

        // Mostrar la firma en el contenedor
        var firmaContainer = document.getElementById('firmaContainer');
        firmaContainer.innerHTML = '<img src="' + dataURL + '" />';
    }
});