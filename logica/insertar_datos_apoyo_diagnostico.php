<style type="text/css">
    html,
    body {
        background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    @media screen and (max-width:1000px) {

        html,
        body {
            background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    }
</style>
<?php
$url = "http://172.16.20.182/bayer/presentacion/";
if (isset($_POST['insertar'])) {
    if ($_POST['insertar']) {
        $tamano = $_FILES["ZmMyZTQ5NWMyN2Q2ODE1NDRhNmIxYjc5NWI5ZWM4MzQ="]['size'];
        $tipo = $_FILES["ZmMyZTQ5NWMyN2Q2ODE1NDRhNmIxYjc5NWI5ZWM4MzQ="]['type'];
        $archivo1 = $_FILES["ZmMyZTQ5NWMyN2Q2ODE1NDRhNmIxYjc5NWI5ZWM4MzQ="]['name'];
        $archivo1 = str_replace(" ", "_", $archivo1);
        $prefijo1 = substr(md5(uniqid(rand())), 0, 3);
        if ($archivo1 != "") {
            $destino =  "" . $prefijo1 . "_" . $archivo1;
            if (copy($_FILES['ZmMyZTQ5NWMyN2Q2ODE1NDRhNmIxYjc5NWI5ZWM4MzQ=']['tmp_name'], $destino)) {
                $status = "Archivo subido: <b>" . $archivo1 . "</b>";
            } else {
                $status = "Error al subir el archivo";
            }
        } else {
            $status = "Error al subir archivo";
        }
        if ($archivo1 != "") {
            echo " El Archivo N&deg; 1 con nombre: " . $archivo1 . " Fue subido con exito<br>";
        } else {
            echo "";
        }
    }
    echo $status; ?>
<?php
    if ($archivo1 != "") {
        $enlace1 = $url . $prefijo1 . "_" . $archivo1 . "";
        $nombre1 = "" . $archivo1 . "";
    } else {
        $enlace1 = "";
        $nombre1 = "";
    }
    echo $enlace1;
}
?>
<?php
require('../datos/conex.php');
if (isset($_GET['xnfgti'])) {
    $id_personaa = base64_decode($_GET['xnfgti']);
    $terapia = base64_decode($_GET['vvgg']);
    $examne1 = $_POST['examne1'];
    $examne2 = $_POST['examne2'];
    $examne3 = $_POST['examne3'];
    $examne4 = $_POST['examne4'];
    $examne5 = $_POST['examne5'];
    $examne6 = $_POST['examne6'];
    $examne7 = $_POST['examne7'];
    $cant_examenes = $_POST['cant_examenes'];
    $numero_voucher = $_POST['numero_voucher'];
    $centro_medic = $_POST['centro_medic'];
    $n_gestion = $_POST['n_gestion'];
    $insert_apoyo_diagnostico = mysqli_query($conex, "INSERT INTO ipsen_apoyo_diagnostico (FK_PAP, TERAPIA, EXAMEN_1, EXAMEN_2, EXAMEN_3, EXAMEN_4, EXAMEN_5, EXAMEN_6, EXAMEN_7, CANTIDAD_EXAMENES, NUMERO_VOUCHER, CENTRO_MEDICO, ARCHIVO_IMG) VALUE ('" . $id_personaa . "','" . $terapia . "','" . $examne1 . "','" . $examne2 . "','" . $examne3 . "','" . $examne4 . "','" . $examne5 . "','" . $examne6 . "','" . $examne7 . "','" . $cant_examenes . "','" . $numero_voucher . "','" . $centro_medic . "','" . $enlace1 . "'); ");  ?>
    <span style="margin-top:5%;">
        <center>
            <img src="../presentacion/imagenes/chulo.png" width="151" height="150" style="width:100px; margin-top:100px;margin-top:5%;" />
        </center>
    </span>
    <br><br><br>
    <center>
        <p class="aviso3">HA REGISTRADO AL PACIENTE CORRECTAMENTE.</p>
    </center>
<?php    }
?>