<?php
include'header.php';
require'../Modelos/consultas.php';
$DNI = filter_input(INPUT_POST, 'dni');
$Nombre = filter_input(INPUT_POST, 'nombre');
$Apellido = filter_input(INPUT_POST, 'apellido');
$Telefono = filter_input(INPUT_POST, 'telefono');
$Direccion = filter_input(INPUT_POST, 'direccion');
$Fnac = filter_input(INPUT_POST, 'fecha');
$Puesto = filter_input(INPUT_POST, 'puesto');
$Sueldo = filter_input(INPUT_POST, 'sueldo');
$codigo = $_GET['cod'];
$Clave=filter_input(INPUT_POST, 'clave');
updateEmpleado($codigo,$DNI,$Clave,$Nombre,$Apellido,$Telefono,$Direccion,$Fnac,$Puesto,$Sueldo);
header('location:../Vistas/view_empleados.php')
?>