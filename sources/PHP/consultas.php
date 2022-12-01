<?php 
    include_once("conexion.php");
    if(isset($_POST["idProd"])){
        $producto = getProducto($_POST["idProd"]);
        echo json_encode($producto);
    }

    if(isset($_POST["idCat"])){
        echo json_encode(getCategoria($_POST["idCat"]));
    }

    if(isset($_POST["idProdImg"])){
        echo json_encode(getImagenesProd($_POST["idProdImg"]));
    }

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
    
    function bloquear($usr){
        global $conexion;
        $query = 'UPDATE usuario SET Bloqueo=1 WHERE Cuenta_Usr="'.$usr.'";';
        $conexion->query($query);
    }
    function getBloquear($usr){
        global $conexion;
        $query = 'SELECT Bloqueo FROM Usuario WHERE Cuenta_Usr="'.$usr.'";';
        $res = $conexion->query($query);
        /**Deshabilitar la linea de abajo en el webhost */
        $res = $res->fetch_column(0);
        /**La linea de arriba es la que se debe de deshabilitar */
        return $res;
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
            $retornar[$count] = $fila;
            $count++;
        }
        return $retornar;
    }

    function getCarrito($idUsr){
        //Estructura que retorna:
        /**
         * Arreglo
         * Array[ID_Cat] obtiene el nombre de la categoria
         * Se recomienda recuperar los datos mediante un for each
         */
        global $conexion;
        $query = 'SELECT ProductoID_Prod, cant_Prod FROM carrito WHERE UsuarioID_Usr='.$idUsr.';';
        $datos = $conexion->query($query);
        $count = 0;
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $retornar[$count] = $fila;
            $count++;
        }
        return $retornar;
    }

    function getCostoCarrito($idUsr){
        global $conexion;
        $carrito = getCarrito($idUsr);
        $retornar = array();
        $total = 0;
        $totalDesc = 0;
        foreach ($carrito as $producto){
            $infoProd = getProducto($producto["ProductoID_Prod"]);
            $total += $infoProd["Precio_Prod"];
            $totalDesc += ($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01));
        }
        $desc = ($totalDesc*100)/$total;
        $retornar["total"] = $total;
        $retornar["totalDesc"] = round($totalDesc,2);
        $retornar["desc"] = $desc;
        return $retornar;
    }

    function getTotalProdCarrito($idUsr){
        //Retorna el total de productos que tiene un usuario en el carrito
        global $conexion;
        $query = 'SELECT * FROM carrito WHERE UsuarioID_Usr='.$idUsr.';';
        $datos = $conexion->query($query);
        $retornar = 0;
        while($fila = $datos->fetch_assoc()){
            $retornar += $fila["cant_Prod"];
        }
        return $retornar;
    }

    function getCategoria($idCategoria){
        global $conexion;
        $query = 'SELECT * FROM categoria WHERE ID_Cat='.$idCategoria.';';
        $datos = $conexion->query($query);
        $count = 0;
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $retornar = $fila;
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
        $query = 'SELECT * FROM producto, categoria WHERE producto.CategoriaId_Cat=categoria.ID_Cat;';
        $datos = $conexion->query($query);
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $fila["Imagenes"] = getImagenesProd($fila["ID_Prod"]);
            $retornar[$fila["ID_Prod"]] = $fila;
        }
        return $retornar;
    }

    function getProducto($idProducto){
        global $conexion;
        $query = 'SELECT * FROM producto, categoria WHERE producto.CategoriaId_Cat=categoria.ID_Cat AND producto.ID_Prod='.$idProducto.';';
        $datos = $conexion->query($query);
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $fila["Imagenes"] = getImagenesProd($fila["ID_Prod"]);
            $retornar = $fila;
        }
        return $retornar;
    }

    function getProductosCategoria($idCategoria){
        global $conexion;
        $query = 'SELECT * FROM producto, categoria WHERE CategoriaId_Cat='.$idCategoria.' AND producto.CategoriaId_Cat=categoria.ID_Cat;';
        $datos = $conexion->query($query);
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $fila["Imagenes"] = getImagenesProd($fila["ID_Prod"]);
            $retornar[$fila["ID_Prod"]] = $fila;
        }
        return $retornar;
    }

    function encontrarProducto($Nombre_Prod){
        global $conexion;
        $query = 'SELECT * FROM producto, categoria WHERE Nombre_Prod LIKE "%'.$Nombre_Prod.'%" AND producto.CategoriaId_Cat=categoria.ID_Cat;';
        $datos = $conexion->query($query);
        $retornar = array();
        $cont = 0;
        while($fila = $datos->fetch_assoc()){
            $fila["Imagenes"] = getImagenesProd($fila["ID_Prod"]);
            $retornar[$cont] = $fila;
            $cont++;
        }
        return $retornar;
    }

    function getUsuario($idUsuario){
        global $conexion;
        $query = 'SELECT * FROM usuario WHERE ID_Usr='.$idUsuario.';';
        $datos = $conexion->query($query);
        $datos = $datos->fetch_assoc();
        return $datos;
    }

    function getUsuarioNom($cuentaUsr){
        global $conexion;
        $query = 'SELECT COUNT(*) FROM usuario WHERE Cuenta_usr="'.$cuentaUsr.'";';
        $datos = $conexion->query($query);
        $datos = $datos->fetch_assoc();
        return $datos["COUNT(*)"];
    }

    function getPaises(){
        global $conexion;
        $query = 'SELECT * FROM pais;';
        $datos = $conexion->query($query);
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $retornar[$fila["ID_Pais"]] = $fila;
        }
        return $retornar;
    }

    function getDirecciones($idUsuario){
        global $conexion;
        $query = 'SELECT * FROM usr_direccion, pais WHERE UsuarioId_Usr='.$idUsuario.' AND usr_direccion.ID_Pais=pais.ID_Pais;';
        $datos = $conexion->query($query);
        $retornar = array();
        $cont = 0;
        while($fila = $datos->fetch_assoc()){
            $retornar[$cont] = $fila;
            $cont++;
        }
        return $retornar;
    }

    function getDireccion($idUsuario, $alias){
        global $conexion;
        $query = 'SELECT * FROM usr_direccion, pais WHERE UsuarioId_Usr='.$idUsuario.' AND Alias_Dir="'.$alias.'" AND usr_direccion.ID_Pais=pais.ID_Pais;';
        $datos = $conexion->query($query);
        $retornar = $datos->fetch_assoc();
        return $retornar;
    }

    function getVentasMes($mes, $año){
        /**
         * Retorna las ventas en el mes y año seleccionado.
         * -Si en el mes no hay ventas, retorna 0
         * -Si en el mes hay ventas retorna un array con array de la siguiente forma:
         * $array[numeroDeConsulta]["Nom_Cat_Prod"] indica el nombre de la categoria
         * $array[numeroDeConsulta]["venta"] indica la cnatidad vendida de la categoria
         * se recomienda usar un foreach para recorrerlo, de forma que quede:
         * foreach($array as $numConsulta){
         *  $numConsulta["Nom_Cat_Prod"]; //Indica la categoria
         *  $numConsulta["venta"]; //Indica la cantidad vendida
         * }
         * 
         */
        global $conexion;
        $fechaInicio = date("Y-m-d", mktime(0,0,0,$mes,1,$año));
        $fechaFinal = date("Y-m-d", mktime(0,0,0,($mes+1),0,$año));
        $query = 'SELECT Precio_Prod, Cant_Prod, Descuento_Prod, Nom_Cat_Prod, Desc_Cup FROM detalle_compra D, compra C WHERE C.Fecha_Compra>="'.$fechaInicio.'" AND C.Fecha_Compra<="'.$fechaFinal.'" AND C.Id_Compra=D.idCompra_Compra;';
        $datos = $conexion->query($query);
        $retornar = array();
        $calculo = array();
        $cont = 0;
        if($datos->num_rows){
            while($fila = $datos->fetch_assoc()){
                if(!isset($calculo[$fila["Nom_Cat_Prod"]])) $calculo[$fila["Nom_Cat_Prod"]] = 0;
                $total = $fila["Precio_Prod"] * $fila["Cant_Prod"];
                $desc1 = $total * $fila["Descuento_Prod"] * 0.01;
                $total = $total-$desc1;
                $desc2 = $total * $fila["Desc_Cup"] * 0.01;
                $total = $total - $desc2;
                $calculo[$fila["Nom_Cat_Prod"]] += $total;
            }
            $query = 'SELECT DISTINCT Nom_Cat_Prod FROM detalle_compra';
            $datos = $conexion->query($query);
            while($fila = $datos->fetch_assoc()){
                $fila["venta"] = $calculo[$fila["Nom_Cat_Prod"]];
                $retornar[$cont] = $fila;
                $cont++;
            }
            return $retornar;
        }
        return 0;
    }  

    function getCostoEnvio(){
        global $conexion;
        $query = 'SELECT * FROM costo_envio;';
        $datos = $conexion->query($query);
        $retornar = array();
        $cont = 0;
        while($fila = $datos->fetch_assoc()){
            $retornar[$cont] = $fila;
            $cont++;
        }
        return $retornar;
    }

    function getCupon($nomCupon){
        global $conexion;
        $query = 'SELECT * FROM cupon WHERE Nombre_Descuento="'.$nomCupon.'";';
        $datos = $conexion->query($query);
        if($datos->num_rows == 1){
            $fila = $datos->fetch_assoc();
            return $fila;
        }
        return 0;
    }

    function getCompras($idUsr){
        global $conexion;
        $query = 'SELECT * FROM compra WHERE UsuarioId_Usr="'.$idUsr.'";';
        $datos = $conexion->query($query);
        $cont = 0;
        while($fila = $datos->fetch_assoc()){
            $retornar[$cont] = $fila;
            $cont++;
        }
        return $retornar;
    }

    function getCompra($idCompra){
        global $conexion;
        $idUltimaCompra = 0;
        $query = 'SELECT * FROM compra WHERE Id_Compra='.$idCompra.';';
        $datos = $conexion->query($query);
        $fila = $datos->fetch_assoc();
        return $fila;
    }

    function getDetallesCompra($idCompra){
        global $conexion;
        $query = 'SELECT * FROM detalle_compra WHERE idCompra_Compra='.$idCompra.';';
        $datos = $conexion->query($query);
        $cont = 0;
        while($fila = $datos->fetch_assoc()){
            $retornar[$cont] = $fila;
            $cont++;
        }
        return $retornar;
    }

    function getUltimoDetalleCompra($idUsr){
        global $conexion;
        $query = 'SELECT MAX(Id_Compra) FROM compra WHERE UsuarioId_Usr='.$idUsr.';';
        $datos = $conexion->query($query);
        $idUltimaCompra = $datos->fetch_assoc();
        $idUltimaCompra = $idUltimaCompra["MAX(Id_Compra)"];
        $infoUltimaCompra = getCompra($idUltimaCompra);
        $detallesCompra = getDetallesCompra($idUltimaCompra);
        $retornar = array();
        $retornar["infoCompra"] = $infoUltimaCompra;
        $retornar["detalles"] = $detallesCompra;
        /*
        Para la compra obtener su información
        $retornar["infoCompra"]["Fecha_Compra"]
        $retornar["infoCompra"]["Costo_Envio"]
        $retornar["infoCompra"]["Impuesto_Pais"]
            se pueden obtener toda la informacion de la compra
        Para cada detalle de compra obtener su informacion
        foreach($retornar["detalles"] as $detalle){
            $detalle["Nombre_Prod"]
            $detalle["Nom_Cat_Prod"]
            $detalle["Precio_Prod"]
            $detalle["Cant_Prod"]
            $detalle["Descuento_Prod"]
        }
        */
        return $retornar;
    }
?>