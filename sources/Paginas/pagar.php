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
                            <input type="radio" id="tarjeta" name="tarjeta" value="Tarjeta">
                            <label for="tarjeta">Tarjeta</label><br>
                            <input type="radio" id="oxxo" name="tienda" value="Oxxo">
                            <label for="oxxo">Oxxo</label><br>
                            <br>
                            <section class="d-flex justify-content-center">
                            <form action="">
                                    <div>
                                      <input type="text" placeholder="Número de tarjeta">  
                                      <div class="mb-2">
                                        <input type="text" placeholder="Fecha Expiracion">  
                                      </div>
                                      <div class="mb-2">
                                        <input type="text" placeholder="CVV"> 
                                      </div>
                                      <input type="text" placeholder="Nombre como aparece en la tarjeta">  
                                    </div>
                                </form>
                            </section>
                                    
                                
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-8">
                    <?php if(isset($_SESSION["usuario"])): 
                        $carrito = getCarrito($_SESSION["usuario"]["ID_Usr"]);
                        if(!empty($carrito)):
                    ?>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio Unitario</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Precio final</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($carrito as $producto):
                                $infoProd = getProducto($producto["ProductoID_Prod"]);
                                
                            ?>
                            <tr>
                                <th scope="col"><?php echo $infoProd["Nombre_Prod"];?></th>
                                <td style="<?php if($infoProd["Descuento_Prod"]>0){echo "text-decoration: line-through;";}?>">$<?php echo $infoProd["Precio_Prod"];?></td>
                                <td><?php echo $infoProd["Descuento_Prod"]?>%</td>
                                <td>$<?php echo number_format($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01),2)?></td>
                                <td><?php echo $producto["cant_Prod"];?></td>
                                <td><?php echo ($producto["cant_Prod"]*number_format($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01),2));?></td>
                            </tr>
                        </tbody>
                    </table>
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
                <div class="col-4">
                    <div class="card">
                        <div class="card">
                            <?php $resumen = getCostoCarrito($_SESSION["usuario"]["ID_Usr"]);?>
                            <h5 class="card-title">Resumen de pedido</h5>
                            <div>
                                <input type="text">
                                <button class="btn btn-outline-secondary">aplicar</button>
                            </div>
                            <p class="card-text">Total parcial: $<?php echo number_format($resumen["total"],2) ;?></p>
                            <p class="card-text">Descuento: <?php echo number_format($resumen["desc"],3) ;?>%</p>
                            <p class="card-text">Total: $<?php echo number_format($resumen["totalDesc"],2) ;?></p>
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