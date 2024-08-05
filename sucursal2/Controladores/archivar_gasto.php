<?php
require '../Modelos/consultas.php';
date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
		$fecha = date("Y-m-d");
	$id=$_GET['id'];
	updateGasto($id);
	$datos = getDescGasto($fecha);
	foreach($datos as $gasto){
			if($gasto['hora']==$id){
				updateCaja($gasto['monto'],"+");
			}
		}
	header('location:../Vistas/caja.php');
?>