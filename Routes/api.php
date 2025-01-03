<?php
require_once "../Controllers/CursoController.php";
require_once "../Controllers/UsuariosController.php";

$method = $_SERVER['REQUEST_METHOD'];
$request_uri = trim($_SERVER['REQUEST_URI'], "/");
$uri_parts = explode("/", $request_uri);

$recurso = $uri_parts[3];

$id = isset($uri_parts[4]) ? (int) $uri_parts[4] : null;

if ($recurso === 'cursos') {
    $cursoController = new CursoController();
    switch ($method) {
        case 'GET':
            if ($id) {
                echo json_encode($cursoController->obtenerPorId($id));
            } else {
                $action = $uri_parts[4];
                if($action === 'obtener-cursos-actuales'){
                    echo json_encode($cursoController->obtenerCursosActuales()); 
                }
                elseif($action === 'listar'){
                    echo json_encode($cursoController->listar()); 
                }
                else{
                    echo json_encode(["message" => "Metodo no existe"]);
                }
            }
            break;

        case 'POST':
            $input=json_decode(file_get_contents('php://input'), true);
            echo $cursoController->ingresar($input);
            break;

        case 'PUT':
            if ($id) {
                $input=json_decode(file_get_contents('php://input'), true);             
                echo $cursoController->editar($id, $input);
            } else {
                echo json_encode(["error" => "ID de curso requerido"]);
            }
            break;

        case 'DELETE':
            if ($id) {
                return $cursoController->eliminar($id);
            } else {
                echo json_encode(["error" => "ID de curso requerido"]);
            }
            break;

        default:
            echo json_encode(["error" => "Método no permitido"]);
    }
}
elseif($recurso === 'estudiantes'){

    $usuariosController = new UsuariosController();
    switch ($method) {
    case 'GET':
        if ($id) {
            echo json_encode($cursoController->obtenerPorId($id));
        } else {
            $action = $uri_parts[4];
      
            if($action === 'obtener-estudiantes-materia'){
                echo json_encode($usuariosController->ObtenerEstudianstesCursoEspecifico()); 
            }
            elseif($action === 'obtener-estudiantes-aprobados'){
                echo json_encode($usuariosController->obtenerEstudiantesAprobados()); 
            }
            elseif($action === 'obtener-cursos-promedios'){
                echo json_encode($usuariosController->obtenerCursosPromedios()); 
            }
            elseif($action === 'obtener-cursos-perdidos'){
                echo json_encode($usuariosController->obtenerCursosPerdidosEstudiantes()); 
            }
            elseif($action === 'obtener-rango-notas'){
                echo json_encode($usuariosController->obtenerEstadisticaRangoNotas()); 
            }
            elseif($action === 'obtener-curso-especifico'){
                echo json_encode($usuariosController->obtenerCursoHorarioEspecifico()); 
            }
            elseif($action === 'obtener-curso-tomado-estudiante'){
                echo json_encode($usuariosController->obtenerCursoTomadoPorEstudiante()); 
            }
            else{
                echo json_encode(["message" => "Metodo no existe"]);
            }
        }
        break;
        
        default:
            echo json_encode(["error" => "Método no permitido"]);
}
}
else {
    echo json_encode(["error" => "Recurso no válido."]);
}
