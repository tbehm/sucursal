
function add(){
    const contenido= `<form action='../Controladores/up_gasto.php' method="post">
        
        Monto:
        <p>
        <input type="text" name="monto"  class="swal2-input" required>
        <p>
        Descripcion:
        <p>
         <input type="text" name="des"  class="swal2-input" required>
        <p>
        <button type="submit" class="buton-carrito-r">Listo</button>
        </form>
        <p style="margin-top:10px;">
        <br>
        <a href="caja.php"><button class="buton-carrito-c">Volver</button></a></p>`;
    Swal.fire({
        title: "Nuevo gasto",
        html: contenido,
        allowOutsideClick: true,
        showConfirmButton: false,
        footer:"",
    });
    

}

