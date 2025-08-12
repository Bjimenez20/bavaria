<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
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
		if ($privilegios == 1 || $privilegios == 5) {
			$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE INNER JOIN ipsen_gestiones WHERE ID_GESTION = ID_ULTIMA_GESTION ORDER BY ID_PACIENTE");
			echo mysqli_error($conex);
			$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE INNER JOIN ipsen_gestiones WHERE ID_GESTION = ID_ULTIMA_GESTION ORDER BY ID_PACIENTE LIMIT";
		}
		if ($privilegios == 2 || $privilegios == 6) {
			$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
			INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
			INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE
			WHERE G.FECHA_PROGRAMADA_GESTION='" . $hoy . "' AND G.ESTADO_GESTION!='GESTIONADO' AND USUARIO_ASIGANDO='" . $usua . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
			echo mysqli_error($conex);
			$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
			INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
			INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE
			WHERE G.FECHA_PROGRAMADA_GESTION='" . $hoy . "' AND G.ESTADO_GESTION!='GESTIONADO' AND USUARIO_ASIGANDO='" . $usua . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
		}
		if ($privilegios == 4) {
			$consulta_ref = mysqli_query($conex, "SELECT * FROM `ipsen_pacientes` INNER JOIN `ipsen_gestiones` ON ID_PACIENTE_FK2 = ID_PACIENTE INNER JOIN `ipsen_tratamiento` ON ID_PACIENTE_FK = ID_PACIENTE WHERE AUTORIZACION_EDUGESTOR = 'SI'");
			echo mysqli_error($conex);
			$consulta_PACIENTES = "SELECT * FROM `ipsen_pacientes` INNER JOIN `ipsen_gestiones` ON ID_PACIENTE_FK2 = ID_PACIENTE INNER JOIN `ipsen_tratamiento` ON ID_PACIENTE_FK = ID_PACIENTE WHERE AUTORIZACION_EDUGESTOR = 'SI' LIMIT";
		}
	}
	if (isset($_POST['buscar'])) {
		$privilegios;
		if ($privilegios == 1 || $privilegios == 2 || $privilegios == 5 || $privilegios == 6) {
			$NOMBRE = $_POST['nombre'];
			$DOCUMENTO = $_POST['documento'];
			$TELEFONO = $_POST['telefono'];
			$PAP = $_POST['PAP'];
		}
		if ($privilegios == 4) {
			$NOMBRE = '';
			$DOCUMENTO = '';
			$TELEFONO = '';
			$PAP = $_POST['PAP'];
		}
		if ($NOMBRE == '' and $DOCUMENTO == '' and $TELEFONO == '' and $PAP == '') {
			if ($privilegios == 1 || $privilegios == 5) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				echo mysqli_error($conex);
				$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
			}
			if ($privilegios == 2 || $privilegios == 6) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE
				WHERE G.FECHA_PROGRAMADA_GESTION='" . $hoy . "' AND G.ESTADO_GESTION!='GESTIONADO' AND USUARIO_ASIGANDO='" . $usua . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				echo mysqli_error($conex);
				$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE
				WHERE G.FECHA_PROGRAMADA_GESTION='" . $hoy . "' AND G.ESTADO_GESTION!='GESTIONADO' AND USUARIO_ASIGANDO='" . $usua . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
			}
		}
		if ($NOMBRE != '' and $DOCUMENTO == '' and $TELEFONO == '' and $PAP == '') {
			if ($privilegios == 1 || $privilegios == 5) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE CONCAT(P.NOMBRE_PACIENTE,' ',P.APELLIDO_PACIENTE) LIKE '%" . $NOMBRE . "%' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE CONCAT(P.NOMBRE_PACIENTE,' ',P.APELLIDO_PACIENTE) LIKE '%" . $NOMBRE . "%'GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
			}
			if ($privilegios == 2 || $privilegios == 6) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE CONCAT(P.NOMBRE_PACIENTE,' ',P.APELLIDO_PACIENTE) LIKE '%" . $NOMBRE . "%' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE CONCAT(P.NOMBRE_PACIENTE,' ',P.APELLIDO_PACIENTE) LIKE '%" . $NOMBRE . "%'GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
			}
		}
		if ($DOCUMENTO != '' and $NOMBRE == '' and $TELEFONO == '' and $PAP == '') {
			if ($privilegios == 1 || $privilegios == 5) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_ref) > 0) {
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				} else {
					$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
					echo mysqli_error($conex);
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				}
			}
			if ($privilegios == 2 || $privilegios == 6) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_ref) > 0) {
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				} else {
					$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
					echo mysqli_error($conex);
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				}
			}
		}
		if ($TELEFONO != '' and $NOMBRE == '' and $DOCUMENTO == '' and $PAP == '') {
			if ($privilegios == 1 || $privilegios == 5) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE TELEFONO_PACIENTE='" . $TELEFONO . "' OR TELEFONO2_PACIENTE='" . $TELEFONO . "'  OR TELEFONO3_PACIENTE='" . $TELEFONO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE TELEFONO_PACIENTE='" . $TELEFONO . "' OR TELEFONO2_PACIENTE='" . $TELEFONO . "'  OR TELEFONO3_PACIENTE='" . $TELEFONO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
			}
			if ($privilegios == 2 || $privilegios == 6) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE TELEFONO_PACIENTE='" . $TELEFONO . "' OR TELEFONO2_PACIENTE='" . $TELEFONO . "'  OR TELEFONO3_PACIENTE='" . $TELEFONO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE TELEFONO_PACIENTE='" . $TELEFONO . "' OR TELEFONO2_PACIENTE='" . $TELEFONO . "'  OR TELEFONO3_PACIENTE='" . $TELEFONO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
			}
		}
		if ($TELEFONO == '' and $NOMBRE == '' and $DOCUMENTO == '' and $PAP != '') {
			if ($privilegios == 1 || $privilegios == 5) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN(SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_ref) > 0) {
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				} else {
					$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
					echo mysqli_error($conex);
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				}
			}
			if ($privilegios == 2 || $privilegios == 6) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_ref) > 0) {
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				} else {
					$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
					echo mysqli_error($conex);
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				}
			}
		}
	}
