<?php 
    include('../Administracion/adminNavBar.php');
    if(isset($_POST["crearPais"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["pais"] == 0){
            crearPais($_POST["nomPais"],$_POST["impuestoPais"]);
        }else{
            modificarPais($_POST["pais"],$_POST["nomPais"],$_POST["impuestoPais"]);
        }
    }
    if(isset($_POST["elimPais"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["pais"]!=0){
            borrarPais($_POST["pais"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Paises</title>
        <meta name="viewport" content="width=device-width">
        <script src="../../js/paises.js" defer></script>
    </head>
    <body>
        <div class="container text-center my-4">
            <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["Admin"] == 1): ?>  
                <h1 class="h2 mb-3 font-weight-normal">Registro de paises</h1> 
                <form style="max-width:300px;margin:auto;" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <select class="form-select" name="pais" id="pais" tittle="Elige un pais" required>
                            <option value=0>Nuevo Pais</option>
                            <?php
                                $paises = getPaises();
                                foreach($paises as $pais){
                                    echo '<option value='.$pais["ID_Pais"].'>'.$pais["Nombre_Pais"].'</option>';
                                }
                            ?>
                        </select>
                        <br>
                        <div class="form-floating mb-3">
                            <input required type="text" step="any" class="form-control" placeholder="Nombre Pais" name="nomPais" id="nomPais">
                            <label for="nomPais">Nombre Pais</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="number" step="any" min="0" class="mt-2 form-control" placeholder="Impuesto" name="impuestoPais" id="impuestoPais">
                            <label for="impuestoPais">Impuesto</label>
                        </div>
                        <div class="mt-3 d-grid gap-2">
                            <button class="btn btn-dark btn-lg" name="crearPais" id="crearPais" >Crear</button>
                            <button class="btn btn-danger btn-lg" name="elimPais" id="elimPais" disabled>Eliminar</button>
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