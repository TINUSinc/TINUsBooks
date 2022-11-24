<?php
    class Usuario{
        private $nombre; //Nombre completo string
        private $correo; //Correo electronico string
        private $usuario; //Usuario que se mostrara string
        private $contrasena; //string
        private $admin; // Booleano para comprobar si tiene permisos extra
        private $block; // Booleano que comprueba si la cuenta esta blloqueada
        public function __construct($nombre="", $correo="", $usuario="", $contrasena="", $admin=false, $block=false){
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->usuario = $usuario;
            $this->contrasena = $contrasena;
            $this->admin = $admin;
            $this->block = $block;
        }
        public function getUsuario(){
            return $this->usuario;
        }
        public function getUsuario(){
            return $this->usuario;
        }

    }
    
?>