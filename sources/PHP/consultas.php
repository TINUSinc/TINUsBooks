<?php 
    include("conexion.php");

    function login($cuentaUsr, $Contra_usr){
        global $conexion;
        $query = 'SELECT * FROM usuario WHERE Cuenta_usr="'.$cuentaUsr.'" AND Contrasena_usr="'.MD5($Contra_usr).'");';
        if($conexion->query($query)) return true;
        return false;
    }
?>