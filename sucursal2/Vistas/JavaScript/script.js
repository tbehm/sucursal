
function updatemenu() {
  if (document.getElementById('responsive-menu').checked == true) {
    document.getElementById('menu').style.borderBottomRightRadius = '0';
    document.getElementById('menu').style.borderBottomLeftRadius = '0';
  }else{
    document.getElementById('menu').style.borderRadius = '<font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10</font></font>px';
  }
}

function modificar(a, b, c, d, e, f){
    const contenido= `<form action='modify.php?cod=${a}' method="post">
        Direccion:
        <p>
        <input type="text" name="direccion" placeholder="${b}" class="swal2-input">
        <p>
        Capacidad:
        <p>
         <input type="text" name="capacidad" placeholder="${c}" class="swal2-input">
        <p> 
        Supervisor
        <p>
         <input type="text" name="supervisor" placeholder="${d}" class="swal2-input" >
        <p>
        Fecha
        <p>
        <input type="date" name="fecha" placeholder="${e}" class="swal2-input">
        <p>
        Cantidad de empleados
        <p>
         <input type="text" name="cant" placeholder="${f}" class="swal2-input">
        <p>
        <button type="submit" class="buton-carrito-r">Modificar</button>
        </form>
        <p style="margin-top:10px;">
        <br>
        <a href="view_sucursales.php"><button class="buton-carrito-c">Volver</button></a></p>`;
    Swal.fire({
        title: "Modificar",
        html: contenido,
        allowOutsideClick: true,
        showConfirmButton: false,
        footer: "",
    });
    
}
function add(){
    const contenido= `<form action='up_sucursal.php' method="post">
        
        Direccion:
        <p>
        <input type="text" name="dir"  class="swal2-input" required>
        <p>
        Capacidad:
        <p>
         <input type="text" name="cap"  class="swal2-input" required>
        <p>
        Cantidad de empleados
        <p>
         <input type="text" name="cant" class="swal2-input" required>
        <p>
        <button type="submit" class="buton-carrito-r">Ingresar</button>
        </form>
        <p style="margin-top:10px;">
        <br>
        <a href="view_sucursales.php"><button class="buton-carrito-c">Volver</button></a></p>`;
    Swal.fire({//MUESTRA UNA VENTANA EMERGENTE PARA INGRESAR NOMBRE
        title: "Nueva sucursal",
        html: contenido,
        allowOutsideClick: true,
        showConfirmButton: false,
        footer:"Luego debera asignar los empleados y supervisor correspondientes",
    });//MUESTRA UNA VENTANA EMERGENTE PARA INGRESAR NOMBRE
    
}

/**********************************
*
*   FUNCIONES CRUD PRODUCTOS
*
***********************************/

function addProducto(){
    let contenido=`
        <form action="../Controladores/agregar_producto.php" style="font-size:.9rem;">
            <label for="ing_nom">Nombre
            <p>
            <input type="text" name="ing_nom" class="swal2-input" required></label>
            <p>
            <label for="ing_des">Descripcion
            <p>
            <input type="text" name="ing_des" class="swal2-input" required></label>
            <p>
            <label for="ing_pre">Precio
            <p>
            <input type="number" name="ing_pre" class="swal2-input" min="0" required></label>
            <p>
            <button type="submit" class="buton-carrito-r" style="margin:10px 0;">Agregar</button>
        </form>`
    Swal.fire({
        title: "Agregar Producto",
        html: contenido,
        showConfirmButton: false,
        showCloseButton: true,
    });
}

function eliminarProducto(cod){
    Swal.fire({
        title: "Realmente desea eliminar este Producto?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminarla!"
    }).then((result) => {
    if (result.isConfirmed) {
        window.location.href = `../Controladores/eliminar_producto.php?ubi=${cod}`

        }
    });
}

function modifyProducto(id,nombre,descr,precio) {
    console.log(nombre,descr,precio)
    const contenido=`
    <form action="../Controladores/modificar_producto.php" style="display:inline-grid">
        <span>Id Producto<p><input type="text" name="ubi_Id" value="${id}" class="swal2-input" readonly><p></span>
        <span>Nombre<p><input type="text" name="nuev_nombre" value="${nombre}" class="swal2-input" required><p></span>
        <span>Descripcion<p><input type="text" name="nuev_descrip" value="${descr}" class="swal2-input" required><p></span>
        <span>Precio<p><input type="number" name="nuev_precio" value="${precio}" class="swal2-input" required><p></span>
        <button type="submit" class="buton-carrito-r" style="margin:10px 0;">Editar</button>
    </form>`
    Swal.fire({
        title:"Editar Producto",
        html: contenido,
        showConfirmButton: false,
        showCloseButton: true,
    })
}

/********************************
*
*       FUNCIONES PEDIDOS
*
*********************************/
function nombre(mesa){
  (async()=>{
    const { value: nombre } = await Swal.fire({
      title: "Pedido",
      icon: 'question',
      input: 'text',
      inputPlaceholder: "Ingrese nombre del pedido",
      inputAutoFocus: true,
      showCancelButton: true,
      cancelButtonColor: "red",
      confirmButtonColor: "green",
      confirmButtonText: "Realizar",
      position: 'center',
    });

    if (nombre) {
        window.location.assign(`tomar_pedido.php?nom=${nombre}&mesa=${mesa}&ac=nuevo`);
    }
  })()
}

