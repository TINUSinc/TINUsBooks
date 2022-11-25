<?php
    include '../Administracion/adminNavBar.php';
    if(isset($_POST["peticionProducto"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(!$_POST["producto"]){
            crearProucto($_POST["nombreProd"],$_POST["descripcion"],$_POST["precio"],$_POST["existencias"],$_POST["categoria"],$_POST["descuento"]);
            $productos = encontrarProducto($_POST["nombre"]);
            $producto = $productos[0];
            $target = "../../media/productos/";
            if(!empty($_FILES["imagen"]["name"][0])){
                foreach($_FILES["imagen"]["full_path"] as $info){
                    crearImagenProducto($producto["ID_Prod"],$info);
                }
                $cont = 0;
                foreach($_FILES["imagen"]["tmp_name"] as $tmp){
                    move_uploaded_file($tmp,$target.$_FILES["imagen"]["full_path"][$cont]);
                    $cont++;
                }
            }
        }else{
            modificarProducto($_POST["producto"],$_POST["nombreProd"],$_POST["descripcion"],$_POST["precio"],$_POST["existencias"],$_POST["categoria"],$_POST["descuento"]);
            $productos = encontrarProducto($_POST["nombreProd"]);
            $producto = $productos[0];
            $target = "../../media/productos/";
            if(!empty($_FILES["imagen"]["name"][0])){
                foreach($_FILES["imagen"]["full_path"] as $info){
                    crearImagenProducto($producto["ID_Prod"],$info);
                }
                $cont = 0;
                foreach($_FILES["imagen"]["tmp_name"] as $tmp){
                    move_uploaded_file($tmp,$target.$_FILES["imagen"]["full_path"][$cont]);
                    $cont++;
                }
            }
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
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="../../js/productos.js" defer></script>
    </head>
    <body>
        <div class="container text-center">
            <h1 class="h2 mb-3 font-weight-normal">Registro de productos</h1>
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
                            <input required type="text" class="mt-2 form-control" placeholder="Nombre del producto" id="nombreProd" name="nombreProd">
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
                            <input type="file" class="mt-2 form-control" multiple accept=".png, .jpg" name="imagen[]" id="imagen" value="Selecciona imagenes">
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
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <h3>Imagenes</h3>
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carrousel">
                        <div class='carousel-item active'><img src='/media/productos/No image.jpg' class='d-block w-100'></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" style="color: gray;" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" style="color: gray;" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>  
                </div>
            </div>
        </div>
    </body>
</html>