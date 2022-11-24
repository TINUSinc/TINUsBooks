<?php 
    include("conexion.php");
    function login($cuentaUsr, $Contra_usr){
        /**
         * Si el usuario existe retorna un array asociativo de
         * toda la información de la tabla en el usuario.
         * Los nombres del array asociativo son los mismo que los
         * de la tabla, es decir 
         * array[ID_Usr], retorna el id del usuario
         * array[Correo_usr], retorna el correo del usuario
         * y de esta forma con los demás parametros.
         */
        global $conexion;
        $query = 'SELECT * FROM usuario WHERE Cuenta_usr="'.$cuentaUsr.'" AND Contrasena_usr="'.MD5($Contra_usr).'";';
        $datos = $conexion->query($query);
        if($datos->num_rows == 1){
            $datos = $datos->fetch_assoc();
            $id = $datos["ID_Usr"];
            return getUsuario($id);
        }
        return 0;
    }

    function getCategorias(){
        //Estructura que retorna:
        /**
         * Arreglo
         * Array[ID_Cat] obtiene el nombre de la categoria
         * Se recomienda recuperar los datos mediante un for each
         */
        global $conexion;
        $query = 'SELECT ID_cat, Nom_Cat FROM categoria';
        $datos = $conexion->query($query);
        $count = 0;
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $retornar[$fila["ID_cat"]] = $fila["Nom_Cat"];
            $count++;
        }
        return $retornar;
    }

    function getImagenesProd($Id_Prod){
        /**
         * Estructura:
         * Retorna de forma que queda asociado el numero de imagen con
         * la direccion de la imagen
         * array[numeroDeImagen] -> Direccion de la imagen.
         */
        global $conexion;
        $query = 'SELECT * FROM img_producto WHERE ProductoId_Prod='.$Id_Prod.';';
        $datos = $conexion->query($query);
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $retornar[$fila["Num_Img"]] = $fila["Direccion_Img"];
        }
        return $retornar;
    }

    function getProductos(){
        global $conexion;
        $query = 'SELECT * FROM producto';
        $datos = $conexion->query($query);
        $categorias = getCategorias();
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $fila["CategoriaNom_Cat"] = $categorias[$fila["CategoriaId_Cat"]];
            $fila["Imagenes"] = getImagenesProd($fila["ID_Prod"]);
            $retornar[$fila["ID_Prod"]] = $fila;
        }
        return $retornar;
    }

    function getUsuario($Id_Usr){
        global $conexion;
        $query = 'SELECT * FROM usuario WHERE ID_Usr='.$Id_Usr.';';
        $datos = $conexion->query($query);
        $datos = $datos->fetch_assoc();
        return $datos;
    }
?>