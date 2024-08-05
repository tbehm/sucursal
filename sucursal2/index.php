<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapidash</title>
    	<link rel="stylesheet" type="text/css" href="Vistas/styles/style.css">

</head>
<body>
<center><div class="mainbox">
		<form action="Controladores/login.php" method="post">
			<h1>Inicia Sesion</h1>

			<div class="input-box">
				<input type="number" name="DNI" maxlength="10" placeholder="DNI" required>
				<i class='bx bxs-user'></i>
			</div>
			<div class="input-box">
				<input type="Password" name="Clave" placeholder="Contraseña" required>
				<i class='bx bxs-lock-alt'></i>
			</div>
            <div class="boton">
				<button type="submit" class="btn">Ingresar</button>
			</div>
		</form>
	</center>
</body>
</html>
