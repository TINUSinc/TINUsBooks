var producto = document.querySelector('#producto');
var nombre = document.getElementById("nombreProd");
var precio = document.getElementById("precio");
var descripcion = document.getElementById("descripcion");
var existencias = document.getElementById("existencias");
var descuento = document.getElementById("descuento");
var categoria = document.querySelector('#categoria');
var carrousel = document.getElementById("carrousel");
var botonEnviar = document.getElementById("btnEnviar");
var botonElim = document.getElementById("btnEliminar");
var selectImagenes = document.getElementById("imagenesSubidas");
var nuevoNombre = document.getElementById("nuevoNombreImagen");


producto.addEventListener("change", function(){
    var seleccion = producto.options[producto.selectedIndex].value;
    if(seleccion != 0){
        $.post("../PHP/consultas.php",{"idProd":seleccion},"json")
        .done(function(data,textstatus,jqXHR){
            var datos = JSON.parse(data);
            botonElim.removeAttribute("disabled");
            botonEnviar.innerHTML = "Modificar";
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
                selectImagenes.innerHTML="";
                if(datos.length === 0){
                    carrousel.innerHTML = "<div class='carousel-item active'><img src='/media/productos/No image.jpg' class='d-block w-100'></div>";
                    selectImagenes.innerHTML="<option value='0' disabled selected>Sin Imagenes</option>";
                    nuevoNombre.setAttribute("disabled","");
                }else{
                    datos.forEach(function(currentValue, index) {
                        var agregarOpcion;
                        var agregar;
                        agregarOpcion = "<option value='"+currentValue+"'>"+currentValue+"</option>";
                        agregar = "<div class='carousel-item'><img src='/media/productos/"+currentValue+"' class='d-block w-100'><div class='carousel-caption d-none d-md-block'><h5>"+currentValue+"</h5></div></div>";
                        if(index == 0) agregar = "<div class='carousel-item active'><img src='/media/productos/"+currentValue+"' class='d-block w-100'><div class='carousel-caption d-none d-md-block'><h5>"+currentValue+"</h5></div></div>"; 
                        carrousel.innerHTML += agregar;
                        selectImagenes.innerHTML+=agregarOpcion;
                        nuevoNombre.removeAttribute("disabled");
                    });
                }
            });
            
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            
        });
    }else{
        nuevoNombre.setAttribute("disabled","");
        botonElim.setAttribute("disabled","");
        botonEnviar.innerHTML = "Crear";
        selectImagenes.innerHTML="<option value='0' disabled selected>Sin Imagenes</option>";
        nombre.value = "";
        precio.value = "";
        descripcion.value = "";
        existencias.value = "";
        descuento.value = "";
        categoria.value = "";
        carrousel.innerHTML = "<div class='carousel-item active'><img src='/media/productos/No image.jpg' class='d-block w-100'></div>";
    }
});
