 window.addEventListener('load',function(){
    const contenido= `<form action='index.php' method="post">
        
        Ingrese la apertura de caja:
        <p>
        <input type="double" name="caja"  class="swal2-input" required>
        <p>
        <br>
        <button type="submit" class="buton-carrito-r">Abrir caja</button>
        </form>`;
    Swal.fire({
        title: "Caja diaria",
        html: contenido,
        allowOutsideClick: false,
        showConfirmButton: false,
        footer:"Asegurese de ingresar bien el importe",
    });
    
});