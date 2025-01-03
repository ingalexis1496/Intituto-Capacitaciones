<?php
    class Conexion {
        private $conexion;

        public function __construct () {
            $this->conexion = new mysqli('localhost', 'root', '', 'institucion_capacitaciones');
            $this->conexion->set_charset('utf8');
        }

        public function consultar ($sql) {
            return $this->conexion->query($sql)->fetch_all();
        }

        public function actualizar ($sql) {
            return $this->conexion->query($sql);
        }

        public function cerrar () {
            $this->conexion->close();
        }
    }