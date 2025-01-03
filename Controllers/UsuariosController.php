<?php
    require_once "../Models/Usuarios.php";


    class UsuariosController {

        public static function ObtenerEstudianstesCursoEspecifico() {
            return Usuarios::ObtenerEstudianstesCursoEspecifico();
        }
        public static function obtenerEstudiantesAprobados() {
            return Usuarios::obtenerEstudiantesAprobados();
        }

        public static function obtenerCursosPromedios() {
            return Usuarios::obtenerCursosPromedios();
        }

        public static function obtenerCursosPerdidosEstudiantes() {
            return Usuarios::obtenerCursosPerdidosEstudiantes();
        }

        public static function obtenerEstadisticaRangoNotas() {
            return Usuarios::obtenerEstadisticaRangoNotas();
        }
        public static function obtenerCursoHorarioEspecifico() {
            return Usuarios::obtenerCursoHorarioEspecifico();
            
        }
        public static function obtenerCursoTomadoPorEstudiante() {
            return Usuarios::obtenerCursoTomadoPorEstudiante();
            
        }

    }

?>