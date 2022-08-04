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
			$consulta_ref = 0;
			echo mysqli_error($conex);
			$consulta_PACIENTES = 0;
			$num_total_registros = 0;
		}
		//include('../presentacion/listado_pacientes.php');
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
			//include('../presentacion/listado_pacientes.php');
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
			//require('../presentacion/listado_pacientes.php');
		}
		if ($DOCUMENTO != '' and $NOMBRE == '' and $TELEFONO == '' and $PAP == '') {
			if ($privilegios == 1 || $privilegios == 5) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_ref) > 0) {
					//echo 'ok';
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				} else {
					//echo 'ok1';
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
				//echo 'ok2';
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_ref) > 0) {
					//echo 'ok3';
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					INNER JOIN (SELECT * FROM ipsen_gestiones WHERE MOTIVO_COMUNICACION_GESTION!='GESTION FUNDEM' AND AUTOR_GESTION!='FUNDEM' ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				} else {
					//echo 'ok4';
					$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
					echo mysqli_error($conex);
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					WHERE IDENTIFICACION_PACIENTE='" . $DOCUMENTO . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
				}
			}
			//require('../presentacion/listado_pacientes.php');
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
			//require('../presentacion/listado_pacientes.php');
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
			if ($privilegios == 4) {
				$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_pacientes AS P
				INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
				INNER JOIN (SELECT * FROM ipsen_gestiones ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_ref) > 0) {
					$consulta_PACIENTES = "SELECT * FROM ipsen_pacientes AS P
					INNER JOIN ipsen_tratamiento AS T ON T.ID_PACIENTE_FK=P.ID_PACIENTE
					INNER JOIN (SELECT * FROM ipsen_gestiones ORDER BY ID_GESTION DESC) AS G ON G.ID_PACIENTE_FK2=P.ID_PACIENTE WHERE ID_PACIENTE='" . $PAP . "' GROUP BY P.ID_PACIENTE  ORDER BY P.ID_PACIENTE ASC LIMIT";
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
		/*$consulta_ref=mysql_query("select * from ipsen_pacientes order by ID ASC",$conex);	*/
		if ($privilegios == 1 || $privilegios == 2 || $privilegios == 5 || $privilegios == 6) {
			$num_total_registros = mysqli_num_rows($consulta_ref);
		}
		if (isset($_POST['buscar']) && $privilegios == 4) {
			$num_total_registros = mysqli_num_rows($consulta_ref);
		}
		//Si hay registros
		if ($num_total_registros > 0) {
		?>
			<table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
				<tr>
					<th width="9%" class="botones">CODIGO</th>
					<?php
					if ($privilegios != 4) {
					?>
						<th width="31%" class="botones">NOMBRE</th>
						<th width="12%" class="botones">DOCUMENTO</th>
					<?php } ?>
					<th width="7%" class="botones">GENERO</th>
					<th width="12%" class="botones">CIUDAD</th>
					<th width="12%" class="botones">PRODUCTO</th>
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
						<th width="6%" class="botones">GESTION</th>
						<th width="6%" class="botones">ENVIO</th>
					<?php
					}
					?>
				</tr>
				<?PHP
				//Limito la busqueda
				$TAMANO_PAGINA = 20;
				$pagina = false;
				//examino la pagina a mostrar y el inicio del registro a mostrar
				if (isset($_GET["pagina"]))
					$pagina = $_GET["pagina"];
				if (!$pagina) {
					$inicio = 0;
					$pagina = 1;
				} else {
					$inicio = ($pagina - 1) * $TAMANO_PAGINA;
				}
				//calculo el total de paginas
				$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
				//pongo el nï¿½mero de registros total, el tamaï¿½o de pï¿½gina y la pï¿½gina que se muestra
				/*echo '<h3>Numero de articulos: '.$num_total_registros .'</h3>';
		echo '<h3>En cada pagina se muestra '.$TAMANO_PAGINA.' articulos ordenados por fecha de forma descendente.</h3>';
		echo '<h3>Mostrando la pagina '.$pagina.' de ' .$total_paginas.' paginas.</h3>';*/
				$consulta = "$consulta_PACIENTES " . $inicio . "," . $TAMANO_PAGINA;
				$consulta_ref = mysqli_query($conex, $consulta);
				//while ($row = mysql_fetch_array($rs)) {	
				while ($fila1 = mysqli_fetch_array($consulta_ref)) {
					//$ref_cod = $fila1['CODIGO_GENFAR'];
				?>
					<tr align="center">
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
							<td><?php echo $fila1['ESTADO_GESTION'] ?></td>
							<td>
								<?php
								$sqlusu = mysqli_query($conex, "SELECT PROGRAMA FROM ipsen_usuario WHERE USER = '$usua' ");
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
						if ($privilegios == 4) {
						?>
							<td><a href="../presentacion/form_paciente.php?artid=<?php echo base64_encode($fila1['ID_PACIENTE']); ?>&artge=<?php echo base64_encode($fila1['ID_GESTION']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="25" height="25" /></a></td>
							<td><a href="../presentacion/envio_fundem.php?artid=<?php echo base64_encode($fila1['ID_PACIENTE']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="25" height="25" /></a></td>
						<?php
						}
						?>
					</tr>
				<?php
				}
				?>
				<tr bgcolor="#FFFFFF" class="titulo" align="center">
					<td colspan="3" class="botones">Se encontraron Registros <?php echo $num_total_registros; ?></td>
					<td colspan="8" class="botones">
						<?php
						if ($total_paginas > 1) {
							if ($pagina != 1)
								echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
							for ($i = 1; $i <= $total_paginas; $i++) {
								if ($pagina == $i)
									//si muestro el indice de la pagina actual, no coloco enlace
									echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
								else
									//si el indice no corresponde con la pagina mostrada actualmente,co
									//coloco el enlace para ir a esa pagina
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
				<span style="border-left-color:#fff">NO SE ENCUENTRAN REGISTROS CON ESTA INFORMACI&Oacute;N.</span>
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