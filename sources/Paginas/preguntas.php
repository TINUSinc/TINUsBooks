<?php 
  include("../header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preguntas Frecuentes</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        body{
            background-color: rgb(239, 239, 205);
        }

        h2{
          color: #1B1B1B;
        }

    </style>
</head>

<body>
    <br>
    <div class="d-flex justify-content-center">
        <h2>Preguntas Frecuentes</h2>
    </div>
    <div class="d-flex justify-content-center">
        <p>Todo lo que necesitas saber</p>
    </div>
    <!-- cuerpo -->
    <div class="container" style="text-align: justify;">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              ¿Cuántos días puede tardar en llegar mi pedido?
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">El pedido puede tardar a llegar de 10 a 15 días hábiles, dependiendo también de 
                a donde se envía el producto puede tardar más días o menos de lo establecido.</div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              ¿Hacen envíos internacionales?
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
              Sí, contamos con envíos dentro de México, en Estados Unidos, Cánada y España, 
              de momento. Para envíos a otros países el costo será variable y es necesario contactarnos, 
              por medio de nuestra pagina de Facebook o Instagram.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              ¿Cuál es la política de devolución?
              </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">A partir de que llegue el producto a tus manos, se tiene un tiempo de 15 días hábiles para 
              poder  solicitar un cambió o una devolución, después de ese tiempo ya no se podrá aceptar una solicitud de devolución.</div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFourth">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFourth" aria-expanded="false" aria-controls="flush-collapseFourth">
              ¿Qué hacemos con los datos de compra?
              </button>
            </h2>
            <div id="flush-collapseFourth" class="accordion-collapse collapse" aria-labelledby="flush-headingFourth" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Los datos únicamente son utilizados para la información de pago y envío, cuando creas una cuenta estos 
              son guardados para futuras compras y solicitar devoluciones</div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
              ¿Cómo se aplican las promociones?
              </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Para aplicar cualquier promoción es necesario agregar el cupón antes de finalizar una compra. En la página del carrito 
              antes de finalizar está una sección para agregar el cupón.</div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingSix">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
              ¿Hacen pedidos de libros fuera del catalogo?
              </button>
            </h2>
            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Por supuesto, puedes preguntar y cotizar sin compromiso. Mandandonos mensaje del libro que te interesaría encargar
                por medio de nuestra página de Facebook o de Instagram, con gusto ahí te atendemos.
              </div>
            </div>
          </div>

      </div>
    </div>
    <br>
</body>
</html>
<?php
    include_once("../PHP/footer.php");
?>