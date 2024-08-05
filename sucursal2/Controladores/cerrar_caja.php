<?php
require '../Modelos/consultas.php';
cerrarCaja();
session_destroy();
header('location:../index.php');
?>