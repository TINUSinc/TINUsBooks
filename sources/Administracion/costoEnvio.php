<?php 
    include('../Administracion/adminNavBar.php');
    if(isset($_POST["crearMonto"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["MontoAct"] != 0){
            crearCosto_Envio($_POST["MontoAct"], $_POST["Costo"]);
        }else{
            modificarCostoEnvio($_POST["Monto"], $_POST["MontoAct"], $_POST["Costo"]);
        }
    }
    if(isset($_POST["elimMonto"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["Monto"]!=0){
            borrarCostoEnvio($_POST["Monto"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cupones</title>
        <meta name="viewport" content="width=device-width">
        <script src="../../js/envio.js" defer></script>
    </head>
    <body>
        <div class="container text-center my-4">
            <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["Admin"] == 1): ?>  
                <h1 class="h2 mb-3 font-weight-normal">Registro de costos de envio</h1> 
                <form style="max-width:300px;margin:auto;" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <select class="form-select" name="Monto" id="Monto" tittle="Elige un costo de envio" required>
                            <option value=0>Nuevo Costo de Envio</option>
                            <?php
                                $costosEnvio = getCostoEnvio();
                                foreach($costosEnvio as $costoEnvio){
                                    echo '<option value='.$costoEnvio["Monto_Compra"].'>'.$costoEnvio["Monto_Compra"].'</option>';
                                }
                            ?>
                        </select>
                        <br>
                        <div class="form-floating mb-3">
                            <input required type="number" step="any" class="form-control" placeholder="Monto de Compra" name="MontoAct" id="MontoAct">
                            <label for="MontoAct">Monto de Compra</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="number" step="any" min="0" class="mt-2 form-control" placeholder="Costo de Envio" name="Costo" id="Costo">
                            <label for="Costo">Costo de Envio</label>
                        </div>
                        <div class="mt-3 d-grid gap-2">
                            <button class="btn btn-dark btn-lg" name="crearMonto" id="crearMonto" >Crear</button>
                            <button class="btn btn-danger btn-lg" name="elimMonto" id="elimMonto" disabled>Eliminar</button>
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
    </body>
</html>
<?php
    include_once("../PHP/footer.php");
?>