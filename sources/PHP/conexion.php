<?php 
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='tinusbooks';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);
    if($conexion->connect_errno):
    include_once("altas.php");
    include_once("bajas.php");
    include_once("consultas.php");
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <div class="alert alert-danger" role="alert">
            Error al conctar con la base de datos: <?php echo $conexion->connect_error?>
            </div>
        </body>
        </html>
<?endif?>
