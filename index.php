<?php
    include_once("sources/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas</title>
</head>
<body>
<?php
                            $paises = getPaises();
foreach ($paises as $pais):
    print_r($pais);
                            endforeach;
                        ?>
</body>
</html>