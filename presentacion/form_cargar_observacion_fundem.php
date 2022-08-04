<?php
include('../logica/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IPSEN</title>
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
</head>
<?php
require('../datos/parse_str.php');
$usua;
?>
<style>
    .input__row {
        margin-top: 10px;
    }

    .upload {
        display: none;
    }

    .uploader {
        border: 2px solid #224a81;
        width: 300px;
        position: relative;
        height: 30px;
        display: flex;
    }

    .uploader .input-value {
        width: 250px;
        padding: 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 25px;
        font-family: sans-serif;
        font-size: 16px;
    }

    .uploader label {
        cursor: pointer;
        margin: 0;
        width: 30px;
        height: 30px;
        position: absolute;
        right: 0;
        background: #224a81 url('https://www.interactius.com/wp-content/uploads/2017/09/folder.png') no-repeat center;
    }
</style>

<body>
    <form id="cargar_observaciones" name="cargar_observaciones" method="post" action="../logica/importar.php" enctype="multipart/form-data" class="letra">
        <br><br><br>
        <table width="100%">
            <tr>
                <td style="background-color:#848484;text-align:center">
                    <span style="color:#FFF;">Gestion Fundem</span>
                </td>
            </tr>
        </table>
        <table width="95%">
            <tr>
                <td>
                    <span>USUARIO:</span>
                </td>
                <td>
                    <input type="text" name="usuario" id="usuario" value="<?php echo $usua ?>" readonly="readonly" style="width:70%;" />
                </td>
                <td>
                    <input type="submit" name="descargar" id="descargar" value="Exportar" class="btn_exp" title="DESCARGAR ESTRUCTURA" formaction="doc/estructura.csv" />
                </td>
            </tr>
            <tr>
                <td>
                    <span>Seleccione archivo...</span>
                </td>
                <td>
                    <div class="input__row uploader">
                        <div id="inputval" class="input-value"></div>
                        <label for="archivo"></label>
                        <input type="file" class="upload" name="archivo" id="archivo" class="aceptar">
                    </div>
                </td>
            </tr>
            <script>
                $('#archivo').on('change', function() {
                    $('#inputval').text($(this).val());
                });
            </script>
        </table>
        <table width="100%">
            <tr>
                <td style="background-color:#848484;text-align:center">
                    <input type="submit" value="ENVIAR ARCHIVO" class="btn_upload" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>