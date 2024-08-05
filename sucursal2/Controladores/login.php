<!DOCTYPE html>
<html>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
<?php
    session_start();
    require "../Modelos/consultas.php";

    $colors=getColors();
    foreach($colors as $col){
        $_SESSION['bg']=$col['bg_color'];
        $_SESSION['header'] = $col['header_color'];
        $_SESSION['th'] = $col['table_color'];
        $_SESSION['font']=$col['font'];
        $_SESSION['btn'] = $col['btn'];
        $_SESSION['aside'] = $col['aside'];
        $_SESSION['aside_btn']=$col['aside_btn'];
    }

    $DNI = filter_input(INPUT_POST,'DNI');
    $Clave = filter_input(INPUT_POST,'Clave');
    $datos = userExists($DNI,$Clave);
    if(!empty($datos)){
        foreach($datos as $elemento){
            $_SESSION['usuario'] = $elemento['Nombre'];
            $_SESSION['DNI'] = $elemento['DNI'];
            $_SESSION['sucursal']=$elemento['Direccion'];
            $_SESSION['Cod_sucursal']=$elemento['Cod_sucursal'];
            header('Location:../Vistas/user/index.php'); 
        } 
    }
    if ($DNI=='0101' && $Clave=='admin' ) {
        $_SESSION['usuario'] = "admin";
        $_SESSION['DNI'] = $DNI;
        header('Location:../Vistas/select.php'); 
    }
    else{
        echo"<script>
Swal.fire({
  title: 'Error',
  text: 'Contraseña Incorrecta, intente nuevamente',
  icon: 'error',
  confirmButtonText: 'Reintentar'

})
.then((resulta )=>{
    window.location.assign('../index.php')
}) 
</script>";
    
       
    }

    
           
?>