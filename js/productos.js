var producto = document.querySelector('#producto');
var nombre = document.getElementById("nombre");
var precio = document.getElementById("precio");
var descripcion = document.getElementById("descripcion");
var existencias = document.getElementById("existencias");
var descuento = document.getElementById("descuento");
var categoria = document.querySelector('#categoria');
var carrousel = document.getElementById("carrousel");
producto.addEventListener("change", function(){
    var seleccion = producto.options[producto.selectedIndex].value;
    if(seleccion != 0){
        $.post("../PHP/consultas.php",{"idProd":seleccion},"json")
        .done(function(data,textstatus,jqXHR){
            var datos = JSON.parse(data);
            nombre.value = datos.Nombre_Prod;
            precio.value = datos.Precio_Prod;
            descripcion.value = datos.Descripcion_Prod;
            existencias.value = datos.Existencias_Prod;
            descuento.value = datos.Descuento_Prod;
            categoria.value = datos.ID_Cat;
            $.post("../PHP/consultas.php",{"idProdImg":datos.ID_Prod},"json").
            done(function(data, textstatus, jqXHR){
                var datos = JSON.parse(data);
                datos = Object.values(datos);
                carrousel.innerHTML = "";
                datos.forEach(function(currentValue, index) {
                    var agregar;
                    agregar = "<div class='carousel-item'><img src='/media/productos/"+currentValue+"' class='d-block w-100'></div>";
                    if(index == 0) agregar = "<div class='carousel-item active'><img src='/media/productos/"+currentValue+"' class='d-block w-100'></div>"; 
                    carrousel.innerHTML += agregar;
                });
                if(datos.length === 0){
                    carrousel.innerHTML = "<div class='carousel-item active'><img src='/media/productos/No image.jpg' class='d-block w-100'></div>";
                }

            });
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log("Solicitud fallada");
        });
    }else{
        nombre.value = "";
        precio.value = "";
        descripcion.value = "";
        existencias.value = "";
        descuento.value = "";
        categoria.value = "";
        carrousel.innerHTML = "<div class='carousel-item active'><img src='/media/productos/No image.jpg' class='d-block w-100'></div>";
    }
});