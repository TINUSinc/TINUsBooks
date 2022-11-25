<?php
    $servidor = "localhost";
    $bd ="id19819763_tinusbooks";
    $cuenta = "id19819763_username";
    $password ="0#i}sUM5m#sUB}Qq";
    //estas credenciales son para subir una bd a 000webhost, pero varían segun donde la vayamos a publicar 

    //mysqli(host,usuario,contraseña, bd)
    $conexion = new mysqli($servidor, $cuenta, $password, $bd);
    $conexion->set_charset("utf8");

    //localhost:3306 puerto web 
    //comprobar si existe la conexion en 000webhost
    if($mysqli){
        echo "<p style'
        display: table:cell;
        background: #cacaca00;
        bottom: 0;
        position:fixed;
        z-index: +1;
        vertical-align: middle;
        color: #5cbc04;
        opacity: 25%;
        '> </p>";
    }

?>
