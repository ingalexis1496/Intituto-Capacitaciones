<?php

require_once 'Conexion.php';
class Usuarios {



    private $id_usuario;
    private $nombre;
    private $apellido;
    private $num_identificacion;
    private $correo;
    private $celular;
    private $apartado_aereo;
    private $telefono;
    private $direccion;
    private $id_rol;
    
    


    public function __construct($id_usuario = 0, $nombre = '', 
          $apellido = '', $num_identificacion = '',$correo = '',$celular = '',
          $apartado_aereo = '',$telefono = '',$direccion = '',$id_rol = '') {

        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->num_identificacion = $num_identificacion;
        $this->correo = $correo;
        $this->celular = $celular;
        $this->apartado_aereo = $apartado_aereo;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->id_rol = $id_rol;

    
    }






}

?>