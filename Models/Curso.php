<?php

require_once 'Conexion.php';

class Curso {
    private $id;
    private $nombre;
    private $descripcion;


    public function __construct($id = 0, $nombre = '', $descripcion = '') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    
    }

    public static function listar() {
        $conexion = new Conexion();
        $listado = $conexion->consultar('SELECT * FROM cursos');
        $conexion->cerrar();
        return $listado;
    }

    public static function obtenerPorId($id) {
        $conexion = new Conexion();
        $listado = $conexion->consultar("SELECT * FROM curso WHERE id = $id");
        $conexion->cerrar();
        return $listado[0] ?? null;
    }

    public function eliminar() {
        $conexion = new Conexion();
        $query = "DELETE FROM curso WHERE id = $this->id";
        $resultado = $conexion->actualizar($query);
        $conexion->cerrar();
        return $resultado;
    }

    public function ingresar() {
        $conexion = new Conexion();
        $query = "INSERT INTO cursos (nombre, descripcion) VALUES ('$this->nombre', '$this->descripcion')";
        $resultado = $conexion->actualizar($query);
        $conexion->cerrar();
        return $resultado;
    }

    public function editar() {
        $conexion = new Conexion();
        $query = "UPDATE curso SET nombre = '$this->nombre', descripcion = '$this->descripcion', WHERE id = $this->id";
        $resultado = $conexion->actualizar($query);
        $conexion->cerrar();
        return $resultado;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }

}
?>