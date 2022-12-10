<?php 
    include("../header.php");
    if(isset($_SESSION["usuario"]) && isset($_POST["Id_Prod"])){
        agregarCarrito($_SESSION["usuario"]["ID_Usr"],$_POST["Id_Prod"],1);
    }
    if(isset($_GET["id"]) && !empty($_GET["id"])):
        $producto=getProducto($_GET["id"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7491ec4faf.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/producto-individual.css">
</head>

<body>
    <div class="container my-4">

    <div class="card cardInvidivdual">
            <div class="row g-0">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" >
                        <div class="carousel-inner" id="carrousel">
                            <?php 
                                $cont = 0;
                                $imagenes = getImagenesProd($_GET["id"]);
                                foreach($imagenes as $imagen):
                            ?>
                            <div class='carousel-item <?php if($cont == 0){ echo "active";}?>'><img src="/media/productos/<?php echo $imagen?>" class="imagen" alt="<?php echo $imagen?>"></div>
                            <?php 
                                $cont++;
                                endforeach;
                            ?>
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
                <div class="col-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                    <div class="card-body card-body text-center">
                        <h5 class="titulo"><?php echo $producto["Nombre_Prod"]?></h5>
                        <p class="descripcion"><?php echo $producto["Descripcion_Prod"]?></p>
                        <div class="row my-4">
                            <div class="card-text text-muted col-12 col-md-6 mt-3">
                                
                                <div class="text-muted my-3">
                                    <i class="fa-solid fa-boxes-stacked"></i> Disponibles: <span><?php echo $producto["Existencias_Prod"]?></span>
                                </div>
                                <div class="text-muted my-3">
                                    <i class="fa fa-tags"></i> Precio: <span style="<?php if($producto["Descuento_Prod"]>0){echo "text-decoration: line-through;";}?>">$<?php echo $producto["Precio_Prod"]?></span>
                                </div>
                                <?php if($producto["Descuento_Prod"]>0):?>
                                <div class="text-muted my-3">
                                    <i class="fa fa-bolt"></i> Descuento: <span><?php echo $producto["Descuento_Prod"]?>%</span>
                                </div>
                                <div class=" text-muted my-3">
                                    <i class="fa-solid fa-percent"></i> Precio: <span>$<?php echo number_format($producto["Precio_Prod"]-($producto["Precio_Prod"]*$producto["Descuento_Prod"]*0.01),2)?></span>
                                </div>
                                <?php endif?>
                            </div>
                            
                            <div class="contenedorIconos col-12 col-md-6 justify-content-center my-3">
                                <div class="iconoTexto">
                                    <article class=".articlecirc">
                                        <img src="/media/productos/carrito-compra.jpg" alt="Sucursales" class="avatar">
                                        <p style="color: black">Amplia variedad de productos</p>
                                    </article>
                                </div>
                                <div class="iconoTexto">
                                    <article class=".articlecirc">
                                        <img src="/media/productos/compra-segura.jpg" alt="Sucursales" class="avatar">
                                        <p style="color: black">Seguridad en tu compra</p>
                                    </article>
                                </div>
                            </div>
                        </div> 
                        <div class="text-center">
                            <?php if(isset($_SESSION["usuario"])){
                            $disponibilidad = ""; 
                            $texto=" Agregar al carrito";
                            if($producto["Existencias_Prod"] == 0){
                                $disponibilidad = "disabled";
                                $texto = " Sin inventario";
                            }
                            echo '
                                <form method="POST" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'">
                                    <div class="row justify-content-center">
                                    <input type="hidden" name="Id_Prod" value="'.$producto["ID_Prod"].'">
                                    <button '.$disponibilidad.' style="color: green; width: 200px;" class="btn btn-light" type="submit"><i class="fas fa-shopping-cart"></i>'.$texto.'</button>
                                    </div>
                                </form>
                                ';
                            }else{
                            echo '
                                <div class="row justify-content-center">
                                    <button class="btn btn-light"  style="color: green; width: 200px;" type="button" data-bs-toggle="modal" data-bs-target="#modalIniciar"><i class="fas fa-shopping-cart"></i> Inicie sesión</button>
                                </div>
                            ';
                            }
                            ?> 
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php if(isset($_SESSION["usuario"]) && isset($_POST["Id_Prod"])): ?>
    <script>
        document.getElementById("carritoCant").innerText = <?php echo getTotalProdCarrito($_SESSION["usuario"]["ID_Usr"]) ?>;
    </script>
<?php endif ?>

</body>

</html>
<?php else: ?>
    <script type='text/javascript'>window.location = '/sources/Paginas/productos.php'</script>
<?php endif; ?>
<?php
    include_once("../PHP/footer.php");
?>