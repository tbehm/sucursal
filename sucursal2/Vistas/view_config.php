<?php 
	include_once 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="UTF-8">
	<title>Configuracion</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<section id="media">
		<form action="../Controladores/configuracion.php" class="form" enctype="multipart/form-data" method="post">
			<h1 style="margin: 10px 0;">Configuración</h1>
			<hr>
			<div id="conf">
				<div style="line-height: 50px; height: 400px;">
					<img src="data:image/jpg;base64,<?= $info[0]['logo'] ?>" id="img" width="200" height="200">
					<input type="file" name="logo" id="foto" accept="image/*">
					<p>
					<label for="foto" class="boton-file">Cambiar Logo</label>
				
					<div style="margin:10px 0;">
						<label for="N">Nombre</label><br>
						<input type="text" name="titulo" id="N" value="<?= $info[0]['nombre'] ?>" placeholder="<?= $info[0]['nombre'] ?>" required>	
					</div>
				</div>
				
				<div id="config_buttons">
					<h1 style="margin: 10px 0;">Configurar colores</h1>
					<label class="color"><input type="color" name="bg_color" value="<?= $_SESSION['bg']?>" id="bg_color">Color de fondo</input></label>
					<label class="color"><input type="color" name="th_color" value="<?= $_SESSION['th']?>" id="th_color">Color de encabezado de tablas</input></label>
					<label class="color"><input type="color" name="header_color" value="<?= $_SESSION['header']?>" id="header_col">Color del header</input></label>
					<label class="color"><input type="color" name="font_color" value="<?= $_SESSION['font']?>" id="font_color">Color de letras del header</input></label>
					<label class="color"><input type="color" name="btn_color" id="btn_color" value="<?= $_SESSION['btn']?>" id="th_color">Color de botones</input></label>
					<label class="color"><input type="color" name="aside_color" id="aside_color" value="<?= $_SESSION['aside']?>" id="aside_color">Color de ventana lateral</input></label>
					<label class="color"><input type="color" name="aside_btn_color" value="<?= $_SESSION['aside_btn']?>" id="aside_btn_color">Color de botones de barra lateral</input></label>
				</div>
			</div>	
			<button type="submit" id="sub" class="buton-carrito-r" >
				Guardar Cambios
			</button>	
			<script src="JavaScript/setColors.js"></script>

		</form>	
	</section>
	<script src="JavaScript/config.js"></script>
</body>
</html>