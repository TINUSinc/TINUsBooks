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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/perfil.css">
    <title>Perfil</title> 
</head>
<body>
        <br>
        <?php if(isset($_SESSION["usuario"])): ?>
        <div class="container mb-4 contenedorFormulario"> 
            <center>
                <h3><i class="fa-solid fa-id-badge mt-3"></i> Perfil</h3>
            </center>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row justify-content-center">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="nombreCambio" class="form-label">Nombre</label>
                        <input required type="text" class="form-control" id="nombreCambio" 
                        name="nombreCambio" placeholder="Nombre" value="<?php echo $_SESSION['usuario']['Nombre_Usr'];?>">
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="correoCambio" class="form-label">Dirección de Correo</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-envelope"></i></span>
                            <input required type="email" class="form-control" id="correoCambio" 
                            name="correoCambio" placeholder="Dirección de Correo" value="<?php echo $_SESSION['usuario']['Correo_usr']?>">
                        </div> 
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="contra1Cambio" class="form-label">Modificar la contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-unlock"></i></span>
                            <input type="password" class="form-control" id="contra1Cambio" 
                            name="contra1Cambio" placeholder="Modificar la contraseña">
                        </div> 
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="contra2Cambio" class="form-label">Verificar contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" id="contra2Cambio" 
                             name="contra2Cambio" placeholder="Verifique la nueva contraseña">
                        </div> 
                        
                    </div>
                    <div class="mb-3 col-12">
                        <label for="admin" class="form-label">Administrador</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                            <input type="password" id="admin" class="form-control" <?php if($_SESSION['usuario']['Admin']==1){echo "disabled";}?>
                            name="admin" placeholder="<?php if($_SESSION['usuario']['Admin']==0){echo "Contraseña de Administrador";}else{echo "Ya eres administrador";}?>">
                            </input>  
                        </div> 
                         
                    </div>
                    <div class="mb-3 col-12 text-center">
                        <button type="submit" class="btn btn-primary" name="cambiarDatos" value="Guardar">Guardar Cambios</button>
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
</body>
</html>
<?php
    include_once("../footer.php");
?>
