<?php
    include('../Administracion/adminNavBar.php');
    if(isset($_POST["peticionProducto"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(!$_POST["producto"]){
            crearProucto($_POST["nombreProd"],$_POST["descripcion"],$_POST["precio"],$_POST["existencias"],$_POST["categoria"],$_POST["descuento"]);
            $productos = encontrarProducto($_POST["nombreProd"]);
            $producto = $productos[0];
            $target = "../../media/productos/";
            if(!empty($_FILES["imagen"]["name"][0])){
                foreach($_FILES["imagen"]["name"] as $info){
                    crearImagenProducto($producto["ID_Prod"],$info);
                }
                $cont = 0;
                foreach($_FILES["imagen"]["tmp_name"] as $tmp){
                    move_uploaded_file($tmp,$target.$_FILES["imagen"]["name"][$cont]);
                    $cont++;
                }
            }
        }else{
            modificarProducto($_POST["producto"],$_POST["nombreProd"],$_POST["descripcion"],$_POST["precio"],$_POST["existencias"],$_POST["categoria"],$_POST["descuento"]);
            $productos = encontrarProducto($_POST["nombreProd"]);
            $producto = $productos[0];
            $target = "../../media/productos/";
            if(!empty($_FILES["imagen"]["name"][0])){
                foreach($_FILES["imagen"]["name"] as $info){
                    crearImagenProducto($producto["ID_Prod"],$info);
                }
                $cont = 0;
                foreach($_FILES["imagen"]["tmp_name"] as $tmp){
                    move_uploaded_file($tmp,$target.$_FILES["imagen"]["name"][$cont]);
                    $cont++;
                }
            }
            if(!empty($_POST["nuevoNombreImagen"]) && isset($_POST["imagenesSubidas"])){
                $anteriorNombre = $_POST["imagenesSubidas"];
                $nuevoNombre = $_POST["nuevoNombreImagen"];
                if(modificarImagen($producto["ID_Prod"],$anteriorNombre,$nuevoNombre)){
                    rename($target.$anteriorNombre,$target.$nuevoNombre);
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
        <link rel="stylesheet" href="/css/admin-productos.css">
        <script src="../../js/productos.js" defer></script>
    </head>
    <body style="background-color: rgb(239, 239, 205);"></body>
        <div class="container text-center my-4">
        <?php if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["Admin"] == 1): ?>  
            <h1 class="h2 mb-3 font-weight-normal">Registro de productos</h1> 
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="producto">Elige un producto:</label>
                            <br>
                            <select class="form-select" name="producto" id="producto" tittle="Elige un producto de la lista" required>
                                <option value=0>Nuevo Producto</option>
                                <?php
                                    $productos = getProductos();
                                    foreach($productos as $producto){
                                        echo '<option value='.$producto["ID_Prod"].'>'.$producto["Nombre_Prod"].'</option>';
                                    }
                                ?>
                            </select>
                            <br>
                            <div class="form-floating mb-3">
                                <input required type="text" class="form-control" placeholder="Nombre del producto" id="nombreProd" name="nombreProd">
                                <label for="nombreProd">Nombre del producto</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="number" step="any" class="mt-2 form-control" placeholder="Precio" id="precio" name="precio">
                                <label for="precio">Precio</label>
                            </div>
                            <label for="categoria">Elige una categoria</label>
                            <br>
                            <select class="form-select" required name="categoria" id="categoria" title="Elige una categoria de la lista">
                                <?php
                                    $categorias = getCategorias();
                                    foreach($categorias as $categoria){
                                        echo '<option value='.$categoria["ID_cat"].'>'.$categoria["Nom_Cat"].'</option>';
                                    }
                                ?>
                            </select>
                            <div class="form-floating mb-3">
                                <textarea required class="mt-2 form-control" name="descripcion" style="height: 100px;" cols="60" placeholder="Descripcion" id="descripcion"></textarea> 
                                <label for="descripcion">Descripcion</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="number" class="form-control" placeholder="Existencias" name="existencias" id="existencias">
                                <label for="existencias">Existencias</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input required type="number" class="form-control" placeholder="Descuento" name="descuento" max="99" min="0" id="descuento">
                                <label for="descuento">Descuento</label>
                            </div>
                            <br>
                            <label for="imagenesSubidas">Imagen</label>
                            <select placeholder="Imagenes" class="form-select" name="imagenesSubidas" id="imagenesSubidas" title="Imagenes subidas">
                                <option value="0" disabled selected>Sin Imagenes</option>
                            </select>
                            <div class="form-floating mb-3">
                                <input disabled type="text" class="mt-2 form-control" id="nuevoNombreImagen" placeholder="Nuevo nombre" name="nuevoNombreImagen">
                                <label for="nuevoNombreImagen">Nuevo nombre</label>
                            </div>
                            <label for="imagen">Subir imagen</label>
                            <input type="file" class="mt-2 form-control" multiple accept=".png, .jpg" name="imagen[]" id="imagen" value="Selecciona imagenes">
                            <div class="mt-3 d-grid gap-2">
                                <button id="btnEnviar" class="btn btn-dark btn-lg" name="peticionProducto">Crear</button>
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button id="btnEliminar" class="btn btn-danger btn-lg" name="eliminacionProducto" disabled>Eliminar</button>
                            </div>
                            <br>
                        </div>
                    </form>
                </div>
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <h3>Imagenes</h3>
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" >
                        <div class="carousel-inner" id="carrousel">
                        <div class='carousel-item active'><img src='/media/productos/No image.jpg' class='d-block w-100'></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon carousel-diseno" style="color: gray;" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon carousel-diseno" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>  
                </div>
            </div>
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