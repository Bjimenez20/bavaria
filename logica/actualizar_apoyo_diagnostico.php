<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
    <script src="../presentacion/js/jquery.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../presentacion/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="../presentacion/css/jquery.dataTables.css" />
    <link href="../presentacion/css/Estilo_Menu_C1.css" rel="stylesheet" type="text/css">
    <script>
        $('#check1').click(function() {
            var check1 = $('#check1').val();
            var examne1 = $('#examne1').val();
        });
        if ($(this).is(":checked")) {
            $("#examne1").attr('disabled', false);
        } else if ($(this).is(":not(:checked)")) {
            $('#examne1').val("");
            $("#examne1").attr('disabled', true);
        }
        $('#check2').click(function() {
            var check2 = $('#check2').val();
            var examne2 = $('#examne2').val();
            if ($(this).is(":checked")) {
                $("#examne2").attr('disabled', false);
            } else if ($(this).is(":not(:checked)")) {
                $('#examne2').val("");
                $("#examne2").attr('disabled', true);
            }
        });
        $('#check3').click(function() {
            var check3 = $('#check3').val();
            var examne3 = $('#examne3').val();
            if ($(this).is(":checked")) {
                $("#examne3").attr('disabled', false);
            } else if ($(this).is(":not(:checked)")) {
                $('#examne3').val("");
                $("#examne3").attr('disabled', true);
            }
        });
        $('#check4').click(function() {
            var check4 = $('#check4').val();
            var examne4 = $('#examne4').val();
            if ($(this).is(":checked")) {
                $("#examne4").attr('disabled', false);
            } else if ($(this).is(":not(:checked)")) {
                $('#examne4').val("");
                $("#examne4").attr('disabled', true);
            }
        });
        $('#check5').click(function() {
            var check3 = $('#check5').val();
            var examne3 = $('#examne5').val();
            if ($(this).is(":checked")) {
                $("#examne5").attr('disabled', false);
            } else if ($(this).is(":not(:checked)")) {
                $('#examne5').val("");
                $("#examne5").attr('disabled', true);
            }
        });
        $('#check6').click(function() {
            var check6 = $('#check6').val();
            var examne6 = $('#examne6').val();
            if ($(this).is(":checked")) {
                $("#examne6").attr('disabled', false);
            } else if ($(this).is(":not(:checked)")) {
                $('#examne6').val("");
                $("#examne6").attr('disabled', true);
            }
        });
        $('#check7').click(function() {
            var check7 = $('#examen7').val();
            var examen7 = $('#examen7').val();
            if ($(this).is(":checked")) {
                $("#examen7").attr('disabled', false);
            } else if ($(this).is(":not(:checked)")) {
                $('#examen7').val("");
                $("#examen7").attr('disabled', true);
            }
        });
    </script>
    <style>
        .error {
            font-size: 130%;
            font-weight: bold;
            color: red;
            text-transform: uppercase;
            background-color: transparent;
            text-align: center;
            padding: 10px;
        }
        html,
        body {
            background: url(../presentacion/imagenes/background.png) no-repeat fixed center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        @media screen and (max-width:1000px) {
            html,
            body {
                background: url(../presentacion/imagenes/background.png) no-repeat fixed center;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        }
        select {
            height: none !important;
            width: none !important;
        }
    </style>
</head>
<?php require('../datos/conex.php'); ?>
<?php
if (isset($_GET['xnfgti'])) {
    $id_personaa = base64_decode($_GET['xnfgti']);
    $terapia = base64_decode($_GET['vvgg']);
}
?>
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
                                <td> EXAMEN 7 </td>
                                <td> CANTIDAD EXAMENES </td>
                                <td> NUMERO VOUCHER </td>
                                <td> CENTRO MEDICO </td>
                                <td> ARCHIVO </td>
                                <td> GESTIONAR </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlpp = mysqli_query($conex,"SELECT * FROM ipsen_apoyo_diagnostico WHERE FK_PAP='" . $id_personaa . "' ORDER BY ID_APOYO_DIAGNOSTICO DESC");
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
                                    <td><?php echo $datos['EXAMEN_7']; ?></td>
                                    <td><?php echo $datos['CANTIDAD_EXAMENES']; ?></td>
                                    <td><?php echo $datos['NUMERO_VOUCHER']; ?></td>
                                    <td><?php echo $datos['CENTRO_MEDICO']; ?></td>
                                    <td><?php echo $datos['ARCHIVO_IMG']; ?></td>
                                    <td>
                                        <input type="button" name="diagnostico_j" id="diagnostico_j" title="Gestion Apoyo Diagnostico" style="width:100%;" value="Gestion Apoyo Diagnostico" onclick="javascript:window.location='../logica/actualizar_apoyo_diagnostico.php?hthsddf=<?php echo base64_encode($datos['ID_APOYO_DIAGNOSTICO']) ?>&xnfgti=<?php echo base64_encode($id_personaa) ?>&vvgg=<?php echo base64_encode($terapia) ?>';" />
                                    </td>
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
<?php
if (isset($_GET['hthsddf'])) {
    $id_gestionar = base64_decode($_GET['hthsddf']);
    $SELECT_GESTION = mysqli_query($conex,"SELECT * FROM ipsen_apoyo_diagnostico WHERE ID_APOYO_DIAGNOSTICO = '" . $id_gestionar . "';");
    while ($gestion = (mysqli_fetch_array($SELECT_GESTION))) {
        $ID_APOYO_DIAGNOSTICO = $gestion['ID_APOYO_DIAGNOSTICO'];
        $FK_PAP = $gestion['FK_PAP'];
        $TERAPIA = $gestion['TERAPIA'];
        $EXAMEN_1 = $gestion['EXAMEN_1'];
        $EXAMEN_2 = $gestion['EXAMEN_2'];
        $EXAMEN_3 = $gestion['EXAMEN_3'];
        $EXAMEN_4 = $gestion['EXAMEN_4'];
        $EXAMEN_5 = $gestion['EXAMEN_5'];
        $EXAMEN_6 = $gestion['EXAMEN_6'];
        $EXAMEN_7 = $gestion['EXAMEN_7'];
        $CANTIDAD_EXAMENES = $gestion['CANTIDAD_EXAMENES'];
        $NUMERO_VOUCHER = $gestion['NUMERO_VOUCHER'];
        $CENTRO_MEDICO = $gestion['CENTRO_MEDICO'];
    } ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form action="actualizar_diagnostico.php?xnfgti=<?php echo base64_encode($id_personaa) ?>&vvgg=<?php echo base64_encode($terapia) ?>" method="post">
                <div class="form-group row">
                    <div class="col-md-2">
                        <span>PAP</span>
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="PAP_AD" id="PAP_AD" value="<?php echo $FK_PAP ?>" disabled="disabled">
                    </div>
                    <div class="col-md-2">
                        <span>Terapia</span>
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="terapia_AD" id="terapia_AD" value="<?php echo $TERAPIA  ?>" disabled="disabled">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <center>examenes</center>
                    </div>
                </div>
                <?php if ($terapia == "Xofigo 1x6 ml CO") {
                ?>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <input type="checkbox" name="" id="check1">
                        </div>
                        <div class="col-md-5">
                            <label>Gammagraf&iacute;a &Oacute;sea total</label>
                        </div>
                        <div class="col-md-2">
                            <label>valor de examen</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="examne1" id="examne1" value="<?php echo $EXAMEN_1 ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <input type="checkbox" name="" id="check2">
                        </div>
                        <div class="col-md-5">
                            <label>Tomograf&iacute;a Axial Computarizada con contraste (toraco-abdominal)</label>
                        </div>
                        <div class="col-md-2">
                            <label>valor de examen</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="examne2" id="examne2" value="<?php echo $EXAMEN_2 ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <input type="checkbox" name="" id="check3">
                        </div>
                        <div class="col-md-5">
                            <label>Cuadro Hem&acute;tico</label>
                        </div>
                        <div class="col-md-2">
                            <label>valor de examen</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="examne3" id="examne3" value="<?php echo $EXAMEN_3 ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <input type="checkbox" name="" id="check4">
                        </div>
                        <div class="col-md-5">
                            <label>Fosfatasa Alcalina</label>
                        </div>
                        <div class="col-md-2">
                            <label>valor de examen</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="examne4" id="examne4" value="<?php echo $EXAMEN_4 ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <input type="checkbox" name="" id="check5">
                        </div>
                        <div class="col-md-5">
                            <label>Creatinina</label>
                        </div>
                        <div class="col-md-2">
                            <label>valor de examen</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="examne5" id="examne5" value="<?php echo $EXAMEN_5 ?>">disabled
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <input type="checkbox" name="" id="check6">
                        </div>
                        <div class="col-md-5">
                            <label>PSA</label>
                        </div>
                        <div class="col-md-2">
                            <label>valor de examen</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="examne6" id="examne6" value="<?php echo $EXAMEN_6 ?>" disabled>
                        </div>
                    </div>
                <?php } else if ($terapia == "Eylia 2MG VL 1x2ML CO INST") { ?>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <input type="checkbox" name="" id="check7">
                        </div>
                        <div class="col-md-5">
                            <label>Tomograf&iacute;a de Coherencia &Oacute;ptica OCT</label>
                        </div>
                        <div class="col-md-2">
                            <label>valor de examen</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="examen7" id="examen7" value="<?php echo $EXAMEN_7 ?>" disabled>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label>Cantidad examenes</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="cant_examenes" id="cant_examenes" value="<?php echo $CANTIDAD_EXAMENES ?>">
                    </div>
                    <div class="col-md-2">
                        <label>Numero de Voucher</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="numero_voucher" id="numero_voucher" value="<?php echo $NUMERO_VOUCHER ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label>Centro Medico de Diagnostico</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="centro_medic" id="centro_medic" value="<?php echo $CENTRO_MEDICO ?>">
                    </div>
                    <div class="col-md-2">
                        <label>Gestion</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" readonly="readonly" name="n_gestion" id="n_gestion" value="<?php echo $ID_APOYO_DIAGNOSTICO ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Archivo adjunto</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="myfile">Adjuntar archivo:</label>
                    <input type="file" id="img_archivo" name="img_archivo">
                </div>
                <div>
                    <center><button type="submit">Actualizar</button></center>
                </div>
            </form>
        </div>
        <div class="col-md-1"></div>
    </div>
<?php } ?>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#usertable').DataTable();
    });
</script>