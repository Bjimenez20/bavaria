<?PHP
//session_start();
require('../datos/parse_str.php');
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=bayer_contador.xls");
require_once("../datos/conex.php");
$consulta_paciente = mysqli_query($conex, "SELECT P.ID_PACIENTE AS PAP, T.PRODUCTO_TRATAMIENTO AS PRODUCTO_TRATAMIENTO, C.CONTEO, C.CAUSAL_NO_VISITA, T.ASEGURADOR_TRATAMIENTO, T.OPERADOR_LOGISTICO_TRATAMIENTO, T.MEDICO_TRATAMIENTO, C.FECHA_ULTIMO_REGISTRO   FROM bayer_pacientes AS P INNER JOIN bayer_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE INNER JOIN bayer_conteo AS C ON C.ID_TRATAMIENTO = T.ID_TRATAMIENTO  WHERE  CAUSAL_NO_VISITA <> 'Finalizo Barrera'  AND CAUSAL_NO_VISITA <> '' ORDER BY P.ID_PACIENTE DESC");
echo mysqli_error($conex);
?>
<table border="1px" bordercolor="#15a9e3">
  <tr style="font-weight:bold; text-transform:uppercase; height:25; padding:3px">
    <th class="botones" style="background-color:#99c655">PAP</th>
    <th class="botones" style="background-color:#99c655">PRODUCTO TRATAMIENTO</th>
    <th class="botones" style="background-color:#99c655">CONTADOR CAUSAL</th>
    <th class="botones" style="background-color:#99c655">CAUSA NO RECLAMACION GESTION</th>
    <th class="botones" style="background-color:#99c655">ASEGURADOR TRATAMIENTO</th>
    <th class="botones" style="background-color:#99c655">OPERADOR LOGISTICO TRATAMIENTO</th>
    <th class="botones" style="background-color:#99c655">MEDICO TRATAMIENTO</th>
    <th class="botones" style="background-color:#99c655">FECHA REGISTRO</th>
  </tr>
  <?php
  while ($fila1 = mysqli_fetch_array($consulta_paciente)) {
  ?>
    <tr align="center" style="height:25px;">
      <td><?php echo $fila1['PAP'] ?></td>
      <td><?php echo $fila1['PRODUCTO_TRATAMIENTO'] ?></td>
      <td><?php echo $fila1['CONTEO'] ?></td>
      <td><?php echo $fila1['CAUSAL_NO_VISITA'] ?></td>
      <td><?php echo $fila1['ASEGURADOR_TRATAMIENTO'] ?></td>
      <td><?php echo $fila1['OPERADOR_LOGISTICO_TRATAMIENTO'] ?></td>
      <td><?php echo $fila1['MEDICO_TRATAMIENTO'] ?></td>
      <td><?php echo $fila1['FECHA_ULTIMO_REGISTRO'] ?></td>
    </tr>
  <?php
  }
  ?>
</table>