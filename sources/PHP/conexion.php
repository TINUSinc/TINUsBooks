<?php 
    $servidor='localhost';
    $cuenta='root';
    $password='';
    $bd='tinustest';
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);
    if($conexion->connect_errno):
?>
<div class="alert alert-danger" role="alert">
Error al conctar con la base de datos: <?php echo $conexion->connect_error?>
</div>
<?php endif?>