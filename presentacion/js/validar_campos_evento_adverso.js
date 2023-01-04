function validar(tuformulario, val) {

    // var FECHA_NOTIFICACION = $('#fecha_notificacion').val();
    // if (FECHA_NOTIFICACION == '') {
    //     alert('La fecha notificacion esta vacia');
    //     $('#fecha_notificacion').focus();
    //     return false;
    // }

    var DEPARTAMENTO = $('#departamento').val();
    if (DEPARTAMENTO == '') {
        alert('El departamento esta vacio');
        $('#departamento').focus();
        return false;
    }

    var MUNICIPIO = $('#municipio').val();
    if (MUNICIPIO == '') {
        alert('El municipio esta vacio');
        $('#municipio').focus();
        return false;
    }

    var INSTITUCION = $('#institucion_evento').val();
    if (INSTITUCION == '') {
        alert('La institucion esta vacia');
        $('#institucion_evento');
        return false;
    }

    var CODIGO_PNF = $('#codigo_pnf').val();
    if (CODIGO_PNF == '') {
        alert('El codigo pnf esta vacio');
        $('#codigo_pnf');
        return false;
    }

    var PROFESION = $('#profecion_usuario').val();
    if (PROFESION == '') {
        alert('La profesion esta vacia');
        $('#profecion_usuario');
        return false;
    }

    var INICIALES = $('#iniciales_pa').val();
    if (INICIALES == '') {
        alert('Las iniciales del paciente estan vacias');
        $('#iniciales_pa');
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

    var SCI = $('#S_C_I1').val();
    if (SCI == '') {
        alert('El SCI esta vacio');
        $('#S_C_I1');
        return false;
    }

    var MEDICAMENTO = $('#medicamento1').val();
    if (MEDICAMENTO == '') {
        alert('El medicamento esta vacio');
        $('#medicamento1');
        return false;
    }

    var INDICACION = $('#indicacion1').val();
    if (INDICACION == '') {
        alert('La indicacion esta vacia');
        $('#indicacion1');
        return false;
    }

    var DOSIS = $('#dosis1').val();
    if (DOSIS == '') {
        alert('La dosis esta vacia');
        $('#dosis1');
        return false;
    }

    var UNIDAD_MEDIDA = $('#unidad_medida1').val();
    if (UNIDAD_MEDIDA == '') {
        alert('La unidad de medida esta vacia');
        $('#unidad_medida1');
        return false;
    }

    var VIA_ADMINISTRACION = $('#via_administracion1').val();
    if (VIA_ADMINISTRACION == '') {
        alert('La via de administracion esta vacia');
        $('#via_administracion1');
        return false;
    }

    var FRECUENCIA_ADMINISTRACION = $('#frecuencia_administracion1').val();
    if (FRECUENCIA_ADMINISTRACION == '') {
        alert('La frecuencia de administracion esta vacia');
        $('#frecuencia_administracion1');
        return false;
    }

    // var FECHA_INICIO = $('#fecha_inicio1').val();
    // if (FECHA_INICIO == '') {
    //     alert('La fecha de inicio esta vacia');
    //     $('#fecha_inicio1');
    //     return false;
    // }

    // var FECHA_FIN = $('#fecha_fin1').val();
    // if (FECHA_FIN == '') {
    //     alert('La fecha de finalizacion esta vacia');
    //     $('#fecha_fin1');
    //     return false;
    // }

    // var FECHA_INICIO_EVENTO = $('#fecha_ini_evento').val();
    // if (FECHA_INICIO_EVENTO == '') {
    //     alert('La fecha de inicio del evento esta vacia');
    //     $('#fecha_ini_evento');
    //     return false;
    // }

    // var EVENTO_ADVERSO = $('#evento_adverso').val();
    // if (EVENTO_ADVERSO == '') {
    //     alert('El evento adverso esta vacio');
    //     $('#evento_adverso');
    //     return false;
    // }

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