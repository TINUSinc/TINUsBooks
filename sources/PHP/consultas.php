<?php
    include_once("conexion.php");
    if(isset($_POST["idProd"])){
        $producto = getProducto($_POST["idProd"]);
        echo json_encode($producto);
    }

    if(isset($_POST["idUsrCorreo"])){
        $usr = getUsuario($_POST["idUsrCorreo"]);
        echo json_encode($usr["Correo_usr"]);
    }

    if(isset($_POST["idCat"])){
        echo json_encode(getCategoria($_POST["idCat"]));
    }

    if(isset($_POST["idProdImg"])){
        echo json_encode(getImagenesProd($_POST["idProdImg"]));
    }

    if(isset($_POST["Alias_Dir"]) && isset($_POST["idUsr"])){
        echo json_encode(getDireccion($_POST["idUsr"],$_POST["Alias_Dir"]));
    }

    if(isset($_POST["idCupon1"])){
        echo json_encode(getCuponId($_POST["idCupon1"]));
    }

    if(isset($_POST["montoCompra1"])){
        echo json_encode(getCostoEnvioId($_POST["montoCompra1"]));
    }

    if(isset($_POST["idPais1"])){
        echo json_encode(getPais($_POST["idPais1"]));
    }

    if(isset($_POST["Impuesto1"]) && isset($_POST["idUsr"]) && isset($_POST["nomCupon"])){
        echo json_encode(getCostoCarritoEnvCup($_POST["idUsr"],$_POST["Impuesto1"],$_POST["nomCupon"]));
    }

    if(isset($_POST["nombreCupon"])){
        echo json_encode(getCupon($_POST["nombreCupon"]));
    }

    if(isset($_POST["idUsrUltimaCompra"])){
        echo json_encode(getUltimaCompra($_POST["idUsrUltimaCompra"]));
    }
    //Relacion carrito
    if(isset($_POST["idUsr"]) && isset($_POST["alias"]) && isset($_POST["cupon"])){
        echo json_encode(crearCompra($_POST["idUsr"],$_POST["alias"],$_POST["cupon"]));
    }

    if(isset($_POST["mes"]) && isset($_POST["ano"]) && isset($_POST["ventas"])){
        echo json_encode(getVentasMes($_POST["mes"],$_POST["ano"]));
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
        $query = 'SELECT Bloqueo FROM usuario WHERE Cuenta_Usr="'.$usr.'";';
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
            $total += $infoProd["Precio_Prod"]*$producto["cant_Prod"];
            $totalDesc += ($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01))*$producto["cant_Prod"];
        }
        $desc = 100 - ((round($totalDesc,2)*100)/round($total,2));
        $retornar["total"] = round($total,2);
        $retornar["totalDesc"] = round($totalDesc,2);
        $costos_envio = getCostoEnvio();
        $costo_envio = array();
        foreach($costos_envio as $envio){
            if($retornar["totalDesc"]>=$envio["Monto_Compra"]){
                $costo_envio["Costo"] = $envio["Costo_Envio"];
                $costo_envio["Monto"] = $envio["Monto_Compra"];
            }else{
                break;
            }
        }
        $retornar["CostoEnv"] = $costo_envio["Costo"];
        $retornar["totalEnvio"] = $retornar["totalDesc"]+$costo_envio["Costo"];
        $retornar["desc"] = round($desc,3);
        return $retornar;
    }

    function getCostoCarritoEnvCup($idUsr, $impuesto, $nomCupon=""){
        global $conexion;
        $carrito = getCarrito($idUsr);
        $retornar = array();
        $cupon = getCupon($nomCupon);
        if($cupon != 0){
            $cupon = $cupon["Porcentaje_Desc"];
        } 
        $total = 0;
        $totalDesc = 0;
        foreach ($carrito as $producto){
            $infoProd = getProducto($producto["ProductoID_Prod"]);
            $total += $infoProd["Precio_Prod"]*$producto["cant_Prod"];
            $totalDesc += ($infoProd["Precio_Prod"]-($infoProd["Precio_Prod"]*$infoProd["Descuento_Prod"]*0.01))*$producto["cant_Prod"];
        }
        $desc = 100 - ((round($totalDesc,2)*100)/round($total,2));
        $retornar["desc"] = round($desc,3);
        $retornar["total"] = round($total,2);
        $retornar["totalDesc"] = round($totalDesc,2);
        $costos_envio = getCostoEnvio();
        $costo_envio = array();
        foreach($costos_envio as $envio){
            if($retornar["totalDesc"]>=$envio["Monto_Compra"]){
                $costo_envio["Costo"] = $envio["Costo_Envio"];
                $costo_envio["Monto"] = $envio["Monto_Compra"];
            }else{
                break;
            }
        }
        $retornar["totalEnvio"] = round($retornar["totalDesc"]+$costo_envio["Costo"],2);
        $retornar["totalImpuesto"] = round($retornar["totalEnvio"] + ($retornar["totalEnvio"]*$impuesto*0.01),2);
        $retornar["totalCupon"] = round($retornar["totalImpuesto"]-($retornar["totalImpuesto"]*$cupon*0.01),2);
        $retornar["porcentajeCupon"] = $cupon;
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
                if(isset($calculo[$fila["Nom_Cat_Prod"]])){
                    $fila["venta"] = $calculo[$fila["Nom_Cat_Prod"]];
                }else{
                    $fila["venta"] = 0;
                }
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

    function getCostoEnvioId($MontoCompra){
        global $conexion;
        $query = 'SELECT * FROM costo_envio WHERE Monto_Compra='.$MontoCompra.';';
        $datos = $conexion->query($query);
        if($datos->num_rows == 1){
            $fila = $datos->fetch_assoc();
            return $fila;
        }
        return 0;
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

    function getCuponId($idCupon){
        global $conexion;
        $query = 'SELECT * FROM cupon WHERE ID_Cupon='.$idCupon.';';
        $datos = $conexion->query($query);
        if($datos->num_rows == 1){
            $fila = $datos->fetch_assoc();
            return $fila;
        }
        return 0;
    }

    function getPais($idPais){
        global $conexion;
        $query = 'SELECT * FROM pais WHERE ID_Pais='.$idPais.';';
        $datos = $conexion->query($query);
        if($datos->num_rows == 1){
            $fila = $datos->fetch_assoc();
            return $fila;
        }
        return 0;
    }

    function getCupones(){
        global $conexion;
        $query = 'SELECT * FROM cupon;';
        $datos = $conexion->query($query);
        $cont = 0;
        while($fila = $datos->fetch_assoc()){
            $retornar[$cont] = $fila;
            $cont++;
        }
        return $retornar;
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
        $retornar = array();
        while($fila = $datos->fetch_assoc()){
            $retornar[$cont] = $fila;
            $cont++;
        }
        return $retornar;
    }

    function getUltimaCompra($idUsr){
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

    function getProductosMasVendidos($mes, $año){
        /**
         * Retorna la cantidad de producto vendido en el mes y año seleccionado.
         * -Si en el mes no hay ventas, retorna 0
         * -Si en el mes hay ventas retorna un array con array de la siguiente forma:
         * $array[numeroDeConsulta]["Nombre_Prod"] indica el nombre del producto
         * $array[numeroDeConsulta]["SUM(Cant_Prod)"] indica la cantidad vendida del producto
         * Nota: Estan ordenados del más vendido al menos vendido
         * se recomienda usar un foreach y limitarlo a la cantidad de productos que se desean mostrar
         * $cont=0;
         * foreach($array as $numConsulta){
         *  $cont++;
         *  if(cont==10) break; //si se vendieron más de 10 productos solo muestra los primeros 10 con más ventas
         *  $numConsulta["Nombre_Prod"]; //Indica el nombre del producto
         *  $numConsulta["SUM(Cant_Prod)"]; //Indica la cantidad vendida en el mes
         * }
         * 
         */
        global $conexion;
        $fechaInicio = date("Y-m-d", mktime(0,0,0,$mes,1,$año));
        $fechaFinal = date("Y-m-d", mktime(0,0,0,($mes+1),0,$año));
        $query = 'SELECT Nombre_Prod, SUM(Cant_Prod) FROM detalle_compra D, compra C WHERE C.Fecha_Compra>="'.$fechaInicio.'" AND C.Fecha_Compra<="'.$fechaFinal.'" AND C.Id_Compra=D.idCompra_Compra GROUP BY Nombre_Prod ORDER BY SUM(Cant_Prod) DESC;';
        $datos = $conexion->query($query);
        $retornar = array();
        $calculo = array();
        $cont = 0;
        if($datos->num_rows){
            while($fila = $datos->fetch_assoc()){
                $retornar[$cont] = $fila;
                $cont++;
            }
            return $retornar;
        } else{
            return 0;
        }
    }

    function crearCompra($idUsr, $alias, $cupon){
        /**
         * cupon, unicamente se espera el id
         */
        global $conexion;
        $fecha = date("Y-m-d", time());
        $carrito = getCarrito($idUsr);
        $direccion = getDireccion($idUsr, $alias);
        if(!empty($carrito)){
            $costos_envio = getCostoEnvio();
            $totalDesc = getCostoCarrito($idUsr);
            $totalDesc = $totalDesc["totalDesc"];
            $cupones = getCupon($cupon);
            $costo_envio= array();
            $cuponAplicado = array();
            if(!empty($cupones)){
                $cuponAplicado = $cupones;
            }else{
                $cuponAplicado["ID_Cupon"]="NULL";
                $cuponAplicado["Porcentaje_Desc"] = 0;
            }
            foreach($costos_envio as $envio){
                if($totalDesc>=$envio["Monto_Compra"]){
                    $costo_envio["Costo"] = $envio["Costo_Envio"];
                    $costo_envio["Monto"] = $envio["Monto_Compra"];
                }
            }
            if(empty($direccion["Num_Int_Dir"])) $direccion["Num_Int_Dir"]="NULL";
            $query = 'INSERT INTO compra (Fecha_Compra, Costo_Envio, 
                    Impuesto_Pais, Desc_Cup, Estado_Compra, Num_Int_Dir, 
                    Num_Ext_Dir, Calle_Dir, Mcpio_Dir, Edo_Dir, Num_Tel_Dir, 
                    UsuarioId_Usr, CuponId_Cupon, Costo_EvioMonto_Compra) 
                    VALUES ("'.$fecha.'",'.$costo_envio["Costo"].','.$direccion["Impuesto"].','.
                    $cuponAplicado["Porcentaje_Desc"].',"Pedido",'.
                    $direccion["Num_Int_Dir"].','.$direccion["Num_Ext_Dir"].',"'.
                    $direccion["Calle_Dir"].'","'.$direccion["Mcpio_Dir"].'","'.
                    $direccion["Edo_Dir"].'","'.$direccion["Num_Tel_Dir"].'",'.
                    $idUsr.','.$cuponAplicado["ID_Cupon"].','.$costo_envio["Monto"].');';
            try{
                $conexion->query($query);
            }catch(Exception $e){
                return 1;
            }     
            $compras = getCompras($idUsr);
            foreach($compras as $infoCompra){
                $compra = $infoCompra;
            }
            foreach ($carrito as $producto){
                $infoProd = getProducto($producto["ProductoID_Prod"]);
                $query = 'INSERT INTO detalle_compra (idCompra_Compra, Nombre_Prod,
                        Nom_Cat_Prod, Precio_Prod, Cant_Prod, Descuento_Prod) VALUES ('.
                        $compra["Id_Compra"].',"'.$infoProd["Nombre_Prod"].'","'.
                        $infoProd["Nom_Cat"].'",'.$infoProd["Precio_Prod"].','.
                        $producto["cant_Prod"].','.$infoProd["Descuento_Prod"].');';
                try{
                    if($conexion->query($query) === TRUE){
                        modificarCantProdConsultas($infoProd["ID_Prod"],($infoProd["Existencias_Prod"]-$producto["cant_Prod"]));
                    }
                }catch(Exception $e){
                }
            }
            borrarCarritoConsultas($idUsr);
            return 0;
        }else{
            return 1;
        }
    }

    function borrarCarritoConsultas($idUsr){
        global $conexion;
        try{
            $query = 'DELETE FROM carrito WHERE UsuarioID_Usr='.$idUsr.';';
            $conexion->query($query);
        }catch(Exception $e){
            
        }
    }

    function modificarCantProdConsultas($idProd, $nuevaCant){
        global $conexion;
        $query = 'UPDATE producto SET Existencias_Prod='.$nuevaCant.' WHERE ID_Prod='.$idProd.';';
        try{
            $conexion->query($query);
        }catch(Exception $e){
            
        }
    }
?>