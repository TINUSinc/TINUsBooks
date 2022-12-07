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
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 justify-content-end text-center">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
        <select class="form-select" name="categoria" id="categoria" tittle="Elige una categoria de la lista" required>
          <option value="0">Todas las categorías</option>
          <?php
              $categorias = getCategorias();
              foreach($categorias as $categoria){
                  echo '<option value='.$categoria["ID_cat"].'>'.$categoria["Nom_Cat"].'</option>';
              }
          ?>
        </select>
        <input type="submit" class="btn btn-light my-2" value="Mostrar">
      </form>
    </div>
    <br>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 g-4">
      <?php
        if(isset($_GET["categoria"]) && !empty($_GET["categoria"])){
          $productos = getProductosCategoria($_GET["categoria"]);
        }else{
          $productos=getProductos();
        }
        $band = false;
      if(!empty($productos)):
        foreach($productos as $producto):
          if(!$band && $producto["Descuento_Prod"]==0 && rand(1,3) == 3){
            $cantidad = rand(55,80);
            $producto["Descuento_Prod"]=$cantidad;
            $band= true;
          }
      ?>
          <div class="col">
            <div class="card">
              <img class="card-img-top imagen" src="/media/productos/<?php echo $producto["Imagenes"][1]?>" alt="<?php echo $producto["Imagenes"][1]?>">
              <!--<button class="card-img-top imagen" class="card-img-top imagen" style="background: url('/media/productos/<?php //echo $producto["Imagenes"][1]?>" alt="'.$producto["Imagenes"][1].') no-repeat;"></button>-->
              <div class="card-body">
                <h5 class="card-title"><?php echo $producto["Nombre_Prod"]?></h5>
                <p class="card-text descripcion"><?php echo $producto["Descripcion_Prod"]?></p>
                <?php if(isset($_SESSION["usuario"])){
                  $disponibilidad = "";
                  $texto=" Agregar al carrito";
                  if($producto["Existencias_Prod"] == 0){
                    $disponibilidad = "disabled";
                    $texto = " Sin inventario";
                  }
                  echo '
                      <form method="POST" action="'.$_SERVER["PHP_SELF"].'">
                        <div class="row justify-content-center">
                          <input type="hidden" name="Id_Prod" value="'.$producto["ID_Prod"].'">
                          <button '.$disponibilidad.' style="color: rgb(172, 18, 18); width: 200px;" class="btn btn-light" type="submit"><i class="fas fa-shopping-cart"></i>'.$texto.'</button>
                        </div>
                      </form>
                      ';
                }else{
                  echo '
                    <div class="row justify-content-center">
                      <button class="btn btn-light" style="color: rgb(172, 18, 18); width: 200px" type="button" data-bs-toggle="modal" data-bs-target="#modalIniciar"><i class="fas fa-shopping-cart"></i> Inicie sesión</button>
                    </div>
                  ';
                }
                ?> 
                <br>
                <p class="card-text">
                  <small class="text-muted">
                    <i class="fa-solid fa-boxes-stacked"></i><span><?php echo $producto["Existencias_Prod"] ?></span>
                    <i class="fa fa-tags"></i><span style="<?php if($producto["Descuento_Prod"]>0){echo "text-decoration: line-through;";}?>">$<?php echo $producto["Precio_Prod"]?></span>
                    <?php if($producto["Descuento_Prod"]>0):?>
                      <i class="fa fa-bolt"></i><span><?php echo $producto["Descuento_Prod"]?>%</span>
                      <i class="fa-solid fa-percent"></i><span>$<?php echo number_format($producto["Precio_Prod"]-($producto["Precio_Prod"]*$producto["Descuento_Prod"]*0.01),2)?></span>
                    <?php endif?>
                  </small>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach?>
        <?php else: ?>
          <div class='alert alert-warning show text-center' style="width: 100%;" role='alert'>
              No hay productos para esta categoría.
          </div>
        <?php endif ?>
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
