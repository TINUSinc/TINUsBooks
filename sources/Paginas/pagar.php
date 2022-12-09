<?php
include("../header.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pagar</title>
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
        
        <div class="container">
            <div class="row">
                <div>
                    <h4>Metodos de pago</h4> 
                    <div class="card">
                        <div class="card-body">
                            <p>Elija un metodo de pago:</p>
                            <ul>
                                <li>Bancomer</li>
                                <li>Banamex</li>
                                <li>Santander</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row my-4">
                <div class="col-8">
                    <?php if(isset($_SESSION["usuario"])): 
                        $carrito = getCarrito($_SESSION["usuario"]["ID_Usr"]);
                        if(!empty($carrito)):
                    ?>
                    <div class="card">
                    <?php
                    foreach($carrito as $producto):
                        $infoProd = getProducto($producto["ProductoID_Prod"]);
                        
                    ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $infoProd["Nombre_Prod"];?></h5>
                            <p class="card-text"><small class="text-muted">Cantidad: <?php echo $producto["cant_Prod"];?></small></p>
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
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                        <?php $resumen = getCostoCarrito($_SESSION["usuario"]["ID_Usr"]);?>
                            <h5 class="card-title">Resumen de pedido</h5>
                            <p class="card-text">total neto: <?php $resumen["total"];?></p>
     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    include_once("../PHP/footer.php");
?>