<?php 
    include("../PHP/altas.php");
    include("../PHP/consultas.php");
    include("../PHP/bajas.php");
    include("../PHP/actualizaciones.php");
    if(isset($_POST["peticionCategoria"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(!$_POST["categoria"]){
            crearCategoria($_POST["nombre"],$_POST["descripcion"]);
        }else{
            modificarCategoria($_POST["categoria"],$_POST["nombre"],$_POST["descripcion"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Categoria</title>
        <meta name="viewport" content="width=device-width">

        <!-- links de Bootstrap -->
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="../../js/categorias.js" defer></script>
    </head>
    <body>
        
        <div class="text-center mt-5">
            <h1 class="h2 mb-3 font-weight-normal">Registro de categorias</h1>
            <form style="max-width:300px;margin:auto;" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <select name="categoria" id="categoria" tittle="Elige una categoria de la lista" required>
                        <option value=0>Nueva Categoria</option>
                        <?php
                            $categorias = getCategorias();
                            foreach($categorias as $categoria){
                                echo '<option value='.$categoria["ID_cat"].'>'.$categoria["Nom_Cat"].'</option>';
                            }
                        ?>
                    </select>
                    <br>
                    <input required type="text" class="form-control" placeholder="Nombre de la categoria" name="nombre" id="nombre">
                    <input required type="text" class="mt-2 form-control" placeholder="Tipo de categoria" name="descripcion" id="descripcion">
                    <div class="mt-3 d-grid gap-2">
                        <button class="btn btn-dark btn-lg" name="peticionCategoria">Enviar</button>
                    </div>
                </div>
            </form>
        </div>

    </body>

</html>