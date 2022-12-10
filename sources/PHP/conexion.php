
<?php
/*
    //Usar esta configuracion para el servidor 000webhost
    $servidor = "localhost";
    $bd ="id19819763_tinusbooks";
    $cuenta = "id19819763_username";
    $password ="0#i}sUM5m#sUB}Qq";
    //estas credenciales son para subir una bd a 000webhost, pero varían segun donde la vayamos a publicar 

    //mysqli(host,usuario,contraseña, bd)
    $conexion = new mysqli($servidor, $cuenta, $password, $bd);
    $conexion->set_charset("utf8");
    }*/
?>

<?php 
    //Usar esta configuracion para el localhost personal
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd="tinutest";
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);
    if($conexion->connect_errno):
?>
<div class="alert alert-danger" role="alert">
Error al conectar con la base de datos: <?php echo $conexion->connect_error?>
</div>
<?php endif?>