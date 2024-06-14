function validar(tuformulario, val) {
    var INSTITUCION = $('#institucion_evento').val();
    if (INSTITUCION == '') {
        alert('La institucion esta vacia');
        $('#institucion_evento');
        return false;
    }

    var PROFESION = $('#profecion_usuario').val();
    if (PROFESION == '') {
        alert('La profesion esta vacia');
        $('#profecion_usuario');
        return false;
    }

    var PESO = $('#peso').val();
    if (PESO == '') {
        alert('El peso esta vacio');
        $('#peso');
        return false;
    }

    var TALLA = $('#talla').val();
    if (TALLA == '') {
        alert('La talla esta vacia');
        $('#talla');
        return false;
    }

    var DIAGNOSTICO = $('#diagnostico').val();
    if (DIAGNOSTICO == '') {
        alert('El diagnostico esta vacio');
        $('#diagnostico');
        return false;
    }

    var SCI = $('#S_C_I').val();
    if (SCI == '') {
        alert('El SCI esta vacio');
        $('#S_C_I');
        return false;
    }

    var MEDICAMENTO = $('#medicamento').val();
    if (MEDICAMENTO == '') {
        alert('El medicamento esta vacio');
        $('#medicamento');
        return false;
    }

    var INDICACION = $('#indicacion').val();
    if (INDICACION == '') {
        alert('La indicacion esta vacia');
        $('#indicacion');
        return false;
    }

    var DOSIS = $('#dosis').val();
    if (DOSIS == '') {
        alert('La dosis esta vacia');
        $('#dosis');
        return false;
    }

    var UNIDAD_MEDIDA = $('#unidad_medida').val();
    if (UNIDAD_MEDIDA == '') {
        alert('La unidad de medida esta vacia');
        $('#unidad_medida');
        return false;
    }

    var VIA_ADMINISTRACION = $('#via_administracion').val();
    if (VIA_ADMINISTRACION == '') {
        alert('La via de administracion esta vacia');
        $('#via_administracion');
        return false;
    }

    var FRECUENCIA_ADMINISTRACION = $('#frecuencia_administracion').val();
    if (FRECUENCIA_ADMINISTRACION == '') {
        alert('La frecuencia de administracion esta vacia');
        $('#frecuencia_administracion');
        return false;
    }

    var DESCRIPCION_EVENTO = $('#descripcion_evento').val();
    if (DESCRIPCION_EVENTO == '') {
        alert('La descripcion del evento esta vacia');
        $('#descripcion_evento');
        return false;
    }

    if ($('input[name="desenlace_evento"]').is(':checked')) {
    } else {
        alert('Se debe seleccionar un desenlace del evento');
        return false;
    }

    if ($('input[name="seriedad"]').is(':checked')) {
    } else {
        alert('Se debe seleccionar una seriedad');
        return false;
    }

    if ($('input[name="pregunta1"]').is(':checked')) {
    } else {
        alert('Responde la pregunta: ¿El evento se presento despues de administrar el medicamento?');
        return false;
    }

    if ($('input[name="pregunta2"]').is(':checked')) {
    } else {
        alert('Responde la pregunta: ¿Existen otros factores que puedan explicar el evento (medicamento, patologías, etc.)?');
        return false;
    }

    if ($('input[name="pregunta3"]').is(':checked')) {
    } else {
        alert('Responde la pregunta: ¿El evento desapareció al disminuir o suspender el medicamento sospechoso?');
        return false;
    }

    if ($('input[name="pregunta4"]').is(':checked')) {
    } else {
        alert('Responde la pregunta: ¿El paciente ya había presentado la misma reacción al medicamento sospechoso?');
        return false;
    }

    if ($('input[name="pregunta5"]').is(':checked')) {
    } else {
        alert('Responde la pregunta: ¿Se puede ampliar la información del paciente relacionando con el evento?');
        return false;
    }
}