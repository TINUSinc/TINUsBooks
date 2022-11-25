<?php 
    $servidor='localhost:33065';
    $cuenta='root';
    $password='';
    $bd='tinusbooks';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);
    if($conexion->connect_errno):
    include_once("altas.php");
    include_once("bajas.php");
    include_once("consultas.php");
?>
<div class="alert alert-danger" role="alert">
Error al conectar con la base de datos: <?php echo $conexion->connect_error?>
</div>
<?php endif?>