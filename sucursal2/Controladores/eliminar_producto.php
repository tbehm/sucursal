<?php
    require "../Modelos/consultas.php";
    $ubi=filter_input(INPUT_GET,'ubi');
    delete_producto($ubi);
    header('Location:../Vistas/view_productos.php');
?>