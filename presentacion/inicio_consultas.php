<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link rel="stylesheet" href="css/menu.css" />
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
    <link rel="stylesheet" href="../presentacion/css/menu_consulta.css" />
</head>
<script src="js/jquery.js"></script>
<script src="../presentacion/js/jquery.js"></script>
<script>
    var height = window.innerHeight - 2;
    var porh = (height * 74 / 100);
    $(document).ready(function() {
        $('#info').css('height', porh);
    });
</script>
<style>
    html {
        background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<?php
if ($privilegios != '' && $usua != '') {
?>

    <body>
        <div class="body">
            <div class="div_menu" style="margin-top:-20px;">
                <ul>
                    <li><a href="../presentacion/form_paciente_nuevo.php" target="info"><span class="icon-paste"></span> PACIENTE NUEVO</a>
                    </li>
                    <li><a href="../presentacion/form_paciente_seguimiento.php" target="info"><span class="icon-user-check"></span> SEGUIMIENTO </a>
                    </li><?php if ($id_usu == '77' || $id_usu == '13') {
                                echo "";
                            } else { ?>
                        <li><a href="#"><span class="icon-clipboard"></span> PRODUCTOS</a>
                            <ul>
                                <li><a href="../presentacion/form_inventario.php" target="info"><span class="icon-unlocked"></span> INVENTARIO</a></li>
                            </ul>
                        </li>
                        <li><a href="../presentacion/form_reporte.php" target="info"><span class="icon-user-check"></span> REPORTES </a>
                            <ul>
                                <li><a href="../info/index.php" target="info"><span class="icon-unlocked"></span> OTROS REPORTES</a></li>
                        </li>
                        <li style="background: rgb(199,187,3);
                            background: linear-gradient(0deg, rgba(199,187,3,1) 38%, rgba(255,255,255,1) 100%);">
                            <a href="../presentacion/form_autorizaciones_radicadas.php" target="info"><span class="icon-unlocked"></span>OTROS REPORTES (NUEVO)</a>
                        </li>
                </ul>
                </li><?php } ?>
            <li><a href="form_mi_cuenta.php" target="info"><span class="icon-unlocked"></span> CONFIGURACION</a>
                <ul>
                    <li><a href="../presentacion/form_cuenta_usuario.php" target="info"><span class="icon-unlocked"></span> MI CUENTA</a></li>
                </ul>
            </li>
            <li class="a1" id="salir"><a href="../logica/cerrar_sesion.php" style="border-right:2px solid transparent;"><span class="icon-exit"></span> SALIR</a></li>
            </ul>
            </div>
        </div>
        <div class="body">
            <iframe style=" padding-top:20px; width:100%;border:1px solid transparent" name="info" id="info" scrolling="auto"></iframe>
        </div>
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