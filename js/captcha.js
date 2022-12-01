var captcha;
function generate() {
    document.getElementById("submit_captcha").value = "";

    const randomchar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    var string = "";


    for (let i = 0; i < 4; i++) {
        string += randomchar.charAt(Math.random() * randomchar.length)
    }

    captcha = document.getElementById("image_captcha");
    captcha.innerHTML = string;
}
function generate2() {
    document.getElementById("submit_captcha2").value = "";

    const randomchar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    var string = "";


    for (let i = 0; i < 4; i++) {
        string += randomchar.charAt(Math.random() * randomchar.length)
    }

    captcha = document.getElementById("image_captcha2");
    captcha.innerHTML = string;
}
function printmsg() {
    // Check whether the input is equal
    // to generated captcha or not
    if (document.getElementById("submit_captcha").value == captcha.innerHTML) {
        document.getElementById("mensaje_captcha").innerHTML = "Captcha correcto";
        document.getElementById("boton_registro").removeAttribute("disabled");
        document.getElementById("user-input").addAttribute("disabled");
        document.getElementById("recharge").addAttribute("disabled");
    }else{
        document.getElementById("mensaje_captcha").innerHTML = "Captcha incorrecto, intentalo de nuevo";
        generate();
    }
}

function printmsg2() {
    // Check whether the input is equal
    // to generated captcha or not
    if (document.getElementById("submit_captcha2").value == captcha.innerHTML) {
        document.getElementById("mensaje_captcha2").innerHTML = "Captcha correcto";
        document.getElementById("button-login").removeAttribute("disabled");
        document.getElementById("user-input2").addAttribute("disabled");
        document.getElementById("recharge2").addAttribute("disabled");
    }else{
        document.getElementById("mensaje_captcha2").innerHTML = "Captcha incorrecto, intentalo de nuevo";
        generate2();
    }
}
  

//Forma alternativa (Semi-funciona)
/*
var captcha;
function generate() {
    document.getElementById("submit_captcha").value = "";

    $.post("sources/PHP/generar_captcha.php", {}, "json").
    done(function (data, textStatus, jqXHR) {
        var string = data;
        captcha = document.getElementById("image_captcha");
        captcha.innerHTML = string;
    });
}

function printmsg() {
    // Check whether the input is equal
    // to generated captcha or not
    if (document.getElementById("").value == captcha.innerHTML) {
        var s = (document.getElementById("key").innerHTML = "Matched");
        generate();
    } else {
        var s = (document.getElementById("key").innerHTML = "not Matched");
        generate();
    }
}
*/