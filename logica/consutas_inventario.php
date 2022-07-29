<?php
include('../logica/session.php');
"<body>";
require('../datos/parse_str.php');
require('../datos/conex.php');
if ($_POST['fecha_ini'] = '') {
	$FECHAINI = $_POST['fecha_ini'] . " 00:00:00";
} else {
	$FECHAINI = "0000-00-00" . " 00:00:00";
}
if ($_POST['fecha_fin'] = '') {
	$FECHAFIN = $_POST['fecha_fin'] . " 24:00:00";
} else {
	$FECHAFIN = "9999-99-99" . " 24:00:00";
}
$TIPO = $_POST['TIPO'];
$TIPO_C = $_POST['TIPO_CON'];
$LUGAR = $_POST['LUGAR'];
$serial_producto = $_POST['serial_producto'];
if (isset($_POST['buscar'])) {
	//INICIO MOVIMIENTO 
	if ($TIPO_C == 'MOVIMIENTO') {
		if ($TIPO == 'TODAS') {
			$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_movimientos WHERE (FECHA_MOVIMIENTO>='" . $FECHAINI . "' and FECHA_MOVIMIENTO<='" . $FECHAFIN . "') order by ID_MOVIMIENTOS ASC");
			require('../presentacion/listado_inventario.php');
		}
		if ($TIPO == 'ENTRADA') {
			$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_movimientos where TIPO_MOVIMIENTO='1' and(FECHA_MOVIMIENTO>='" . $FECHAINI . "' and FECHA_MOVIMIENTO<='" . $FECHAFIN . "') order by ID_MOVIMIENTOS ASC");
			require('../presentacion/listado_inventario.php');
		}
		if ($TIPO == 'SALIDA') {
			$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_movimientos where TIPO_MOVIMIENTO='2' and(FECHA_MOVIMIENTO>='" . $FECHAINI . "' and FECHA_MOVIMIENTO<='" . $FECHAFIN . "') order by ID_MOVIMIENTOS ASC");
			require('../presentacion/listado_inventario.php');
		}
	}
	//INICIO DETALLE INVENTARIO
	if ($TIPO_C == 'DETALLE INVENTARIO') {
		if ($LUGAR == 'TODOS') {
			if ($serial_producto == '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_inventario 
				INNER JOIN ipsen_referencia ON ipsen_referencia.ID_REFERENCIA=ipsen_inventario.ID_REFERENCIA_FK
				INNER JOIN ipsen_movimientos AS M ON ipsen_inventario.ID_INVENTARIO=M.ID_INVENTARIO_FK
				WHERE ipsen_referencia.OPCION_SERIAL='' ORDER BY ID_MOVIMIENTOS ASC");
				echo mysqli_error($conex);
			} elseif ($serial_producto != '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_inventario 
				INNER JOIN ipsen_referencia ON ipsen_referencia.ID_REFERENCIA=ipsen_inventario.ID_REFERENCIA_FK
				INNER JOIN ipsen_movimientos AS M ON ipsen_inventario.ID_INVENTARIO=M.ID_INVENTARIO_FK
				WHERE ipsen_referencia.OPCION_SERIAL='' AND CODIGO_PRODUCTO='" . $serial_producto . "'
				ORDER BY ID_MOVIMIENTOS DESC LIMIT 1 ");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_inv) <= 0) {
?>
					<p class="aviso2" style="background-color:#F79D49; color:#000;">EL PRODUCTO CON EL # DE SERIAL <?php echo $serial_producto ?> NO SE ENCUENTRA.</p>
				<?php
				}
			}
			require('../presentacion/listado_inventario2.php');
		}
		if ($LUGAR == 'BODEGA') {
			if ($serial_producto == '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_inventario AS I INNER JOIN ipsen_referencia AS R ON R.ID_REFERENCIA=I.ID_REFERENCIA_FK INNER JOIN ipsen_movimientos AS M ON I.ID_INVENTARIO=M.ID_INVENTARIO_FK WHERE I.LUGAR_MATERIAL='BODEGA' AND M.TIPO_MOVIMIENTO='1' ORDER BY I.ID_INVENTARIO ASC;");
				echo mysqli_error($conex);
			} elseif ($serial_producto != '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_inventario 
				INNER JOIN ipsen_referencia ON ipsen_referencia.ID_REFERENCIA=ipsen_inventario.ID_REFERENCIA_FK
				WHERE LUGAR_MATERIAL=!'BODEGA' AND ipsen_referencia.OPCION_SERIAL='SI'  AND CODIGO_PRODUCTO='" . $serial_producto . "'");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_inv) <= 0) {
				?>
					<p class="aviso2" style="background-color:#F79D49; color:#000;">EL PRODUCTO CON EL # DE SERIAL <?php echo $serial_producto ?> NO SE ENCUENTRA EN LA BODEGA.</p>
				<?php
				}
			}
			require('../presentacion/listado_inventario2.php');
		}
		if ($LUGAR == 'PACIENTE') {
			if ($serial_producto == '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_inventario AS I
				INNER JOIN ipsen_referencia AS R ON R.ID_REFERENCIA=I.ID_REFERENCIA_FK
				INNER JOIN ipsen_movimientos AS M ON I.ID_INVENTARIO=M.ID_INVENTARIO_FK
				WHERE I.LUGAR_MATERIAL!='BODEGA' AND M.TIPO_MOVIMIENTO='2' ORDER BY I.ID_INVENTARIO ASC");
				echo mysqli_error($conex);
			} else if ($serial_producto != '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_inventario AS I
				INNER JOIN ipsen_referencia AS R ON R.ID_REFERENCIA=I.ID_REFERENCIA_FK
				INNER JOIN ipsen_movimientos AS M ON I.ID_INVENTARIO=M.ID_INVENTARIO_FK
				WHERE LUGAR_MATERIAL!='BODEGA' AND R.OPCION_SERIAL='SI'  AND I.CODIGO_PRODUCTO='" . $serial_producto . "'
				ORDER BY M.ID_MOVIMIENTOS DESC LIMIT 1");
				echo mysqli_error($conex);
				if (mysqli_num_rows($consulta_inv) <= 0) {
				?>
					<p class="aviso2" style="background-color:#F79D49; color:#000;">EL PRODUCTO CON EL # DE SERIAL <?php echo $serial_producto ?> NO SE ENCUENTRA ASIGNADO.</p>
<?php
				}
			}
			require('../presentacion/listado_inventario2.php');
		}
	}
	//INICIO INVENTARIO
	if ($TIPO_C == 'INVENTARIO') {
		$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_referencia order by ID_REFERENCIA ASC");
		require('../presentacion/listado_referencia.php');
	}
}
if (isset($_POST['descargar'])) {
	//INICIO MOVIMIENTO
	if ($TIPO_C == 'MOVIMIENTO') {
		if ($TIPO == 'TODAS') {
			$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_movimientos where (FECHA_MOVIMIENTO>='" . $FECHAINI . "' and FECHA_MOVIMIENTO<='" . $FECHAFIN . "') order by ID_MOVIMIENTOS ASC");
			require('../presentacion/exportar_listado_inventario.php');
		}
		if ($TIPO == 'ENTRADA') {
			$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_movimientos where TIPO_MOVIMIENTO='1' and(FECHA_MOVIMIENTO>='" . $FECHAINI . "' and FECHA_MOVIMIENTO<='" . $FECHAFIN . "') order by ID_MOVIMIENTOS ASC");
			require('../presentacion/exportar_listado_inventario.php');
		}
		if ($TIPO == 'SALIDA') {
			$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_movimientos where TIPO_MOVIMIENTO='2' and(FECHA_MOVIMIENTO>='" . $FECHAINI . "' and FECHA_MOVIMIENTO<='" . $FECHAFIN . "') order by ID_MOVIMIENTOS ASC");
			require('../presentacion/exportar_listado_inventario.php');
		}
	}
	//INVENTARIO
	if ($TIPO_C == 'INVENTARIO') {
		$consulta_ref = mysqli_query($conex, "SELECT * FROM ipsen_referencia order by ID_REFERENCIA ASC");
		require('../presentacion/exportar_listado_inventario3.php');
	}
	//DETALLE INVENTARIO
	if ($TIPO_C == 'DETALLE INVENTARIO') {
		if ($LUGAR == 'TODOS') {
			if ($serial_producto == '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_inventario INNER JOIN ipsen_referencia ON ID_REFERENCIA=ID_REFERENCIA_FK WHERE OPCION_SERIAL='' order by ID_INVENTARIO ASC;");
				echo mysqli_error($conex);
			} else if ($serial_producto != '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM INVENTARIO 
				INNER JOIN REFERENCIA ON REFERENCIA.ID_REFERENCIA=INVENTARIO.ID_REFERENCIA_FK
				WHERE REFERENCIA.OPCION_SERIAL='SI' AND CODIGO_PRODUCTO='" . $serial_producto . "'");
				echo mysqli_error($conex);
			}
			require('../presentacion/exportar_listado_inventario2.php');
		}
		if ($LUGAR == 'BODEGA') {
			if ($serial_producto == '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_inventario 
				INNER JOIN ipsen_referencia ON ID_REFERENCIA=ID_REFERENCIA_FK
				WHERE LUGAR_MATERIAL='BODEGA' AND OPCION_SERIAL='' order by ID_INVENTARIO ASC;");
				echo mysqli_error($conex);
			} else if ($serial_producto != '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM INVENTARIO 
				INNER JOIN REFERENCIA ON REFERENCIA.ID_REFERENCIA=INVENTARIO.ID_REFERENCIA_FK
				WHERE LUGAR_MATERIAL='BODEGA' AND REFERENCIA.OPCION_SERIAL='SI'  AND CODIGO_PRODUCTO='" . $serial_producto . "'");
				echo mysqli_error($conex);
			}
			require('../presentacion/exportar_listado_inventario2.php');
		}
		if ($LUGAR == 'PACIENTE') {
			if ($serial_producto == '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM ipsen_inventario 
				INNER JOIN ipsen_referencia ON ID_REFERENCIA=ID_REFERENCIA_FK
				WHERE LUGAR_MATERIAL!='BODEGA' AND OPCION_SERIAL='' order by ID_INVENTARIO ASC");
				echo mysqli_error($conex);
			} else if ($serial_producto != '') {
				$consulta_inv = mysqli_query($conex, "SELECT * FROM INVENTARIO 
				INNER JOIN REFERENCIA ON REFERENCIA.ID_REFERENCIA=INVENTARIO.ID_REFERENCIA_FK
				WHERE LUGAR_MATERIAL!='BODEGA' AND REFERENCIA.OPCION_SERIAL='SI'  AND CODIGO_PRODUCTO='" . $serial_producto . "'");
				echo mysqli_error($conex);
			}
			require('../presentacion/exportar_listado_inventario2.php');
		}
	}
	if ($TIPO_C == 'BODEGA') {
		$consulta_ref = mysqli_query($conex, "SELECT * FROM REFERENCIA order by ID_REFERENCIA ASC");
		require('../presentacion/exportar_listado_referencia.php');
	}
}
?>
</body>

</html>
<?php
?>