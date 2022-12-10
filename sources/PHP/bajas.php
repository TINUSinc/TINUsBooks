<?php
    include_once("conexion.php");
    //Funciones a las que se mandan parametros de las bajas.
    function borrarProducto($idProducto) {
        global $conexion;
        try{
            $query = 'SELECT Direccion_Img FROM img_producto WHERE ProductoId_Prod='.$idProducto.';';
            $imagenes = $conexion->query($query);
            $target = "../../media/productos/";
            while($fila = $imagenes->fetch_assoc()){
                if(file_exists(($target.$fila["Direccion_Img"]))){
                    unlink(($target.$fila["Direccion_Img"]));
                }
            }
            $query = 'DELETE FROM img_producto WHERE ProductoId_Prod='.$idProducto.';';
            $conexion->query($query);
            $query = 'DELETE FROM carrito WHERE ProductoID_Prod='.$idProducto.';';
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
    function borrarProductoCategoria($idProducto) {
        global $conexion;
        try{
            $query = 'SELECT Direccion_Img FROM img_producto WHERE ProductoId_Prod='.$idProducto.';';
            $imagenes = $conexion->query($query);
            $target = "../../media/productos/";
            while($fila = $imagenes->fetch_assoc()){
                if(file_exists(($target.$fila["Direccion_Img"]))){
                    unlink(($target.$fila["Direccion_Img"]));
                }
            }
            $query = 'DELETE FROM img_producto WHERE ProductoId_Prod='.$idProducto.';';
            $conexion->query($query);
            $query = 'DELETE FROM carrito WHERE ProductoID_Prod='.$idProducto.';';
            $conexion->query($query);
            $query = 'DELETE FROM producto WHERE ID_Prod='.$idProducto.';';
            if($conexion->query($query) === TRUE){
                
            }
        }catch(Exception $e){
            
        }
    }

    function borrarProdCarrito($idUsr, $idProd){
        global $conexion;
        try{
            $query = 'DELETE FROM carrito WHERE UsuarioID_Usr='.$idUsr.' AND ProductoID_Prod='.$idProd.';';
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se elimino el producto del carrito
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al eliminar el producto del carrito
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

    function borrarCarrito($idUsr){
        global $conexion;
        try{
            $query = 'DELETE FROM carrito WHERE UsuarioID_Usr='.$idUsr.';';
            $conexion->query($query);
        }catch(Exception $e){
            
        }
    }


    function borrarCupon($idCupon){
        global $conexion;
        try{
            $query = 'UPDATE compra SET CuponId_Cupon=NULL WHERE CuponId_Cupon='.$idCupon.';';
            $conexion->query($query);
            $query = 'DELETE FROM cupon WHERE ID_Cupon='.$idCupon.';';
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se elimino el cupon
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al eliminar el cupón
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

    function borrarCategoria($idCategoria){
        global $conexion;
        try{
            $productos = getProductosCategoria($idCategoria);
            foreach($productos as $producto){
                borrarProductoCategoria($producto["ID_Prod"]);
            }
            $query = 'DELETE FROM categoria WHERE ID_Cat='.$idCategoria.';';
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se elimino la categoria y todos los productos que pertenecian a ella.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error al eliminar la categoria
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

    function borrarPais($idPais){
        global $conexion;
        try{
            $query = 'DELETE FROM usr_direccion WHERE ID_Pais='.$idPais.';';
            $conexion->query($query);
            $query = 'DELETE FROM pais WHERE ID_Pais='.$idPais.';';
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se elimino el pais junto a todas las direcciones
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error al eliminar el pais
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

    function borrarCostoEnvio($monto){
        global $conexion;
        try{
            $query = 'UPDATE compra SET Costo_EvioMonto_Compra=NULL WHERE Costo_EvioMonto_Compra='.$monto.';';
            $conexion->query($query);
            $query = 'DELETE FROM costo_envio WHERE Monto_Compra='.$monto.';';
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se elimino el costo de envio
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al eliminar el costo de envio
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

    function borrarDireccion($idUsuario, $alias_dir){
        global $conexion;
        try{
            $query = 'DELETE FROM usr_direccion WHERE UsuarioId_Usr='.$idUsuario.' AND Alias_Dir="'.$alias_dir.'";';
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se elimino la direccion
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al eliminar la direccion
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

?>