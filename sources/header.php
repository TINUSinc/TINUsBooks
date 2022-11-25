<?php
  date_default_timezone_set('America/Mexico_City');
  include_once("sources/PHP/altas.php");
  include_once("sources/PHP/consultas.php");
  include_once("sources/PHP/usuarios/usuario.php");
  if(isset($_POST["sesion"]) && !isset($_POST["registro"]) && $_SERVER["REQUEST_METHOD"] == "POST"){ 
    $username = $_POST["usuario"];
    $contrasena = $_POST["contra"];
    $usr = crearUsuario($username,$contrasena);
    if(!empty($usr)){
      if(session_status()==PHP_SESSION_ACTIVE){
        session_unset();
        session_destroy();
      }
      session_start();
      $_SESSION["usuario"] = $usr;
      if(isset($_POST["cookieUSR"])){
        $_COOKIE["usuario"] = $usr;
      }
    }else{
      echo "
        <div class='container-fluid'>
            <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                Compruebe sus datos e intetelo de nuevo.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        </div>
      ";
    }
  }elseif(isset($_POST["registro"]) && !isset($_POST["sesion"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["usuario"];
    $contrasena = $_POST["contra"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $usr = new Usuario($username,$correo,$contrasena,$nombre);

    if(session_status()==PHP_SESSION_ACTIVE){
      session_unset();
      session_destroy();
    }
    if(crearUsuario($username,$correo,$contrasena,$nombre)){
      session_start();
      $_SESSION["usuario"] = $usr;
      echo "
        <div class='container-fluid'>
            <div class='alert alert-succes alert-dismissible fade show text-center' role='alert'>
                Se ha creado el usuario.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        </div>
      ";
    }else{
      echo "
        <div class='container-fluid'>
            <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                Ya existe un usuario, inicie sesión o registrese con otro.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        </div>
      ";
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="shortcut icon" href="/media/TICERIco.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/headerStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous" defer></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark text-black">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                
              </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="/">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">Certificaciones</a> 
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">Contacto</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">Acerda De</a>
              </li>
            </ul>
            <div class="btn-group">
              <button type="button" class="btn btn-secondary <?php if(!empty($_SESSION)){echo "disabled";}?>" 
                      data-bs-toggle="modal" data-bs-target="#modalIniciar">
                <?php 
                  if(empty($_SESSION)){
                    echo "Inciar sesión/Registrarse";
                  }else{
                    $saludo = "Bienvenido";
                    $nom = $_SESSION['usuario']->getNombre(); echo "$saludo, $nom";
                  }?>
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
                              <input type="text" id="usuario" class="form-control" name="usuario" value="<?php if(!empty($_COOKIE['usuario']))echo $_COOKIE['usuario']?>" required>
                            </div>
                          </div>
                          <div class="row align-items-center mx-4 my-4">
                            <div class="col-3">
                              <label for="contra" class="col-form-label text-black">Contraseña:</label>
                            </div>
                            <div class="col-9">
                              <input type="password" id="contra" class="form-control" name="contra" required>
                            </div>
                          </div>
                          <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" name="cookieUSR" id="cookieUSR">
                              </div>
                              <label for="cookie" class="form-control">¿Desea guardar su usuario para despues?</label>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modalRegistro" data-bs-toggle="modal">Registrarse</button>
                        <button type="submit" class="btn btn-primary" name="sesion" >Inciar sesión</button>
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
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="registro">Registrarse</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="visually-hidden">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end dropdown-menu-sm-start ">
                <li><a class="dropdown-item <?php if(empty($_SESSION)){echo "disabled";}?>" href="/sources/pagUsuarios.php">Perfil</a></li>
                <?php 
                  if(!empty($_SESSION) && isset($_SESSION['usuario'])):
                ?>
                <?php if($_SESSION['usuario']->getAdmin()): ?>
                <li><a class="dropdown-item <?php if(empty($_SESSION)){echo "disabled";}?>" href="/sources/pagAdminExamenes.php">Examenes Usuarios</a></li>
                <?php endif ?>
                <?php endif ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item <?php if(empty($_SESSION)){echo "disabled";}?>" href="/sources/php/usuarios/cerrarSesion.php">Cerrar sesión</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
</body>
</html>