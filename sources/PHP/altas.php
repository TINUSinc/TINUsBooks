<?php
    include_once("conexion.php");
    //Funciones a las que se manden los parametros de las altas
    function crearUsuario($cuentaUsr, $correoUsr, $Contra_usr, $Nombre_usr){
        global $conexion;
        $query = 'INSERT INTO usuario (Cuenta_usr, Correo_usr, 
                  Contrasena_usr, Nombre_Usr) VALUES ("'.$cuentaUsr.'","'
                  .$correoUsr.'","'.MD5($Contra_usr).'","'.$Nombre_usr.'");';
        if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se creo correctamente el usuario
                  </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al crear el usuario
                  </div>';
        }
    }

    function crearPais($Nombre_pais, $Impuesto_pais){
        global $conexion;
        $query = 'INSERT INTO pais (Nombre_Pais, Impuesto) VALUES
                  ("'.$Nombre_pais.'",'.$Impuesto_pais.');';
        if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se añadio el país
                  </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir el país
                  </div>';
        }
    }

    function crearCupon($Nombre_des, $Porcentaje_des){
        global $conexion;
        $query = 'INSERT INTO cupon (Nombre_Descuento, Porcentaje_Desc) VALUES ("'.$Nombre_des.'",'.$Porcentaje_des.');';
        echo $query;
        if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se creo el cupón
                  </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir el cupón
                  </div>';
        }
    }

    function crearCosto_Envio($Monto_compra, $Costo_Envio){
        global $conexion;
        $query = 'INSERT INTO costo_envio (Monto_Compra, Costo_Envio) VALUES
                  ('.$Monto_compra.','.$Costo_Envio.');';
        if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se creo el costo de envio
                  </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al crear el costo de envio
                  </div>';
        }
    }

    function crearCategoria($Nomrbre_cat, $Descripcion_Cat){
        global $conexion;
        $query = 'INSERT INTO categoria (Nom_Cat, Descripcion_Cat) VALUES
                  ("'.$Nomrbre_cat.'","'.$Descripcion_Cat.'");';
        if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se añadio la categoria
                  </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir la categoria
                  </div>';
        }
    }

    function crearProucto($Nombre_Prod, $Descripcion_Prod, $Precio_Prod, $Existencias_Prod, $Categoria_Prod, $Descuento_Prod){
        global $conexion;
        $query = 'INSERT INTO producto (Nombre_Prod, Descripcion_Prod, Precio_Prod,
                  Existencias_Prod, CategoriaId_Cat, Descuento_Prod) VALUES
                  ("'.$Nombre_Prod.'","'.$Descripcion_Prod.'",'.$Precio_Prod.','
                  .$Existencias_Prod.','.$Categoria_Prod.','.$Descuento_Prod.');';
        if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se añadio el producto
                  </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir el producto
                  </div>';
        }
    }

    function agregarCarrito($Id_Usr, $Id_Prod, $Cantidad_Prod){
        global $conexion;
        $query = 'SELECT cant_Prod FROM carrito WHERE UsuarioID_Usr='.$Id_Usr.' AND ProductoID_Prod='.$Id_Prod.';';
        $datos = $conexion->query($query);
        if($datos->num_rows){
            $fila = $datos->fetch_assoc();
            $cantidad = $fila["cant_Prod"];
            $cantidad += $Cantidad_Prod;
            $query = 'UPDATE carrito SET cant_Prod='.$cantidad.' WHERE UsuarioID_Usr='.$Id_Usr.' AND ProductoID_Prod='.$Id_Prod.';';
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se añadio el producto al carrito
                    </div>';
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al añadir el producto al carrito
                    </div>';
            }
        }else{
            $query = 'INSERT INTO carrito (UsuarioID_Usr, ProductoID_Prod, cant_Prod) 
                  VALUES ('.$Id_Usr.','.$Id_Prod.','.$Cantidad_Prod.');';
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se añadio el producto al carrito
                    </div>';
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al añadir el producto al carrito
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
        if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se añadio la imagen
                  </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir la imagen
                  </div>';
        }
    }

    function crearDireccion($idUsuario, $alias_dir, $numInterior, $numExterior, $calle, $cp, $municipio, $estado, $idPais, $numTelefono ){
        global $conexion;
        if(empty($numInterior)) $numInterior = "NULL";
        $query = 'INSERT INTO usr_direccion (UsuarioId_Usr, Alias_Dir, Num_Int_Dir, Num_Ext_Dir, Calle_Dir, CP_Dir, Mcpio_Dir, Edo_Dir, Num_Tel_Dir, ID_Pais) 
                  VALUES ('.$idUsuario.',"'.$alias_dir.'",'.$numInterior.','.$numExterior.',"'.$calle.'","'.$cp.'","'.$municipio.'","'.$estado.'","'.$numTelefono.'",'.$idPais.');';
        if($conexion->query($query) === TRUE){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Se añadio la dirección
                  </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al añadir la direccion
                  </div>';
        }
    }

    function crearCompra($idUsuario, $alias_dir, $cupon){
        global $conexion;
        $query = '';
    }


?>