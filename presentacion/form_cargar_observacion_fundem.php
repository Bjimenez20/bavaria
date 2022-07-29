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
<body>
    <form id="cargar_observaciones" name="cargar_observaciones" method="post" action="../logica/importar.php" enctype="multipart/form-data" class="letra">
        <fieldset style="margin:auto auto; width:90%;">
            <span style="font-size:90%;">USUARIO:</span>
            <input type="text" name="usuario" id="usuario" value="<?php echo $usua ?>" readonly="readonly" style="width:70%;" />
            <input type="submit" name="descargar" id="descargar" value="Exportar" class="btn_exp" title="DESCARGAR ESTRUCTURA" formaction="doc/estructura.csv" />
            <br />
            <br />
            <input id="archivo" name="archivo" type="file" />
            <br />
            <br />
            <center>
                <input type="submit" value="ENVIAR ARCHIVO" class="btn_upload" />
            </center>
        </fieldset>
    </form>
</body>
</html>