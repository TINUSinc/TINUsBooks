var captcha;
function generate() {
    document.getElementById("submit_captcha").value = "";

    const randomchar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    var string = "";


    for (let i = 0; i < 8; i++) {
        string += randomchar.charAt(Math.random() * randomchar.length)
    }

    captcha = document.getElementById("image_captcha");
    captcha.innerHTML = string;
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