function addPedido(producto,mesa,id,nombre,sucursal) {
    console.log(producto+id+mesa+nombre)
    window.location.assign(`../../Controladores/agregar_pedido.php?pro=${producto}&mesa=${mesa}&id=${id}&nom=${nombre}&suc=${sucursal}`);
}

function eliminar_pedido(cod,accion,sucursal){
    Swal.fire({
        title: "Realmente desea eliminar este pedido?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminarla!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `../../Controladores/eliminar_pedido.php?id=${cod}&ac=${accion}&suc=${sucursal}`
        }
    });
}

function realizar_pedido(cod, id,sucursal){
    Swal.fire({
        title: "Desea realizar el pedido?",
        text: "",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, realizar"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `../../Controladores/realizar_pedido.php?ubi=${cod}&id=${id}&suc=${sucursal}`
        }
    });
}

function eliminar_pedidoProducto(cod,producto,accion) {
    window.location.href = `../../Controladores/eliminar_pedido.php?id=${cod}&pro=${producto}&ac=${accion}`
}

function ver_pedido(mesa,accion) {
    if (accion == 'proceso') {
        window.location.assign(`tomar_pedido.php?mesa=${mesa}&ac=ver`);
    }
    else if (accion == 'finalizado') {
        window.location.assign(`ver_pedido.php?mesa=${mesa}`);
    }

}

function limpiar_mesa(cod,id,sucursal){
    Swal.fire({
        title: "Desea desocupar la mesa?",
        text: "",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, realizar"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `../../Controladores/limpiar_mesa.php?ubi=${cod}&id=${id}&suc=${sucursal}`
        }
    });
}


/********************************
*
*       FUNCIONES DESCUENTO
*
*********************************/
function addDescuento(productos) {
    (async()=>{
    const { value: nombre } = await Swal.fire({
      title: "Agregar Descuento",
      html: `<input type="number" class="swal2-input" id="cant" min="1" max="5" placeholder="Ingrese la Cantidad de productos" style="width:70%;">`,
      inputAutoFocus: true,
      showCloseButton: true,
      confirmButtonColor: "ligthblue",
      confirmButtonText: "Siguiente",
      position: 'center',
    });

    const cantidad=document.getElementById('cant')
    if (cantidad.value) {
        console.log(productos)
        let contenido=`
            <form method="post" action="../Controladores/agregar_descuento.php" style="font-size:.9rem;">
                <label for="ing_pre">Nombre del Descuento
                <p>
                <input type="text" name="nom" class="swal2-input" min="1" max="100" required></label>
                <p>
        `
        for (var i = 1; i <= cantidad.value; i++) {
            contenido=contenido+`
                <label>${i}º Producto
                <p>
                <select name="pro" class="swal2-input" style="margin: 10px;">`
            productos.forEach(({Id_producto,Nombre})=>{
                contenido=contenido+`<option value="${Id_producto}">${Nombre}</option>`
            })
            contenido=contenido+`
                </select></label>
                <p>
            `
        }
        contenido=contenido+`
                <label for="ing_pre">Descuento
                <p>
                <input type="number" name="ing_pre" class="swal2-input" min="1" max="100" required></label>
                <p>
                <button type="submit" class="buton-carrito-r" style="margin:10px 0;">Agregar</button>
            </form>
        `

        Swal.fire({
          title: "Agregar Descuento",
          html: contenido,
          showCloseButton: true,
          showConfirmButton: false,
        });

    }
  })()
}

 function addDescuento2(productos,date) {
 
    let contenido=`
        <form action="../Controladores/agregar_descuento.php" method="post" style="font-size:.9rem;">
            <label>Fecha de duracion   
            <p>
            <input type="date" name="fecha" min="${date}" value="${date}" class="swal2-input" required></label>
            <p>
            <label>Nombre del Descuento
            <p>
            <input type="text" name="nombre" class="swal2-input" required></label>
            <p>
        `
        
    contenido=contenido+`
            Productos
            <p>
            <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:10px;border:1px solid;margin:10px 0;padding:5px;">
            `
    productos.forEach(({Id_producto,Nombre})=>{
        //console.log(`pro${Id_producto}`)
        contenido=contenido+`<label><input type="checkbox" name="pro${Id_producto}" value="${Id_producto}">${Nombre}</label>`
    })
    contenido=contenido+`
            </div>
            <p>
            <label>Descuento
            <p>
            <input type="number" name="descuento" class="swal2-input" min="1" max="100" required></label>
            <p>
            <button type="submit" class="buton-carrito-r" style="margin:10px 0;">Agregar</button>
        </form>
    `

    Swal.fire({
        title: "Agregar Descuento",
        html: contenido,
        showCloseButton: true,
        showConfirmButton: false,
    });

}