<?php 
    include('../Administracion/adminNavBar.php');
    if(isset($_POST["peticionCupon"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["idCupon"] == 0){
            crearCupon($_POST["cupon"], $_POST["descuento"]);
        }else{
            modificarCupon($_POST["idCupon"], $_POST["cupon"], $_POST["descuento"]);
        }
    }
    if(isset($_POST["eliminarCupon"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["idCupon"]!=0){
            borrarCupon($_POST["idCupon"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cupones</title>
        <meta name="viewport" content="width=device-width">
        <script src="../../js/cupon.js" defer></script>
    </head>
    <body style="background-color: rgb(239, 239, 205);">
        <div class="container text-center my-4">
            <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["Admin"] == 1): ?>  
                <h1 class="h2 mb-3 font-weight-normal">Registro de cupones</h1> 
                <form style="max-width:300px;margin:auto;" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <select class="form-select" name="idCupon" id="idCupon" tittle="Elige un cupón de la lista" required>
                            <option value=0>Nuevo cupon</option>
                            <?php
                                $cupones = getCupones();
                                foreach($cupones as $cupon){
                                    echo '<option value='.$cupon["ID_Cupon"].'>'.$cupon["Nombre_Descuento"].'</option>';
                                }
                            ?>
                        </select>
                        <br>
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" placeholder="Cupon" name="cupon" id="cupon">
                            <label for="cupon">Cupon</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="number" max="99" min="1" class="mt-2 form-control" placeholder="Descuento del cupon" name="descuento" id="descuento">
                            <label for="descuento">Descuento del cupon</label>
                        </div>
                        <div class="mt-3 d-grid gap-2">
                            <button class="btn btn-dark btn-lg" name="peticionCupon" id="crearCup" >Crear</button>
                            <button class="btn btn-danger btn-lg" name="eliminarCupon" id="elimCup" disabled>Eliminar</button>
                        </div>
                    </div>
                </form>
            
            <?php else: ?>
                <h1 class="text-center titulos">Inicie sesión</h1>
                <div class='container-fluid'>
                    <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                        Para poder ver esta página necesita iniciar sesión y ser administrador.
                    </div>
                </div>
            <?php endif ?>
        </div>
        <br><br><br><br><br><br><br><br><br>
    </body>
</html>
<?php
    include_once("../PHP/footer.php");
?>