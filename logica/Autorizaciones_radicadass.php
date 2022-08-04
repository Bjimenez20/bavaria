<?php
$conexion = mysqli_connect('app-peoplemarketing.com', 'apppeopl', 'ser1_pE0p1E*2018', 'apppeopl_bayer') or die("no se pudo");
mysqli_select_db($conexion, 'apppeopl_bayer') or die("no se puede conectar a la database");
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Autorizaciones_radicadas.xls");
$consulta_pacientes = mysqli_query($conexion, "SELECT ID_PACIENTE,  ESTADO_CTC_GESTION, PRODUCTO_TRATAMIENTO, ASEGURADOR_TRATAMIENTO, OPERADOR_LOGISTICO_TRATAMIENTO, MEDICO_TRATAMIENTO, NUM_LOTES_DISPOSITIVOS,CIUDAD_RECLAMACION  FROM (SELECT ipsen_pacientes.ID_PACIENTE,    ipsen_tratamiento.PRODUCTO_TRATAMIENTO, ipsen_tratamiento.ASEGURADOR_TRATAMIENTO,     ipsen_tratamiento.OPERADOR_LOGISTICO_TRATAMIENTO, ipsen_tratamiento.MEDICO_TRATAMIENTO,     ipsen_tratamiento.NUM_LOTES_DISPOSITIVOS,ipsen_tratamiento.CIUDAD_RECLAMACION, ipsen_gestiones.ESTADO_CTC_GESTION   FROM ipsen_pacientes     INNER JOIN ipsen_gestiones ON  ipsen_pacientes.ID_PACIENTE = ipsen_gestiones.ID_PACIENTE_FK2    INNER JOIN ipsen_tratamiento ON ipsen_pacientes.ID_PACIENTE = ipsen_tratamiento.ID_PACIENTE_FK  WHERE ipsen_gestiones.FECHA_COMUNICACION = (SELECT  FECHA_COMUNICACION FROM ipsen_gestiones WHERE ID_PACIENTE_FK2=ID_PACIENTE ORDER BY FECHA_COMUNICACION DESC LIMIT 1)   ) people_marketing_SAS; ");
echo mysqli_error($conexion);
?>
<style type="text/css">
  .n111 {
    background: rgb(153, 198, 85);
    border: 1px solid rgb(21, 169, 227);
  }

  .n112 {
    background: #dc3545;
    color: white;
  }

  .nn1 {
    border: 1px solid rgb(21, 169, 227);
  }

  td {
    border: 1px solid;
  }

  tbody>td:nth-child(odd) {
    background-color: #f2f2f2;
  }

  tbody>td:nth-child(even) {
    background-color: #fbfbfb;
  }
</style>
<table>
  <tr>
    <td class="n111">PAP</td>
    <td class="n111">PRODUCTO TRATAMIENTO</td>
    <td class="n111">NUMERO LOTES</td>
    <td class="n111">NUMERO AUTORIZACION</td>
    <td class="n111">CIUDAD RECLAMACION</td>
    <td class="n111">ASEGURADOR TRATAMIENTO</td>
    <td class="n111">OPERADOR LOGISTICO TRATAMIENTO</td>
    <td class="n111">MEDICO TRATAMIENTO</td>
  </tr>
  <?php
  while ($fila1 = mysqli_fetch_array($consulta_pacientes)) {
  ?>
    <tbody>
      <tr>
        <td class="nn1"><?php echo $fila1['ID_PACIENTE'] ?></td>
        <td class="nn1"><?php echo $fila1['PRODUCTO_TRATAMIENTO'] ?></td>
        <td class="nn1"><?php echo $fila1['NUM_LOTES_DISPOSITIVOS'] ?></td>
        <td class="nn1"><?php echo $fila1['ESTADO_CTC_GESTION'] ?></td>
        <td class="nn1"><?php echo $fila1['CIUDAD_RECLAMACION'] ?></td>
        <td class="nn1"><?php echo $fila1['ASEGURADOR_TRATAMIENTO'] ?></td>
        <td class="nn1"><?php echo $fila1['OPERADOR_LOGISTICO_TRATAMIENTO'] ?></td>
        <td class="nn1"><?php echo $fila1['MEDICO_TRATAMIENTO'] ?></td>
      </tr>
    </tbody>
  <?php
  }
  ?>
</table>