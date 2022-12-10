<?php 
    include('../Administracion/adminNavBar.php');
    if(isset($_POST["peticionCategoria"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(!$_POST["categoria"]){
            crearCategoria($_POST["nombre"],$_POST["descripcion"]);
        }else{
            modificarCategoria($_POST["categoria"],$_POST["nombre"],$_POST["descripcion"]);
        }
    }
    if(isset($_POST["eliminarCategoria"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        borrarCategoria($_POST["categoria"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Categoria</title>
        <meta name="viewport" content="width=device-width">
        <script src="../../js/categorias.js" defer></script>
    </head>
    <body style="background-color: rgb(239, 239, 205);">
        <div class="container text-center my-4">
            <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["Admin"] == 1): ?>  
                <h1 class="h2 mb-3 font-weight-normal">Registro de categorias</h1> 
                <form style="max-width:300px;margin:auto;" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <select class="form-select" name="categoria" id="categoria" tittle="Elige una categoria de la lista" required>
                            <option value=0>Nueva Categoria</option>
                            <?php
                                $categorias = getCategorias();
                                foreach($categorias as $categoria){
                                    echo '<option value='.$categoria["ID_cat"].'>'.$categoria["Nom_Cat"].'</option>';
                                }
                            ?>
                        </select>
                        <br>
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" placeholder="Nombre de la categoria" name="nombre" id="nomCat">
                            <label for="nomCat">Nombre de la categoria</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input required type="text" class="mt-2 form-control" placeholder="Descripcion de la categoria" name="descripcion" id="descripcion">
                            <label for="descripcion">Descripcion de la categoria</label>
                        </div>
                        <div class="mt-3 d-grid gap-2">
                            <button class="btn btn-dark btn-lg" name="peticionCategoria" id="btnCrear">Crear</button>
                            <button class="btn btn-danger btn-lg" name="eliminarCategoria" id="btnEliminar" disabled>Eliminar</button>
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
            <br><br><br><br><br><br><br><br><br><br>
        </div>
        
    </body>
</html>
<?php
    include_once("../PHP/footer.php");
?>