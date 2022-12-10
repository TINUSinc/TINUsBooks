var categoria = document.querySelector('#categoria');
var nombre = document.getElementById("nomCat");
var descripcion = document.getElementById("descripcion");
var btnCrear = document.getElementById("btnCrear");
var btnElim = document.getElementById("btnEliminar");
categoria.addEventListener("change", function(){
    var seleccion = categoria.options[categoria.selectedIndex].value;
    if(seleccion != 0){
        $.post("../PHP/consultas.php",{"idCat":seleccion},"json")
        .done(function(data,textstatus,jqXHR){
            var datos = JSON.parse(data);
            nombre.value = datos.Nom_Cat;
            descripcion.value = datos.Descripcion_Cat;
            btnCrear.innerHTML= "Modificar";
            btnElim.removeAttribute("disabled");
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log("Solicitud fallada");
        })
    }else{
        btnElim.setAttribute("disabled","");
        btnCrear.innerHTML = "Crear";
        nombre.value = "";
        descripcion.value = "";
    }
});