const ccField= document.getElementById('ccField'); //Text Field para la forma rectangular No.1
const validateBtn= document.getElementById('validateBtn'); //Text Field para la forma rectangular No.2


const  visa_regexp = /^4[0-9]{12}(?:[0-9]{3})?$/; //expresión regular que separa los numeros reales de imaginarios (j)
             /*empieza con 4   
             termina con 15 numeros
            */
const  master_regexp = /^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$/;//expresión regular que separa los numeros reales de imaginarios (j)
                /* empieza con
                   "5" y un numero de 1 al 5 y otro numero
                   "222" y un  numero del 1 al 9
                   "22", numero del 3 al 9 y un numero
                   "2", numero del 3 al 6 y un numero
                   "27", 0 o 1 y un numero
                   "2720"
                    Termina con 12 numeros

               */
/*****BOTON PARA GRAFICAR ***********/
ccField.addEventListener('change', function(e){
  if (visa_regexp.test(ccField.value)&& validacionLuhn(ccField.value)){
    document.getElementById("basic-addon2").innerHTML = '<i class="fa-brands fa-lg fa-cc-visa"></i>';
  }
else if(master_regexp.test(ccField.value) && validacionLuhn(ccField.value)){
    document.getElementById("basic-addon2").innerHTML = '<i class="fa-brands fa-lg fa-cc-mastercard"></i>';
}else{
    document.getElementById("basic-addon2").innerHTML ='<i class="fa-solid fa-lg fa-triangle-exclamation"></i>';
}
})
function validacionLuhn(arr){
    let sum =0;
    let paridad =arr.length%2;

    for (let i =0;i<arr.length;i++){
        if((i+1)%2 === paridad){
            sum = sum + Number.parseInt(arr[i]);
        }else if(arr[i]>4){
            sum = sum + (2*Number.parseInt(arr[i])-9);
        }else{
            sum = sum+(2*Number.parseInt(arr[i]));
        }
    }
    return sum%10 === 0;
}