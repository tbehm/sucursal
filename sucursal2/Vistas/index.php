<?php 

include 'header.php';
date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
$fecha = date("Y-m-d");
$set = getCaja($fecha);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> 
</head>
<body>
    <section class="menu">
        <a href="view_sucursales.php" class="inicio">
            <span class="material-symbols-outlined">domain</span>
            <h2>Sucursales</h2>
        </a>
        <a href="view_empleados.php" class="inicio">
            <span class="material-symbols-outlined">groups</span>
            <h2>Empleados</h2>
        </a>
        <a href="view_productos.php" class="inicio">
            <span class="material-symbols-outlined">fastfood</span>
            <h2>Productos</h2>
        </a>
         <a href="caja.php" class="inicio">
            <span class="material-symbols-outlined">account_balance</span>
            <h2>Control</h2>
        </a>
        <a href="infoStock.php" class="inicio">
            <span class="material-symbols-outlined">monitoring</span>
            <h2>Stock</h2>
        </a>
        <a href="estadisticas.php" class="inicio">
            <span class="material-symbols-outlined">stacked_bar_chart</span>
            <h2>Estadisticas Ventas</h2>
        </a>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
