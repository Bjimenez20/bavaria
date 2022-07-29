<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IPSEN</title>
	<link rel="stylesheet" type="text/css" href="../PRESENTACION/css/estilo_tablas.css" />
	<style>
		.aviso2 {
			font-size: 130%;
			font-weight: bold;
			color: #fff;
			text-transform: uppercase;
			font-family: "Trebuchet MS";
			border-radius: 10px;
			background: #024959;
			border: 0px;
			/* background-color: #69F */
			text-align: center;
		}
	</style>
</head>

<body>
	<?PHP
require('../datos/parse_str.php');
	require('../datos/conex.php');
	$NOMBRE = $_POST['nombre'];
	$DOCUMENTO = $_POST['documento'];
	$TELEFONO = $_POST['telefono'];
	if (isset($_POST['buscar'])) {
		//////////////////////////
		if ($NOMBRE == '' and $DOCUMENTO == '' and $TELEFONO == '') {
			//$consulta_ref=mysql_query("select * from inventario order by ID_INVENTARIO ASC",$conex);
			/*$consulta_ref=mysql_query("select * from inventario 
				INNER JOIN referencia ON referencia.CODIGO_GENFAR=inventario.CODIGO_PRODUCTO_FK
				order by ID_INVENTARIO ASC",$conex);
				echo mysql_error($conex);*/
			require('../presentacion/listado_rec_residuos.php');
		}
		if ($NOMBRE != '') {
			//$consulta_ref=mysql_query("select * from inventario order by ID_INVENTARIO ASC",$conex);
			/*$consulta_ref=mysql_query("select * from inventario 
				INNER JOIN referencia ON referencia.CODIGO_GENFAR=inventario.CODIGO_PRODUCTO_FK
				order by ID_INVENTARIO ASC",$conex);
				echo mysql_error($conex);*/
			require('../presentacion/listado_rec_residuos.php');
		}
		if ($DOCUMENTO != '') {
			//$consulta_ref = mysql_query("select * from referencia order by ID_REFERENCIA ASC",$conex);
			/*$consulta_ref=mysql_query("select * from inventario 
				INNER JOIN referencia ON referencia.CODIGO_GENFAR=inventario.CODIGO_PRODUCTO_FK
				order by ID_INVENTARIO ASC",$conex); 
				echo mysql_error($conex);*/
			require('../presentacion/listado_rec_residuos.php');
		}
		if ($TELEFONO != '') {
			//$consulta_ref = mysql_query("select * from referencia order by ID_REFERENCIA ASC",$conex);
			/*$consulta_ref=mysql_query("select * from inventario 
				INNER JOIN referencia ON referencia.CODIGO_GENFAR=inventario.CODIGO_PRODUCTO_FK
				order by ID_INVENTARIO ASC",$conex); 
				echo mysql_error($conex);*/
			require('../presentacion/listado_rec_residuos.php');
		}
	}
	////////////////////////// 
	if (isset($_POST['descargar'])) {
		/*	if($TIPO_C=='MOVIMIENTO')
	{
		if($TIPO=='TODAS')
		{
			$consulta_inv=mysql_query("select * from MOVIMIENTOS where (FECHA_MOVIMIENTO>='".$FECHAINI."' and FECHA_MOVIMIENTO<='".$FECHAFIN."') order by ID_MOVIMIENTOS ASC",$conex);
			require('../PRESENTACION/exportar_listado_inventario.php');
		}
		if($TIPO=='ENTRADA')
		{
			$consulta_inv=mysql_query("select * from MOVIMIENTOS where TIPO_MOVIMIENTO='1' and(FECHA_MOVIMIENTO>='".$FECHAINI."' and FECHA_MOVIMIENTO<='".$FECHAFIN."') order by ID_MOVIMIENTOS ASC",$conex);
			require('../PRESENTACION/exportar_listado_inventario.php');
		}
		if($TIPO=='SALIDA')
		{
			$consulta_inv=mysql_query("select * from MOVIMIENTOS where TIPO_MOVIMIENTO='2' and(FECHA_MOVIMIENTO>='".$FECHAINI."' and FECHA_MOVIMIENTO<='".$FECHAFIN."') order by ID_MOVIMIENTOS ASC",$conex);
			require('../PRESENTACION/exportar_listado_inventario.php');
		}
	}
	//DETALLE INVENTARIO
	if($TIPO_C=='DETALLE INVENTARIO')
	{
		if($lugar=='TODOS')
		{
			if($serial_producto=='')
			{
				$consulta_inv=mysql_query("select * from INVENTARIO 
				INNER JOIN REFERENCIA ON REFERENCIA.ID_REFERENCIA=INVENTARIO.ID_REFERENCIA_FK
				WHERE REFERENCIA.OPC_SERIAL='SI' order by ID_INVENTARIO ASC",$conex);
				echo mysql_error($conex);
			}
			else if($serial_producto!='')
			{
				$consulta_inv=mysql_query("select * from INVENTARIO 
				INNER JOIN REFERENCIA ON REFERENCIA.ID_REFERENCIA=INVENTARIO.ID_REFERENCIA_FK
				WHERE REFERENCIA.OPC_SERIAL='SI' AND CODIGO_PRODUCTO='".$serial_producto."'",$conex);
				echo mysql_error($conex);
			}
			require('../PRESENTACION/exportar_listado_inventario2.php');
		}
		if($lugar=='BODEGA')
		{
			if($serial_producto=='')
			{
				$consulta_inv=mysql_query("select * from INVENTARIO 
				INNER JOIN REFERENCIA ON REFERENCIA.ID_REFERENCIA=INVENTARIO.ID_REFERENCIA_FK
				WHERE LUGAR_MATERIAL='BODEGA' AND REFERENCIA.OPC_SERIAL='SI' order by ID_INVENTARIO ASC",$conex);
				echo mysql_error($conex);
			}
			else if($serial_producto!='')
			{
				$consulta_inv=mysql_query("select * from INVENTARIO 
				INNER JOIN REFERENCIA ON REFERENCIA.ID_REFERENCIA=INVENTARIO.ID_REFERENCIA_FK
				WHERE LUGAR_MATERIAL='BODEGA' AND REFERENCIA.OPC_SERIAL='SI'  AND CODIGO_PRODUCTO='".$serial_producto."'",$conex);
				echo mysql_error($conex);
			}
			require('../PRESENTACION/exportar_listado_inventario2.php');
		}
		if($lugar=='PACIENTE O ENFERMERA')
		{
			if($serial_producto=='')
			{
				$consulta_inv=mysql_query("select * from INVENTARIO 
				INNER JOIN REFERENCIA ON REFERENCIA.ID_REFERENCIA=INVENTARIO.ID_REFERENCIA_FK
				WHERE LUGAR_MATERIAL!='BODEGA' AND REFERENCIA.OPC_SERIAL='SI' order by ID_INVENTARIO ASC",$conex);
				echo mysql_error($conex);
			}
			else if($serial_producto!='')
			{
				$consulta_inv=mysql_query("select * from INVENTARIO 
				INNER JOIN REFERENCIA ON REFERENCIA.ID_REFERENCIA=INVENTARIO.ID_REFERENCIA_FK
				WHERE LUGAR_MATERIAL!='BODEGA' AND REFERENCIA.OPC_SERIAL='SI'  AND CODIGO_PRODUCTO='".$serial_producto."'",$conex);
				echo mysql_error($conex);
			}
			require('../PRESENTACION/exportar_listado_inventario2.php');
		}
	}
	if($TIPO_C=='BODEGA')
	{
		$consulta_ref=mysql_query("select * from REFERENCIA order by ID_REFERENCIA ASC",$conex);
		require('../PRESENTACION/exportar_listado_referencia.php');
	}*/
	}
	?>
</body>

</html>