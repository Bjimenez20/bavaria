<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BAVARIA</title>
    <link rel="shortcut icon" href="https://www.ipsen.com/wp-content/themes/ipsen-master/favicon.ico" />
    <script src="../presentacion/js/jquery.js"></script>
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
    <script src="css/SpryAssets/SpryAccordion.js" type="text/javascript"></script>
    <link href="css/SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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

        select {
            height: none !important;
            width: none !important;
        }

        #file-input {
            height: 30px !important;
        }
    </style>
    <script type="text/javascript" id="rendered-js">
        $(window).load(function() {
            $(function() {
                $('#file-input').change(function(e) {
                    addImage(e);
                });

                function addImage(e) {
                    var file = e.target.files[0],
                        imageType = /image.*/;
                    if (!file.type.match(imageType))
                        return;
                    var reader = new FileReader();
                    reader.onload = fileOnload;
                    reader.readAsDataURL(file);
                }

                function fileOnload(e) {
                    var result = e.target.result;
                    $('#imgSalida').attr("src", result);
                }
            });
            $('#check1').click(function() {
                var check1 = $('#check1').val();
                var examne1 = $('#examne1').val();
                if ($(this).is(":checked")) {
                    $("#examne1").attr('disabled', false);
                } else if ($(this).is(":not(:checked)")) {
                    $('#examne1').val("");
                    $("#examne1").attr('disabled', true);
                }
            });
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
                var check7 = $('#check7').val();
                var examne7 = $('#examne7').val();
                if ($(this).is(":checked")) {
                    $("#examne7").attr('disabled', false);
                } else if ($(this).is(":not(:checked)")) {
                    $('#examne7').val("");
                    $("#examne7").attr('disabled', true);
                }
            });
        });
    </script>
</head>

<body>
    <?php
    require('../datos/parse_str.php');
    ?>
    <?php
    if (isset($_GET['xnfgti'])) {
        $id_personaa = base64_decode($_GET['xnfgti']);
        $terapia = base64_decode($_GET['vvgg']);
    }
    ?>
    <div style="width:80.9%;margin-left:12%;">
        <form action="../logica/insertar_datos_apoyo_diagnostico.php?xnfgti=<?php echo base64_encode($id_personaa) ?>&vvgg=<?php echo base64_encode($terapia) ?>" method="post">
            <div>
                <img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <span>PAP</span>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="PAP_AD" id="PAP_AD" value="<?php echo $id_personaa ?>" disabled="disabled">
                </div>
                <div class="col-md-2">
                    <span>Terapia</span>
                </div>
                <div class="col-md-4">
                    <input class="form-control" type="text" name="terapia_AD" id="terapia_AD" value="<?php echo $terapia  ?>" disabled="disabled">
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
                        <input type="text" class="form-control" name="examne1" id="examne1" disabled>
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
                        <input type="text" class="form-control" name="examne2" id="examne2" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <input type="checkbox" name="" id="check3">
                    </div>
                    <div class="col-md-5">
                        <label>Cuadro Hem&aacute;tico</label>
                    </div>
                    <div class="col-md-2">
                        <label>valor de examen</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="examne3" id="examne3" disabled>
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
                        <input type="text" class="form-control" name="examne4" id="examne4" disabled>
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
                        <input type="text" class="form-control" name="examne5" id="examne5" disabled>
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
                        <input type="text" class="form-control" name="examne6" id="examne6" disabled>
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
                        <input type="text" class="form-control" name="examen7" id="examen7">
                    </div>
                </div>
            <?php } ?>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Cantidad examenes</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="cant_examenes" id="cant_examenes">
                </div>
                <div class="col-md-2">
                    <label>Numero de Voucher</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="numero_voucher" id="numero_voucher">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label>Centro Medico de Diagnostico</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="centro_medic" id="centro_medic">
                </div>
                <div class="col-md-2">
                    <label>Gestion</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="n_gestion" id="n_gestion">
                </div>
            </div>
            <div class="form-group">
                <label for="file-input">Adjuntar archivo</label>
                <input type="file" class="form-control-file" id="file-input" name="ZmMyZTQ5NWMyN2Q2ODE1NDRhNmIxYjc5NWI5ZWM4MzQ=">
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    <span for="imagen"><img class="img_ver" id="imgSalida" src="" width="200px" height="200px" style="background: #f1f1f1;" /></span> <br><br>
                </div>
            </div>
            <div>
                <center><button type="submit" name="insertar" class="btn btn-outline-success">Guardar Informacion</button></center>
            </div>
            <br><br><br>
        </form>
</body>

</html>
<script type="text/javascript">
    var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>