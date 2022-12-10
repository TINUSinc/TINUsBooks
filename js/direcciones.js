var direccion = document.querySelector('#validationDefault1');
var alias = document.getElementById("validationDefault");
var calle = document.getElementById("validationDefault2");
var numInt = document.getElementById("validationDefault3");
var numExt = document.getElementById("validationDefault4");
var cp = document.getElementById("validationDefault5");
var mcpio = document.getElementById("validationDefault6");
var edo = document.getElementById("validationDefault7");
var tel = document.getElementById("validationDefaultUsername");
var pais = document.querySelector('#validationDefault8');
var botonEnviar = document.getElementById("registrarDir");
var usr = document.getElementById("ID_Usr").value;
var botonElim = document.getElementById("eliminarDir");

direccion.addEventListener("change", function(){
    var seleccion = direccion.options[direccion.selectedIndex].value;
    if(seleccion != "NuevaDir"){
        $.post("../PHP/consultas.php",{"Alias_Dir":seleccion,"idUsr":usr},"json")
        .done(function(data,textstatus,jqXHR){
            var datos = JSON.parse(data);
            botonElim.removeAttribute("disabled");
            botonEnviar.innerHTML = "Modificar";
            alias.value = datos.Alias_Dir;
            alias.setAttribute("disabled","");
            calle.value = datos.Calle_Dir;
            numInt.value = datos.Num_Int_Dir;
            numExt.value = datos.Num_Ext_Dir;
            mcpio.value = datos.Mcpio_Dir;
            edo.value = datos.Edo_Dir;
            tel.value = datos.Num_Tel_Dir;
            cp.value = datos.CP_Dir;
            pais.value = datos.ID_Pais;
        })
        .fail(function(jqXHR, textStatus, errorThrown){
        });
    }else{
        botonEnviar.innerHTML = "Registrar Direccion";
        botonElim.setAttribute("disabled","");
        alias.removeAttribute("disabled");
        alias.value = "";
        calle.value = "";
        numInt.value = "";
        numExt.value = "";
        mcpio.value = "";
        edo.value = "";
        tel.value = "";
        cp.value ="";
        pais.value = 0;
    }
});
