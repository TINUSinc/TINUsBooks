<?php 
  include("../header.php");
  if(isset($_SESSION["usuario"]) && isset($_POST["Id_Prod"])){
    agregarCarrito($_SESSION["usuario"]["ID_Usr"],$_POST["Id_Prod"],1);
  }
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
    <div class="contenedorPrincipal">

        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="..." class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="titulo">Titulo</h5>
                        <p class="descripcion">Descripcion</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <div class="contenedorIconos">
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