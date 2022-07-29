<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
    <link rel="shortcut icon" href="../presentacion/imagenes/logo.png" />
</head>
<style>
    .error {
        font-size: 130%;
        font-weight: bold;
        color: #fb8305;
        text-transform: uppercase;
        background-color: transparent;
        text-align: center;
        padding: 10px;
    }

    html {
        background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    @media screen and (max-width:1000px) {
        html {
            background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    }
</style>
<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$ID_PACIENTE = base64_decode($xxx);
$producto = base64_decode($xxxx);
$select = mysqli_query($conex, "SELECT DOSIS FROM  ipsen_dosis WHERE NOMBRE_REFERENCIA='$producto' ORDER BY DOSIS ASC");
echo mysqli_error($conex);
?>

<body>
    <div>
        <img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
    </div>
    <form action="../logica/guardar_brindar_apoyo.php" method="post">
        <input type="hidden" value="<?php echo $ID_PACIENTE ?>" name="id_paciente" id="id_paciente" />
        <fieldset style="border:1px solid #000; border-radius:5px; margin:auto auto; width:80%;">
            <legend style="font-size:120%;">Informaci&oacute;n</legend>
            <table style="width:100%">
                <tr>
                    <td style="width:10%;">
                        Razon de Apoyo
                    </td>
                    <td style="width:40%;">
                        <select name="razon_apoyo" id="razon_apoyo" style="width:90%" required>
                            <option value="">Seleccione...</option>
                            <option>Atribuible OPL</option>
                            <option>Atribuible EPS</option>
                            <option>Atribuible a Paciente</option>
                            <option>Atribuible x Call</option>
                            <option>Atribuible x OM</option>
                            <option>CTC Radicado</option>
                            <option>Formula Radicada en Farmacia</option>
                            <option>Reclamo</option>
                        </select>
                    </td>
                    <td style="width:10%;">
                        Fecha de Apoyo
                    </td>
                    <td style="width:40%;">
                        <input type="date" name="fecha_apoyo" id="fecha_apoyo" style="width:90%" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        Dosis
                    </td>
                    <td>
                        <select name="dosis" id="dosis" style="width:90%" required>
                            <option value="">Seleccione...</option>
                            <?php
                            while ($fila = (mysqli_fetch_array($select))) {
                            ?>
                                <option value="<?php echo $fila['DOSIS'] ?>"><?php echo $fila['DOSIS'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        Motivo Apoyo
                    </td>
                    <td>
                        <select name="motivo" id="motivo" style="width:92%" required>
                            <option value="">Seleccione...</option>
                            <option>Apoyo</option>
                            <option>Titulacion</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th colspan="4">
                        <br />
                        <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(seguimiento,2)" />
                    </th>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>