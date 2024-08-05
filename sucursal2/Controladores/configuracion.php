<?php 
	require '../Modelos/consultas.php';
	$info=view_tabla('infoSucursal');
	$titulo=filter_input(INPUT_POST, 'titulo');
	echo $titulo."<br>";
	echo $_FILES["logo"]['name'];
	//var_dump($_FILES);
	if (!empty($_FILES["logo"]['tmp_name'])) {//SI cambia la imagen la envie a la base
		$archivo=$_FILES['logo'];
		$contImg=file_get_contents($archivo['tmp_name']);
		$imgBase64=base64_encode($contImg);
		//var_dump($archivo);
		//var_dump($imgBase64);
	}//SI cambia la imagen la envie a la base
	else{//SI no cambia la imagen 
		$imgBase64=$info[0]['logo'];
	}//SI no cambia la imagen 

	editLocal($titulo,$imgBase64);

/*
	?>
	<div>
		<img src="data:image/png;base64,<?=$imgBase64?>" width="50" hegth="50">
	</div>
	<?php
*/
	
	updateColors($_POST['bg_color'],$_POST['th_color'],$_POST['header_color'], $_POST['font_color'], $_POST['btn_color'], $_POST['aside_color'], $_POST['aside_btn_color']);
		$colors=getColors();
    	foreach($colors as $col){
	        $_SESSION['bg']=$col['bg_color'];
	        $_SESSION['header'] = $col['header_color'];
	        $_SESSION['th'] = $col['table_color'];
	        $_SESSION['font']=$col['font'];
	        $_SESSION['btn'] = $col['btn'];
	        $_SESSION['aside'] = $col['aside'];
	      	$_SESSION['aside_btn'] = $col['aside_btn'];

	    }
	header("Location:../Vistas/view_config.php");
 ?>