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

    public static function ObtenerEstudianstesCursoEspecifico() {
        $conexion = new Conexion();       
        $listado = $conexion->consultar("SELECT usuarios.nombre 
                                         FROM institucion_capacitaciones.cursos 
                                         JOIN horarios ON cursos.id_curso = horarios.id_curso  
                                         JOIN matricula ON horarios.id = matricula.id_horario 
                                         JOIN usuarios ON usuarios.id_usuario = matricula.id_estudiante 
                                         WHERE cursos.nombre = 'Matematica Avanzada';");
    
    
        $conexion->cerrar();
        
        return $listado ?? null;
    }

    public static function obtenerEstudiantesAprobados() {
        $conexion = new Conexion();       
        $listado = $conexion->consultar("SELECT usuarios.nombre, cursos.nombre, matricula.nota_final
                                            FROM institucion_capacitaciones.cursos
                                            JOIN horarios ON cursos.id_curso = horarios.id_curso 
                                            JOIN  matricula ON horarios.id = matricula.id_horario
                                            JOIN usuarios ON usuarios.id_usuario = matricula.id_estudiante
                                            WHERE matricula.aprobo = true
                                            ORDER BY matricula.nota_final DESC;");
    
        $conexion->cerrar();
        
        $resultado = [];
        if ($listado) {
            foreach ($listado as $fila) {
                $resultado[] = [
                    'nombre' => $fila[0],
                    'materia' => $fila[1],
                    'Nota' => $fila[2]
                ];
            }
        }
        
        return ($resultado);
    }
   
    public static function obtenerCursosPromedios() {
        $conexion = new Conexion();       
        $listado = $conexion->consultar("SELECT cursos.nombre, AVG(matricula.nota_final) AS promedio,profesor.nombre
                                        FROM institucion_capacitaciones.cursos
                                        JOIN horarios ON cursos.id_curso = horarios.id_curso 
                                        JOIN matricula ON horarios.id = matricula.id_horario
                                        JOIN usuarios as estudiante ON estudiante.id_usuario = matricula.id_estudiante
                                        JOIN usuarios as profesor ON profesor.id_usuario = horarios.id_profesor
                                        GROUP BY matricula.id_matricula
                                        ORDER BY promedio DESC
                                        LIMIT 5;");
    
        $conexion->cerrar();
        
        $resultado = [];
        if ($listado) {
            foreach ($listado as $fila) {
                $resultado[] = [
                    'nombre curso' => $fila[0],
                    'nota final' => $fila[1],
                    'nombre profesor' => $fila[2]
                ];
            }
        }
        
        return ($resultado);
    }
    public static function obtenerCursosPerdidosEstudiantes() {
        $conexion = new Conexion();       
        $listado = $conexion->consultar("SELECT estudiante.nombre,COUNT(CASE WHEN matricula.nota_final < 6 THEN 1 END) as cursos_perdidos,
                                        AVG(matricula.nota_final) AS promedio FROM institucion_capacitaciones.cursos
                                        JOIN horarios ON cursos.id_curso = horarios.id_curso 
                                        JOIN matricula ON horarios.id = matricula.id_horario
                                        JOIN usuarios as estudiante ON estudiante.id_usuario = matricula.id_estudiante
                                        WHERE matricula.nota_final < 6
                                        GROUP BY estudiante.id_usuario;");
    
        $conexion->cerrar();
        
        $resultado = [];
        if ($listado) {
            foreach ($listado as $fila) {
                $resultado[] = [
                    'nombre' => $fila[0],
                    'cursos Perdido' => $fila[1],
                    'promedio' => $fila[2]
                ];
            }
        }
        
        return ($resultado);
    }
    public static function obtenerEstadisticaRangoNotas() {
        $conexion = new Conexion();       
        $listado = $conexion->consultar("SELECT profesor.nombre,cursos.nombre,
                                        COUNT(CASE WHEN matricula.nota_final >=0 AND matricula.nota_final < 6 THEN 1 END) AS rango_perdidos,
                                        COUNT(CASE WHEN matricula.nota_final >=6 AND matricula.nota_final < 8 THEN 1 END) AS rango_bajas,
                                        COUNT(CASE WHEN matricula.nota_final >=8 AND matricula.nota_final < 10 THEN 1 END) AS rango_altas
                                        FROM institucion_capacitaciones.cursos
                                        JOIN horarios ON cursos.id_curso = horarios.id_curso 
                                        JOIN matricula ON horarios.id = matricula.id_horario
                                        JOIN usuarios as profesor ON profesor.id_usuario = horarios.id_profesor
                                        GROUP BY profesor.id_usuario;");
    
        $conexion->cerrar();
        
        $resultado = [];
        if ($listado) {
            foreach ($listado as $fila) {
                $resultado[] = [
                    'nombre Profesor' => $fila[0],
                    'Nombre Curso' => $fila[1],
                    'Rango Notas Perdidas' => $fila[2],
                    'Rango Notas Bajas' => $fila[3],
                    'Rango Notas Altas' => $fila[4]
                ];
            }
        }
        
        return ($resultado);
    }
    public static function obtenerCursoHorarioEspecifico() {
        $conexion = new Conexion();       
        $listado = $conexion->consultar("SELECT usuarios.nombre, cursos.nombre
                                         FROM institucion_capacitaciones.cursos 
                                         JOIN horarios ON cursos.id_curso = horarios.id_curso  
                                         JOIN matricula ON horarios.id = matricula.id_horario 
                                         JOIN usuarios ON usuarios.id_usuario = matricula.id_estudiante 
                                         WHERE cursos.nombre = 'Matematica Avanzada' 
                                         AND '2025-01-01 15:39:04' between fecha_hora_inicio and fecha_hora_fin;");
    
        $conexion->cerrar();
        
        $resultado = [];
        if ($listado) {
            foreach ($listado as $fila) {
                $resultado[] = [
                    'nombre curso' => $fila[0],
                    'fecha Inicio' => $fila[1],
                   
            
                ];
            }
        }
        
        return ($resultado);
    }
    public static function obtenerCursoTomadoPorEstudiante() {
        $conexion = new Conexion();       
        $listado = $conexion->consultar("SELECT cursos.nombre,horarios.fecha_hora_inicio,horarios.fecha_hora_fin
                                        FROM institucion_capacitaciones.cursos
                                        JOIN horarios ON cursos.id_curso = horarios.id_curso 
                                        JOIN matricula ON horarios.id = matricula.id_horario
                                        JOIN usuarios as estudiante ON estudiante.id_usuario = matricula.id_estudiante
                                        WHERE estudiante.nombre = 'Ana'
                                        ORDER BY horarios.fecha_hora_inicio;");
    
        $conexion->cerrar();
        
        $resultado = [];
        if ($listado) {
            foreach ($listado as $fila) {
                $resultado[] = [
                    'nombre curso' => $fila[0],
                    'fecha Inicio' => $fila[1],
                    'fecha fin' => $fila[2]
                   
            
                ];
            }
        }
        
        return ($resultado);
    }
    

}
    



?>