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
    <body style="background-color: rgb(239, 239, 205);">
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
                                <div class="col-3 col-md-3 col-lg-2 col-xl-3 col-xxl-2">
                                    <img src="/media/productos/<?php echo $imgProd;?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $infoProd["Nombre_Prod"];?></h5>
                                        <p class="card-text"><?php echo $infoProd["Descripcion_Prod"];?></p>
                                        <p class="card-text"><small class="text-muted">Cantidad: <?php echo $producto["cant_Prod"];?></small></p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <div class="card-text text-center">
                                            <div class="my-2">
                                                <i class="fa fa-tags"></i><span style="<?php if($infoProd["Descuento_Prod"]>0){echo "text-decoration: line-through;";}?>">  $<?php echo $infoProd["Precio_Prod"]?></span>
                                            </div >
                                            <?php if($infoProd["Descuento_Prod"]>0):?>
                                            <div class="my-2">
                                                <i class="fa fa-bolt"></i><span>  <?php echo $infoProd["Descuento_Prod"]?>% </span>
                                            </div>
                                            <div class="my-2">
                                                <i class="fa-solid fa-percent"></i><span>  $<?php echo number_format($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01),2)?>  </span>
                                            </div>
                                            <?php endif?>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-12 col-lg-6 col-xl-4 col-xxl-4">
                                    <div class="card-body row justify-content-center">
                                        <div class="col-7">
                                            <div class="form-floating">
                                                <input required class="form-control" type="number" placeholder="Cantidad" name="cantidadElim" id="cantElim" max='<?php echo $producto["cant_Prod"] ?>' min='0'>
                                                <label for="nombreProd">Cantidad</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="Id_Prod" value='<?php echo $infoProd["ID_Prod"]; ?>'>
                                        <input type="hidden" name="cantProd" value='<?php echo $producto["cant_Prod"];?>'>
                                        <div class="col-5">
                                            <input type="submit" style="width:100%; height:100%;" class="btn btn-outline-danger" id="delete" value="Eliminar">
                                        </div>
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