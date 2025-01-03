<?php
require_once "../Models/Curso.php";

class CursoController {
    public static function listar() {
        return Curso::listar();
    }

    public static function obtenerPorId($id) {
        return Curso::obtenerPorId($id);
    }

    public static function ingresar($data) {
        $curso = new Curso();
        $curso->setNombre($data['nombre']);
        $curso->setDescripcion($data['descripcion']);
        $curso->ingresar();
        http_response_code(201);
        return json_encode(["message" => "Curso creado exitosamente"]);
    }

    public static function editar($id, $data) {
        $curso = new Curso();
        $curso->setId($id);
        $curso->setNombre($data['nombre']);
        $curso->setDescripcion($data['descripcion']);
        $curso->editar();
        return json_encode(["message" => "Curso actualizado exitosamente"]);
    }

    public static function eliminar($id) {
        $curso = new Curso($id);
        $curso->eliminar();
        return json_encode(["message" => "Curso eliminado exitosamente"]);
    }

    public static function obtenerCursosActuales() {
        return Curso::obtenerCursosActuales();
        
    }
}
?>
