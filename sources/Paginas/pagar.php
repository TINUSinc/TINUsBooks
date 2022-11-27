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
        <div class="container">
        
            <div class="tarjeta">
                <?php 
                $prodCarrito=getProd($_SESSION["usuario"]);
                $prodCarrito=$prodCarrito->fetch_assoc();
                foreach($prod as $prodCarrito):?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo getNameProd($prod["ProductoID_Prod"]);?></h5>
                                    <p class="card-text"><?php echo getDescProd($prod["ProductoID_Prod"]);?></p>
                                    <p class="card-text"><small class="text-muted"><?php echo $prod["cant_Prod"];?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>

    </body>

</html>