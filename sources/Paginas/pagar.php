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
        <script src="/js/pago.js"></script>
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
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-8">
                    <div class="card">
                        <h4 class="card-title text-center mt-3">Metodos de pago</h4>
                        <div class="card-body">
                            <div class="row">
                                <p>Elija un metodo de pago:</p>
                                <div class="col">
                                    <input type="radio" id="tarjeta" name="tipoPago" value="Tarjeta">
                                    <label for="tarjeta">Tarjeta</label><br>
                                </div>
                                <div class="col">
                                    <input type="radio" id="oxxo" name="tipoPago" value="Oxxo">
                                    <label for="oxxo">Oxxo</label><br>
                                </div>
                            </div>
                            <br>
                            <div style="display:none;" id="pagoTarjeta"> 
                                <form action="">
                                      <div class="mb-2">  
                                        <input type="text" class="form-control" placeholder="Numero de tarjeta">
                                      </div>
                                      <div class="mb-2">  
                                        <input type="text" class="form-control" placeholder="Fecha Expiracion">  
                                      </div>
                                      <div class="mb-2">
                                        <input type="text" class="form-control" placeholder="CVV"> 
                                      </div>
                                      <div class="mb-2">
                                        <input type="text" class="form-control" placeholder="Nombre como aparece en la tarjeta">  
                                      </div>
                                      <div class="mb-2 d-grid gap-2 col-6 mx-auto">
                                        <button type="button" class="btn btn-primary">Realizar pedido</button>
                                      </div>
                                </form>
                            </div>
                            <div style="display:none;" id="pagoOxxo">
                                <div class="d-flex justify-content-center">
                                    <h5>Haz tu deposito en el siguiente número de tarjeta 👇</h5> 
                                </div>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <p>1234567890</p>
                                </div>
                            </div>
                            
                            
                            
                                    
                                
                           
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-4">
                    <div class="card" style="height: 100%;">
                        <?php 
                            $resumen = getCostoCarrito($_SESSION["usuario"]["ID_Usr"]);
                            $costos_envio = getCostoEnvio();
                            $costo_envio = array();
                            foreach($costos_envio as $envio){
                                if($resumen["totalDesc"]>=$envio["Monto_Compra"]){
                                    $costo_envio["Costo"] = $envio["Costo_Envio"];
                                    $costo_envio["Monto"] = $envio["Monto_Compra"];
                                }
                            }
                            $total = ($resumen["totalDesc"]+$costo_envio["Costo"]);
                        ?>
                        <h4 class="card-title mt-3" style="text-align:center;">Resumen de pedido</h4>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <div class="input-group my-3">
                                <div class="form-floating mx-3">
                                    <input type="text" placeholder="Cupón" id="cupon" name="cupon" class="form-control">
                                    <label for="cupon">Cupón</label> 
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-secondary col-3">Aplicar</button>
                            </div>
                        </form>
                        <div class="text-center m-3">
                            <p class="card-text">Total parcial: $<?php echo number_format($resumen["total"],2) ;?></p>
                            <p class="card-text">Descuento: <?php echo number_format($resumen["desc"],3) ;?>%</p>
                            <p class="card-text">Envio: $<?php echo number_format($costo_envio["Costo"],2) ;?></p>
                            <p class="card-text">Total: $<?php echo number_format($total,2) ;?></p>
                            <?php 
                                if(isset($_POST["cupon"])):
                                    $cupon = getCupon($_POST["cupon"]);
                                    if(!empty($cupon)):
                                        echo '
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Cupón válido
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        ';
                                        $totalCup = ($resumen["totalDesc"]+$costo_envio["Costo"])-(($resumen["totalDesc"]+$costo_envio["Costo"])*$cupon["Porcentaje_Desc"]*0.01);
                            ?>
                            <p class="card-text">Cupon: <?php echo $cupon["Porcentaje_Desc"] ;?>%</p>
                            <p class="card-text">Total con cupón: $<?php echo number_format($totalCup,2) ;?></p>
                            <?php
                                    else:
                                        echo '
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            Cupón no válido
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        ';
                                    endif;
                                endif;
                            ?>
                        </div>
                        <div class="text-center mb-3">
                            <button class="btn btn-outline-secondary col-3">Pagar</button>
                        </div>
                    </div>
            </div>
            </div>
            <div class="row my-4">
                <div class="col-12">
                    <?php if(isset($_SESSION["usuario"])): 
                        $carrito = getCarrito($_SESSION["usuario"]["ID_Usr"]);
                        if(!empty($carrito)):
                    ?>
                    <table class="table">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio Unitario</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Precio final</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            foreach($carrito as $producto):
                                $infoProd = getProducto($producto["ProductoID_Prod"]);
                                
                            ?>
                            <tr class="table align-middle">
                                <th scope="col" rowspan="2"><?php echo $infoProd["Nombre_Prod"];?></th>
                                <td  style="<?php if($infoProd["Descuento_Prod"]>0){echo "text-decoration: line-through;";}?>">$<?php echo $infoProd["Precio_Prod"];?></td>
                                <td ><?php echo $infoProd["Descuento_Prod"]?>%</td>
                                <td >$<?php echo number_format($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01),2)?></td>
                                <td ><?php echo $producto["cant_Prod"];?></td>
                                <td >$<?php echo number_format($producto["cant_Prod"]*number_format($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01),2),2);?></td>
                            </tr>
                        </tbody>
                        <?php endforeach; ?>
                    </table>
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
            
        </div>
        
    </body>
</html>
<?php
    include_once("../PHP/footer.php");
?>