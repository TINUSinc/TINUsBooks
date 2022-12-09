<?php
    include_once("../../header.php");
?>
<?php
    if(isset($_POST["cambiarDatos"])){
        if(!isset($_POST["contra1Cambio"])) $_POST["contra1Cambio"] = "";
        if(!isset($_POST["contra2Cambio"])) $_POST["contra2Cambio"] = "";
        if(!isset($_POST["admin"])) $_POST["admin"] = "";
        modificarUsuario($_SESSION["usuario"]["Cuenta_usr"],$_POST["nombreCambio"],$_POST["correoCambio"],$_POST["contra1Cambio"],$_POST["contra2Cambio"],$_POST["admin"]);
        $_SESSION['usuario'] = getUsuario($_SESSION['usuario']['ID_Usr']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/FontFamilies.css">
    <link rel="stylesheet" href="../css/contactoStyle.css">
    <link rel="stylesheet" href="../css/InicioStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title> 
</head>
<body>
    <div class="container">
        <br>
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perfil</li>
            </ol>
        </div>
        <?php if(isset($_SESSION["usuario"])): ?>
            <div class="card border-secondary mb-4">  
                <h1 class="text-center my-3 titulos card-header ">Configuración del perfil</h1>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row justify-content-center">
                        <div class="container text-center col-xs-11 col-sm-10 col-md-8 col-lg-6">
                            <label for="nombreCambio" class="form-label">Nombre</label>
                            <input required type="text" class="form-control" id="nombreCambio" 
                            name="nombreCambio" value="<?php echo $_SESSION['usuario']['Nombre_Usr'];?>">
                            <label for="correoCambio" class="form-label">Dirección de Correo</label>
                            <input required type="email" class="form-control" id="correoCambio" 
                            name="correoCambio" value="<?php echo $_SESSION['usuario']['Correo_usr']?>">
                            <label for="contra1Cambio" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contra1Cambio" 
                            name="contra1Cambio" placeholder="Modificar la contraseña">
                            <label for="contra2Cambio" class="form-label">Verificar contraseña</label>
                            <input type="password" class="form-control" id="contra2Cambio" 
                            name="contra2Cambio" placeholder="Verifique la nueva contraseña">
                            <label for="admin" class="form-label">Administrador</label>
                            <input type="password" id="admin" class="form-control" <?php if($_SESSION['usuario']['Admin']==1){echo "disabled";}?>
                            name="admin" placeholder="<?php if($_SESSION['usuario']['Admin']==1){echo "Ya eres administrador";}else{echo "Contraseña de Administrador";}?>">
                            <br>
                            <button type="submit" class="btn btn-outline-secondary" name="cambiarDatos" value="Guardar">Guardar Cambios</button>
                            <br>
                        </div>
                    </div>
                        
                </form>
            </div>
        <?php else: ?>
            <h1 class="text-center titulos">Inicie sesión</h1>
            <div class='container-fluid'>
                <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                    Para poder ver esta página necesita iniciar sesión.
                </div>
            </div>
        <?php endif ?>
    </div>
    <br><br>
</body>
</html>
<?php
    include_once("../footer.php");
?>
