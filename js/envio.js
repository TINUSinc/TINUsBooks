var monto = document.querySelector('#Monto');
var nombre = document.getElementById("MontoAct");
var costo = document.getElementById("Costo");
var btnCrear = document.getElementById("crearMonto");
var btnElim = document.getElementById("elimMonto");
monto.addEventListener("change", function(){
    var seleccion = monto.options[monto.selectedIndex].value;
    nombre.value = seleccion;
    if(seleccion != "crearCosto"){
        $.post("../PHP/consultas.php",{"montoCompra1":seleccion},"json")
        .done(function(data,textstatus,jqXHR){
            var datos = JSON.parse(data);
            nombre.value = datos.Monto_Compra;
            costo.value = datos.Costo_Envio;
            btnCrear.innerHTML= "Modificar";
            btnElim.removeAttribute("disabled");
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            
        })
    }else{
        btnElim.setAttribute("disabled","");
        btnCrear.innerHTML = "Crear";
        nombre.value = "";
        costo.value = "";
    }
});