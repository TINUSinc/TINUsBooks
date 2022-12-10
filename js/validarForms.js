var char;
var nombre = true;
var lname = true;
var contra1;
var contra2;

function containsNumber(str) {
    return /\d/.test(str); //Analiza si hay un caracter que tenga el valor de lo que esta dentro de los corchetes
}


//---------------------------------------------------Empieza Contactanos-------------------------------------------------

function comprobarNameFormContac() {
    $("#fname").focusout(function () { //Cuando se quita el focus del input...
        string = document.getElementById("fname").value; //Se obtiene la string completa
        if (containsNumber(string) == true) { //Se llama a la funcion y se checa si hay numeros en la cadena
            $("#textErrfname").show();
            
        }
    });
    $("#fname").keyup(function () {//Cuando se termina de presionar una tecla del keyboard...
        string = document.getElementById("fname").value; //Se obtiene la string completa
        if (containsNumber(string) == true) { //Se llama a la funcion y se checa si hay numeros en la cadena
            nombre = false;
            $("#textErrfname").show();
            $("#boton-contacto").hide();
        } else {
            nombre = true;
            if(nombre && lname) {
                $("#boton-contacto").show();
            }
        }
    });
}

function validNameFormContact() {
    $(document).ready(function () { //Carga la funcion cuando document esta ready
        $("#fname").keyup(function () { //Cuando se termina de presoinar la tecla...
            char = document.getElementById("fname").value; //Obtiene el valor del input
            const element = char[char.length - 1]; //Obtiene el ultimo caracter ingresado
            if (isNaN(element) || (element == ' ')) { //Si no es un numero... 
                $("#textErrfname").hide(); //El mensaje de error se esconde
                comprobarNameFormContac();
            } else { //Si resulta aparecer un numero en el ultimo caracter...
                $("#textErrfname").show(); //El mensaje de error se muestra
                comprobarNameFormContac();
            }
        });

    });
}

function comprobarlNameFormContact() {
    $("#lname").focusout(function () {//Cuando se quita el focus del input...
        string = document.getElementById("lname").value; //Se obtiene la string completa
        if (containsNumber(string) == true) { //Se llama a la funcion y se checa si hay numeros en la cadena
            $("#textErrlname").show();
        }
    });
    $("#lname").keyup(function () {//Cuando se termina de presionar una tecla del keyboard...
        string = document.getElementById("lname").value; //Se obtiene la string completa
        if (containsNumber(string) == true) { //Se llama a la funcion y se checa si hay numeros en la cadena
            lname = false;
            $("#textErrlname").show();
            $("#boton-contacto").hide();
        } else {
            lname = true;
            if(nombre && lname) {
                $("#boton-contacto").show();
            }
        }
    });
}

function validlNameFormContact() {
    $(document).ready(function () { //Carga la funcion cuando document esta ready
        $("#lname").keyup(function () { //Cuando se termina de presoinar la tecla...
            char = document.getElementById("lname").value; //Obtiene el valor del input
            const element = char[char.length - 1]; //Obtiene el ultimo caracter ingresado
            if (isNaN(element) || (element == ' ')) { //Si no es un numero... 
                $("#textErrlname").hide(); //El mensaje de error se esconde
                comprobarlNameFormContact();
            } else { //Si resulta aparecer un numero en el ultimo caracter...
                $("#textErrlname").show(); //El mensaje de error se muestra
                comprobarlNameFormContact();
            }
        });

    });
}

//---------------------------------------------------Termina area de Contactanos-------------------------------------------------

//---------------------------------------------------Empieza registro-------------------------------------------------

function comprobarNameForm() {
    $("#nombre").focusout(function () {//Cuando se quita el focus del input...
        string = document.getElementById("nombre").value; //Se obtiene la string completa
        if (containsNumber(string) == true) { //Se llama a la funcion y se checa si hay numeros en la cadena
            $("#textErr").show();
            $("#boton_registro").hide();
        } else {
            $("#boton_registro").show();
        }
    });
    $("#nombre").keyup(function () {//Cuando se termina de presionar una tecla del keyboard...
        string = document.getElementById("nombre").value; //Se obtiene la string completa
        if (containsNumber(string) == true) { //Se llama a la funcion y se checa si hay numeros en la cadena
            $("#textErr").show();
            $("#boton_registro").hide();
        } else {
            $("#boton_registro").show();
        }
    });
}


function validNameForm() {
    $(document).ready(function () { //Carga la funcion cuando document esta ready
        $("#nombre").keyup(function () { //Cuando se termina de presoinar la tecla...
            char = document.getElementById("nombre").value; //Obtiene el valor del input
            const element = char[char.length - 1]; //Obtiene el ultimo caracter ingresado
            if (isNaN(element) || (element == ' ')) { //Si no es un numero... 
                $("#textErr").hide(); //El mensaje de error se esconde
                $("#boton_registro").show();
                comprobarNameForm();
            } else { //Si resulta aparecer un numero en el ultimo caracter...
                $("#textErr").show(); //El mensaje de error se muestra
                $("#boton_registro").hide();
                comprobarNameForm();
            }
        });
    });
}

function validPassword() {
    $(document).ready(function () {
        $("#contraConfi").focusout(function () {//Cuando se quita el focus del input...
            contra1 = document.getElementById("contraPrim").value;
            contra2 = document.getElementById("contraConfi").value;
            if(contra1 == contra2) {
                $("#textErrPS").hide();
                $("#boton_registro").show();
            } else {
                $("#textErrPS").show();
                $("#boton_registro").hide();
            }
        });
        $("#contraConfi").keyup(function () {//Cuando se termina de presionar una tecla del keyboard...
            contra1 = document.getElementById("contraPrim").value;
            contra2 = document.getElementById("contraConfi").value;
            if(contra1 == contra2) {
                $("#textErrPS").hide();
                $("#boton_registro").show();
            } else {
                $("#textErrPS").show();
                $("#boton_registro").hide();
            }
        });
        $("#contraPrim").keyup(function () {//Cuando se quita el focus del input...
            contra1 = document.getElementById("contraPrim").value;
            contra2 = document.getElementById("contraConfi").value;
            if(contra1 == contra2) {
                $("#textErrPS").hide();
                $("#boton_registro").show();
            } else {
                $("#textErrPS").show();
                $("#boton_registro").hide();
            }
        });
    });
}

//---------------------------------------------------Termina area de registro-------------------------------------------------