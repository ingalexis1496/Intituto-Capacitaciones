<?php

require_once 'Conexion.php';
class Archivos_curso {



    private $id_archivo;
    private $nombre;
    private $id_curso;


    public function __construct($id_archivo = 0, $nombre = '', $id_curso = '') {
        $this->id_archivo = $id_archivo;
        $this->nombre = $nombre;
        $this->id_curso = $id_curso;;
    
    }






}

?>