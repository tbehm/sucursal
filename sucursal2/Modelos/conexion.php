<?php
	$user="root";
	$psw="";
	$dbname="sucursal";
	$host="localhost";
	try{
		$dsn="mysql:host=localhost;dbname=$dbname";
		$conexion = new PDO($dsn, $user, $psw);
		//echo "Conexion realizada con exito";
	}catch(PDOException $e){
		echo $e->getMessage();

	}
	
