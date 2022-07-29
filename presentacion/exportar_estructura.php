<?PHP
//session_start();
require('../datos/parse_str.php');
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=estructura.xls");
?>
<table border="1px" bordercolor="#15a9e3">
    <tr style="font-weight:bold; text-transform:uppercase; height:25; padding:3px">
        <th class="botones" style="background-color:#99c655">MOTIVO_COMUNICACION_GESTION</th>
        <th class="botones" style="background-color:#99c655">EVENTO_ADVERSO_GESTION</th>
        <th class="botones" style="background-color:#99c655">DESCRIPCION_COMUNICACION_GESTION</th>
        <th class="botones" style="background-color:#99c655">ID_PACIENTE_FK</th>
        <th class="botones" style="background-color:#99c655">FECHA_COMUNICACION</th>
    </tr>
</table>