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
                        Se actualizo la información correctamente
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
                        Se actualizo la información correctamente
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
                  es necesario que utilice la contraseña que le proporcionaremos a continuación
                  y es recomendable que la cambie inmediamente, gracias, buen dia y perdón por las molestias
            </p>
            <h5>Saludos cordiales, TINUSBOOKS</h5>
            <h4>Contraseña: <span style='color=blue;'>".$contraNueva."</span></h4>
            ";
        crearEmail($asunto, $mensaje, $destinatario);
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
?>