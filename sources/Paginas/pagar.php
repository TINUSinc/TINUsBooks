<?php
include("../header.php");
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
                        <div class="card mb-3">
                            <div class="row g-0 align-items-center">
                                <div class="col-4 col-md-2 col-lg-2 col-xl-2 col-xxl-1 d-flex justify-content-center">
                                    <img src="/media/productos/<?php echo $imgProd;?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-8 col-md-10 col-lg-10 col-xl-10 col-xxl-11">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $infoProd["Nombre_Prod"];?></h5>
                                        <p class="card-text"><?php echo $infoProd["Descripcion_Prod"];?></p>
                                        <p class="card-text"><small class="text-muted">Cantidad: <?php echo $producto["cant_Prod"];?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                        else:
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
    </body>

</html>