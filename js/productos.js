var producto = document.querySelector('#producto');
var nombre = document.getElementById("nombre");
var precio = document.getElementById("precio");
var descripcion = document.getElementById("descripcion");
var existencias = document.getElementById("existencias");
var descuento = document.getElementById("descuento");
var categoria = document.querySelector('#categoria');
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
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log("Solicitud fallada");
        })
    }else{
        nombre.value = "";
        precio.value = "";
        descripcion.value = "";
        existencias.value = "";
        descuento.value = "";
        categoria.value = "";
    }
});