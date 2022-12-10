var pais = document.querySelector('#pais');
var nombre = document.getElementById("nomPais");
var impuesto = document.getElementById("impuestoPais");
var btnCrear = document.getElementById("crearPais");
var btnElim = document.getElementById("elimPais");
pais.addEventListener("change", function(){
    var seleccion = pais.options[pais.selectedIndex].value;
    if(seleccion != 0){
        $.post("../PHP/consultas.php",{"idPais1":seleccion},"json")
        .done(function(data,textstatus,jqXHR){
            var datos = JSON.parse(data);
            nombre.value = datos.Nombre_Pais;
            impuesto.value = datos.Impuesto;
            btnCrear.innerHTML= "Modificar";
            btnElim.removeAttribute("disabled");
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            
        })
    }else{
        btnElim.setAttribute("disabled","");
        btnCrear.innerHTML = "Crear";
        nombre.value = "";
        impuesto.value = "";
    }
});