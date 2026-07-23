<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BAVARIA</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
</head>
<?PHP
require('../datos/parse_str.php');
require('../datos/conex.php');
$consulta_PACIENTES;
$hoy = date('Y-m-d');
if ($privilegios != '' && $usua != '') {
    if (!isset($_POST['buscar'])) {

        $consulta_ref = mysqli_query($conex, "SELECT * FROM `ipsen_pacientes` INNER JOIN `ipsen_gestiones` ON ID_PACIENTE_FK2 = ID_PACIENTE INNER JOIN `ipsen_tratamiento` ON ID_PACIENTE_FK = ID_PACIENTE WHERE AUTORIZACION_EDUGESTOR = 'Rechazado'");
        echo mysqli_error($conex);
        $consulta_PACIENTES = "SELECT * FROM `ipsen_pacientes` INNER JOIN `ipsen_gestiones` ON ID_PACIENTE_FK2 = ID_PACIENTE INNER JOIN `ipsen_tratamiento` ON ID_PACIENTE_FK = ID_PACIENTE WHERE AUTORIZACION_EDUGESTOR = 'Rechazado' LIMIT";
    }
?>

    <body>
        <?php
        $url = "../presentacion/listado_pacientes.php";
        if ($privilegios == 1 || $privilegios == 2 || $privilegios == 4 || $privilegios == 3) {
            $num_total_registros = mysqli_num_rows($consulta_ref);
        }
        // if (isset($_POST['buscar']) && $privilegios == 4) {
        // 	$num_total_registros = mysqli_num_rows($consulta_ref);
        // }
        if ($num_total_registros > 0) {
        ?>
            <table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
                <tr>
                    <th width="9%" class="botones">CODIGO</th>
                    <th width="12%" class="botones">PRODUCTO</th>
                    <th width="12%" class="botones">CAUSAL</th>
                    <th width="12%" class="botones">ESTADO</th>
                    <th width="6%" class="botones">RESPONDER CASO</th>
                </tr>
                <?PHP
                $TAMANO_PAGINA = 10;
                $pagina = false;
                if (isset($_GET["pagina"]))
                    $pagina = $_GET["pagina"];
                if (!$pagina) {
                    $inicio = 0;
                    $pagina = 1;
                } else {
                    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
                }
                $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
                $consulta = "$consulta_PACIENTES " . $inicio . "," . $TAMANO_PAGINA;
                $consulta_ref = mysqli_query($conex, $consulta);
                while ($fila1 = mysqli_fetch_array($consulta_ref)) {
                ?>
                    <tr align="center">

                        <td><?php echo 'PAP' . $fila1['ID_PACIENTE'] ?></td>
                        <td><?php echo $fila1['PRODUCTO_TRATAMIENTO'] ?></td>
                        <td><?php echo $fila1['CAUSA_NO_RECLAMACION_GESTION'] ?></td>
                        <td><?php echo $fila1['AUTORIZACION_EDUGESTOR'] ?></td>
                        <td style="display: flex; justify-content: space-evenly; align-items: center;">
                            <a href="#" onclick="abrirModal('<?php echo base64_encode($fila1['ID_PACIENTE']); ?>','<?php echo base64_encode($fila1['ID_GESTION']); ?>'); return false;">
                                <img src="../presentacion/imagenes/restable.png" width="25" height="25" />
                            </a>

                            <!-- Modal -->
                            <div id="modalRechazo" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
                                <div style="background:white; padding:20px; max-width:400px; margin:100px auto; border-radius:8px;">
                                    <h3>Observacion</h3>
                                    <textarea id="razonRechazo" rows="4" style="width:100%;" placeholder="Escribe..."></textarea>
                                    <div style="margin-top:10px; text-align:right;">
                                        <button onclick="cerrarModal()">Cancelar</button>
                                        <button onclick="enviarRechazo()">Enviar</button>
                                    </div>
                                </div>
                            </div>

                            <script>
                                let pacienteId = '';
                                let gestionId = '';

                                function abrirModal(idPaciente, idGestion) {
                                    pacienteId = idPaciente;
                                    gestionId = idGestion;
                                    document.getElementById('modalRechazo').style.display = 'block';
                                }

                                function cerrarModal() {
                                    document.getElementById('modalRechazo').style.display = 'none';
                                }

                                function enviarRechazo() {
                                    let razon = document.getElementById('razonRechazo').value.trim();
                                    if (razon === '') {
                                        alert('Por favor, escribe la observacion.');
                                        return;
                                    }

                                    // Redirigir con la razón como parámetro
                                    window.location.href = `../logica/aprobar_paciente.php?accion=Autorizar&artid=${pacienteId}&artge=${gestionId}&razon=${encodeURIComponent(razon)}`;
                                }
                            </script>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <style>
                    .modal-body .form-control {
                        padding-top: 6px;
                        padding-bottom: 6px;
                    }
                </style>
                <tr bgcolor="#FFFFFF" class="titulo" align="center">
                    <td colspan="3" class="botones">Se encontraron Registros <?php echo $num_total_registros; ?></td>
                    <td colspan="8" class="botones">
                        <?php
                        if ($total_paginas > 1) {
                            if ($pagina != 1)
                                echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
                            for ($i = 1; $i <= $total_paginas; $i++) {
                                if ($pagina == $i)
                                    echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
                                else
                                    echo '  <a href="' . $url . '?pagina=' . $i . '" style="font-size:110%;">' . $i . '</a>  ';
                            }
                            if ($pagina != $total_paginas)
                                echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '"><img src="../presentacion/imagenes/der.gif" border="0"></a>';
                        }
                        echo '</p>';
                        ?></td>
                </tr>
            </table>
        <?php
        } else {
        ?>
            <span style="margin-top:1%;">
                <br><br><br><br><br><br>
                <center>
                    <img src="../presentacion/imagenes/advertencia2.png" style="width:70px; margin-top:1%;" />
                </center>
            </span>
            <p class="error" style=" width:68.9%; margin:auto auto;">
                <span style="border-left-color:#fff">NO SE ENCONTRARON REGISTROS CON ESTA INFORMACI&Oacute;N.</span>
            </p>
        <?php
        }
        ?>
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