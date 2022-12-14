<?php
    function modificarProducto($IdProd, $Nombre_Prod, $Descripcion_Prod, $Precio_Prod, 
                        $Existencias_Prod, $Categoria_Prod, $Descuento_Prod){
        global $conexion;
        $query = 'UPDATE producto SET Nombre_Prod="'.$Nombre_Prod.'", 
                  Descripcion_Prod="'.$Descripcion_Prod.'", Precio_Prod='.$Precio_Prod.',
                  Existencias_Prod='.$Existencias_Prod.', CategoriaId_Cat='.$Categoria_Prod.',
                  Descuento_Prod='.$Descuento_Prod.' WHERE ID_Prod='.$IdProd.';';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se modifico el producto
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar el producto
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    function modificarCantProd($idProd, $nuevaCant){
        global $conexion;
        $query = 'UPDATE producto SET Existencias_Prod='.$nuevaCant.' WHERE ID_Prod='.$idProd.';';
        try{
            $conexion->query($query);
        }catch(Exception $e){
            
        }
    }

    function modificarImagen($idProd, $direccionImagen, $nuevaDireccion){
        global $conexion;
        $query = 'UPDATE img_producto SET Direccion_Img="'.$nuevaDireccion.'" WHERE ProductoId_Prod='.$idProd.' AND Direccion_Img="'.$direccionImagen.'";';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se modifico el nombre de la imagen
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                return true;
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar el nombre de la imagen
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        return false;
    }

    function modificarCategoria($IdCat, $NomCat, $Descripcion_Cat){
        global $conexion;
        $query = 'UPDATE categoria SET Nom_Cat="'.$NomCat.'", 
                  Descripcion_Cat="'.$Descripcion_Cat.'" WHERE ID_Cat='.$IdCat.';';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se modifico la catrgoria
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar la categoria
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    function modificarCupon($IdCupon, $NomCupon, $DescuentoCupon){
        global $conexion;
        $query = 'UPDATE cupon SET Nombre_Descuento="'.$NomCupon.'", 
                  Porcentaje_Desc="'.$DescuentoCupon.'" WHERE ID_Cupon='.$IdCupon.';';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se modifico el cup??n
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar el cup??n
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    function modificarPais($IdPais, $NomPais, $Impuesto){
        global $conexion;
        $query = 'UPDATE pais SET Nombre_Pais="'.$NomPais.'", 
                  Impuesto="'.$Impuesto.'" WHERE ID_Pais='.$IdPais.';';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se modifico el pais
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar el pais
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    function modificarCostoEnvio($Monto, $MontoAct, $Costo){
        global $conexion;
        $query = 'UPDATE costo_envio SET Monto_Compra="'.$MontoAct.'", 
                  Costo_Envio="'.$Costo.'" WHERE Monto_Compra='.$Monto.';';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se modifico el costo de envio
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al modificar el costo de envio
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    function modificarUsuario($cuentaUsr, $nombreUsr,$correo, $contrasena1, $contrasena2, $administrador){
        global $conexion;
        $contraNueva = generarContrasena();
        if(empty($contrasena1)){
            if(MD5($administrador) == MD5("FullTINU247")){
                $query = 'UPDATE usuario SET Admin=1, Nombre_Usr="'.$nombreUsr.'", Correo_usr="'.$correo.'" WHERE Cuenta_usr="'.$cuentaUsr.'";';
            }else{
                $query = 'UPDATE usuario SET Nombre_Usr="'.$nombreUsr.'", Correo_usr="'.$correo.'" WHERE Cuenta_usr="'.$cuentaUsr.'";';
            }
            try{
                if($conexion->query($query) === TRUE){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se actualizo la informaci??n correctamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }catch(Exception $e){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Error al modificar el usuario
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }elseif($contrasena1 == $contrasena2){
            if(MD5($administrador) == MD5("FullTINU247")){
                $query = 'UPDATE usuario SET Admin=1, Nombre_Usr="'.$nombreUsr.'", Correo_usr="'.$correo.'", Contrasena_usr="'.MD5($contrasena1).'" WHERE Cuenta_usr="'.$cuentaUsr.'";';
            }else{
                $query = 'UPDATE usuario SET Nombre_Usr="'.$nombreUsr.'", Correo_usr="'.$correo.'", Contrasena_usr="'.MD5($contrasena1).'" WHERE Cuenta_usr="'.$cuentaUsr.'";';
            }
            try{
                if($conexion->query($query) === TRUE){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se actualizo la informaci??n correctamente
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }catch(Exception $e){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Error al modificar el usuario '.$e.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Error al modificar el usuario, compruebe los datos
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }
    function desbloquearCuenta($cuentaUsuario){
        global $conexion;
        $contraNueva = generarContrasena();
        $query = 'UPDATE usuario SET Bloqueo=0, Contrasena_usr="'.MD5($contraNueva).'" WHERE Cuenta_usr="'.$cuentaUsuario.'";';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Se desbloqueo el usuario
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al desbloquear el usuario
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        $usuario = login($cuentaUsuario,$contraNueva);
        $destinatario = $usuario["Correo_usr"];
        $asunto="Desbloquear cuenta";
        $mensaje="
            <h1>Terminar el desbloqueo de su cuenta</h1>
            <p>Hola ".$usuario["Nombre_Usr"].", para poder regresar al uso de su cuenta
                  es necesario que utilice la contrase??a que le proporcionaremos a continuaci??n
                  y es recomendable que la cambie inmediamente en su perfil, buen dia.
            </p>
            <h5>Saludos cordiales, TINUSBOOKS</h5>
            <h4>Contrase??a: <span style='color=blue;'>".$contraNueva."</span></h4>
            ";
        crearEmail($asunto, $mensaje, $destinatario);
    }

    function modificarCarrito($idUsr, $idProd, $cantidad){
        //Se espera que la cantidad recibida por la funci??n se la cantidad de productos que se quieren tener
        global $conexion;
        $producto = getProducto($idProd);
        if($producto["Existencias_Prod"] < $cantidad){ 
            $cantidad = $producto["Existencias_Prod"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Debido a disponibilidad, se limito la cantidad de "'.$producto["Nombre_Prod"].'" en su carrito
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        $query = 'UPDATE carrito SET cant_Prod='.$cantidad.' WHERE UsuarioID_Usr='.$idUsr.' AND ProductoID_Prod='.$idProd.';';
        try{
            $conexion->query($query);
        }catch(Exception $e){}
    }
    function revisarCarrito($idUsr){
        global $conexion;
        $carrito = getCarrito($idUsr);
        foreach ($carrito as $producto){
            $infoProd = getProducto($producto["ProductoID_Prod"]);
            if($producto["cant_Prod"]>$infoProd["Existencias_Prod"]){
                if($infoProd["Existencias_Prod"] == 0){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Debido a disponibilidad, se elimin?? "'.$infoProd["Nombre_Prod"].'" de su carrito
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    $query = 'DELETE FROM carrito WHERE UsuarioID_Usr='.$idUsr.' AND ProductoID_Prod='.$infoProd["ID_Prod"].';';
                }else{
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Debido a disponibilidad, se limito la cantidad de "'.$infoProd["Nombre_Prod"].'" en su carrito
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    $query = 'UPDATE carrito SET cant_Prod='.$infoProd["Existencias_Prod"].' WHERE UsuarioID_Usr='.$idUsr.' AND ProductoID_Prod='.$infoProd["ID_Prod"].';';
                }
                try{
                    $conexion->query($query);
                }catch(Exception $e){}
            }
        }
    }
    function generarContrasena() {
        $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $length = strlen($permitted_chars);
        $random_string = "";
        for($i = 0; $i < 12; $i++) {
            $random_character = $permitted_chars[random_int(0, ($length - 1))];
            $random_string .= $random_character;
        }
        return $random_string;
    }

    function modificarDireccion($idUsuario, $alias_dir, $numInterior, $numExterior, $calle, $cp, $municipio, $estado, $idPais, $numTelefono){
        global $conexion;
        if(empty($numInterior)) $numInterior = "NULL";
        $query = 'UPDATE usr_direccion SET Num_Int_Dir='.$numInterior.', Num_Ext_Dir='.$numExterior.', Calle_Dir="'.$calle.
                '", CP_Dir="'.$cp.'", Mcpio_Dir="'.$municipio.'", Edo_Dir="'.$estado.'", Num_Tel_Dir="'.$numTelefono.'", ID_Pais='.$idPais.
                ' WHERE UsuarioId_Usr='.$idUsuario.' AND Alias_Dir="'.$alias_dir.'";';
        try{
            if($conexion->query($query) === TRUE){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Se actualizo la direccion
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error al actualizar la direccion '.$e.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }        
    }
    
?>