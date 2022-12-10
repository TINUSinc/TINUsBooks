var direcciones = Array();
direcciones = document.getElementsByClassName("direccion");
var impuesto = document.getElementById("impuestoAplicable");
var cuponPorc = document.getElementById("cuponPorc");
var total = document.getElementById("total");
var btnCupon = document.getElementById("btnCupon");
var btnPago = document.getElementById("btnPagar");
var cupon = document.getElementById("cupon");
var cuponPago = document.getElementById("cuponPago");
var aliasPago = document.getElementById("aliasPago");
var pagoTarjeta = document.getElementById("pagoTarjeta");
var pagoOxxo = document.getElementById("pagoOxxo");
var textoTar = document.getElementById("basic-addon2");
var fechaTar = document.getElementById("start");
var CVVTar = document.getElementById("CVV");
var NomUsrTar = document.getElementById("nomTar");
var IdUSr ="";
var alias ="";
var nombreCupon = "";
var metodo = "Tarjeta";
btnPago.setAttribute("disabled","");
for (let index = 0; index < direcciones.length; index++){
       direcciones[index].addEventListener("click",function(){
              this.style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 #345457";
              IdUSr = this.children[0].children[0].innerHTML;
              alias = this.children[0].children[1].innerHTML;
              for (let index2 = 0; index2 < direcciones.length; index2++) {
                     if(index2!=index){
                            direcciones[index2].style.boxShadow="";
                     }  
              }
              cambiarDatosResumen();
       });
}

btnCupon.addEventListener("click",function(){
       $.post("../PHP/consultas.php",{"nombreCupon":(cupon.value)},"json").
       done(function(data,textstatus,jqXHR){
              var datos = JSON.parse(data);
              if(datos!=0){
                     nombreCupon = datos.Nombre_Descuento;
                     swal("Cupón Aplicado", nombreCupon+": "+datos.Porcentaje_Desc+"%","success");
                     cambiarDatosResumen();
              }else{
                     nombreCupon = "";
                     swal ( "Cupón no válido" ,  "El cupón no es válido" ,  "error" )
                     cambiarDatosResumen();
              }
       }).fail(function(jqXHR, textStatus, errorThrown){
              console.log("Solicitud fallada");
       });
})

btnPago.addEventListener("click",function(){
       $.post("../PHP/consultas.php",{"alias":alias,"idUsr":IdUSr,"cupon":nombreCupon},"json")
       .done(function(data,textstatus,jqXHR){
              verificacion = JSON.parse(data);
              if(!verificacion){
                     $.post("../PHP/consultas.php",{"idUsrUltimaCompra":IdUSr},"json")
                     .done(function(data,textstatus,jqXHR){
                            datos = JSON.parse(data);
                            var infoCarrito = document.getElementById("infoCarrito");
                            var tablaCarrito = document.getElementById("tablaCarrito");
                            var mensaje = `<h1 style="text-align:center">TINUSBOOKS</h1>
                                           <h2 style="text-align:center;">INFORMACIÓN DE VENTA</h2>
                                           <h4 style="text-align:center;">Resumen de venta con número: ${datos.infoCompra.Id_Compra}</h4>
                                           <br><div style='text-align:center; margin-left:auto; margin-right: auto;'>`;
                            infoCarrito = infoCarrito.innerHTML;
                            tablaCarrito = tablaCarrito.innerHTML;
                            mensaje += infoCarrito + tablaCarrito;
                            mensaje += "</div><p style='text-align:center;'>Gracias por comprar con nosotros, Tinusbooks</p>";
                            $.post("../PHP/consultas.php",{"idUsrCorreo":IdUSr},"json")
                            .done(function(data,textstatus,jqXHR){
                                   var correoUsr = JSON.parse(data);
                                   $.post("../PHP/mail/info.php",{"asunto":("TINUSBOOKS Compra "+datos.infoCompra.Id_Compra)
                                   ,"mensaje":mensaje,"destinatario":correoUsr},"json")
                                   .done(function(data,textstatus,jqXHR){
                                   });
                            });
                            swal({
                                   title: "Compra",
                                   text: ("Se realizo la compra y se le enviará un correo con los detalles. Numero de compra: "+datos.infoCompra.Id_Compra),
                                   icon: "success",
                            }).then(function() {    
                                   window.location = "/";
                            });
                     });
              }else{
                     swal("Compra","Error al realizar la compra","error");
              }
       });
});

document.getElementById("tarjeta").addEventListener("click", function(){
       pagoOxxo.style.display="none";
       pagoTarjeta.style.display="block";
       metodo = "Tarjeta";
       cambiarDatosResumen();
});
document.getElementById("oxxo").addEventListener("click", function(){
       pagoTarjeta.style.display="none";
       pagoOxxo.style.display="block";
       metodo = "OXXO";
       cambiarDatosResumen();
});

function cambiarDatosResumen(){
       if(alias!="" && IdUSr!=""){
              $.post("../PHP/consultas.php",{"Alias_Dir":alias,"idUsr":IdUSr},"json")
              .done(function(data,textstatus,jqXHR){
                     var datos = JSON.parse(data);
                     impuesto.innerHTML = ("Impuesto: "+datos.Impuesto+"%");
                     if(validarTarjeta() || metodo=="OXXO"){
                            btnPago.removeAttribute("disabled");
                     }else{
                            btnPago.setAttribute("disabled","");
                     }
                     $.post("../PHP/consultas.php",{"Impuesto1":(datos.Impuesto),"idUsr":IdUSr,"nomCupon":nombreCupon},"json").
                     done(function(data1,textstatus,jqXHR){
                            var datos1 = JSON.parse(data1);
                            if(datos1.totalImpuesto!=datos1.totalCupon){
                                   cuponPorc.innerHTML = "Cupón: "+datos1.porcentajeCupon+"%";
                                   total.innerHTML = "Total: $" + datos1.totalCupon;
                            }else{
                                   total.innerHTML = "Total: $" + datos1.totalImpuesto;
                                   cuponPorc.innerHTML ="";
                            }
                            aliasPago.value = alias;
                            cuponPago.value = nombreCupon;
                     }).fail(function(jqXHR, textStatus, errorThrown){
                            console.log("Solicitud fallada");
                     });
              })
              .fail(function(jqXHR, textStatus, errorThrown){
              console.log("Solicitud fallada");
              })
       }
}

function validarTarjeta(){
    if(textoTar.innerHTML == '<i class="fa-brands fa-lg fa-cc-visa"></i>' || textoTar.innerHTML == '<i class="fa-brands fa-lg fa-cc-mastercard"></i>'){
        if(CVVTar.value >= 100 && CVVTar.value <= 999){
            //if(fechaTar.value > date)
            if(NomUsrTar.value != ""){
                return true;
            }
            
        } 
    }
}
ccField = document.getElementById("ccField");
ccField.addEventListener("change", cambiarDatosResumen);
textoTar.addEventListener("change", cambiarDatosResumen);
CVVTar.addEventListener("change", cambiarDatosResumen);
NomUsrTar.addEventListener("change", cambiarDatosResumen);
fechaTar.addEventListener("change", cambiarDatosResumen);