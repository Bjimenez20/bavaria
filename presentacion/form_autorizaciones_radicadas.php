<?php
/*
$conexion=mysqli_connect('192.168.0.7','webuser','P4t4d4 4l n3n3!!!','peoplema_bayer')or die ("no se pudo");
mysqli_select_db($conexion,'peoplema_bayer') or die ("no se puede conectar a la database");   
*/
?>
<?php
$conexion = mysqli_connect('app-peoplemarketing.com', 'apppeopl', 'ser1_pE0p1E*2018', 'apppeopl_bayer') or die("no se pudo");
mysqli_select_db($conexion, 'apppeopl_bayer') or die("no se puede conectar a la database");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
</head>

<body>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>IPSEN</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- META-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- AJAX-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- BOOOTSTRAP -->
        <link href="css/bootstrap.css" rel="stylesheet" />
        <!-- JQUERY PAGINIADO-->
        <script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <!-- EXPORTABLE-->
        <link href="css/style_table.css" rel="stylesheet" type="text/css">
        <!--ESTILO DEL PAGINIADO-->
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
        <link href="css/Estilo_Menu_C.css" rel="stylesheet" type="text/css">
        <!-- FUNCION DEL PAGINIADO -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#usertable').DataTable();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#SELECTOR').change(function() {
                    var x = $('#SELECTOR').val();
                    if (x == '<' || x == '>' || x == '') {
                        $("#division1").css('display', 'inline');
                        $("#division2").css('display', 'none');
                    }
                    if (x == 'total') {
                        $("#division1").css('display', 'none');
                        $("#division2").css('display', 'none');
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#Busqueda').click(function() {
                    $("#super_busqueda").css('display', 'inline-block');
                    $("#ocultar_boton").css('display', 'none');
                });
                $('#Cancelar').click(function() {
                    $("#super_busqueda").css('display', 'none');
                });
            });
        </script>
    </head>
    <style type="text/css">
        a {
            color: green;
        }
    </style>

    <body>
        <iframe src="./scriptcase_nuevo/ipsen_20210426105050/" frameborder="0" style="padding-top: 20px; width: 100%; border: 1px solid transparent; height: 714.1px;" name="info" id="info" scrolling="auto"> </iframe>
        <footer class="footer fixed-bottom">
            <div class="container">
                <span class="text-muted"></span>
            </div>
        </footer>
    </body>
    <!-- Llamar a los complementos javascript-->
    <!-- JQUERY EXPORTABLE--->
    <script src="js/jquery-1.12.4.min.js"></script>
    <!-- Llamar a los complementos javascript EXPORTABLE-->
    <!-- JS DE PAGINIADO-->
    <script type="text/javascript" src="js/jquery.dataTablesc.js"></script>
    <!-- FUNCION DE LA EXPORTACION-->
    <script>
        $("table").tableExport({
            formats: ["xlsx", "txt", "csv"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
            position: 'button', // Posicion que se muestran los botones puedes ser: (top, bottom)
            bootstrap: false, //Usar lo estilos de css de bootstrap para los botones (true, false)
            fileName: "sc_csv_autorizaciones_radicadas", //Nombre del archivo 
        });
    </script>

    </html>
</body>

</html>