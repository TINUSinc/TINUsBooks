<?php
    include_once("conexion.php");
    //Funciones a las que se mandan parametros de las bajas.
    function borrarProducto($idProducto) {
        global $conexion;
        try{
            $query = 'DELETE FROM img_producto WHERE ProductoId_Prod='.$idProducto.';';
            $conexion->query($query);
            $query = 'DELETE FROM producto WHERE ID_Prod='.$idProducto.';';
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se elimino el producto
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al eliminar el producto
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }


?>