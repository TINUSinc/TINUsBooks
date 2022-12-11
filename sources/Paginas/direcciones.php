<?php 
  include("../header.php");
  if(isset($_POST["registrarDir"]) && isset($_SESSION["usuario"])){
    if($_POST["direccion"]=="NuevaDir"){
        crearDireccion($_SESSION["usuario"]["ID_Usr"], $_POST["alias"], $_POST["numInt"], 
                    $_POST["numExt"], $_POST["calle"], $_POST["CP"], $_POST["Mcpio"], 
                    $_POST["Edo"], $_POST["pais"], $_POST["tel"]);
    }else{
        modificarDireccion($_SESSION["usuario"]["ID_Usr"], $_POST["direccion"], $_POST["numInt"], 
                    $_POST["numExt"], $_POST["calle"], $_POST["CP"], $_POST["Mcpio"], 
                    $_POST["Edo"], $_POST["pais"], $_POST["tel"]);
    }
  }
  if(isset($_POST["eliminarDir"]) && isset($_SESSION["usuario"])){
    borrarDireccion($_SESSION["usuario"]["ID_Usr"], $_POST["direccion"]);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dirección</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/direccionesStyle.css">
    <script src="../../js/direcciones.js" defer></script>
</head>
<body style="background-color: rgb(239, 239, 205);">
    <?php if(isset($_SESSION["usuario"])): ?>
        <div class="container my-4 contenedorFormulario">
            <center>
                <h3><i class="fa-solid fa-address-book mt-3"></i> Direcciones</h3>
            </center>
            <form class="row g-3 my-3" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" id="ID_Usr" name="ID_Usr" value="<?php echo $_SESSION["usuario"]["ID_Usr"]?>">
                <div class="col-md-12">
                    <label for="validationDefault1" class="form-label">Direccion</label>
                    <select class="form-select" id="validationDefault1" name="direccion" required>
                        <option value="NuevaDir">Nueva Direccion</option>
                        <?php 
                            $direcciones = getDirecciones($_SESSION["usuario"]["ID_Usr"]);
                            foreach($direcciones as $direccion):
                        ?>
                            <option value="<?php echo $direccion["Alias_Dir"]?>"><?php echo $direccion["Alias_Dir"]?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="validationDefault" class="form-label">Alias</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-location-arrow"></i></span>
                        <input required type="text" name="alias" class="form-control" id="validationDefault">
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="validationDefault2" class="form-label">Calle</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-road"></i></span>
                        <input required type="text" name="calle" class="form-control" id="validationDefault2">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="validationDefault3" class="form-label">Núm. Int.</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-list-ol"></i></span>
                        <input type="text" name="numInt" class="form-control" id="validationDefault3">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="validationDefault4" class="form-label">Núm. Ext.</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-hashtag"></i></span>
                        <input required type="text" name="numExt" class="form-control" id="validationDefault4">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="validationDefault5" class="form-label">C.P.</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-location-dot"></i></span>
                        <input type="text" name="CP" class="form-control" id="validationDefault5" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="validationDefault6" class="form-label">Municipio</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-tower-observation"></i></span>
                        <input type="text" name="Mcpio" class="form-control" id="validationDefault6" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="validationDefault7" class="form-label">Estado</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-city"></i></span>
                        <input type="text" name="Edo" class="form-control" id="validationDefault7" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="validationDefault8" class="form-label">País</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-globe"></i></span>
                        <select class="form-select" name="pais" id="validationDefault8" required>
                            <option selected disabled value="0">Selecciona</option>
                            <?php
                                $paises = getPaises();
                                foreach ($paises as $pais):
                                
                            ?>
                                <option value="<?php echo $pais["ID_Pais"]?>"><?php echo $pais["Nombre_Pais"]?></option>
                            <?php 
                                endforeach;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="validationDefaultUsername" class="form-label">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" name="tel" class="form-control" id="validationDefaultUsername"
                            aria-describedby="inputGroupPrepend2" required>
                    </div>
                </div>
                <div class="col-12 text-center mb-4">
                    <button class="btn btn-primary" id="registrarDir" name="registrarDir" type="submit">Registrar dirección</button>
                    <button class="btn btn-danger" id="eliminarDir" name="eliminarDir" disabled type="submit">Eliminar Direccion</button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="container my-4">
            <h1 class="text-center titulos">Inicie sesión</h1>
            <div class='container-fluid'>
                <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                    Para poder ver esta página necesita iniciar sesión.
                </div>
            </div>
        </div>
    <?php endif ?>
    <br><br><br><br><br><br><br><br>
</body>
</html>
<?php include('../PHP/footer.php')?>