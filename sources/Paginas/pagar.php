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
        <script src="/js/pago.js" defer></script>
        <script src="/js/ValidarCC.js" defer></script>
        <link rel="stylesheet" href="/css/pago.css">
    </head> 
    <body> 
        <?php
            if(isset($_SESSION["usuario"])){
                revisarCarrito($_SESSION["usuario"]["ID_Usr"]);
            }else{
                echo "
                    <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                        Inicie sesión para poder ver la página de pagos.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    "; 
            }
        ?>
        <?php if(isset($_SESSION["usuario"])): 
                $carrito = getCarrito($_SESSION["usuario"]["ID_Usr"]);
                if(!empty($carrito)):
        ?>
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <h4 class="card-title text-center mt-3">Direcciones</h4>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                    $dir=getDirecciones($_SESSION["usuario"]["ID_Usr"]);
                                    foreach($dir as $direccion):
                                ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2">
                                    <div class="card dir mx-2 my-2 direccion">
                                        <div class="card-body"> 
                                        <p style="display: none;"><?php echo $_SESSION["usuario"]["ID_Usr"]?></p>
                                        <p><?php echo $direccion["Alias_Dir"]?></p>
                                        <p><?php echo $direccion["Calle_Dir"]?>, <?php echo $direccion["Num_Ext_Dir"]?>, <?php echo $direccion["Num_Int_Dir"]?>,
                                        <?php echo $direccion["CP_Dir"]?>, <?php echo $direccion["Mcpio_Dir"]?>, 
                                        <?php echo $direccion["Edo_Dir"]?>, <?php echo $direccion["Nombre_Pais"]?>
                                        </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php endforeach;?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2">
                                    <div class="card dir mx-2 my-2 ">
                                        <h5 class="card-title text-center mt-3">Agregar direccion</h5>
                                        <div class="card-body">
                                            <form action="direcciones.php" method="POST">
                                                <input type="submit" class="form-control" value="Nueva Direccion">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-8">
                    <div class="card">
                        <h4 class="card-title text-center mt-3">Metodos de pago</h4>
                        <div class="card-body">
                            <div class="row">
                                <p>Elija un metodo de pago:</p>
                                <div class="col">
                                    <input type="radio" name="tipoPago" id="tarjeta" value="Tarjeta" checked>
                                    <label for="tarjeta">Tarjeta</label><br>
                                </div>
                                <div class="col" >
                                    <input type="radio" name="tipoPago" id="oxxo" value="Oxxo">
                                    <label for="oxxo">OXXO</label><br>
                                </div>
                            </div>
                            <br>
                            <div id="pagoTarjeta"> 
                                <form action="">
                                    <div class=" input-group mb-2">  
                                        <input type="text" class="form-control" placeholder="Numero de tarjeta" id="ccField">
                                        <span class="input-group-text" id="basic-addon2"></span>
                                    </div>
                                    <div class="mb-2">  
                                        <input type="month" class="form-control" id="start" name="start" min="<?php echo date('Y-m'); ?>" placeholder="Fecha Expiracion">  
                                    </div>
                                    <div class="mb-2">
                                        <input type="number" class="form-control" placeholder="CVV" max="999" min="111" id="CVV"> 
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" class="form-control" placeholder="Nombre como aparece en la tarjeta" id="nomTar">  
                                    </div>
                                </form>
                            </div>
                            <div style="display:none; width: 100%;" id="pagoOxxo">
                                <div class="d-flex justify-content-center">
                                    <h5>Haz el desposito al siguiente número de tarjeta con referencia el número de compra 👇</h5> 
                                </div>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <p>1234567890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-4 resumen">
                    <div class="card" style="height: 100%;">
                        <?php 
                            $resumen = getCostoCarrito($_SESSION["usuario"]["ID_Usr"]);
                        ?>
                        <h4 class="card-title mt-3" style="text-align:center;">Resumen de pedido</h4>
                        <div id="infoCarrito">  
                            <div class="text-center m-3">
                                <p class="card-text">Total parcial: $<?php echo number_format($resumen["total"],2) ;?></p>
                                <p class="card-text">Descuento: <?php echo number_format($resumen["desc"],3) ;?>%</p>
                                <p class="card-text">Envio: $<?php echo number_format($resumen["CostoEnv"],2) ;?></p>
                                <p class="card-text" id="impuestoAplicable"></p>
                                <p class="card-text" id="cuponPorc"></p>
                                <p class="card-text" id="total"></p>
                            </div>
                        </div>  
                        <div class="text-center mb-3">
                            <input type="hidden" name="cupon" id="cuponPago">
                            <input type="hidden" name="alias" id="aliasPago">
                            <button class="btn btn-outline-secondary col-3" id="btnPagar">Pagar</button>
                        </div>
                        <div class="input-group my-3">
                            <div class="form-floating mx-3">
                                <input type="text" placeholder="Cupón" id="cupon" class="form-control">
                                <label for="cupon">Cupón</label> 
                            </div>
                        </div>
                        <div class="text-center mb-3">
                            <button class="btn btn-outline-secondary col-3" id="btnCupon">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-4" id="tablaCarrito">
                <div class="col-12">
                    <?php if(isset($_SESSION["usuario"])): 
                        $carrito = getCarrito($_SESSION["usuario"]["ID_Usr"]);
                        if(!empty($carrito)):
                    ?>
                    <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead class="table-primary">
                            <tr>
                                <th class="cabecera" scope="col">Producto</th>
                                <th class="cabecera" scope="col">Precio Unitario</th>
                                <th class="cabecera" scope="col">Descuento</th>
                                <th class="cabecera" scope="col">Precio final</th>
                                <th class="cabecera" scope="col">Cantidad</th>
                                <th class="cabecera" scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            foreach($carrito as $producto):
                                $infoProd = getProducto($producto["ProductoID_Prod"]);
                            ?>
                            <tr class="align-middle">
                                <th scope="row" rowspan="2"><?php echo $infoProd["Nombre_Prod"];?></th>
                                <td  style="<?php if($infoProd["Descuento_Prod"]>0){echo "text-decoration: line-through;";}?>">$<?php echo $infoProd["Precio_Prod"];?></td>
                                <td ><?php echo $infoProd["Descuento_Prod"]?>%</td>
                                <td >$<?php echo number_format($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01),2)?></td>
                                <td ><?php echo $producto["cant_Prod"];?></td>
                                <td >$<?php echo number_format($producto["cant_Prod"]*number_format($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01),2),2);?></td>
                            </tr>
                        </tbody>
                        <?php endforeach; ?>
                    </table>
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
        </div>
        <?php else:
            echo "
                <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                    No hay productos en su carrito
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                "; 
            endif;
        ?>
    <?php endif; ?>
    </body>
</html>
<?php
    include_once("../PHP/footer.php");
?>