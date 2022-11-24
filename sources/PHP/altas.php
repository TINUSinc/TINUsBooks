<?php 
    include_once("conexion.php");
    
    //Funciones a las que se manden los parametros de las altas
    function crearUsuario($cuentaUsr, $correoUsr, $Contra_usr, $Nombre_usr){
        $query = 'INSERT INTO usuario (Cuenta_usr, Correo_usr, 
                  Contrasena_usr, Nombre_Usr) VALUES ('.$cuentaUsr.','
                  .$correoUsr.','.$Contra_usr.','.$Nombre_usr.');';
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
        $query = 'INSERT INTO pais (Nombre_Pais, Impuesto) VALUES
                  ('.$Nombre_pais.','.$Impuesto_pais.');';
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
        $query = 'INSERT INTO cupon (Nombre_Descuento, Porcentaje_Desc) VALUES
                  ('.$Nombre_des.','.$Porcentaje_des.');';
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
        $query = 'INSERT INTO categoria (Monto_Compra, Costo_Envio) VALUES
                  ('.$Nomrbre_cat.','.$Descripcion_Cat.');';
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
        $query = 'INSERT INTO producto (Nombre_Pord, Descripcion_Prod, Precio_Prod,
                  Existencias_Prod, CategoriaId_Cat, Descuento_Prod) VALUES
                  ('.$Nomrbre_Prod.','.$Descripcion_Prod.','.$Precio_Prod.','
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

    function crearCarrito($Id_Usr, $Id_Prod, $Cantidad_Prod){
        $query = 'INSERT INTO carrito (UsuarioID_Usr, ProductoID_Prod, Descuento_Prod) 
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

?>