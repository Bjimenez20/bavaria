<?php
require_once('session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>insertar</title>
    <style>
        .aviso3 {
            font-size: 130%;
            font-weight: bold;
            color: #11a9e3;
            text-transform: uppercase;
            background-color: transparent;
            text-align: center;
            padding: 10px;
        }

        .error {
            font-size: 130%;
            font-weight: bold;
            color: #fb8305;
            text-transform: uppercase;
            background-color: transparent;
            text-align: center;
            padding: 10px;
        }

        .btn_continuar {
            padding-top: 7px;
            width: 152px;
            height: 37px;
            color: transparent;
            background-color: transparent;
            border-radius: 5px;
            border: 1px solid transparent;
        }

        .btn_continuar:active {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
                inset 0px 0px 20px #EEECEC;
        }

        .btn_continuar:hover {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
                inset 0px 0px 20px #EEECEC;
        }
    </style>
</head>

<body>
    <?php
    require('../datos/parse_str.php');
    require_once("../datos/conex.php");
    if (isset($_POST['registrar'])) {
        $FECHA_NOTIFICA = $_POST['fecha_notificacion'];
        $DEPARTAMENTO = $_POST['departamento'];
        $MUNICIPIO = $_POST['municipio'];
        $NOMBRE_INSTITUCION = $_POST['institucion_evento'];
        $CODIGO_PNF = $_POST['codigo_pnf'];
        $NOMBRE_REPORTANTE = $_POST['nombre_usuario'];
        $NOMBRE_PACIENTE_ACUDIENTE = $_POST['nombre_paciente_acudiente'];
        $CONSECUTIVO = $_POST['consecutivo'];
        $PROFESION_REPORTANTE = $_POST['profecion_usuario'];
        $CORREO_REPORTANTE = $_POST['correo_usuario'];
        $FECHA_NACIMIENTO_PACIENTE = $_POST['fecha_nacimiento'];
        $EDAD_PACIENTE = $_POST['edad_paciente'];
        $TIPO_DOCUMENTO_PACIENTE = $_POST['tipo_documento_paciente'];
        $NUMERO_DOCUMENTO_PACIENTE = $_POST['documento_paciente'];
        $INICIALES_PACIENTE = $_POST['iniciales_pa'];
        $SEXO = $_POST['genero'];
        $PESO = $_POST['peso'];
        $TALLA = $_POST['talla'];
        $DIAGNOSTICO_PRINCIPAL = $_POST['diagnostico'];
        $TITULAR_REGISTRO = $_POST['titular_registro'];
        $NOMBRE_COMERCIAL = $_POST['nombre_comercial'];
        $REGISTRO_SANITARIO = $_POST['registro_sanitario'];
        $LOTE = $_POST['lote'];
        $FECHA_INICIO_EVENTO = $_POST['fecha_ini_evento'];
        $EVENTO_ADVERSO = $_POST['evento_adverso'];
        $DESCRIPCION_ANALISIS_EVENTO = $_POST['descripcion_evento'];
        $DESENLACE_EVENTO = $_POST['desenlace_evento'];
        $SERIEDAD = $_POST['seriedad'];
        $LUGAR_DISTRIBUCION = $_POST['lugar_distribucion'];
        $FECHA_MUERTE = $_POST['fecha_muerte'];
        $PREGUNTA1 = $_POST['pregunta1'];
        $PREGUNTA2 = $_POST['pregunta2'];
        $PREGUNTA3 = $_POST['pregunta3'];
        $PREGUNTA4 = $_POST['pregunta4'];
        $PREGUNTA5 = $_POST['pregunta5'];
        $ID_PACIENTE = $_POST['ID_PACIENTE'];
        $ID_GESTION = $_POST['ID_GESTION'];
        $URL = "localhost/IPSEN/EVENTO_ADVERSO/$ID_GESTION/Evento_Adverso_$ID_PACIENTE.pdf";
        $insertar = mysqli_query($conex, "INSERT INTO ipsen_evento_adverso(FECHA_NOTIFICA,DEPARTAMENTO,MUNICIPIO,NOMBRE_INSTITUCION,CODIGO_PNF,NOMBRE_REPORTANTE,NOMBRE_PACIENTE_ACUDIENTE,CONSECUTIVO,PROFESION_REPORTANTE,CORREO_REPORTANTE,FECHA_NACIMIENTO_PACIENTE,EDAD_PACIENTE,TIPO_DOCUMENTO_PACIENTE,NUMERO_DOCUMENTO_PACIENTE,INICIALES_PACIENTE,SEXO,PESO,TALLA,DIAGNOSTICO_PRINCIPAL,TITULAR_REGISTRO,NOMBRE_COMERCIAL,REGISTRO_SANITARIO,LOTE,FECHA_INICIO_EVENTO,EVENTO_ADVERSO,DESCRIPCION_ANALISIS_EVENTO,DESENLACE_EVENTO,SERIEDAD,LUGAR_DISTRIBUCION,FECHA_MUERTE,PREGUNTA1,PREGUNTA2,PREGUNTA3,PREGUNTA4,PREGUNTA5,ID_PACIENTE_FK, ID_GESTION_FK, URL_PDF) VALUES ('" . $FECHA_NOTIFICA . "','" . $DEPARTAMENTO . "','" . $MUNICIPIO . "','" . $NOMBRE_INSTITUCION . "','" . $CODIGO_PNF . "','" . $NOMBRE_REPORTANTE . "','" . $NOMBRE_PACIENTE_ACUDIENTE . "','" . $CONSECUTIVO . "','" . $PROFESION_REPORTANTE . "','" . $CORREO_REPORTANTE . "','" . $FECHA_NACIMIENTO_PACIENTE . "','" . $EDAD_PACIENTE . "','" . $TIPO_DOCUMENTO_PACIENTE . "','" . $NUMERO_DOCUMENTO_PACIENTE . "','" . $INICIALES_PACIENTE . "','" . $SEXO . "','" . $PESO . "','" . $TALLA . "','" . $DIAGNOSTICO_PRINCIPAL . "','" . $TITULAR_REGISTRO . "','" . $NOMBRE_COMERCIAL . "','" . $REGISTRO_SANITARIO . "','" . $LOTE . "','" . $FECHA_INICIO_EVENTO . "','" . $EVENTO_ADVERSO . "','" . $DESCRIPCION_ANALISIS_EVENTO . "','" . $DESENLACE_EVENTO . "','" . $SERIEDAD . "','" . $LUGAR_DISTRIBUCION . "','" . $FECHA_MUERTE . "','" . $PREGUNTA1 . "','" . $PREGUNTA2 . "','" . $PREGUNTA3 . "','" . $PREGUNTA4 . "','" . $PREGUNTA5 . "','" . $ID_PACIENTE . "','" . $ID_GESTION . "','" . $URL . "')");
        echo mysqli_error($conex);
        if ($insertar) {
            require('../presentacion/pdf_tecno.php');
    ?>
            <span style="margin-top:5%;">
                <center>
                    <img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
                </center>
            </span>
            <p class="aviso3" style=" width:68.9%; margin:auto auto;">HA CREADO EXISITOSAMENTE EL EVENTO ADVERSO.</p>
            <br />
            <br />
            <div style="text-align: center;">
                <input type="button" value="Aceptar" onclick="CloseventanaSecundaria()">
            </div>
            <script>
                function CloseventanaSecundaria(URL) {
                    window: close('form_evento_adverso.php?xnfgti=<?php echo base64_encode($ID_PACIENTE) ?>>&artget=<?php echo base64_encode($ID_GESTION); ?>', "ventana1", "width=1650,height=500,Top=150,Left=50%");
                }
            </script>
        <?php
        } else {
        ?>
            <span style="margin-top:5%;">
                <center>
                    <img src="../presentacion/imagenes/advertencia2.png" width="68" height="78" style="width:70px; margin-top:100px;margin-top:5%;" />
                </center>
            </span>
            <p class="error" style=" width:68.9%; margin:auto auto;">
                <span style="border-left-color:#fff">ERROR VERIFIQUE LOS DATOS REGISTRADOS</span>
            </p>
            <br />
            <br />
            <script language=javascript>
                function ventanaSecundaria(URL) {
                    window.open(URL, "ventana1", "width=1650,height=500,Top=150,Left=50%")
                }
            </script>
            <a onclick="javascript:ventanaSecundaria('../presentacion/form_evento_adverso.php?ID_PACIENTE=<?php echo $ID_PACIENTE ?>') target=" info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_ROJO.png" style="width:152px; height:37px" /></a>
            </center>
    <?php
        }
    }
