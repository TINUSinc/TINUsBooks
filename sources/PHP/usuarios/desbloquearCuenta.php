<?php
include_once("/sources/PHP/consultas.php");
include_once("/sources/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h3>Modo de recuperacion, se le enviara un correo a su cuenta</h3>
        <h3>¿Esta de acuerdo con esto?</h3>
        <form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="submit" value="aceptar">
        </form>
    </div>
</body>
</html>