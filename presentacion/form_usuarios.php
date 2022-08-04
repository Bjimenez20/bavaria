<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
    <link rel="stylesheet" href="css/estilos_form_usuario.css" />
    <script src="js/jquery.js"></script>
    <script src="../presentacion/js/jquery.js"></script>
    <script>
        var height = window.innerHeight - 2;
        var porh = (height * 80 / 100);
        $(document).ready(function() {
            $('#usuarios').css('height', porh);
        });
    </script>
</head>
<?php
if ($privilegios != '' && $usua != '') {
?>
    <body>
        <form name="miformulario" method="post" action="listado_usuario.php" onkeydown="return filtro(2)" target="usuarios" class="letra">
            <table width="100%" style="margin:auto auto;" cellpadding="2" cellspacing="1" class="letra">
                <tr>
                    <th colspan="3" style="padding:5px; font-size:120%">USUARIOS</th>
                </tr>
                <tr>
                    <th style="width:45%;">
                        NOMBRE USUARIO
                        <input name="nombre" type="text" id="nombre" style="height:13px" />
                    </th>
                    <th style="width:45%;">
                        PERFIL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="perfil" id="perfil" style="height:20px; width:60%;">
                            <option value="">SELECCIONE...</option>
                            <option value="1">COORDINADOR(A)</option>
                            <option value="2">ASESOR(A)</option>
                        </select>
                    </th>
                    <th>
                        <input type="submit" name="buscar" id="buscar" value="Consultar" class="btn_buscar" title="BUSCAR" />
                    </th>
                </tr>
                <tr>
                    <th colspan="4" style="background-color:transparent;">
                        <iframe src="listado_usuario.php" name="usuarios" id="usuarios" class="ifra2"></iframe>
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