?>

	<body>
		<?php
		$url = "../presentacion/listado_pacientes.php";
		if ($privilegios == 1 || $privilegios == 2 || $privilegios == 4 || $privilegios == 5 || $privilegios == 6) {
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
					<?php
					if ($privilegios == 1 || $privilegios == 2 || $privilegios == 5 || $privilegios == 6) {
					?>
						<th width="31%" class="botones">NOMBRE</th>
						<th width="12%" class="botones">DOCUMENTO</th>
						<th width="7%" class="botones">GENERO</th>
						<th width="12%" class="botones">CIUDAD</th>
					<?php
					}
					?>
					<th width="12%" class="botones">PRODUCTO</th>
					<?php
					if ($privilegios == 4) {
					?>
						<th width="12%" class="botones">CAUSAL</th>
					<?php
					}
					?>
					<?php
					if ($privilegios == 1 || $privilegios == 2 || $privilegios == 5 || $privilegios == 6) {
					?>
						<th width="11%" class="botones">PROXIMO CONTACTO</th>
						<th width="11%" class="botones">ESTADO GESTION</th>
						<th width="6%" class="botones">EDITAR</th>
					<?php
					}
					if ($privilegios == 1) {
					?>
						<th width="6%" class="botones">MODIFICAR</th>
					<?php
					}
					if ($privilegios == 4) {
					?>
						<th width="6%" class="botones">AUTORIZA</th>
						<!-- <th width="6%" class="botones">ENVIO</th> -->
					<?php
					}
					?>
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
						<?php
						if ($privilegios != 4) {
						?>
							<td><?php echo 'PAP' . $fila1['ID_PACIENTE'] ?></td>
							<?php
							if ($privilegios == '7') {
								if ($privilegios == '7') {
							?>
									<td align="left"><?php echo $fila1['NOMBRE_PACIENTE'] . ' ' . $fila1['APELLIDO_PACIENTE'] ?></td>
									<td><?php echo $fila1['IDENTIFICACION_PACIENTE'] ?></td>
								<?php } ?>
								<td><?php echo $fila1['GENERO_PACIENTE'] ?></td>
								<td><?php echo $fila1['CIUDAD_PACIENTE'] ?></td>
							<?php } else { ?>
								<td>****</td>
								<td>****</td>
								<td>****</td>
								<td>****</td>
							<?php } ?>
							<td><?php echo $fila1['PRODUCTO_TRATAMIENTO'] ?></td>
							<?php
							if ($privilegios == 1 || $privilegios == 2 || $privilegios == 5) {
							?>
								<?php
								$gestion = mysqli_query($conex, "SELECT * FROM `ipsen_gestiones` WHERE `ID_PACIENTE_FK2` = '" . $fila1['ID_PACIENTE'] . "' ORDER BY `FECHA_COMUNICACION` DESC LIMIT 1");
								while ($fila2 = mysqli_fetch_array($gestion)) {
									echo "<td>" . $fila2['FECHA_PROGRAMADA_GESTION'] . "</td>";
								}
								?>
								<td><?php echo $fila2['ESTADO_GESTION'] ?></td>
								<td>
									<?php
									$sqlusu = mysqli_query($conex, "SELECT PROGRAMA FROM ipsen_usuario WHERE USER = '" . $usua . "' ");
									echo mysqli_error($conex);
									while ($row1 = mysqli_fetch_array($sqlusu)) {
										$PROGRAMA = $row1['PROGRAMA'];
									}
									if ($PROGRAMA == "PAAP") { ?>
										<a href="../presentacion/form_paciente_paap.php?artid=<?php echo base64_encode($fila1['ID_PACIENTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="25" height="25" /></a>
									<?php } else { ?>
										<a href="../presentacion/form_paciente.php?artid=<?php echo base64_encode($fila1['ID_PACIENTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="25" height="25" /></a>
									<?php } ?>
								</td>
							<?php
							}
							if ($privilegios == 6) {
							?>
								<td><?php echo $fila1['FECHA_PROGRAMADA_GESTION'] ?></td>
								<td><?php echo $fila1['ESTADO_GESTION'] ?></td>
								<td><a href="../presentacion/form_paciente_recolecc.php?artid=<?php echo base64_encode($fila1['ID_PACIENTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="25" height="25" /></a></td>
							<?php
							}
							if ($privilegios == 1) {
							?>
								<td><a href="../presentacion/form_paciente_modificacion.php?artid=<?php echo base64_encode($fila1['ID_PACIENTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="25" height="25" /></a></td>
							<?php
							}
						} else {
							?>
							<td><?php echo 'PAP' . $fila1['ID_PACIENTE'] ?></td>
							<td><?php echo $fila1['PRODUCTO_TRATAMIENTO'] ?></td>
							<td><?php echo $fila1['CAUSA_NO_RECLAMACION_GESTION'] ?></td>
						<?php
						}
						if ($privilegios == 4) {
						?>
							<td style="display: flex; justify-content: space-evenly; align-items: center;">
								<a href="../logica/aprobar_paciente.php?accion=aprobar&artid=<?php echo base64_encode($fila1['ID_PACIENTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info">
									<img src="../presentacion/imagenes/CHULO.png" width="25" height="25" />
								</a>

								<!-- Botón/Imagen de Rechazo -->
								<a href="#" onclick="abrirModal('<?php echo base64_encode($fila1['ID_PACIENTE']); ?>','<?php echo base64_encode($fila1['ID_GESTION']); ?>'); return false;">
									<img src="../presentacion/imagenes/no.png" width="25" height="25" />
								</a>

								<!-- Modal -->
								<div id="modalRechazo" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
									<div style="background:white; padding:20px; max-width:400px; margin:100px auto; border-radius:8px;">
										<h3>Razón del rechazo</h3>
										<textarea id="razonRechazo" rows="4" style="width:100%;" placeholder="Escribe la razón..."></textarea>
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
											alert('Por favor, escribe la razón del rechazo.');
											return;
										}

										// Redirigir con la razón como parámetro
										window.location.href = `../logica/aprobar_paciente.php?accion=rechazar&artid=${pacienteId}&artge=${gestionId}&razon=${encodeURIComponent(razon)}`;
									}
								</script>


							</td>
						<?php
						}
						?>
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