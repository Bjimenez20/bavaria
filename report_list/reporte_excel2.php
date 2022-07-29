<?PHP

//session_start();

require('../datos/parse_str.php');

//Exportar datos de php a Excel

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=seguimiento.xls");

require_once("conex.php");

$consulta_paciente = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P

INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE ORDER BY ID_PACIENTE ASC");

echo mysqli_error($conex);

?>

<table border="1px" bordercolor="#15a9e3">

  <tr style="font-weight:bold; text-transform:uppercase; height:25; padding:3px">

    <th class="botones" style="background-color:#99c655">TERAPIA</th>

    <th class="botones" style="background-color:#99c655">DOSIS</th>

    <th class="botones" style="background-color:#99c655">FECHA RECLAMACION</th>

    <th class="botones" style="background-color:#99c655">Asegurador</th>

    <th class="botones" style="background-color:#99c655">Operador Logistico</th>

    <th class="botones" style="background-color:#99c655">Punto de Entrega</th>

    <th class="botones" style="background-color:#99c655">Dia Ultima Reclamacion</th>

    <th class="botones" style="background-color:#99c655">Ciudad</th>

    <th class="botones" style="background-color:#99c655">estatus</th>

    <th class="botones" style="background-color:#99c655">Ultima reclamcion(gestiones)</th>

    <th class="botones" style="background-color:#99c655">Causal de No reclamacion</th>

    <th class="botones" style="background-color:#99c655">Unidades/Cajas</th>

    <th class="botones" style="background-color:#99c655">Observaciones</th>

    <th class="botones" style="background-color:#99c655">Consecutivo Betaferon</th>

    <th class="botones" style="background-color:#99c655">fecha de contacto</th>

    <th class="botones" style="background-color:#99c655">fecha de proximo contacto</th>

    <th class="botones" style="background-color:#99c655">PAP PACIENTE</th>

    <th class="botones" style="background-color:#99c655">Fecha de retiro</th>

    <th class="botones" style="background-color:#99c655">Motivo de retiro</th>

  </tr>

  <?php

  while ($fila1 = mysqli_fetch_array($consulta_paciente)) {

  ?>

    <tr align="center" style="height:25px;">

      <td><?php echo $fila1['PRODUCTO_TRATAMIENTO'] ?></td>

      <td><?php echo $fila1['DOSIS_TRATAMIENTO'] ?></td>

      <td><?php echo $fila1['FECHA_ULTIMA_RECLAMACION_TRATAMIENTO'] ?></td>

      <td><?php echo $fila1['ASEGURADOR_TRATAMIENTO'] ?></td>

      <td><?php echo $fila1['OPERADOR_LOGISTICO_TRATAMIENTO'] ?></td>

      <td><?php echo $fila1['PUNTO_ENTREGA'] ?></td>

      <td></td>

      <td><?php echo $fila1['CIUDAD_PACIENTE'] ?></td>

      <td><?php echo $fila1['ESTADO_PACIENTE'] ?></td>

      <?php

      $ID = $fila1['ID_PACIENTE'];

      /*$consulta_ultima_reclamacion_gestion=mysql_query("SELECT FECHA_RECLAMACION_GESTION FROM ipsen_gestiones

			  WHERE ID_PACIENTE_FK2='$ID'

			  ORDER BY FECHA_RECLAMACION_GESTION DESC LIMIT 1",$conex);

			  $nreg_ult=mysql_num_rows($consulta_ultima_reclamacion_gestion);

			  echo mysql_error($conex);

			  if($nreg_ult>0)

	  		  {

				  while ($datos = mysql_fetch_array($consulta_ultima_reclamacion_gestion))

				  {

					  ?>

					  <td><?php echo $datos['FECHA_RECLAMACION_GESTION']?></td>

					  <?php

				  }

			  }

			  else

			  {

				  ?>

                  	<td></td>

                  <?php 

			  }*/

      $consulta_gestion = mysqli_query($conex, "SELECT * FROM ipsen_gestiones

WHERE ID_PACIENTE_FK2='$ID'

ORDER BY FECHA_COMUNICACION DESC LIMIT 1");

      echo mysqli_error($conex);

      $nreg = mysqli_num_rows($consulta_gestion);

      if ($nreg > 0) {

        while ($dato = mysqli_fetch_array($consulta_gestion)) {

      ?>

          <td><?php echo $datos['FECHA_RECLAMACION_GESTION'] ?></td>

          <td><?php echo $dato['CAUSA_NO_RECLAMACION_GESTION'] ?></td>

          <td><?php echo $dato['CONSECUTIVO_GESTION'] ?></td>

          <td><?php echo $dato['DESCRIPCION_COMUNICACION_GESTION'] ?></td>

          <td><?php echo $dato['CONSECUTIVO_BETAFERON'] ?></td>

          <td><?php echo $dato['FECHA_COMUNICACION'] ?></td>

          <td><?php echo $dato['FECHA_PROGRAMADA_GESTION'] ?></td>

        <?php

        }
      } else {

        ?>

        <td></td>

        <td></td>

        <td></td>

        <td></td>

        <td></td>

        <td></td>

        <td></td>

      <?php

      }

      ?>

      <td><?php echo 'PAP' . $fila1['ID_PACIENTE'] ?></td>

      <td><?php echo $fila1['FECHA_RETIRO_PACIENTE'] ?></td>

      <td><?php echo $fila1['MOTIVO_RETIRO_PACIENTE'] ?></td>

    </tr>

  <?php

  }

  ?>

</table>