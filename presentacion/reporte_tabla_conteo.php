<?php
$conexion = mysqli_connect('app-peoplemarketing.com', 'apppeopl', 'ser1_pE0p1E*2018', 'apppeopl_bayer') or die("no se pudo");
mysqli_select_db($conexion, 'apppeopl_bayer') or die("no se puede conectar a la database");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>IPSEN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
    <link href="css/style_table.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
    <link href="css/Estilo_Menu_C.css" rel="stylesheet" type="text/css">
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

<body>
    <div class="container col-md-10">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2>Reporte Causal Conteo</h2>
                <iframe src="./reportes_conteo/ipsen_20210325143125/" frameborder="0" width="100%" height="500"></iframe>
            </div>
        </div>
    </div>
    <footer class="footer fixed-bottom">
        <div class="container">
            <span class="text-muted"></span>
        </div>
    </footer>
</body>
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/FileSaver.min.js"></script>
<script src="js/Blob.min.js"></script>
<script src="js/xls.core.min.js"></script>
<script src="js/tableexport.js"></script>
<script type="text/javascript" src="js/jquery.dataTablesc.js"></script>
<script>
    $("table").tableExport({
        formats: ["xlsx", "txt", "csv"],
        position: 'button',
        bootstrap: false,
        fileName: "sc_csv_informe_conteo",
    });
</script>

</html>