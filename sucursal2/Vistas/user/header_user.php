<?php session_start(); require '../../Modelos/consultas.php'; $info=view_tabla2('infosucursal');?>
<nav id='menu'>
  <div style="display: flex;margin-left: 20px;width: 30%;flex-direction: column;">
    <div style="display: flex;align-items: center;">
      <img src="data:image/jpg;base64,<?= $info[0]['logo'] ?>" width="40" height="40">
      <h2 style="margin:0"><?= $info[0]['nombre'] ?></h2> 
    </div>
    <h4 style="color: white;"><?= isset($_SESSION['sucursal']) ? 'Sucursal: '.$_SESSION['sucursal'] : ''; ?></h4>     
  </div>
   
  <ul>
    <li><a href='index.php'>Inicio</a></li>
    <li><a href="cola_pedidos.php">Pedidos</a></li>
    <li><a href="menu_pedidos.php">Realizar Pedido</a></li>
    <li><a href="infoStock.php">Stock</a></li>
    <li><a class="dropdown-arrow">Usuario: <?= $_SESSION['usuario'] ?></a>
        <ul class="sub-menus">
           <li><a href='../../Controladores/cerrarSesion.php'>Cerrar Sesion</a></li> 
        </ul>
    </li>
  </ul>
</nav>
