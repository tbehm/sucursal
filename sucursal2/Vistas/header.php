<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); 
}
if(!isset($_SESSION['usuario'])){
  header("location:../index.php");
}
else{
    var_dump($_SESSION['header']);
    include_once '../Modelos/consultas.php'; $info=view_tabla('infosucursal'); 
    ?>
      <link rel="stylesheet" type="text/css" href="styles/style.css">

  <nav id='menu' data-bg="<?= $_SESSION['bg'] ?>" data-header="<?= $_SESSION['header'] ?>" data-th="<?= $_SESSION['th'] ?>" data-font="<?= $_SESSION['font'] ?>" data-btn="<?= $_SESSION['btn'] ?>" data-aside="<?= $_SESSION['aside'] ?>" data-aside_btn="<?= $_SESSION['aside_btn'] ?>"">
    <div style="display: flex;margin-left: 20px;width: 30%;flex-direction: column;">
      <div style="display: flex;align-items: center;">
        <img src="data:image/jpg;base64,<?= $info[0]['logo'] ?>" width="40" height="40">
        <h2 style="margin:0"><?= $info[0]['nombre'] ?></h2> 
      </div>
      <h4 style="color: white;"><?= isset($_SESSION['sucursal']) ? 'Sucursal: '.$_SESSION['sucursal'] : ''; ?></h4>     
    </div>
    
    <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
    <ul>
      <li><a href='select.php'>Inicio</a></li>
      <li><a href='view_sucursales.php'>Sucursales</a></li>
      <li><a href='view_empleados.php'>Empleados</a></li>
      <li><a href='view_productos.php'>Productos</a></li>
      <li><a href='infoStock.php'>Stock</a></li>
      <li><a href='estadisticas.php'>Estadisticas Ventas</a></li>
      <li><a href='caja.php'>Control</a></li>
      <li><a class="dropdown-arrow">Usuario: <?= $_SESSION['usuario'] ?></a>
          <ul class="sub-menus">
             <li><a href='./view_config.php'>Configuración</a></li> 
             <li><a href='../Controladores/cerrarSesion.php'>Cerrar Sesion</a></li> 
          </ul>
      </li>
    </ul>
  </nav>
  <script type="text/javascript">
    const data = document.getElementById('menu');
    console.log(data.dataset.header);
    document.documentElement.style.cssText = `--bg-color:${data.dataset.bg};
    --header-color:${data.dataset.header};
    --header-color:${data.dataset.header};
    --table-th-color:${data.dataset.th};
    --header-font-color:${data.dataset.font};
    --button-color:${data.dataset.btn};
    --aside-color:${data.dataset.aside};
    --aside-button-color:${data.dataset.aside_btn};
    --header-color:${data.dataset.header};
    --header-color:${data.dataset.header};`;
   

  </script>
<?php
  }
?>