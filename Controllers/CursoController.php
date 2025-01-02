<?php
require_once "../Models/Curso.php";

class CursoController {
    public static function listar() {
        return Curso::listar();
    }

    public static function obtenerPorId($id) {
        return Curso::obtenerPorId($id);
    }

    public static function guardar($data) {
        $curso = new Curso(0, $data['nombre'], $data['descripcion']);
        $curso->ingresar();
        http_response_code(201);
        echo json_encode(["message" => "Curso creado exitosamente"]);
    }

    public static function editar($data) {
        $curso = new Curso($data['id'], $data['nombre'], $data['descripcion'], $data['fecha_inicio'], $data['fecha_fin']);
        $curso->editar();
        echo json_encode(["message" => "Curso actualizado exitosamente"]);
    }

    public static function eliminar($id) {
        $curso = new Curso($id);
        $curso->eliminar();
        echo json_encode(["message" => "Curso eliminado exitosamente"]);
    }
}
?>
