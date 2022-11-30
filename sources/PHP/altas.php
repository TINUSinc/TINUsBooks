<?php
    include_once("conexion.php");
    //Funciones a las que se manden los parametros de las altas

    function crearUsuario($cuentaUsr, $correoUsr, $Contra_usr1, $Contra_usr2, $Nombre_usr){
        global $conexion;
        $query = 'INSERT INTO usuario (Cuenta_usr, Correo_usr, 
                  Contrasena_usr, Nombre_Usr) VALUES ("'.$cuentaUsr.'","'
                  .$correoUsr.'","'.MD5($Contra_usr1).'","'.$Nombre_usr.'");';
        if($Contra_usr1 == $Contra_usr2){
            try{
                if($conexion->query($query) === TRUE){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se creo correctamente el usuario
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }catch(Exception $e){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al crear el usuario
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Las contraseñas no coinciden, intente registrarse de nuevo.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

    function crearPais($Nombre_pais, $Impuesto_pais){
        global $conexion;
        $query = 'INSERT INTO pais (Nombre_Pais, Impuesto) VALUES
                  ("'.$Nombre_pais.'",'.$Impuesto_pais.');';
        try{
            if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se añadio el país
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Error, no se añadio el país
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        
    }

    function crearCupon($Nombre_des, $Porcentaje_des){
        global $conexion;
        $query = 'INSERT INTO cupon (Nombre_Descuento, Porcentaje_Desc) VALUES ("'.$Nombre_des.'",'.$Porcentaje_des.');';
        echo $query;
        try{
            if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se creo el cupón
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir el cupón
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    function crearCosto_Envio($Monto_compra, $Costo_Envio){
        global $conexion;
        $query = 'INSERT INTO costo_envio (Monto_Compra, Costo_Envio) VALUES
                  ('.$Monto_compra.','.$Costo_Envio.');';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se creo el costo de envio
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al crear el costo de envio
                  </div>';
        }
    }

    function crearCategoria($Nomrbre_cat, $Descripcion_Cat){
        global $conexion;
        $query = 'INSERT INTO categoria (Nom_Cat, Descripcion_Cat) VALUES
                  ("'.$Nomrbre_cat.'","'.$Descripcion_Cat.'");';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se añadio la categoria
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir la categoria
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    function crearProucto($Nombre_Prod, $Descripcion_Prod, $Precio_Prod, $Existencias_Prod, $Categoria_Prod, $Descuento_Prod){
        global $conexion;
        $query = 'INSERT INTO producto (Nombre_Prod, Descripcion_Prod, Precio_Prod,
                  Existencias_Prod, CategoriaId_Cat, Descuento_Prod) VALUES
                  ("'.$Nombre_Prod.'","'.$Descripcion_Prod.'",'.$Precio_Prod.','
                  .$Existencias_Prod.','.$Categoria_Prod.','.$Descuento_Prod.');';        
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se añadio el producto
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir el producto
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    function agregarCarrito($Id_Usr, $Id_Prod, $Cantidad_Prod){
        global $conexion;
        $producto = getProducto($Id_Prod);
        $query = 'SELECT cant_Prod FROM carrito WHERE UsuarioID_Usr='.$Id_Usr.' AND ProductoID_Prod='.$Id_Prod.';';
        $datos = $conexion->query($query);
        if($datos->num_rows){
            $fila = $datos->fetch_assoc();
            $cantidad = $fila["cant_Prod"];
            $cantidad += $Cantidad_Prod;
            if($producto["Existencias_Prod"]>=$cantidad){
                $query = 'UPDATE carrito SET cant_Prod='.$cantidad.' WHERE UsuarioID_Usr='.$Id_Usr.' AND ProductoID_Prod='.$Id_Prod.';';
                try{
                    if($conexion->query($query) === TRUE){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Se añadio el producto al carrito
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                }catch(Exception $e){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error al añadir el producto al carrito
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al añadir el producto al carrito, no hay suficiente inventario
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }else{
            $query = 'INSERT INTO carrito (UsuarioID_Usr, ProductoID_Prod, cant_Prod) 
                VALUES ('.$Id_Usr.','.$Id_Prod.','.$Cantidad_Prod.');';
            if($producto["Existencias_Prod"]>=$Cantidad_Prod){
                try{
                    if($conexion->query($query) === TRUE){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Se añadio el producto al carrito
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                }catch(Exception $e){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error al añadir el producto al carrito
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al añadir el producto al carrito, no hay suficiente inventario
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
    }

    function crearImagenProducto($Id_Prod, $direccion_Img){
        global $conexion;
        $query = 'SELECT COUNT(*) FROM img_producto WHERE ProductoId_Prod ='.$Id_Prod.';';
        $datos = $conexion->query($query);
        $fila = $datos->fetch_assoc();
        $numImg = $fila["COUNT(*)"] + 1;
        $query = 'INSERT INTO img_producto (Direccion_Img, ProductoId_Prod, Num_Img) 
                  VALUES ("'.$direccion_Img.'",'.$Id_Prod.','.$numImg.');';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se añadio la imagen
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir la imagen '.$e.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    function crearDireccion($idUsuario, $alias_dir, $numInterior, $numExterior, $calle, $cp, $municipio, $estado, $idPais, $numTelefono ){
        global $conexion;
        if(empty($numInterior)) $numInterior = "NULL";
        $query = 'INSERT INTO usr_direccion (UsuarioId_Usr, Alias_Dir, Num_Int_Dir, Num_Ext_Dir, Calle_Dir, CP_Dir, Mcpio_Dir, Edo_Dir, Num_Tel_Dir, ID_Pais) 
                  VALUES ('.$idUsuario.',"'.$alias_dir.'",'.$numInterior.','.$numExterior.',"'.$calle.'","'.$cp.'","'.$municipio.'","'.$estado.'","'.$numTelefono.'",'.$idPais.');';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se añadio la dirección
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error al añadir la direccion
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }        
    }

    function crearCompra($idUsr, $direccion, $cupon){
        /**
         * Se espera recibir los datos de la siguiente forma:
         * idUsr como el id del usuario
         * productos como un array asociativo que tenga la sig estructura:
         * direccion como un array asociativo con los campos de la direccion
         *      direccion[Num_Int_Dir]
         *      direccion[Num_Ext_Dir]
         *      direccion[Calle_Dir]
         *      direccion[CP_dir]
         *      direccion[Mcpio_Dir]
         *      direccon[Edo_Dir]
         *      direccion[Num_Tel_Dir]
         *      direccon[Nombre_Pais]
         *      direccon[Impuesto]
         * cupon, unicamente se espera el id
         */
        global $conexion;
        $fecha = date("Y-m-d", time());
        $carrito = getCarrito($idUsr);
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
                if($conexion->query($query) === TRUE){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se realizo la compra
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }catch(Exception $e){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al realizar la compra
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
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
                        modificarCantProd($infoProd["ID_Prod"],($infoProd["Existencias_Prod"]-$producto["cant_Prod"]));
                    }
                }catch(Exception $e){
                    echo $e;
                }
            }
            borrarCarrito($idUsr);
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Se deben agregar productos al carrito.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
?>