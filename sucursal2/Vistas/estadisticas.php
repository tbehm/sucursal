<?php
    include_once "header.php";
    date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
    //var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Estadisticas de ventas</title>
</head>
<body>
	<section id="content">
	<aside>
		<div id="buttons">
			<form action="" method="post">
				<h2>Plazo de tiempo</h2>
				<input type="submit" name="time" value="Siempre">
				<input type="submit" name="time" value="Este año">
				<input type="submit" name="time" value="Este mes">
				<input type="submit" name="time" value="Esta semana">
				
				<h2>Filtrar por:</h2>
				<input type="submit" name="op" value="Producto mas vendido">
				<input type="submit" name="op" value="Producto mas vendido aqui">
				<input type="submit" name="op" value="Actividad sucursales">
				<input type="submit" name="op" value="Horario mas concurrido">
			</form>
			
		</div>
	</aside>
	<div id="grafico"><canvas id="Estadistica" height=250px></canvas></div>
</section>
</body>
<?php

	if(isset($_POST['op'])){
		$_SESSION['op']=$_POST['op'];
	}
	if(isset($_POST['time'])){
		$_SESSION['time']=$_POST['time'];
	}
	if(isset($_SESSION['op'])){
		if(isset($_SESSION['time'])){
			$año=date("o");
			$mes=date("m");
			switch ($_SESSION['time']) {
				case 'Este año':
					$fechaInicio=date("Y-m-d",mktime(0,0,0,1,1,$año));
					$periodo=" AND fecha>'$fechaInicio'";
					break;
				case 'Este mes':
					$fechaInicio=date("Y-m-d",mktime(0,0,0,intval($mes),1,$año));
					$periodo=" AND fecha>'$fechaInicio'";
					break;
				case 'Esta semana':
					$dia=date("j");
					$diaSemanal=date("w");
					if($diaSemanal=="0"){
						$diaSemanal=7;
					}
					$dia = intval($dia)-intval($diaSemanal);
					$fechaInicio=date("Y-m-d",mktime(0,0,0,intval($mes),$dia,$año));
					$periodo=" AND fecha>'$fechaInicio'";
					break;
				default:
					$periodo="";
					break;
			}
		}		
		$suc = $_SESSION['Cod_sucursal'];
		switch ($_SESSION['op']) {
			case 'Producto mas vendido':
				$productos = getProductos();
				$data=[];
				$label=[];
				foreach($productos as $producto){
					$label[]=$producto['Nombre'];
					$nom=$producto['Nombre'];
					$sql="SELECT Cod_pedido FROM pedido WHERE Cod_sucursal=$suc AND producto LIKE '%".$nom."%'".$periodo;
					$data[$nom]=getPedidosEstadisticas($sql);
				}
				break;
				case 'Producto mas vendido aqui':
				$productos = getProductos();
				$data=[];
				$label=[];
				$sucursal = $_SESSION['Cod_sucursal'];
				foreach($productos as $producto){
					$label[]=$producto['Nombre'];
					$nom=$producto['Nombre'];
					$sql="SELECT Cod_pedido FROM pedido WHERE Cod_sucursal=$sucursal AND producto LIKE '%".$nom."%'".$periodo;
					$data[$nom]=getPedidosEstadisticas($sql);
				}
				break;
			case 'Actividad sucursales':
				$sucursales = getSucursales();
				$data=[];
				foreach($sucursales as $sucursal){
					$label[]=$sucursal['Direccion'];
					$cod=$sucursal['Cod_sucursal'];
					$sql="SELECT Cod_pedido FROM pedido WHERE Cod_sucursal=$cod".$periodo;
					$data[]=getPedidosEstadisticas($sql);
				}
				break;
			case 'Horario mas concurrido':
				$data=[];
				$label=["Madrugada","Mañana","Tarde","Noche"];
				$cod = $_SESSION['Cod_sucursal'];
				for ($i=0; $i <24 ; $i=$i+6) {
					$hora1=date("H:i:s",mktime($i,0,0,0,0,0));
					$hora2=date("H:i:s",mktime($i+6,0,0,0,0,0));
					$sql="SELECT Cod_pedido FROM pedido WHERE Cod_sucursal=$cod AND hora>'$hora1' AND hora<'$hora2'";
					$data[]=getPedidosEstadisticas($sql);
				}
				break;
		}
		$data=json_encode($data);
		$label=json_encode($label);
		echo'<script src="JavaScript/estadisticas.js"></script>';
		echo"<script type='text/javascript'>graficar(".$data.",".$label.")</script>";

	}
?>