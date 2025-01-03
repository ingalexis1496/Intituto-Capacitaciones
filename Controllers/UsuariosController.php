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

    }

?>