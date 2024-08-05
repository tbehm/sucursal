<<!DOCTYPE html>
<html>
<head>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
</html>
<?php
	session_start();
	require '../Modelos/consultas.php';
	date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
	$monto = filter_input(INPUT_POST, 'monto');
	$desc = filter_input(INPUT_POST, 'des');
	
	$hora= date("H:i:s");
	$datos = getId();
	foreach($datos as $elementos){
		$id_caja=$elementos['fecha'];
	}
	if($_SESSION['caja']<$monto){
	echo"<script type='text/javascript'>

			console.log('hola');
	Swal.fire({
  		title: 'Error',
  		text: 'No se puede cargar un gasto mayor al monto de la caja',
  			icon: 'error',
  			confirmButtonText:'Ok',
  			}).then((result) => {
    			if (result.isConfirmed) {
    			window.location.href = `../Vistas/caja.php`}});</script>";
    }else{
		postGasto($monto,$desc,$id_caja,$hora);	
?>
<script type="text/javascript">
	Swal.fire({
  		icon: "success",
 		title: "Listo...",
  		text: "Gasto registrado",
  		footer: "",
	}).then((result) => {
    if (result.isConfirmed) {
		window.location.href = "../Vistas/caja.php"
	}});
</script>
<?php
}
?>
