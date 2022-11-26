<?php
  date_default_timezone_set('America/Mexico_City');
  include 'PHP/altas.php';
  include 'PHP/consultas.php';
  include 'PHP/bajas.php';
  include 'PHP/actualizaciones.php';
  include 'PHP/mail/info.php';
  include("PHP/generar_captcha.php");
  session_start();
  if(!isset($_SESSION["intentos"])) $_SESSION["intentos"] = 0;
  if(isset($_POST["sesion"]) && !isset($_POST["registro"]) && $_SERVER["REQUEST_METHOD"] == "POST" && getBloquear($_POST["usuario"])==0){ 
    $username = $_POST["usuario"];
    $contrasena = $_POST["contra"];
    $usr = login($username,$contrasena);
    if(!empty($usr)){
      if(session_status()==PHP_SESSION_ACTIVE){
        session_unset();
        session_destroy();
      }
      session_start();
      $_SESSION["usuario"] = $usr;
      if(!empty($_POST["cookieUSR"])){
        setcookie ("usuario",$username,time()+3600);
        setcookie ("contra",$contrasena,time()+3600);
      }
      else{
          setcookie("usuario","");
          setcookie ("contra","");
      }
    }else{
      if($_SESSION["intentos"]<2 && getUsuarioNom($username)){
        $_SESSION["intentos"]+=1;
        echo "
            <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                Compruebe sus datos e intetelo de nuevo.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
      }
      else{
        if(getUsuarioNom($username)){
          bloquear($username);
          echo "
              <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                  Maximos intentos alcanzados, cuenta bloqueada.
                  <form action='".$_SERVER["PHP_SELF"]."' method='POST'>
                    <input class='btn btn-danger' type='submit' name='restaurar' value='Restaurar'></input>
                    <input type='hidden' value='".$_POST["usuario"]."' name='usuario'></input>
                  </form>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
          ";
        }else{
          echo "
              <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                  No se encuentra esa cuenta de usuario, revise los datos o regístrese
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
          ";
        }
        
      }
    }
  }elseif(isset($_POST["registro"]) && !isset($_POST["sesion"]) && $_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["usuario"];
    $contrasena = $_POST["contra"];
    $confirmacion = $_POST["contra2"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    if(session_status()==PHP_SESSION_ACTIVE){
      session_unset();
      session_destroy();
    }
    if(!getUsuarioNom($username)){
      crearUsuario($username,$correo,$contrasena,$confirmacion,$nombre);
      $usr = login($username,$contrasena);
      if($usr != 0){
        session_start();
        $_SESSION["usuario"] = $usr;
      }
    }else{
      echo "
          <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
              Ya existe un usuario, inicie sesión o registrese con otro.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
      ";
    }
  }elseif(isset($_POST["restaurar"]) && !isset($_POST["registro"]) && !isset($_POST["sesion"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    desbloquearCuenta($_POST["usuario"]);
  }else{
    if(isset($_POST["sesion"])){
      if(getBloquear($_POST["usuario"])==1){
        echo "
          <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
              CUENTA BLOQUEADA
              <form action='".$_SERVER["PHP_SELF"]."' method='POST'>
                <input class='btn btn-danger' type='submit' name='restaurar' value='Restaurar'></input>
                <input type='hidden' value='".$_POST["usuario"]."' name='usuario'></input>
              </form>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
        ";
      }
    } 
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/generalStyle.css">

    <!-- CSS only -->
    <link rel="shortcut icon" href="/media/TICERIco.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/headerStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous" defer></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script src="js/captcha.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" defer></script>

    <link rel="stylesheet" href= "https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body onload="generate(), generate2()">
    <nav class="navbar navbar-expand-md navbar-dark text-black">
      <div class="container-fluid">
        <a class="navbar-brand" href="/"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active text-white" aria-current="page" href="/">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Productos</a> 
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Acerca De</a>
            </li>
          </ul>
          <div class="btn-group">
            <button type="button" class="btn btn-secondary <?php if(isset($_SESSION["usuario"])){echo "disabled";}?>" 
                    data-bs-toggle="modal" data-bs-target="#modalIniciar">
              <?php 
                if(!isset($_SESSION["usuario"])){
                  echo "Inciar sesión/Registrarse";
                }else{
                  $saludo = "Bienvenido";
                  $nom = $_SESSION['usuario']['Nombre_Usr']; 
                  echo "$saludo, $nom";
                }
              ?>
            </button>
            <div class="modal fade" id="modalIniciar" tabindex="-1" aria-labelledby="modalIniciar" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 text-black" id="modalIniciar">Incia sesión</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row align-items-center mx-4 my-4">
                          <div class="col-3">
                            <label for="usuario" class="col-form-label text-black">Usuario:</label>
                          </div>
                          <div class="col-9">
                            <input type="text" id="usuario" class="form-control" name="usuario" value="<?php if(!empty($_COOKIE['usuario']))echo $_COOKIE['usuario'];?>" required>
                          </div>
                        </div>
                        <div class="row align-items-center mx-4 my-4">
                          <div class="col-3">
                            <label for="contra" class="col-form-label text-black">Contraseña:</label>
                          </div>
                          <div class="col-9">
                            <input type="password" id="contra" class="form-control" name="contra" value="<?php if(!empty($_COOKIE['contra']))echo $_COOKIE['contra'];?>" required>
                          </div>
                        </div> 
                        <div class="row algin-items-center">
                          
                          <div id="captcha_container2">

                            <div id="user-input2">
                                <input type="text" id="submit_captcha2" placeholder="Captcha code" />
                            </div>

                            <div onclick="generate2()">
                                <i class="fas fa-sync"></i>
                            </div>

                            <div id="image_captcha2" selectable="False" class="test"> </div>
                          </div>
                            <br><br>
                            <div id="btn_captcha2" onclick="printmsg2()" selectable="False" class="btn btn-light">Verificar Captcha</div>
                            <br><br>
                            <p id="mensaje_captcha2"></p>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="cookieUSR" id="cookieUSR" <?php if(!empty($_COOKIE['usuario'])){ echo 'checked';}?>>
                            </div>
                            <label for="cookie" class="form-control">¿Desea guardar sus credenciales para despues?</label>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-target="#modalRegistro" data-bs-toggle="modal">Registrarse</button>
                      <button disabled type="submit" class="btn btn-primary" name="sesion" id="button-login">Iniciar sesión</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal fade" id="modalRegistro" aria-hidden="true" aria-labelledby="modalRegistro" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 text-black" id="modalRegistro">Registro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row align-items-center mx-1 my-4">
                          <div class="col-3">
                            <label for="usuario" class="col-form-label text-black">Crea un usuario:</label>
                          </div>
                          <div class="col-9">
                            <input type="text" id="usuario" class="form-control" name="usuario" required>
                          </div>
                        </div>
                        <div class="row align-items-center mx-1 my-4">
                          <div class="col-3">
                            <label for="contra" class="col-form-label text-black">Crea una contraseña:</label>
                          </div>
                          <div class="col-9">
                            <input type="password" id="contra" class="form-control" name="contra" required>
                          </div>
                        </div>
                        <div class="row align-items-center mx-1 my-4">
                          <div class="col-3">
                            <label for="contra2" class="col-form-label text-black">Confirme la contraseña:</label>
                          </div>
                          <div class="col-9">
                            <input type="password" id="contra" class="form-control" name="contra2" required>
                          </div>
                        </div>
                        <div class="row align-items-center mx-1 my-4">
                          <div class="col-3">
                            <label for="nombre" class="col-form-label text-black">Nombre completo:</label>
                          </div>
                          <div class="col-9">
                            <input type="text" id="nombre" class="form-control" name="nombre" required>
                          </div>
                        </div>
                        <div class="row align-items-center mx-1 my-4">
                          <div class="col-3">
                            <label for="correo" class="col-form-label text-black">Correo electrónico:</label>
                          </div>
                          <div class="col-9">
                            <input type="email" id="correo" class="form-control" name="correo" required>
                          </div>




                          <div id="captcha_container">

                            <div id="user-input">
                                <input type="text" id="submit_captcha" placeholder="Captcha code" />
                            </div>

                            <div onclick="generate()">
                                <i class="fas fa-sync"></i>
                            </div>

                            <div id="image_captcha" selectable="False"> </div>
                          </div>
                          <br><br>
                          <div id="btn_captcha2" onclick="printmsg()" selectable="False" class="btn btn-light">Verificar Captcha</div>
                          <br><br>
                          <p id="mensaje_captcha"></p>
                        </div>




                      </div>
                    </div>
                    <div class="modal-footer">
                      <button disabled id="boton_registro" type="submit" class="btn btn-primary" name="registro">Registrarse</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end dropdown-menu-sm-start">
              <li><a class="dropdown-item <?php if(!isset($_SESSION["usuario"])){echo "disabled";}?>" href="/sources/PHP/usuarios/perfil.php">Perfil</a></li>
              <?php if(isset($_SESSION['usuario'])): ?>
              <?php if($_SESSION['usuario']['Admin'] == 1): ?>
              <li><a class="dropdown-item <?php if(!isset($_SESSION["usuario"])){echo "disabled";}?>" href="/sources/Administracion/pagAdministracion.php">Administracion</a></li>
              <?php endif ?>
              <?php endif ?>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item <?php if(!isset($_SESSION["usuario"])){echo "disabled";}?>" href="/sources/PHP/usuarios/cerrarSesion.php">Cerrar sesión</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <?php if(isset($_POST["restaurar"])):?>
      <script>
          swal("Contrasena restaurada", "Se ha desbloqueado su cuenta y se le ha mandado un correo con una contraseña provisional", "success", {
            button: "Aceptar",
          });
      </script>
    <?php endif;?>
</body>
</html>