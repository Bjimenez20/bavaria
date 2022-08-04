<?php
require('../datos/conex.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="euc-jp">

    <link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
    <link rel="stylesheet" href="css/estilos_menu.css" />
    <title>IPSEN</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="js/jquery.js"></script>
    <script src="../presentacion/js/jquery.js"></script>
    <script>
        var height = window.innerHeight - 2;
        var porh = (height * 80 / 100);
        $(document).ready(function() {
            $('#consulta_inv').css('height', porh);
        });
    </script>
    <style>
        @import url("../../bayer/webfonts/avenir/stylesheet.css");

        .btn_registrar {
            padding-top: 2%;
            background-image: url(imagenes/BOTONES_REGISTRAR.png);
            background-repeat: no-repeat;
            width: 152px;
            height: 37px;
            color: transparent;
            background-color: transparent;
            border-radius: 5px;
            border: 1px solid transparent;
        }

        .izq {
            text-align: left;
        }

        .der {
            text-align: right;
        }

        th {
            padding: 7px;
            color: #FFF;
            background: #848484;
            font-family: avenir;
            font-size: 100%;
            font-style: normal;
            line-height: normal;
            font-weight: normal;
            font-variant: normal;
            text-align: center;
            font-family: Tahoma, Geneva, sans-serif;
        }

        td {
            padding: 2px;
            color: #000;
            font-family: avenir;
            font-size: 100%;
            font-style: normal;
            line-height: normal;
            font-weight: normal;
            font-variant: normal;
            text-align: left;
            font-family: Tahoma, Geneva, sans-serif;
        }

        .actualizar {
            background: #224a81;
            width: 80px;
            height: 30px;
            color: #ffffff;
            display: inline-block;
            text-align: center;
            border: none;
        }

        .eliminar {
            background: red;
            width: 80px;
            height: 30px;
            color: #ffffff;
            display: inline-block;
            text-align: center;
            border: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#ver1').click(function() {
                $("#con").fadeIn();
            });
            $('#close').click(function() {
                $("#con").fadeOut();
            });
            $("#salir").click(function() {
                if (confirm('¿Estas seguro de cerrar sesion?')) {
                    window.location = "../index.php";
                } else {}
            });
        });
    </script>
    <?php
    require('../datos/parse_str.php');
    $usua = strtoupper($usua);
    $ID = $artid;
    ?>
</head>

<body>
    <section>
        <blockquote>
            <?php
            $asegurador = mysqli_query($conex, "SELECT * FROM ipsen_asegurador WHERE ID_ASEGURADOR = '" . $ID . "'");
            while ($fila = mysqli_fetch_array($asegurador)) {
            ?>
                <form action="editar_asegurador.php?erted=<?php echo $fila['ID_ASEGURADOR'] ?>" method="POST">
                    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" style="margin:auto auto;">
                        <tr>
                            <th colspan="4">
                                <strong>HABILITAR ASEGURADOR</strong>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <span>ASEGURADOR POR HABILITAR</span>
                            </td>
                            <td>
                                <input type="text" name="asegurador_habilitar" id="asegurador_habilitar" value="<?php echo $fila['ASEGURADOR'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="4">
                                <input type="submit" class="actualizar" value="Actualizar" id="actualizar" name="actualizar">
                                <input type="submit" class="eliminar" value="Eliminar" id="eliminar" name="eliminar">
                            </th>
                        </tr>
                    </table>
                </form>
            <?php
            }
            ?>
        </blockquote>
    </section>
    <map name="Map7" id="Map7">
        <area shape="rect" coords="-3,-1,275,78" href="#" />
    </map>
</body>

</html>