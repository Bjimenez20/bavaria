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
<body>
    <div class="container col-md-10">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2>Reporte Causal Conteo</h2>
                <iframe src="./reportes_conteo/Bayer_20210325143125/" frameborder="0" width="100%" height="500"></iframe>
                <!-- 
            <form method="post" action="#">
                   <button class="btn_buscar" name="enviar" type="submit" id="enviar">Buscar</button>
</form>
                        </div>
                    <div class="table-responsive">
                        <div class="tabla1">
                        <table id="usertable" class="display">
                            <thead>
                                <tr>
                                    <td> PAP</td>                      
                                    <td> PRODUCTO TRATAMIENTO </td>
                                    <td> CONTADOR CAUSAL </td>
                                    <td> CAUSA NO RECLAMACION GESTION </td>                         
                                    <td> ASEGURADOR TRATAMIENTO </td>
                                    <td> OPERADOR LOGISTICO TRATAMIENTO </td>
                                    <td> MEDICO TRATAMIENTO </td>                    
                                    <td> FECHA REGISTRO </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*
                                if(isset($_POST['enviar'])){
                                $sqlpp = mysqli_query($conexion, "SELECT P.ID_PACIENTE AS PAP, T.PRODUCTO_TRATAMIENTO AS PRODUCTO_TRATAMIENTO, C.CONTEO, C.CAUSAL_NO_VISITA, T.ASEGURADOR_TRATAMIENTO, T.OPERADOR_LOGISTICO_TRATAMIENTO, T.MEDICO_TRATAMIENTO, C.FECHA_ULTIMO_REGISTRO   FROM bayer_pacientes AS P INNER JOIN bayer_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE INNER JOIN bayer_conteo AS C ON C.ID_TRATAMIENTO = T.ID_TRATAMIENTO  WHERE  CAUSAL_NO_VISITA <> 'Finalizo Barrera'  AND CAUSAL_NO_VISITA <> '' ORDER BY P.ID_PACIENTE DESC");
                                while ($datos =(mysqli_fetch_array($sqlpp))) {?>                          
                              <tr>    
                                    <td><?php echo $datos['PAP']; ?></td>                      
                                    <td><?php echo $datos['PRODUCTO_TRATAMIENTO']; ?></td>
                                    <td><?php echo $datos['CONTEO']; ?></td>
                                    <td><?php echo $datos['CAUSAL_NO_VISITA']; ?></td>                         
                                    <td><?php echo $datos['ASEGURADOR_TRATAMIENTO']; ?></td>
                                    <td><?php echo $datos['OPERADOR_LOGISTICO_TRATAMIENTO']; ?></td>
                                    <td><?php echo $datos['MEDICO_TRATAMIENTO']; ?></td>                    
                                    <td><?php echo $datos['FECHA_ULTIMO_REGISTRO']; ?></td>
                                </tr>
                              <?php }
							   }*/ ?>
                            </tbody></table>
                    </div>      
                </div>
                -->
            </div>
        </div>
    </div>
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
<script src="js/FileSaver.min.js"></script>
<script src="js/Blob.min.js"></script>
<script src="js/xls.core.min.js"></script>
<script src="js/tableexport.js"></script>
<!-- JS DE PAGINIADO-->
<script type="text/javascript" src="js/jquery.dataTablesc.js"></script>
<!-- FUNCION DE LA EXPORTACION-->
<script>
    $("table").tableExport({
        formats: ["xlsx", "txt", "csv"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
        position: 'button', // Posicion que se muestran los botones puedes ser: (top, bottom)
        bootstrap: false, //Usar lo estilos de css de bootstrap para los botones (true, false)
        fileName: "sc_csv_informe_conteo", //Nombre del archivo 
    });
</script>
</html>