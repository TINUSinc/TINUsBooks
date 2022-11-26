<?php 
    include("adminNavBar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas</title>
</head>
<body>
    <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["Admin"] == 1):?>
        <h1 class="h2 mb-3 font-weight-normal">Pagina de Administracion</h1> 
    <?php else: ?>
        <h1 class="text-center titulos">Inicie sesión</h1>
        <div class='container-fluid'>
            <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                Para poder ver esta página necesita iniciar sesión y ser administrador.
            </div>
        </div>
    <?php endif ?>
</body>
</html>
