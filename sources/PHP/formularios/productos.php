<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Productos</title>
        <meta name="viewport" content="width=device-width">

        <!-- links de Bootstrap -->
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <div class="text-center mt-5">
            <h1 class="h2 mb-3 font-weight-normal">Registro de productos</h1>
            <form style="max-width:300px;margin:auto;">
                <div class="form-group">
                    <input type="checkbox">
                    <input type="text" class="form-control" placeholder="Nombre del producto">
                    <input type="text" class="mt-2 form-control" placeholder="Tipo de categoria">
                    <textarea name="comentarios" rows="5" cols="60"></textarea> 
                    <div class="mt-3 d-grid gap-2">
                        <button class="btn btn-dark btn-lg">Enviar</button>
                    </div>
                </div>
            </form>
        </div>

    </body>

</html>