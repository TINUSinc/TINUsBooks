<?php 
  include("../header.php");
  if(isset($_SESSION["usuario"]) && isset($_POST["Id_Prod"])){
    agregarCarrito($_SESSION["usuario"]["ID_Usr"],$_POST["Id_Prod"],1);
  }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Productos</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/css/estilos-productos.css">
</head>
<body>
<div class="container">
  <div class="text-center">
    <h1>Productos</h1>
  </div>
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-3 g-4">
      <?php 
        $productos=getProductos();
        $band = false;
        foreach($productos as $producto):
          if(!$band && $producto["Descuento_Prod"]==0 && rand(1,3) == 3){
            $cantidad = rand(55,80);
            $producto["Descuento_Prod"]=$cantidad;
            $band= true;
          }
          ?>
          <div class="col">
            <div class="card">
              <img class="card-img-top imagen" src="/media/productos/<?php echo $producto["Imagenes"][1]?>" alt="'.$producto["Imagenes"][1].'">
              <div class="card-body">
                <h5 class="card-title"><?php echo $producto["Nombre_Prod"]?></h5>
                <p class="card-text descripcion"><?php echo $producto["Descripcion_Prod"]?></p>
                <?php if(isset($_SESSION["usuario"])){
                  echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'">
                          <input type="hidden" name="Id_Prod" value="'.$producto["ID_Prod"].'">
                          <button style="color: rgb(172, 18, 18);" class="btn btn-light" type="submit"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>
                        </form>';
                }else{
                  echo '<button class="btn btn-light" style="color: rgb(172, 18, 18);" type="button" data-bs-toggle="modal" data-bs-target="#modalIniciar"><i class="fas fa-shopping-cart"></i> Inicie sesión</button>';
                }
                ?> 
                <br>
                <p class="card-text">
                  <small class="text-muted">
                    <i class="fa-solid fa-boxes-stacked"></i><span><?php echo $producto["Existencias_Prod"] ?></span>
                    <i class="fa fa-tags"></i><span style="<?php if($producto["Descuento_Prod"]>0){echo "text-decoration: line-through;";}?>">$<?php echo $producto["Precio_Prod"]?></span>
                    <i class="fa fa-bolt"></i><span><?php echo $producto["Descuento_Prod"]?>%</span>
                    <?php if($producto["Descuento_Prod"]>0):?>
                      <i class="fa-solid fa-percent"></i><span>$<?php echo number_format($producto["Precio_Prod"]-($producto["Precio_Prod"]*$producto["Descuento_Prod"]*0.01),2)?></span>
                    <?php endif?>
                  </small>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach?>
    </div>
  </div>
</div>

  
</body>
</html>
