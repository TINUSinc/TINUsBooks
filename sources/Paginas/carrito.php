<?php
include("../header.php");
if(isset($_SESSION["usuario"]) && isset($_POST["cantidadElim"])){
    if($_POST["cantidadElim"] >= $_POST["cantProd"]){
        borrarProdCarrito($_SESSION["usuario"]["ID_Usr"],$_POST["Id_Prod"]);
    }else{
        modificarCarrito($_SESSION["usuario"]["ID_Usr"],$_POST["Id_Prod"],($_POST["cantProd"]-$_POST["cantidadElim"]));
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Pagar</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../../css/disenopag.css">
    </head>
    <body>
        <?php
            if(isset($_SESSION["usuario"])){
                revisarCarrito($_SESSION["usuario"]["ID_Usr"]);
            }else{
                echo "
                    <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                        Inicie sesión para poder ver su carrito.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    "; 
            }
        ?>
        <?php if(isset($_SESSION["usuario"])): 
            $carrito = getCarrito($_SESSION["usuario"]["ID_Usr"]);
            if(!empty($carrito)):
            ?>
        <div class="container">
            <div class="tarjeta">
                <?php
                    foreach($carrito as $producto):
                        $infoProd = getProducto($producto["ProductoID_Prod"]);
                        $imgProd = getImagenesProd($producto["ProductoID_Prod"]);
                        $imgProd = $imgProd[1];
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="card mb-3">
                            <div class="row g-0 align-items-center">
                                <div class="col-4 col-md-2 col-lg-2 col-xl-2 col-xxl-1">
                                    <img src="/media/productos/<?php echo $imgProd;?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-8 col-md-6 col-lg-6 col-xl-6 col-xxl-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $infoProd["Nombre_Prod"];?></h5>
                                        <p class="card-text"><?php echo $infoProd["Descripcion_Prod"];?></p>
                                        <p class="card-text"><small class="text-muted">Cantidad: <?php echo $producto["cant_Prod"];?></small></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-3">
                                    <div class="card-body d-flex justify-content-center">
                                        <div class="form-floating">
                                            <input required class="form-control" type="number" placeholder="Cantidad" name="cantidadElim" id="cantElim" max='<?php echo $producto["cant_Prod"] ?>' min='0'>
                                            <label for="nombreProd">Cantidad</label>
                                        </div>
                                        <input type="hidden" name="Id_Prod" value='<?php echo $infoProd["ID_Prod"]; ?>'>
                                        <input type="hidden" name="cantProd" value='<?php echo $producto["cant_Prod"];?>'>
                                        <input type="submit" class="btn btn-outline-danger" id="delete" value="Eliminar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endforeach; ?>
                    <div class="container text-center my-4">
                        <a href="pagar.php"><button class="btn btn-outline-warning btn-lg">Proceder al pago</button></a>
                    </div>
                    <?php else:
                        echo "
                            <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                                No hay productos en su carrito
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            "; 
                        endif;
                    endif;?>
            </div>
        </div>
    <?php if(isset($_SESSION["usuario"])): ?>
        <script>
            document.getElementById("carritoCant").innerText = <?php echo getTotalProdCarrito($_SESSION["usuario"]["ID_Usr"]) ?>;
        </script>
    <?php endif ?>
    </body>

</html>
<?php
    include_once("../PHP/footer.php");
?>