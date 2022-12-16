<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/validar_campos_evento_adverso.js"></script>
    <style>
        .titulos {
            background-color: #848484;
            font-family: Tahoma, Geneva, sans-serif;
            color: #FFF;
        }

        .obli {
            color: #ff0000;
        }

        .texto {
            font-weight: lighter;
            text-align: justify;
        }

        th {
            width: 25%;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
        }

        input[type=text] {
            width: 40%;
            height: 17px;
        }

        input[type=date] {
            width: 40%;
        }

        .btn_registrar {
            padding-top: 2%;
            background-image: url(imagenes/BTN_CONTINUAR2.png);
            background-image: url(../presentacion/imagenes/BTN_CONTINUAR2.png);
            background-repeat: no-repeat;
            width: 152px;
            height: 37px;
            color: transparent;
            background-color: transparent;
            border-radius: 5px;
            border: 1px solid transparent;
        }

        .btn_registrar:active {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
                inset 0px 0px 20px #EEECEC;
        }

        .btn_registrar:hover {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
                inset 0px 0px 20px #EEECEC;
        }

        .letra {
            font-family: Tahoma, Geneva, sans-serif;
        }
    </style>
    <script>
        function trat_previo(sel) {
            if (sel.value == "Muerte") {
                divC = document.getElementById("fecha_muerte_id");
                divC.style.display = "";
            }
            if (sel.value != "Muerte") {
                divC = document.getElementById("fecha_muerte_id");
                divC.style.display = "none";
            }
        }
    </script>
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
include('../logica/consulta_ea.php');
$ID_PACIENTE = base64_decode($xnfgti);
$ID_GESTION = base64_decode($artget);
if ($privilegios != '' && $usua != '') {
    $SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_usuario WHERE USER = '" . $usua . "'");
    while ($opcion = mysqli_fetch_array($SELECT_USUARIO_TOTAL)) {
        $NOMBRES = $opcion['NOMBRES'];
        $APELLIDOS = $opcion['APELLIDOS'];
        $EMAIL = $opcion['EMAIL'];
    }
    $Seleccion = mysqli_query($conex, "SELECT * FROM `ipsen_pacientes` WHERE ID_PACIENTE = '" . $ID_PACIENTE . "'");
    while ($fila = mysqli_fetch_array($Seleccion)) {
        $ID_PACIENTE2 = $fila['ID_PACIENTE'];
        $EDAD = $fila['EDAD_PACIENTE'];
        $TIPO_IDENTIFICACION_PACIENTE = $fila['TIPO_IDENTIFICACION_PACIENTE'];
        $IDENTIFICACION_PACIENTE = $fila['IDENTIFICACION_PACIENTE'];
        $FECHA_NACIMIENTO = $fila['FECHA_NACIMINETO_PACIENTE'];
        $GENERO_PACIENTE = $fila['GENERO_PACIENTE'];
    }

?>

    <body>
        <form id="evento_adverso" name="evento_adverso" action="../logica/insertar_datos_ea.php" enctype="multipart/form-data" method="post" class="letra">
            <center>
                <table style="width:80%; border:1px solid #000;" rules="all">
                    <tr>
                        <th class="titulos" colspan="4">
                            1. INFORMACIÓN DEL REPORTANTE
                        </th>
                    </tr>
                    <input type="text" name="ID_PACIENTE" id="ID_PACIENTE" value="<?php echo $ID_PACIENTE2 ?>" readonly="readonly" style="display:none;">
                    <tr colspan="4">
                        <th>
                            Fecha de Notificacion<span class="obli">*</span><br><br>
                            <input type="date" name="fecha_notificacion" id="fecha_notificacion" style="width:90%; height:100%;">
                        </th>
                        <th>Origen del reporte
                            <hr>
                            Departamento - Municipio<span class="obli">*</span><br /><br>
                            <input type="text" name="departamento" id="departamento"> - <input type="text" name="municipio" id="municipio">
                        </th>
                        <th>
                            Nombre de la Institución donde ocurri&oacute; el evento<span class="obli">*</span><br /><br>
                            <input type="text" name="institucion_evento" id="institucion_evento" style="width:90%; height:100%;">
                        </th>
                        <th>
                            C&oacute;digo PNF<span class="obli">*</span><br /><br>
                            <input type="text" name="codigo_pnf" id="codigo_pnf" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr colspan="4">
                        <th colspan="2">
                            Nombre del Reportante primario<span class="obli">*</span><br /><br>
                            <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo $NOMBRES . ' ' . $APELLIDOS ?>" readonly="readonly" style="width:90%; height:100%;"><br>
                        </th>
                        <th>
                            Profesi&oacute;n del reportante primario <span class="obli">*</span><br><br>
                            <input type="text" name="profecion_usuario" id="profecion_usuario" style="width:90%; height:100%;">
                        </th>
                        <th>
                            Correo electr&oacute;nico institucional del reportante primario <span class="obli">*</span><br /><br>
                            <input type="email" name="correo_usuario" id="correo_usuario" value="<?php echo $EMAIL ?>" readonly="readonly" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th class="titulos" colspan="4">
                            2. INFORMACIÓN DEL PACIENTE
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Fecha de nacimiento del paciente <span class="obli">*</span><br><br>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $FECHA_NACIMIENTO ?>" readonly="readonly" style="width:90%; height:100%;">
                        </th>
                        <th>
                            Edad del paciente en el momento del EA
                            <hr>
                            Edad<span class="obli">*</span><br /><br>
                            <input type="number" name="edad_paciente" id="edad_paciente" value="<?php echo $EDAD ?>" readonly="readonly" style="width:90%; height:100%;">
                        </th>
                        <th>
                            Tipo de identificación - Número de identificación del paciente<span class="obli">*</span><br><br>
                            <input type="text" name="tipo_documento_paciente" id="tipo_documento_paciente" value="<?php echo $TIPO_IDENTIFICACION_PACIENTE ?>" readonly="readonly"> - <input type="text" name="documento_paciente" id="documento_paciente" value="<?php echo $IDENTIFICACION_PACIENTE ?>" readonly="readonly">
                        </th>
                        <th>
                            Iniciales del paciente<span class="obli">*</span><br><br>
                            <input type="text" name="iniciales_pa" id="iniciales_pa" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Sexo<span class="obli">*</span><br><br>
                            <input type="text" name="genero" id="genero" value="<?php echo $GENERO_PACIENTE ?>" readonly="readonly" style="width:90%; height:100%;">
                        </th>
                        <th>
                            Peso - Talla<span class="obli">*</span><br><br>
                            <input type="text" name="peso" id="peso"> - <input type="text" name="talla" id="talla">
                        </th>
                        <th colspan="2">
                            Diagnóstico principal y otros diagnósticos:<span class="obli">*</span><br><br>
                            <textarea name="diagnostico" id="diagnostico" cols="95" rows="5"></textarea>
                        </th>
                    </tr>
                    <tr>
                        <th class="titulos" colspan="4">
                            3. INFORMACIÓN DE LOS MEDICAMENTOS
                            <P>Registre todos los medicamentos utilizados y marque con una <span style="color:#000">(S)</span> el (los) sospechoso(s), con una <span style="color:#000">(C)</span> el (los) concomitantes y con una <span style="color:#000">(I)</span> las interacciones. </P>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            S/C/I<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="text" name="S_C_I1" id="S_C_I1" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="S_C_I2" id="S_C_I2" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="S_C_I3" id="S_C_I3" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            Medicamento (Denominación Común Internacional o Nombre genérico) <span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="text" name="medicamento1" id="medicamento1" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="medicamento2" id="medicamento2" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="medicamento3" id="medicamento3" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            Indicación<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="text" name="indicacion1" id="indicacion1" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="indicacion2" id="indicacion2" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="indicacion3" id="indicacion3" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            Dosis<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="text" name="dosis1" id="dosis1" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="dosis2" id="dosis2" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="dosis3" id="dosis3" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            Unidad de medida<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="text" name="unidad_medida1" id="unidad_medida1" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="unidad_medida2" id="unidad_medida2" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="unidad_medida3" id="unidad_medida3" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            Vía de administración<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="text" name="via_administracion1" id="via_administracion1" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="via_administracion2" id="via_administracion2" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="via_administracion3" id="via_administracion3" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            Frecuencia de administración<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="text" name="frecuencia_administracion1" id="frecuencia_administracion1" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="frecuencia_administracion2" id="frecuencia_administracion2" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="text" name="frecuencia_administracion3" id="frecuencia_administracion3" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            Fecha inicio<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="date" name="fecha_inicio1" id="fecha_inicio1" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="date" name="fecha_inicio2" id="fecha_inicio2" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="date" name="fecha_inicio3" id="fecha_inicio3" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            Fecha de finalización<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="date" name="fecha_fin1" id="fecha_fin1" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="date" name="fecha_fin2" id="fecha_fin2" style="width:90%; height:100%;">
                        </th>
                        <th>
                            <input type="date" name="fecha_fin3" id="fecha_fin3" style="width:90%; height:100%;">
                        </th>
                    </tr>
                    <tr>
                        <th class="titulos" colspan="4">
                            4. INFORMACIÓN DEL EVENTO ADVERSO
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            Fecha de Inicio del Evento Adverso:<span class="obli">*</span><br /><br>
                            <input type="date" name="fecha_ini_evento" id="fecha_ini_evento">
                        </th>
                        <th colspan="2">
                            Evento adverso:<span class="obli">*</span><br><br>
                            <textarea name="evento_adverso" id="evento_adverso" cols="95" rows="5"></textarea>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            Descripción y análisis del Evento Adverso:<span class="obli">*</span><br /><br>
                            <textarea name="descripcion_evento" id="descripcion_evento" cols="95" rows="5"></textarea>
                        </th>
                        <th>
                            Desenlace del evento (Marcar con una X)<span class="obli">*</span><br />
                            <hr>
                            <div style="text-align: left;">
                                <input type="radio" name="desenlace_evento" id="desenlace_evento" style=" width:20%; display:none" value="">
                                <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Recuperado / Resuelto sin secuelas"> Recuperado / Resuelto sin secuelas <br>
                                <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Recuperado / Resuelto con secuelas"> Recuperado / Resuelto con secuelas <br>
                                <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Recuperando / Resolviendo"> Recuperando / Resolviendo <br>
                                <input type="radio" name="desenlace_evento" id="desenlace_evento" value="No recuperado / No resuelto"> No recuperado / No resuelto <br>
                                <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Fatal"> Fatal <br>
                                <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Desconocido"> Desconocido
                            </div>
                        </th>
                        <th>
                            Seriedad (Marcar con X)<span class="obli">*</span><br />
                            <hr>
                            <div style="text-align: left;">
                                <input type="radio" name="seriedad" id="seriedad" style=" width:20%; display:none">
                                <input type="radio" name="seriedad" id="seriedad" value="Produjo o prolongo hospitalizacion" onchange="trat_previo(this)"> Produjo o prolongó hospitalización <br>
                                <input type="radio" name="seriedad" id="seriedad" value="Anomalia congenita" onchange="trat_previo(this)"> Anomalía congénita <br>
                                <input type="radio" name="seriedad" id="seriedad" value="Amenaza de vida" onchange="trat_previo(this)"> Amenaza de vida <br>
                                <input type="radio" name="seriedad" id="seriedad" value="Muerte" onchange="trat_previo(this)"> Muerte
                                <div id="fecha_muerte_id" style="display: none;"> Fecha Muerte:<span class="obli">*</span><input type="date" name="fecha_muerte" id="fecha_muerte"></div><br>
                                <input type="radio" name="seriedad" id="seriedad" value="Produjo discapacidad o incapacidad permanente / condicion medica importante" onchange="trat_previo(this)"> Produjo discapacidad o incapacidad permanente / condición médica importante <br>
                            </div>
                        </th>
                    </tr>
                    <tr colspan="4">
                        <th colspan="1">
                        </th>
                        <th colspan="1" class="titulos">
                            SI
                        </th>
                        <th colspan="1" class="titulos">
                            NO
                        </th>
                        <th colspan="1" class="titulos">
                            NO SABE
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿El evento se presentó después de administrar el medicamento?<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="radio" name="pregunta1" id="pregunta1" value="SI"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta1" id="pregunta1" value="NO"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta1" id="pregunta1" value="NO SEBE"> <br>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿Existen otros factores que puedan explicar el evento (medicamento, patologías, etc.)?<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="radio" name="pregunta2" id="pregunta2" value="SI"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta2" id="pregunta2" value="NO"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta2" id="pregunta2" value="NO SABE"> <br>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿El evento desapareció al disminuir o suspender el medicamento sospechoso?<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="radio" name="pregunta3" id="pregunta3" value="SI"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta3" id="pregunta3" value="NO"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta3" id="pregunta3" value="NO SABE"> <br>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿El paciente ya había presentado la misma reacción al medicamento sospechoso?<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="radio" name="pregunta4" id="pregunta4" value="SI"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta4" id="pregunta4" value="NO"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta4" id="pregunta4" value="NO SABE"> <br>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">
                            ¿Se puede ampliar la información del paciente relacionando con el evento?<span class="obli">*</span><br />
                        </th>
                        <th>
                            <input type="radio" name="pregunta5" id="pregunta5" value="SI"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta5" id="pregunta5" value="NO"> <br>
                        </th>
                        <th>
                            <input type="radio" name="pregunta5" id="pregunta5" value="NO SABE"> <br>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <br />
                            <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(evento_adverso,1);this.disabled=true" />
                            <br />
                        </th>
                    </tr>
                </table>
            </center>
        </form>
    </body>
<?php
} else {
?>
    <script type="text/javascript">
        window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
    </script>-
<?php
}
?>

</html>