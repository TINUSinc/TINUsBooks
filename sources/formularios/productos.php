<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Productos</title>
        <meta name="viewport" content="width=device-width">

        <!-- links de Bootstrap -->
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        
        <div class="text-center mt-5">
            <h1 class="h2 mb-3 font-weight-normal">Registro de productos</h1>
            <form style="max-width:300px;margin:auto;">
                <div class="form-group">
                    <label for="producto">Elige un producto:</label>
                    <br>
                    <select name="producto" id="producto" tittle="Elige un producto de la lista">
                        <option value="manga">Manga</option>
                    </select>
                    <input type="text" class="form-control" placeholder="Nombre del producto">
                    <input type="text" class="mt-2 form-control" placeholder="Tipo de categoria">
                    <textarea class="mt-2 form-control" name="descripcion" rows="5" cols="60" placeholder="Descripcion"></textarea> 
                    <input type="number" class="mt-2 form-control" placeholder="Existencias">
                    <input type="number" class="mt-2 form-control" placeholder="Descuento">
                    <div class="mt-3 d-grid gap-2">
                        <button class="btn btn-dark btn-lg">Enviar</button>
                    </div>
                </div>
            </form>
        </div>

    </body>

</html>