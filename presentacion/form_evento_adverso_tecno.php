<?php
include('../logica/session.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.js"></script>
    <!-- <script type="text/javascript" src="js/validar_campos_evento_adverso.js"></script> -->
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
// if ($privilegios != '' && $usua != '') {
$SELECT_USUARIO_TOTAL = mysqli_query($conex, "SELECT * FROM ipsen_usuario WHERE USER = '" . $usua . "'");
while ($opcion = mysqli_fetch_array($SELECT_USUARIO_TOTAL)) {
    $NOMBRES = $opcion['NOMBRES'];
    $APELLIDOS = $opcion['APELLIDOS'];
    $EMAIL = $opcion['EMAIL'];
}
$Seleccion = mysqli_query($conex, "SELECT * FROM `ipsen_pacientes` AS P INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK = P.ID_PACIENTE WHERE ID_PACIENTE = '" . $ID_PACIENTE . "'");
while ($fila = mysqli_fetch_array($Seleccion)) {
    $ID_PACIENTE2 = $fila['ID_PACIENTE'];
    $ID_GESTION2 = $fila['ID_GESTION'];
    $EDAD = $fila['EDAD_PACIENTE'];
    $TIPO_IDENTIFICACION_PACIENTE = $fila['TIPO_IDENTIFICACION_PACIENTE'];
    $IDENTIFICACION_PACIENTE = $fila['IDENTIFICACION_PACIENTE'];
    $FECHA_NACIMIENTO = $fila['FECHA_NACIMINETO_PACIENTE'];
    $GENERO_PACIENTE = $fila['GENERO_PACIENTE'];
    $CLASIFICACION_PATOLOGICA_TRATAMIENTO = $fila['CLASIFICACION_PATOLOGICA_TRATAMIENTO'];
    $NOMBRE_PACIENTE = $fila['NOMBRE_PACIENTE'];
    $APELLIDO_PACIENTE = $fila['APELLIDO_PACIENTE'];
    $DEPARTAMENTO_PACIENTE = $fila['DEPARTAMENTO_PACIENTE'];
    $CIUDAD_PACIENTE = $fila['CIUDAD_PACIENTE'];
}

$SELECT_GESTION = mysqli_query($conex, "SELECT ID_GESTION FROM ipsen_gestiones ORDER BY ID_GESTION DESC LIMIT 1");
while ($dato = mysqli_fetch_array($SELECT_GESTION)) {
    $ID_GESTION = $dato['ID_GESTION'];
    $ID_GESTION3 = $ID_GESTION + 1;
}

$re = '/\b(\w)[^\s]*\s*/m';
$str = $NOMBRE_PACIENTE . ' ' . $APELLIDO_PACIENTE;
$subst = '$1';

$result = preg_replace($re, $subst, $str);

$SELECT_EV = mysqli_query($conex, "SELECT COUNT(*) AS EV FROM `ipsen_gestiones` WHERE ID_PACIENTE_FK2 = '" . $ID_PACIENTE2 . "' AND EVENTO_ADVERSO_GESTION = 'SI'");
$data = mysqlI_fetch_assoc($SELECT_EV);

$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$cad = '';
for ($i = 0; $i < 8; $i++) {
    $cad .= substr($characters, rand(0, 61), 1);
}
?>

<body style="padding: 0; margin: 0;">
    <form id="formulario" method="POST" action="../logica/insertar_datos_ea_tecno.php">
        <table class="table table-bordered" cellspacing="0" cellpadding="0" style="width: 100%;" id="header">
            <tbody>
                <tr colspan="3">
                    <td width="400" height="100">
                        <img src="../presentacion/imagenes/logo_tecno.png" alt="" width="400" height="100" />
                    </td>
                    <td>
                        <h1 style="color: #D4243B;">FORMATO REPORTE DE QUEJAS <br> TECNICAS - PTC</h1>
                    </td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tbody>
                                <tr>
                                    <td colspan="2" style="color: #D4243B;">CODIGO:</td>
                                    <td colspan="2">GC-FO-27</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="color: #D4243B;">VERSIÓN:</td>
                                    <td colspan="2">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="color: #D4243B;">FECHA DE VIGENCIA:</td>
                                    <td colspan="2">5/01/2023</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered" cellspacing="0" cellpadding="0" style="width: 100%;">
            <tbody>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tbody>
                                <tr>
                                    <td colspan="4" class="titulos" style="font-weight: 700; color:#fff;">1. INFORMACIÓN DEL REPORTANTE <?PHP echo $EV ?></td>
                                </tr>
                                <input type="text" name="ID_PACIENTE" id="ID_PACIENTE" value="<?php echo $ID_PACIENTE2 ?>" readonly="readonly" style="display: none;">
                                <input type="text" name="ID_GESTION" id="ID_GESTION" value="<?php echo $ID_GESTION3 ?>" readonly="readonly" style="display: none;">
                                <tr>
                                    <td colspan="1" style="font-weight: 700; background-color: #DBDBDB;">
                                        Fecha de notificación
                                    </td>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        Origen del reporte
                                        <hr>
                                        Departamento – Municipio
                                    </td>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        Nombre de la Institución donde ocurrió el evento
                                    </td>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        ID Paciente
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1">
                                        <input type="date" name="fecha_notificacion" id="fecha_notificacion" value="<?php echo date('Y-m-d'); ?>" style="width:90%; height:100%;" readonly="readonly">
                                    </td>
                                    <td>
                                        <input type="text" name="departamento" id="departamento" value="<?php echo $DEPARTAMENTO_PACIENTE ?>" readonly="readonly"> - <input type="text" name="municipio" id="municipio" value="<?php echo $CIUDAD_PACIENTE ?>" readonly="readonly">
                                    </td>
                                    <td>
                                        <input type="text" name="institucion_evento" id="institucion_evento" style="width:90%; height:100%;">
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $ID_PACIENTE2 ?>" style="width:90%; height:100%;" readonly="readonly">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        Nombre del Reportante primario
                                    </td>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        Nombre del Paciente o Acudiente
                                    </td>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        Consecutivo
                                    </td>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        Profesión del reportante primario
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo $NOMBRES . ' ' . $APELLIDOS ?>" readonly="readonly" style="width:90%; height:100%;">
                                    </td>
                                    <td>
                                        <input type="text" name="nombre_paciente_acudiente" id="nombre_paciente_acudiente" value="" style="width:90%; height:100%;">
                                    </td>
                                    <td>
                                        <input type="text" name="consecutivo" id="consecutivo" value="<?php echo $cad ?>" readonly="readonly" style="width:90%; height:100%;">
                                    </td>
                                    <td>
                                        <input type="text" name="profecion_usuario" id="profecion_usuario" style="width:90%; height:100%;">
                                    </td>

                                </tr>
                                <tr>
                                    <td style="font-weight: 700; background-color: #DBDBDB;" colspan="4">
                                        Correo electrónico institucional del reportante primario
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <input type="email" name="correo_usuario" id="correo_usuario" value="<?php echo $EMAIL ?>" readonly="readonly" style="width:90%; height:100%;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tbody>
                                <tr>
                                    <td colspan="7" class="titulos" style="font-weight: 700; color:#fff;">2. INFORMACIÓN DEL PACIENTE</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="font-weight: 700; background-color: #DBDBDB;">
                                        Fecha de nacimiento del paciente
                                    </td>
                                    <td colspan="2" style="font-weight: 700; background-color: #DBDBDB;">
                                        Edad del paciente en el momento del EA
                                        <hr>
                                        Edad – Años/Meses/ días
                                    </td>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        Documento de identificación del paciente
                                        <hr>
                                        CC | TI | RC | NUIP | Cód. Lab | Otro | S/I
                                    </td>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        Iniciales del paciente
                                    </td>
                                    <td style="font-weight: 700; background-color: #DBDBDB;">
                                        Sexo
                                        <hr>
                                        M | F | S/I
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $FECHA_NACIMIENTO ?>" readonly="readonly" style="width:90%; height:100%;">
                                    </td>
                                    <td colspan="2">
                                        <input type="number" name="edad_paciente" id="edad_paciente" value="<?php echo $EDAD ?>" readonly="readonly" style="width:90%; height:100%;">
                                    </td>
                                    <td>
                                        <input type="text" name="tipo_documento_paciente" id="tipo_documento_paciente" value="<?php echo $TIPO_IDENTIFICACION_PACIENTE ?>" readonly="readonly"> - <input type="text" name="documento_paciente" id="documento_paciente" value="<?php echo $IDENTIFICACION_PACIENTE ?>" readonly="readonly">
                                    </td>
                                    <td>
                                        <input type="text" name="iniciales_pa" id="iniciales_pa" value="<?php echo $result ?>" style="width:90%; height:100%;" readonly="readonly">
                                    </td>
                                    <?php if ($GENERO_PACIENTE == 'Mujer') { ?>
                                        <td>
                                            <input type="text" name="genero" id="genero" value="F" readonly="readonly" style="width:90%; height:100%;">
                                        </td>
                                    <?php } else if ($GENERO_PACIENTE == 'Hombre') { ?>
                                        <td>
                                            <input type="text" name="genero" id="genero" value="M" readonly="readonly" style="width:90%; height:100%;">
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <input type="text" name="genero" id="genero" value="N/A" readonly="readonly" style="width:90%; height:100%;">
                                        </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td colspan="7" style="text-align: left; font-weight: 700">
                                        Diagnóstico principal y otros diagnósticos:
                                        <input type="text" name="diagnostico" id="diagnostico" value="<?php echo $CLASIFICACION_PATOLOGICA_TRATAMIENTO ?>" readonly="readonly">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="font-weight: 700; background-color: #DBDBDB;">
                                        Información comercial del medicamento sospechoso
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="font-weight: 700;">
                                        Titular del Registro sanitario
                                    </td>
                                    <td colspan="2" style="font-weight: 700;">
                                        Nombre Comercial
                                    </td>
                                    <td colspan="2" style="font-weight: 700;">
                                        Registro sanitario
                                    </td>
                                    <td colspan="1" style="font-weight: 700;">
                                        Lote
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <textarea name="titular_registro" id="titular_registro" cols="50" rows="5"></textarea>
                                    </td>
                                    <td colspan="2">
                                        <textarea name="nombre_comercial" id="nombre_comercial" cols="50" rows="5"></textarea>
                                    </td>
                                    <td colspan="2">
                                        <textarea name="registro_sanitario" id="registro_sanitario" cols="50" rows="5"></textarea>
                                    </td>
                                    <td colspan="1">
                                        <textarea name="lote" id="lote" cols="50" rows="5"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tbody>
                                <tr>
                                    <td colspan="4" class="titulos3" style="font-weight: 700; color:#fff;">3.RECLAMOS TECNICOS DE PRODUCTO</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 700; text-align:left;">
                                        Fecha de Inicio del Reporte: <br>
                                        <input type="date" name="fecha_ini_evento" id="fecha_ini_evento">
                                    </td>
                                    <td style="font-weight: 700; text-align:left;">
                                        <p>Queja técnica /Reclamos Técnicos de Producto:</p>
                                        <textarea name="evento_adverso" id="evento_adverso" cols="95" rows="5"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 700; text-align:left;">
                                        Descripción y análisis del Reclamo:<br>
                                        <textarea name="descripcion_evento" id="descripcion_evento" cols="95" rows="5"></textarea>
                                    </td>
                                    <td>
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <hr>
                                                    <p style="font-weight: 700; ">Información complementaria (Marcar con X) </p>
                                                    <hr>
                                                    <div style="text-align: left;">
                                                        <input type="radio" name="desenlace_evento" id="desenlace_evento" style=" width:20%; display:none" value="">
                                                        <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Cuando se notifico el problema, ¿el paciente estaba utilizando el producto?"> Cuando se notificó el problema, ¿el paciente estaba utilizando el producto? <br>
                                                        <input type="radio" name="desenlace_evento" id="desenlace_evento" value="Se notifico algun dano o lesion"> Se notificó algún daño o lesión
                                                    </div>
                                                </tr>
                                                <hr>
                                                <tr>
                                                    <p style="font-weight: 700; ">Información complementaria (lugar de distribución)</p>
                                                    <hr>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Asegurador</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Operador Logístico</td>
                                                    <td colspan="2" style="background-color: #D4243B; color:#fff;">Punto de Entrega</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <input type="radio" name="lugar_distribucion" id="lugar_distribucion" style=" width:20%; display:none" value="">
                                                        <input type="radio" name="lugar_distribucion" id="lugar_distribucion" value="Asegurador">
                                                    </td>
                                                    <td colspan="2">
                                                        <input type="radio" name="lugar_distribucion" id="lugar_distribucion" style=" width:20%; display:none" value="">
                                                        <input type="radio" name="lugar_distribucion" id="lugar_distribucion" value="Operador Logistico">
                                                    </td>
                                                    <td colspan="2">
                                                        <input type="radio" name="lugar_distribucion" id="lugar_distribucion" style=" width:20%; display:none" value="">
                                                        <input type="radio" name="lugar_distribucion" id="lugar_distribucion" value="Punto de Entrega">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <br />
                        <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(evento_adverso,1);this.disabled=true" />
                        <br />
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <script>
        const botonAgregar = document.querySelector('#btn-agregar');
        const tabla = document.querySelector('#contenedor');

        botonAgregar.addEventListener('click', () => {
            const nuevaFila = document.createElement('tr');
            nuevaFila.innerHTML = `<td><input type="text" class="form-control" name="S_C_I[]" id="S_C_I" style="width:90%; height:100%;"></td>
                         <td><input type="text" class="form-control" name="medicamento[]" id="medicamento" style="width:90%; height:100%;"></td>
                         <td><input type="text" class="form-control" name="indicacion[]" id="indicacion" style="width:90%; height:100%;"></td>
                         <td><input type="text" class="form-control" name="dosis[]" id="dosis" style="width:90%; height:100%;"></td>
                         <td><input type="text" class="form-control" name="unidad_medida[]" id="unidad_medida" style="width:90%; height:100%;"></td>
                         <td><input type="text" class="form-control" name="via_administracion[]" id="via_administracion" style="width:90%; height:100%;"></td>
                         <td><input type="text" class="form-control" name="frecuencia_administracion[]" id="frecuencia_administracion" style="width:90%; height:100%;"></td>
                         <td><input type="date" class="form-control" name="fecha_inicio[]" id="fecha_inicio" style="width:90%; height:100%;"></td>
                         <td><input type="date" class="form-control" name="fecha_fin[]" id="fecha_fin" style="width:90%; height:100%;"></td>
                         <td><button class="eliminar btn btn-danger bg-gradient text-white"><span class="iconify" data-icon="tabler:trash-x-filled" data-width="25"></span></button></td>`;
            tabla.appendChild(nuevaFila);
            document.querySelectorAll('.eliminar').forEach(button => {
                button.addEventListener('click', () => {
                    button.closest('tr').remove();
                });
            });

        });
    </script>
</body>
<style>
    @page {
        margin: 180px 50px;
    }

    #footer {
        position: fixed;
        left: 0px;
        bottom: -180px;
        right: 0px;
        height: 150px;
        background-color: transparent;
    }

    #footer .page:after {
        content: counter(page, upper-roman);
    }

    * {
        font-size: 12px !important;
    }

    .titulos {
        background-color: #D4243B;
        font-family: Tahoma, Geneva, sans-serif;
        color: #fff;
    }

    .titulos2 {
        background-color: #D4243B;
        font-family: Tahoma, Geneva, sans-serif;
        color: #fff;
    }

    .titulos3 {
        background-color: #D4243B;
        font-family: Tahoma, Geneva, sans-serif;
        color: #fff;
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
        width: 50%;
    }

    h1 {
        margin-top: 3%;
        font-size: 20px !important;
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

    .table td,
    .table th {
        padding: 10px;
        text-align: center;
        color: black;
    }

    .table {
        margin-bottom: 1rem;
        margin: auto;
        background-color: transparent;
    }

    table {
        border-collapse: collapse;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid black;
    }
</style>
<?php
// } else {
// 
?>
// <script type="text/javascript">
    //         window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
    //     
</script>-
// <?php
    // }
    // 
    ?>

</html>