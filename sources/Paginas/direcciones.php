<?php 
  include("../header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dirección</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/direccionesStyle.css">

</head>

<body>
    
        <div class="contenedorFormulario">
            <center>
                <h3><i class="fa-solid fa-address-book"></i> Registrar Dirección</h3>
            </center>
            <form class="row g-3">
                <div class="col-md-8">
                    <label for="validationDefault01" class="form-label">Calle</label>
                    <input type="text" class="form-control" id="validationDefault01">
                </div>
                <div class="col-md-2">
                    <label for="validationDefault02" class="form-label">Núm. Int.</label>
                    <input type="text" class="form-control" id="validationDefault02">
                </div>
                <div class="col-md-2">
                    <label for="validationDefault02" class="form-label">Núm. Ext.</label>
                    <input type="text" class="form-control" id="validationDefault02">
                </div>

                <div class="col-md-2">
                    <label for="validationDefault05" class="form-label">C. P</label>
                    <input type="text" class="form-control" id="validationDefault05" required>
                </div>
                <div class="col-md-5">
                    <label for="validationDefault03" class="form-label">Municipio</label>
                    <input type="text" class="form-control" id="validationDefault03" required>
                </div>
                <div class="col-md-5">
                    <label for="validationDefault05" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="validationDefault05" required>
                </div>

                <div class="col-md-6">
                    <label for="validationDefault04" class="form-label">País</label>
                    <select class="form-select" id="validationDefault04" required>
                        <option selected disabled value="">Selecciona</option>
                        <option>Alemania</option>
                        <option>Argentina</option>
                        <option>Chile</option>
                        <option>Japón</option>
                        <option>México</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="validationDefaultUsername" class="form-label">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control" id="validationDefaultUsername"
                            aria-describedby="inputGroupPrepend2" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                        <label class="form-check-label" for="invalidCheck2">
                            Acepto términos y condiciones
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Registrar dirección</button>
                </div>
            </form>
        </div>
</body>

</html>