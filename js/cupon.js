var cupon = document.querySelector('#idCupon');
var nombre = document.getElementById("cupon");
var descuento = document.getElementById("descuento");
var btnCrear = document.getElementById("crearCup");
var btnElim = document.getElementById("elimCup");
cupon.addEventListener("change", function(){
    var seleccion = cupon.options[cupon.selectedIndex].value;
    if(seleccion != 0){
        $.post("../PHP/consultas.php",{"idCupon1":seleccion},"json")
        .done(function(data,textstatus,jqXHR){
            var datos = JSON.parse(data);
            nombre.value = datos.Nombre_Descuento;
            descuento.value = datos.Porcentaje_Desc;
            btnCrear.innerHTML= "Modificar";
            btnElim.removeAttribute("disabled");
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            
        })
    }else{
        btnElim.setAttribute("disabled","");
        btnCrear.innerHTML = "Crear";
        nombre.value = "";
        descuento.value = "";
    }
});