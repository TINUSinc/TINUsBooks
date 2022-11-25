<?php
    include("../PHP/altas.php");
    include("../PHP/consultas.php");
    include("../PHP/bajas.php");
    include("../PHP/actualizaciones.php");
    if(isset($_POST["peticionProducto"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(!$_POST["producto"]){
            crearProucto($_POST["nombre"],$_POST["descripcion"],$_POST["precio"],$_POST["existencias"],$_POST["categoria"],$_POST["descuento"]);
        }else{
            modificarProducto($_POST["producto"],$_POST["nombre"],$_POST["descripcion"],$_POST["precio"],$_POST["existencias"],$_POST["categoria"],$_POST["descuento"]);
        }
    }
    if(isset($_POST["eliminacionProducto"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["producto"] == 0){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Seleccione un producto para eliminar
                  </div>';
        }else{
            borrarProducto($_POST["producto"]);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Productos</title>
        <meta name="viewport" content="width=device-width">
        <!-- links de Bootstrap -->
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="../../js/productos.js" defer></script>
    </head>
    <body>
        
        <div class="text-center mt-5">
            <h1 class="h2 mb-3 font-weight-normal">Registro de productos</h1>
            <form style="max-width:300px;margin:auto;" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="producto">Elige un producto:</label>
                    <br>
                    <select name="producto" id="producto" tittle="Elige un producto de la lista" required>
                        <option value=0>Nuevo Producto</option>
                        <?php
                            $productos = getProductos();
                            foreach($productos as $producto){
                                echo '<option value='.$producto["ID_Prod"].'>'.$producto["Nombre_Prod"].'</option>';
                            }
                        ?>
                    </select>
                    <br>
                    <input required type="text" class="mt-2 form-control" placeholder="Nombre del producto" id="nombre" name="nombre">
                    <input required type="number" step="any" class="mt-2 form-control" placeholder="Precio" id="precio" name="precio">
                    <label for="categoria">Elige una categoria</label>
                    <br>
                    <select required name="categoria" id="categoria" title="Elige una categoria de la lista">
                        <?php
                            $categorias = getCategorias();
                            foreach($categorias as $categoria){
                                echo '<option value='.$categoria["ID_cat"].'>'.$categoria["Nom_Cat"].'</option>';
                            }
                        ?>
                        
                    </select>
                    <textarea required class="mt-2 form-control" name="descripcion" rows="5" cols="60" placeholder="Descripcion" id="descripcion"></textarea> 
                    <input required type="number" class="mt-2 form-control" placeholder="Existencias" name="existencias" id="existencias">
                    <input required type="number" class="mt-2 form-control" placeholder="Descuento" name="descuento" max="99" min="0" id="descuento">
                    <div class="mt-3 d-grid gap-2">
                        <button class="btn btn-dark btn-lg" name="peticionProducto">Enviar</button>
                    </div>
                    <div class="mt-3 d-grid gap-2">
                        <button class="btn btn-danger btn-lg" name="eliminacionProducto">Eliminar</button>
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </body>
</html>