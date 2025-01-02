<?php
require_once "../Models/Curso.php";



$method = $_SERVER['REQUEST_METHOD'];
$request_uri = trim($_SERVER['REQUEST_URI'], "/");
$uri_parts = explode("/", $request_uri);

$recurso = $uri_parts[3];

$id = isset($uri_parts[4]) ? (int) $uri_parts[4] : null;

if ($recurso === 'cursos') {
    $curso = new Curso();
    switch ($method) {
        case 'GET':
            if ($id) {
                echo json_encode($curso->obtenerPorId($id));
            } else {
                echo json_encode($curso->listar());
            }
            break;

        case 'POST':
            $input=json_decode(file_get_contents('php://input'), true);
            $curso->setNombre($input['nombre']);
            $curso->setDescripcion($input['descripcion']);
            $curso->ingresar();
           
            echo json_encode(["message" => "Curso creado con éxito"]);
            break;

        case 'PUT':
            if ($id) {
                $input=json_decode(file_get_contents('php://input'), true);
                $curso->setId($id);
                $curso->setNombre($input['nombre']);
                $curso->setDescripcion($input['descripcion']);
                
          
                $curso->editar();
                echo json_encode(["message" => "Curso actualizado con éxito"]);
            } else {
                echo json_encode(["error" => "ID de curso requerido"]);
            }
            break;

        case 'DELETE':
            if ($id) {
                $curso->setId($id);
                $curso->eliminar();
                echo json_encode(["message" => "Curso eliminado con éxito"]);
            } else {
                echo json_encode(["error" => "ID de curso requerido"]);
            }
            break;

        default:
            echo json_encode(["error" => "Método no permitido"]);
    }
}
elseif($recursos === 'estudiantes'){

}
else {
    echo json_encode(["error" => "Recurso no válido."]);
}
