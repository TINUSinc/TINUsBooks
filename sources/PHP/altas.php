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

    
?>