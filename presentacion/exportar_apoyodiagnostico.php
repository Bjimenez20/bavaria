<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=total_inventarios.xls");
?>
<?php require('../datos/conex.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>BAVARIA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
    <link href="css/Estilo_Menu_C.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        $(document).ready(function() {
            $('#usertable').DataTable();
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="row" id="tablas_css_jair">
            <div class="table-responsive">
                <div class="tabla1">
                    <table id="usertable" class="display">
                        <thead>
                            <tr>
                                <td> ID_DIAGNOSTICO</td>
                                <td> PAP </td>
                                <td> TERAPIA </td>
                                <td> EXAMEN 1 </td>
                                <td> EXAMEN 2 </td>
                                <td> EXAMEN 3 </td>
                                <td> EXAMEN 4 </td>
                                <td> EXAMEN 5 </td>
                                <td> EXAMEN 6 </td>
                                <td> CANTIDAD EXAMENES </td>
                                <td> NUMERO VOUCHER </td>
                                <td> CENTRO MEDICO </td>
                                <td> ARCHIVO </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlpp = mysqli_query($conex, "SELECT * FROM ipsen_apoyo_diagnostico ORDER BY ID_APOYO_DIAGNOSTICO DESC");
                            while ($datos = (mysqli_fetch_array($sqlpp))) { ?>
                                <tr>
                                    <td><?php echo $datos['ID_APOYO_DIAGNOSTICO']; ?></td>
                                    <td><?php echo $datos['FK_PAP']; ?></td>
                                    <td><?php echo $datos['TERAPIA']; ?></td>
                                    <td><?php echo $datos['EXAMEN_1']; ?></td>
                                    <td><?php echo $datos['EXAMEN_2']; ?></td>
                                    <td><?php echo $datos['EXAMEN_3']; ?></td>
                                    <td><?php echo $datos['EXAMEN_4']; ?></td>
                                    <td><?php echo $datos['EXAMEN_5']; ?></td>
                                    <td><?php echo $datos['EXAMEN_6']; ?></td>
                                    <td><?php echo $datos['CANTIDAD_EXAMENES']; ?></td>
                                    <td><?php echo $datos['NUMERO_VOUCHER']; ?></td>
                                    <td><?php echo $datos['CENTRO_MEDICO']; ?></td>
                                    <td><?php echo $datos['ARCHIVO_IMG']; ?></td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>