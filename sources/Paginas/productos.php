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
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php 
        $productos=getProductos();
        foreach($productos as $producto){
          if(isset($_SESSION["usuario"])){
              echo '
              <div class="col">
                <div class="card">
                  <img class="card-img-top imagen" src="/media/productos/'.$producto["Imagenes"][1].'" alt="'.$producto["Imagenes"][1].'">
                  <div class="card-body">
                    <h5 class="card-title">'.$producto["Nombre_Prod"].'</h5>
                    <p class="card-text descripcion">'.$producto["Descripcion_Prod"].'</p>
                    <form method="POST" action="'.$_SERVER["PHP_SELF"].'">
                      <input type="hidden" name="Id_Prod" value="'.$producto["ID_Prod"].'">
                      <button style="color: rgb(172, 18, 18);" class="btn btn-light" type="submit"><i class="fas fa-shopping-cart"></i> Agregar al carrito</button>
                    </form>
                    <br>
                    <p class="card-text"><small class="text-muted"><i class="fa-solid fa-boxes-stacked"></i>'.$producto["Existencias_Prod"].'<i class="fa fa-tags"></i>$'.$producto["Precio_Prod"].'<i class="fa fa-bolt"></i>'.$producto["Descuento_Prod"].'%</small></p>
                  </div>
                </div>
              </div>
            ';
          }else{
            echo '
              <div class="col">
                <div class="card">
                  <img class="card-img-top" src="/media/productos/'.$producto["Imagenes"][1].'" alt="'.$producto["Imagenes"][1].'">
                  <div class="card-body">
                    <h5 class="card-title">'.$producto["Nombre_Prod"].'</h5>
                    <p class="card-text descripcion">'.$producto["Descripcion_Prod"].'</p>
                    <button class="btn btn-light" style="color: rgb(172, 18, 18);" type="button" data-bs-toggle="modal" data-bs-target="#modalIniciar"><i class="fas fa-shopping-cart"></i> Inicie sesión</button>
                    <br>
                    <p class="card-text"><small class="text-muted"><i class="fa-solid fa-boxes-stacked"></i>'.$producto["Existencias_Prod"].'<i class="fa fa-tags"></i>$'.$producto["Precio_Prod"].'<i class="fa fa-bolt"></i>'.$producto["Descuento_Prod"].'%</small></p>
                  </div>
                </div>
              </div>
            ';
          }
          
        }
      ?>
    </div>
    
  </div>
</div>

  
</body>
</html>
