var char;

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


function comprobarNameForm() {
    $("#nombre").focusout(function () {//Cuando se quita el focus del input...
        string = document.getElementById("nombre").value; //Se obtiene la string completa
        if (containsNumber(string) == true) { //Se llama a la funcion y se checa si hay numeros en la cadena
            $("#textErr").show();
        }
    });
}

//---------------------------------------------------Empieza registro-------------------------------------------------

function validNameForm() {
    $(document).ready(function () { //Carga la funcion cuando document esta ready
        $("#nombre").keyup(function () { //Cuando se termina de presoinar la tecla...
            char = document.getElementById("nombre").value; //Obtiene el valor del input
            const element = char[char.length - 1]; //Obtiene el ultimo caracter ingresado
            if (isNaN(element) || (element == ' ')) { //Si no es un numero... 
                $("#textErr").hide(); //El mensaje de error se esconde
                comprobarNameForm();
            } else { //Si resulta aparecer un numero en el ultimo caracter...
                $("#textErr").show(); //El mensaje de error se muestra
                comprobarNameForm();
            }
        });

    });
}

//---------------------------------------------------Termina area de registro-------------------------------------------------