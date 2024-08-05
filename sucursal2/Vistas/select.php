<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar</title>
    <link rel="stylesheet" href="../Vistas/styles/style.css">
</head>
<body>
	<section>
        <h1 style="text-align:center;">SUCURSALES</h1>
        <form action="" method="post" class="menu-select">            
            <ul class="links">
                <?php
                   $sucursales = getSucursales();
                   foreach($sucursales as $sucursal){
                        echo'<li>
                    <input id="input_head" name="sucursal" type="submit" value="'.$sucursal['Direccion'].'"></li>';
                   }

                ?>
            </ul>
        </form>
    </section>
    	
</body>
</html>
<?php
    if(isset($_POST['sucursal'])){
        $data = getSucursalByDireccion($_POST['sucursal']);
        foreach($data as $sucursal){
            $_SESSION['Cod_sucursal'] = $sucursal['Cod_sucursal'];
        }
        $_SESSION['sucursal'] = $_POST['sucursal'];
        header("location:index.php");
    }
?>