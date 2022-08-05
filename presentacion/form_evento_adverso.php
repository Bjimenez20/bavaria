<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <style>
        .titulos {
            background-color: #ececec;
            font-family: Tahoma, Geneva, sans-serif;
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
            width: 50%;
            height: 17px;
        }

        input[type=date] {
            width: 50%;
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
</head>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
if (isset($codigo_usuario2)) {
    echo $ID_PACIENTE = $codigo_usuario2;
}
if (isset($ID_PACIENTE)) {
    echo $ID_PACIENTE = $ID_PACIENTE;
}
include('../logica/consulta_ea.php');
if ($privilegios != '' && $usua != '') {
    if ($PRIVILEGIOS == 6) {
        $COMPANIA = "GRUPO ASEI";
        $DIRECCION_COMPANIA = "Diagonal 43 No 28-41 Interior 109 Coplejo Empresarial Marandua Itag&uuml;i - Antioquia";
        $TELEFONO_COMPANIA = "(57 4)377 46 46";
    } else {
        $COMPANIA = "People Marketing S.A";
        $DIRECCION_COMPANIA = "CALLE 93 #49a - 34";
        $TELEFONO_COMPANIA = "2360042";
    }
?>

    <body>
        <form id="paciente_nuevo" name="paciente_nuevo" action="../logica/insertar_datos_ea.php" method="post" class="letra">
            <table style="width:100%; border:1px solid #000;" rules="all">
                <tr>
                    <th class="titulos" colspan="4">
                        Informaci&oacute;n General
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        PSP / CRS(Producto)<span class="obli">*</span><br />
                        <input type="text" name="PSP_PRODUCTO" id="PSP_PRODUCTO" value="<?php echo $PRODUCTO_TRATAMIENTO ?>" readonly="readonly" />
                    </th>
                    <th>
                        Pa&iacute;s<span class="obli">*</span><br />
                        <input type="text" name="PAIS" id="PAIS" value="<?php echo 'Colombia' ?>" readonly="readonly" />
                    </th>
                    <th>
                        Ciudad<span class="obli">*</span><br />
                        <input type="text" name="CIUDAD" id="CIUDAD" value="<?php echo $CIUDAD_PACIENTE ?>" readonly="readonly" />
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        Tipo de Reporte<span class="obli">*</span><br />
                        <input type="radio" name="TIPO_REPORTE" id="TIPO_REPORTE" value="inicial" />
                        <span class="texto">inicial</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="TIPO_REPORTE" id="TIPO_REPORTE" value="seguimiento" />
                        <span class="texto">seguimiento</span>
                    </th>
                    <th colspan="2">
                        Fecha cuando el staff del PSP recibe el AE/PTC/UI <span class="obli">*</span> (aplica s&oacute;lo para PSP)<br />
                        <input type="date" name="FECHA_STAFF" id="FECHA_STAFF" value="<?php echo $hoy ?>" readonly="readonly" />
                    </th>
                </tr>
                <tr>
                    <th class="titulos" colspan="4">
                        Informaci&oacute;n paciente
                    </th>
                </tr>
                <tr>
                    <th>
                        Identificaci&oacute;n paciente <span class="obli">*</span>
                        <?php echo $IDENTIFICACION_PACIENTE; ?><br /><br />
                        <span class="texto">N&uacute;mero paciente</span> <?php echo 'PA' . $ID_PACIENTE; ?><br />
                        <input type="text" name="ID_PACIENTE" id="ID_PACIENTE" value="<?php echo $ID_PACIENTE; ?>" readonly="readonly" style="display:none;" />
                        <span class="texto">Nombre Completo</span> <?php echo $nombre; ?><br />
                        <span class="texto"><input type="radio" name="NO_REPORTE" id="NO_REPORTE" value="no_reporte" /> no reportado</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                    </th>
                    <th>
                        G&eacute;nero<span class="obli">*</span><br />
                        <span class="texto">
                            <?PHP
                            if ($GENERO_PACIENTE == 'Hombre') {
                            ?>
                                <input type="radio" name="GENERO" id="GENERO" value="M" checked="checked" /> masculino&nbsp;&nbsp;&nbsp;&nbsp;
                                <br />
                                <input type="radio" name="GENERO" id="GENERO" value="F" /> femenino&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <br />
                                <input type="radio" name="GENERO" id="GENERO" value="no_reporte" /> no reportado
                        </span>
                    <?PHP
                            }
                            if ($GENERO_PACIENTE == 'Mujer') {
                    ?>
                        <input type="radio" name="GENERO" id="GENERO" value="M" /> masculino&nbsp;&nbsp;&nbsp;&nbsp;
                        <br />
                        <input type="radio" name="GENERO" id="GENERO" value="F" checked="checked" /> femenino&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <br />
                        <input type="radio" name="GENERO" id="GENERO" value="no_reporte" /> no reportado
                        </span>
                    <?PHP
                            }
                            if ($GENERO_PACIENTE != 'Mujer' && $GENERO_PACIENTE != 'Hombre') {
                    ?>
                        <input type="radio" name="GENERO" id="GENERO" value="M" /> masculino&nbsp;&nbsp;&nbsp;&nbsp;
                        <br />
                        <input type="radio" name="GENERO" id="GENERO" value="F" /> femenino&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <br />
                        <input type="radio" name="GENERO" id="GENERO" value="no_reporte" checked="checked" /> no reportado
                        </span>
                    <?PHP
                            }
                    ?>
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    </th>
                    <th>
                        Fecha nacimiento
                        <br />
                        <input type="date" name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO" value="<?php echo $FECHA_NACIMINETO_PACIENTE ?>" readonly="readonly" />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                    </th>
                    <th>
                        <br />
                        <span class="texto">Para ser diligenciado en caso que<br /> paciente sea femenino
                        </span><br />Embarazo?
                        <input type="radio" name="EMBARAZO" id="EMBARAZO" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="EMBARAZO" id="EMBARAZO" value="NO" />
                        <span class="texto">NO</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="EMBARAZO" id="EMBARAZO" value="desconocido " />
                        <span class="texto">desconocido </span>
                        <br />
                        <br />
                        <span class="texto">Si es s&iacute;: </span><br />
                        Fecha esperada de parto:
                        <br />
                        <input type="date" name="FECHA_PARTO" id="FECHA_PARTO" />
                        <br />
                        <br />
                        Desenlace:
                        <input type="radio" name="DESENLACE" id="DESENLACE" value="Continua embarazada" />
                        <span class="texto">Contin&uacute;a embarazada </span>
                        <br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="DESENLACE" id="DESENLACE" value="Nacimiento vivo" />
                        <span class="texto">Nacimiento vivo</span>
                        <br />
                        <input type="radio" name="DESENLACE" id="DESENLACE" value="Aborto" />
                        <span class="texto">Aborto</span>
                        &nbsp;&nbsp;&nbsp;
                        <br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="DESENLACE" id="DESENLACE" value="Embarazo ectopico " />
                        <span class="texto">Embarazo ect&oacute;pico </span>
                        <br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="DESENLACE" id="DESENLACE" value="Embarazo ectopico " />
                        <span class="texto">Other - specify:</span>
                        <input type="text" name="Cuales" id="Cuales" />
                    </th>
                </tr>
                <tr>
                    <th colspan="2" style="text-align:left;" rowspan="4">
                        Paciente permite contacto directo de la compa&ntilde;ia con su m&eacute;dico?
                        <br />
                        <br />
                        <input type="radio" name="PERMITE_CONTACTO" id="PERMITE_CONTACTO" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="PERMITE_CONTACTO" id="PERMITE_CONTACTO" value="NO" />
                        <span class="texto">NO</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="PERMITE_CONTACTO" id="PERMITE_CONTACTO" value="NO APLICA" />
                        <span class="texto">NO APLICA</span>
                        <br />
                        <br />
                        Si lo permite, por favor informe los detalles de contacto de su m&eacute;dico
                        <br />
                        <br />
                    </th>
                    <th style="border:1px solid transparent;">
                        <span class="texto">Nombre m&eacute;dico</span>
                        <br />
                    </th>
                    <th align="left" style="border:1px solid transparent; border-right:1px solid #000;">
                        <input type="text" name="NOMBRE_MEDICO" id="NOMBRE_MEDICO" value="<?php echo $MEDICO_TRATAMIENTO ?>" style="margin-left:5%; width:80%;" />
                        <br />
                    </th>
                </tr>
                <tr style="border:1px solid transparent;">
                    <th>
                        <span class="texto">Tel&eacute;fono</span>
                        <br />
                    </th>
                    <th align="left" style="border:1px solid transparent; border-right:1px solid #000;">
                        <input type="text" name="TELEFONO_MEDICO" id="TELEFONO_MEDICO" style="margin-left:5%;width:80%;" />
                        <br />
                    </th>
                </tr>
                <tr style="border:1px solid transparent;">
                    <th>
                        <span class="texto">Fax</span>
                        <br />
                    </th>
                    <th align="left" style="border:1px solid transparent; border-right:1px solid #000;">
                        <input type="text" name="FAX_MEDICO" id="FAX_MEDICO" style="margin-left:5%; width:80%;" />
                        <br />
                    </th>
                </tr>
                <tr style="border:1px solid transparent;">
                    <th>
                        <span class="texto">Correo electr&oacute;nico</span>
                    </th>
                    <th align="left" style="border:1px solid transparent; border-right:1px solid #000;">
                        <input type="text" name="EMAIL_MEDICO" id="EMAIL_MEDICO" style="margin-left:5%; width:80%;" />
                    </th>
                </tr>
                <tr>
                    <th class="titulos" colspan="4">
                        Informaci&oacute;n producto m&eacute;dico sospechoso Bayer (medicamento/dispositivo m&eacute;dico/ cosm&eacute;tico/ suplemento) <span class="obli">*</span>
                    </th>
                </tr>
                <tr>
                    <th>Nombre comercial / Gen&eacute;rico <span class="obli">*</span></th>
                    <th>1. <input name="MEDICAMENTO1" id="meidcamento1" /></th>
                    <th>2.<input name="MEDICAMENTO2" id="meidcamento2" /></th>
                    <th>3.<input name="MEDICAMENTO3" id="meidcamento3" /></th>
                </tr>
                <tr>
                    <th>Indicaci&oacute;n</th>
                    <th><textarea name="INDICACION1" id="INDICACION1" style="width:90%; height:100%;"></textarea></th>
                    <th><textarea name="INDICACION2" id="INDICACION2" style="width:90%; height:100%;"></textarea></th>
                    <th><textarea name="INDICACION3" id="INDICACION3" style="width:90%; height:100%;"></textarea></th>
                </tr>
                <tr>
                    <th>Formulaci&oacute;n</th>
                    <th><textarea name="FORMULACION1" id="FORMULACION1" style="width:90%; height:100%;"></textarea></th>
                    <th><textarea name="FORMULACION2" id="FORMULACION2" style="width:90%; height:100%;"></textarea></th>
                    <th><textarea name="FORMULACION3" id="FORMULACION3" style="width:90%; height:100%;"></textarea></th>
                </tr>
                <tr>
                    <th>R&eacute;gimen de dosis</th>
                    <th><textarea name="REGIMEN_DOSIS1" id="REGIMEN_DOSIS1" style="width:90%; height:100%;"></textarea></th>
                    <th><textarea name="REGIMEN_DOSIS2" id="REGIMEN_DOSIS2" style="width:90%; height:100%;"></textarea></th>
                    <th><textarea name="REGIMEN_DOSIS3" id="REGIMEN_DOSIS3" style="width:90%; height:100%;"></textarea></th>
                </tr>
                <tr>
                    <th>Ruta de administraci&oacute;n</th>
                    <th><textarea name="RUTA_ADMINISTRACION1" id="RUTA_ADMINISTRACION1" style="width:90%; height:100%;"></textarea></th>
                    <th><textarea name="RUTA_ADMINISTRACION2" id="RUTA_ADMINISTRACION2" style="width:90%; height:100%;"></textarea></th>
                    <th><textarea name="RUTA_ADMINISTRACION3" id="RUTA_ADMINISTRACION3" style="width:90%; height:100%;"></textarea></th>
                </tr>
                <tr>
                    <th>N&uacute;mero de lote <span class="obli">*</span></th>
                    <th><input type="text" name="NUMERO_LOTE1" id="NUMERO_LOTE1" maxlength="16" /></th>
                    <th><input type="text" name="NUMERO_LOTE2" id="NUMERO_LOTE2" maxlength="16" /></th>
                    <th><input type="text" name="NUMERO_LOTE3" id="NUMERO_LOTE3" maxlength="16" /></th>
                </tr>
                <tr>
                    <th>Fecha de expiraci&oacute;n</th>
                    <th><input type="date" name="FECHA_EXPIRACION1" id="FECHA_EXPIRACION1" /></th>
                    <th><input type="date" name="FECHA_EXPIRACION2" id="FECHA_EXPIRACION2" /></th>
                    <th><input type="date" name="FECHA_EXPIRACION3" id="FECHA_EXPIRACION3" /></th>
                </tr>
                <tr>
                    <th>
                        Fecha inicio <span class="obli">*</span><br />
                        <span class="texto">(dd/mmm/aaaa)</span>
                    </th>
                    <th>
                        <input type="date" name="FECHA_INICIO1" id="FECHA_INICIO1" />
                    </th>
                    <th>
                        <input type="date" name="FECHA_INICIO2" id="FECHA_INICIO2" />
                    </th>
                    <th>
                        <input type="date" name="FECHA_INICIO3" id="FECHA_INICIO3" />
                    </th>
                </tr>
                <tr>
                    <th>
                        Tratamiento contin&uacute;o? <span class="obli">*</span><br />
                    </th>
                    <th>
                        <input type="radio" name="TRATAMIENTO_CONTINUA1" id="TRATAMIENTO_CONTINUA1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="TRATAMIENTO_CONTINUA1" id="TRATAMIENTO_CONTINUA1" value="NO" />
                        <span class="texto">NO</span>
                        <br />
                        <br />
                        <span class="texto">Si es No, fecha de <br />suspensi&oacute;n:</span>
                        <br />
                        <input type="date" name="FECHA_SUSPENCION1" id="FECHA_SUSPENCION1" />
                    </th>
                    <th>
                        <input type="radio" name="TRATAMIENTO_CONTINUA2" id="TRATAMIENTO_CONTINUA2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="TRATAMIENTO_CONTINUA2" id="TRATAMIENTO_CONTINUA2" value="NO" />
                        <span class="texto">NO</span>
                        <br />
                        <br />
                        <span class="texto">Si es No, fecha de <br />suspensi&oacute;n:</span>
                        <br />
                        <input type="date" name="FECHA_SUSPENCION2" id="FECHA_SUSPENCION2" />
                    </th>
                    <th>
                        <input type="radio" name="TRATAMIENTO_CONTINUA3" id="TRATAMIENTO_CONTINUA3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="TRATAMIENTO_CONTINUA3" id="TRATAMIENTO_CONTINUA3" value="NO" />
                        <span class="texto">NO</span>
                        <br />
                        <br />
                        <span class="texto">Si es No, fecha de<br /> suspensi&oacute;n:</span>
                        <br />
                        <input type="date" name="FECHA_SUSPENCION3" id="FECHA_SUSPENCION3" />
                    </th>
                </tr>
                <tr>
                    <th>
                        En caso de PTC, esta la muestra disponible?
                    </th>
                    <th colspan="3" style="text-align:left;">
                        <input type="radio" name="MUESTRA_DISPONIBLE" id="MUESTRA_DISPONIBLE" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="MUESTRA_DISPONIBLE" id="MUESTRA_DISPONIBLE" value="NO" />
                        <span class="texto">NO</span>
                        <br />
                        <span class="texto">En caso de S&iacute;, por favor indique informaci&oacute;n de contacto para recoger la muestra:</span><br />
                        <textarea name="INFORMACION_MUESTRA" id="INFORMACION_MUESTRA" style="width:99%;" rows="5"></textarea>
                    </th>
                </tr>
                <tr>
                    <th class="titulos" colspan="4">
                        Informaci&oacute;n de Evento Adverso / Reclamo T&eacute;cnico de Producto / Problemas de Uso
                    </th>
                </tr>
                <tr>
                    <th>AE / PTC / UI <span class="obli">*</span></th>
                    <th>1.<textarea name="INFORMACION_EA1" id="INFORMACION_EA1" style="width:90%; height:100%;"></textarea></th>
                    <th>2.<textarea name="INFORMACION_EA2" id="INFORMACION_EA2" style="width:90%; height:100%;"></textarea></th>
                    <th>3.<textarea name="INFORMACION_EA3" id="INFORMACION_EA3" style="width:90%; height:100%;"></textarea></th>
                </tr>
                <tr>
                    <th>Relacionado al medicamento sospechoso (si aplica) **</th>
                    <th>
                        <input type="radio" name="RELACION_MEDICAMENTO1" id="RELACION_MEDICAMENTO1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACION_MEDICAMENTO1" id="RELACION_MEDICAMENTO1" value="NO" />
                        <span class="texto">NO</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACION_MEDICAMENTO1" id="RELACION_MEDICAMENTO1" value="NO REPORTA" />
                        <span class="texto">NO REPORTA</span>
                        <br />
                    </th>
                    <th>
                        <input type="radio" name="RELACION_MEDICAMENTO2" id="RELACION_MEDICAMENTO2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACION_MEDICAMENTO2" id="RELACION_MEDICAMENTO2" value="NO" />
                        <span class="texto">NO</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACION_MEDICAMENTO2" id="RELACION_MEDICAMENTO2" value="NO REPORTA" />
                        <span class="texto">NO REPORTA</span>
                        <br />
                    </th>
                    <th>
                        <input type="radio" name="RELACION_MEDICAMENTO3" id="RELACION_MEDICAMENTO3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACION_MEDICAMENTO3" id="RELACION_MEDICAMENTO3" value="NO" />
                        <span class="texto">NO</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACION_MEDICAMENTO3" id="RELACION_MEDICAMENTO3" value="NO REPORTA" />
                        <span class="texto">NO REPORTA</span>
                        <br />
                    </th>
                </tr>
                <tr>
                    <th>Relacionado al dispositivo sospechoso (si aplica) **</th>
                    <th>
                        <input type="radio" name="RELACIONADO_DISPOSITIVO1" id="RELACIONADO_DISPOSITIVO1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACIONADO_DISPOSITIVO1" id="RELACIONADO_DISPOSITIVO1" value="NO" />
                        <span class="texto">NO</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACIONADO_DISPOSITIVO1" id="RELACIONADO_DISPOSITIVO1" value="NO REPORTA" />
                        <span class="texto">NO REPORTA</span>
                        <br />
                    </th>
                    <th>
                        <input type="radio" name="RELACIONADO_DISPOSITIVO2" id="RELACIONADO_DISPOSITIVO2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACIONADO_DISPOSITIVO2" id="RELACIONADO_DISPOSITIVO2" value="NO" />
                        <span class="texto">NO</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACIONADO_DISPOSITIVO2" id="RELACIONADO_DISPOSITIVO2" value="NO REPORTA" />
                        <span class="texto">NO REPORTA</span>
                        <br />
                    </th>
                    <th>
                        <input type="radio" name="RELACIONADO_DISPOSITIVO3" id="RELACIONADO_DISPOSITIVO3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACIONADO_DISPOSITIVO3" id="RELACIONADO_DISPOSITIVO3" value="NO" />
                        <span class="texto">NO</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="RELACIONADO_DISPOSITIVO3" id="RELACIONADO_DISPOSITIVO3" value="NO REPORTA" />
                        <span class="texto">NO REPORTA</span>
                        <br />
                    </th>
                </tr>
                <tr>
                    <th>Fecha de inicio del evento <span class="obli">*</span><br />
                        <span class="texto">(dd/mmm/aaaa)</span>
                    </th>
                    <th><input type="date" name="FECHA_INICIO_EVENTO1" id="FECHA_INICIO_EVENTO1" /></th>
                    <th><input type="date" name="FECHA_INICIO_EVENTO2" id="FECHA_INICIO_EVENTO2" /></th>
                    <th><input type="date" name="FECHA_INICIO_EVENTO3" id="FECHA_INICIO_EVENTO3" /></th>
                </tr>
                <tr>
                    <th>
                        Desenlace <span class="obli">*</span><br />
                        <span class="texto">(fecha en dd/mmm/aaaa)</span>
                    </th>
                    <th>
                        <input type="radio" name="DESENLACE1" id="DESENLACE1" value="recuperado " />
                        <span class="texto">recuperado </span><br />
                        <span class="texto">Fecha de recuperaci&oacute;n</span><br />
                        <input type="date" name="FECHA_RECUPERACION1" id="FECHA_RECUPERACION1" /><br />
                        <input type="radio" name="DESENLACE1" id="DESENLACE1" value="recuperandose" />
                        <span class="texto">recuperandose </span><br />
                        <input type="radio" name="DESENLACE1" id="DESENLACE1" value="no recuperado / continua" />
                        <span class="texto">no recuperado / continua </span><br />
                        <input type="radio" name="DESENLACE1" id="DESENLACE1" value="fatal" />
                        <span class="texto">fatal </span><br />
                        <span class="texto">Fecha de la muerte </span><br />
                        <input type="date" name="FECHA_MUERTE1" id="FECHA_MUERTE1" /><br />
                        <input type="radio" name="DESENLACE1" id="DESENLACE1" value=" desconocido" />
                        <span class="texto"> desconocido </span><br />
                        <input type="radio" name="DESENLACE1" id="DESENLACE1" value="no reportado" />
                        <span class="texto">no reportado </span><br />
                    </th>
                    <th>
                        <input type="radio" name="DESENLACE2" id="DESENLACE2" value="recuperado " />
                        <span class="texto">recuperado </span><br />
                        <span class="texto">Fecha de recuperaci&oacute;n</span><br />
                        <input type="date" name="FECHA_RECUPERACION2" id="FECHA_RECUPERACION2" /><br />
                        <input type="radio" name="DESENLACE2" id="DESENLACE2" value="recuperandose" />
                        <span class="texto">recuperandose </span><br />
                        <input type="radio" name="DESENLACE2" id="DESENLACE2" value="no recuperado / continua" />
                        <span class="texto">no recuperado / continua </span><br />
                        <input type="radio" name="DESENLACE2" id="DESENLACE2" value="fatal" />
                        <span class="texto">fatal </span><br />
                        <span class="texto">Fecha de la muerte </span><br />
                        <input type="date" name="FECHA_MUERTE2" id="FECHA_MUERTE2" /><br />
                        <input type="radio" name="DESENLACE2" id="DESENLACE2" value=" desconocido" />
                        <span class="texto"> desconocido </span><br />
                        <input type="radio" name="DESENLACE2" id="DESENLACE2" value="no reportado" />
                        <span class="texto">no reportado </span><br />
                    </th>
                    <th>
                        <input type="radio" name="DESENLACE3" id="DESENLACE3" value="recuperado " />
                        <span class="texto">recuperado </span><br />
                        <span class="texto">Fecha de recuperaci&oacute;n</span><br />
                        <input type="date" name="FECHA_RECUPERACION3" id="FECHA_RECUPERACION3" /><br />
                        <input type="radio" name="DESENLACE3" id="DESENLACE3" value="recuperandose" />
                        <span class="texto">recuperandose </span><br />
                        <input type="radio" name="DESENLACE3" id="DESENLACE3" value="no recuperado / continua" />
                        <span class="texto">no recuperado / continua </span><br />
                        <input type="radio" name="DESENLACE3" id="DESENLACE3" value="fatal" />
                        <span class="texto">fatal </span><br />
                        <span class="texto">Fecha de la muerte </span><br />
                        <input type="date" name="FECHA_MUERTE3" id="FECHA_MUERTE3" /><br />
                        <input type="radio" name="DESENLACE3" id="DESENLACE3" value=" desconocido" />
                        <span class="texto"> desconocido </span><br />
                        <input type="radio" name="DESENLACE3" id="DESENLACE3" value="no reportado" />
                        <span class="texto">no reportado </span><br />
                    </th>
                </tr>
                <tr>
                    <th>
                        Criterio de seriedad del AE / PTC / UI <span class="obli">*</span>
                    </th>
                    <th>
                        <input type="radio" name="CRITERIO_SERIEDAD1" id="CRITERIO_SERIEDAD1" value="No reportado" />
                        <span class="texto"> No reportado </span><br />
                        Muerte? <br />
                        <input type="radio" name="CRITERIO_SERIEDAD_MUERTE1" id="CRITERIO_SERIEDAD_MUERTE1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_MUERTE1" id="CRITERIO_SERIEDAD_MUERTE1" value="NO" />
                        <span class="texto">NO</span><br />
                        <span class="texto"> No reportado </span><br />
                        Hospitalizaci&oacute;n?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_HOSPITALIZACION1" id="CRITERIO_SERIEDAD_HOSPITALIZACION1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_HOSPITALIZACION1" id="CRITERIO_SERIEDAD_HOSPITALIZACION1" value="NO" />
                        <span class="texto">NO</span><br />
                        Amenaza la vida?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_AMENAZA1" id="CRITERIO_SERIEDAD_AMENAZA1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_AMENAZA1" id="CRITERIO_SERIEDAD_AMENAZA1" value="NO" />
                        <span class="texto">NO</span><br />
                        Incapacidad?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_INCAPACIDAD1" id="CRITERIO_SERIEDAD_INCAPACIDAD1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_INCAPACIDAD1" id="CRITERIO_SERIEDAD_INCAPACIDAD1" value="NO" />
                        <span class="texto">NO</span><br />
                        Anormalidad cong&eacute;nita?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_ANORMALIDAD1" id="CRITERIO_SERIEDAD_ANORMALIDAD1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_ANORMALIDAD1" id="CRITERIO_SERIEDAD_ANORMALIDAD1" value="NO" />
                        <span class="texto">NO</span><br />
                        Evento medico importante?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_EVENTO1" id="CRITERIO_SERIEDAD_EVENTO1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_EVENTO1" id="CRITERIO_SERIEDAD_EVENTO1" value="NO" />
                        <span class="texto">NO</span><br />
                        Intervenci&oacute;n m&eacute;dica o quir&uacute;rgica? (Dispositivo)<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_QUIRURGICA1" id="CRITERIO_SERIEDAD_QUIRURGICA1" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_QUIRURGICA1" id="CRITERIO_SERIEDAD_QUIRURGICA1" value="NO" />
                        <span class="texto">NO</span><br />
                        Causa de la muerte:<br />
                        <input type="text" name="CAUSA_MUERTE1" id="CAUSA_MUERTE1" />
                    </th>
                    <th>
                        <input type="radio" name="CRITERIO_SERIEDAD2" id="CRITERIO_SERIEDAD2" value="No reportado" />
                        <span class="texto"> No reportado </span><br />
                        Muerte? <br />
                        <input type="radio" name="CRITERIO_SERIEDAD_MUERTE2" id="CRITERIO_SERIEDAD_MUERTE2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_MUERTE2" id="CRITERIO_SERIEDAD_MUERTE2" value="NO" />
                        <span class="texto">NO</span><br />
                        <span class="texto"> No reportado </span><br />
                        Hospitalizaci&oacute;n?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_HOSPITALIZACION2" id="CRITERIO_SERIEDAD_HOSPITALIZACION2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_HOSPITALIZACION2" id="CRITERIO_SERIEDAD_HOSPITALIZACION2" value="NO" />
                        <span class="texto">NO</span><br />
                        Amenaza la vida?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_AMENAZA2" id="CRITERIO_SERIEDAD_AMENAZA2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_AMENAZA2" id="CRITERIO_SERIEDAD_AMENAZA2" value="NO" />
                        <span class="texto">NO</span><br />
                        Incapacidad?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_INCAPACIDAD2" id="CRITERIO_SERIEDAD_INCAPACIDAD2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_INCAPACIDAD2" id="CRITERIO_SERIEDAD_INCAPACIDAD2" value="NO" />
                        <span class="texto">NO</span><br />
                        Anormalidad cong&eacute;nita?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_ANORMALIDAD2" id="CRITERIO_SERIEDAD_ANORMALIDAD2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_ANORMALIDAD2" id="CRITERIO_SERIEDAD_ANORMALIDAD2" value="NO" />
                        <span class="texto">NO</span><br />
                        Evento medico importante?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_EVENTO2" id="CRITERIO_SERIEDAD_EVENTO2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_EVENTO2" id="CRITERIO_SERIEDAD_EVENTO2" value="NO" />
                        <span class="texto">NO</span><br />
                        Intervenci&oacute;n m&eacute;dica o quir&uacute;rgica? (Dispositivo)<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_QUIRURGICA2" id="CRITERIO_SERIEDAD_QUIRURGICA2" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_QUIRURGICA2" id="CRITERIO_SERIEDAD_QUIRURGICA2" value="NO" />
                        <span class="texto">NO</span><br />
                        Causa de la muerte:<br />
                        <input type="text" name="CAUSA_MUERTE2" id="CAUSA_MUERTE2" />
                    </th>
                    <th>
                        <input type="radio" name="CRITERIO_SERIEDAD3" id="CRITERIO_SERIEDAD3" value="No reportado" />
                        <span class="texto"> No reportado </span><br />
                        Muerte? <br />
                        <input type="radio" name="CRITERIO_SERIEDAD_MUERTE3" id="CRITERIO_SERIEDAD_MUERTE3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_MUERTE3" id="CRITERIO_SERIEDAD_MUERTE3" value="NO" />
                        <span class="texto">NO</span><br />
                        <span class="texto"> No reportado </span><br />
                        Hospitalizaci&oacute;n?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_HOSPITALIZACION3" id="CRITERIO_SERIEDAD_HOSPITALIZACION3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_HOSPITALIZACION3" id="CRITERIO_SERIEDAD_HOSPITALIZACION3" value="NO" />
                        <span class="texto">NO</span><br />
                        Amenaza la vida?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_AMENAZA3" id="CRITERIO_SERIEDAD_AMENAZA3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_AMENAZA3" id="CRITERIO_SERIEDAD_AMENAZA3" value="NO" />
                        <span class="texto">NO</span><br />
                        Incapacidad?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_INCAPACIDAD3" id="CRITERIO_SERIEDAD_INCAPACIDAD3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_INCAPACIDAD3" id="CRITERIO_SERIEDAD_INCAPACIDAD3" value="NO" />
                        <span class="texto">NO</span><br />
                        Anormalidad cong&eacute;nita?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_ANORMALIDAD3" id="CRITERIO_SERIEDAD_ANORMALIDAD3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_ANORMALIDAD3" id="CRITERIO_SERIEDAD_ANORMALIDAD3" value="NO" />
                        <span class="texto">NO</span><br />
                        Evento medico importante?<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_EVENTO3" id="CRITERIO_SERIEDAD_EVENTO3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_EVENTO3" id="CRITERIO_SERIEDAD_EVENTO3" value="NO" />
                        <span class="texto">NO</span><br />
                        Intervenci&oacute;n m&eacute;dica o quir&uacute;rgica? (Dispositivo)<br />
                        <input type="radio" name="CRITERIO_SERIEDAD_QUIRURGICA3" id="CRITERIO_SERIEDAD_QUIRURGICA3" value="SI" />
                        <span class="texto">SI</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="CRITERIO_SERIEDAD_QUIRURGICA3" id="CRITERIO_SERIEDAD_QUIRURGICA3" value="NO" />
                        <span class="texto">NO</span><br />
                        Causa de la muerte:<br />
                        <input type="text" name="CAUSA_MUERTE3" id="CAUSA_MUERTE3" />
                    </th>
                </tr>
                <tr>
                    <th>
                        Detalles del AE / PTC / UI <span class="obli">*</span>
                    </th>
                    <th>
                        <textarea name="DETALLES_EA1" id="DETALLES_EA1"></textarea>
                    </th>
                    <th>
                        <textarea name="DETALLES_EA2" id="DETALLES_EA2"></textarea>
                    </th>
                    <th>
                        <textarea name="DETALLES_EA3" id="DETALLES_EA3"></textarea>
                    </th>
                </tr>
                <tr>
                    <th class="titulos" colspan="4">
                        Informaci&oacute;n adicional (antecedentes m&eacute;dicos, explicaci&oacute;n alternativa, medicamentos concomitantes, datos de laboratorio, etc.)
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <textarea name="INFORMACION_ADICIONAL" id="INFORMACION_ADICIONAL" style="width:99%;" rows="18"></textarea>
                    </th>
                </tr>
                <tr>
                    <th class="titulos" colspan="4">
                        Informaci&oacute;n del Reportante (Staff PSP)<span class="obli">*</span>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <center>
                            <table style="width:50%; border:1px solid #000;" rules="all">
                                <tr>
                                    <th align="left" colspan="2">
                                        Nombre
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="NOMBRE_REPORTE" id="NOMBRE_REPORTE" value="<?php echo $usua ?>" style="width:80%;" / readonly="readonly">
                                    </th>
                                </tr>
                                <tr>
                                    <th align="left" style="width:40%;">
                                        Compa&ntilde;ia&nbsp;
                                        <input type="text" name="COMPANIA" id="COMPANIA" value="<?php echo $COMPANIA; ?>" style="width:80%;" readonly="readonly" />
                                    </th>
                                </tr>
                                <tr>
                                    <th align="left" colspan="2">
                                        Direcci&oacute;n &nbsp;&nbsp;
                                        <input type="text" name="DIRECCION_COMPANIA" id="DIRECCION_COMPANIA" value="<?php echo $DIRECCION_COMPANIA; ?>" style="width:80%;" / readonly="readonly">
                                    </th>
                                </tr>
                                <tr>
                                    <th align="left" colspan="2">
                                        Tel&eacute;fono &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="TELEFONO_COMPANIA" id="TELEFONO_COMPANIA" value="<?php echo $TELEFONO_COMPANIA; ?>" style="width:80%;" / readonly="readonly"><br />
                                    </th>
                                </tr>
                                <tr>
                                    <th align="left" colspan="2">
                                        E-Mail
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="CORREO_COMPANIA" id="CORREO_COMPANIA" value="<?php echo 'reportes_ea@encontactopeoplemarketing.com' ?>" style="width:80%;" / readonly="readonly"><br />
                                    </th>
                                </tr>
                                <tr>
                                    <th align="left" colspan="2">
                                        Tipo de Reportante
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <br />
                                        <br />
                                        <input type="radio" name="TIPO_REPORTANTE" id="TIPO_REPORTANTE" value="medico" />
                                        <span class="texto">MEDICO</span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="TIPO_REPORTANTE" id="TIPO_REPORTANTE" value="QUIMICO FARMACEUTICO" />
                                        <span class="texto">QUIMICO FARMACEUTICO</span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="TIPO_REPORTANTE" id="TIPO_REPORTANTE" value="ENFERMERA" />
                                        <span class="texto">ENFERMERA</span>
                                        <input type="radio" name="TIPO_REPORTANTE" id="TIPO_REPORTANTE" value="OTRO" />
                                        <span class="texto">OTRO</span>
                                        <br />
                                        Cual: <input name="TIPO_REPORTANTE_OTRO" id="TIPO_REPORTANTE_OTRO" type="text" />
                                    </th>
                                </tr>
                            </table>
                        </center>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <center>
                            <table style="width:50%; border:1px solid #000;" rules="all">
                                <tr>
                                    <th align="left">
                                        <br />
                                        PVCH LOCAL
                                        Juan S Franco, MD
                                        <br />
                                        <br />
                                    </th>
                                    <th align="left">
                                        Tel&eacute;fono:
                                        <br />
                                        <br />
                                        5714234607
                                        <br />
                                        573182821316
                                        <br />
                                    </th>
                                    <th align="left">
                                        E-mail:
                                        <br />
                                        <br />
                                        <span style="color:#03C">farmacovigilancia.colombia@bayer.com</span>
                                        <br />
                                        <br />
                                    </th>
                                </tr>
                            </table>
                        </center>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <br />
                        <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" />
                        <br />
                    </th>
                </tr>
            </table>
        </form>
    </body>
<?php
} else {
?>
    <script type="text/javascript">
        window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
    </script>
<?php
}
?>

</html>