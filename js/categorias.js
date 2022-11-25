var categoria = document.querySelector('#categoria');
var nombre = document.getElementById("nombre");
var descripcion = document.getElementById("descripcion");
categoria.addEventListener("change", function(){
    var seleccion = categoria.options[categoria.selectedIndex].value;
    if(seleccion != 0){
        $.post("../PHP/consultas.php",{"idCat":seleccion},"json")
        .done(function(data,textstatus,jqXHR){
            var datos = JSON.parse(data);
            nombre.value = datos.Nom_Cat;
            descripcion.value = datos.Descripcion_Cat;
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log("Solicitud fallada");
        })
    }else{
        nombre.value = "";
        descripcion.value = "";
    }
});