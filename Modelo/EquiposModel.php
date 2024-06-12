<?php
require_once("Conexion.php");

class EquiposModel extends Conexion {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->getConexion();
    }

    // Método para agregar un equipo nuevo
    public function agregarEquipo($nombreEquipo, $institucion, $departamento, $municipio, $direccion, $telefono) {
        try {
            $sql = "INSERT INTO equipos (nombreEquipo, institucion, departamento, municipio, direccion, telefono) VALUES (?, ?, ?, ?, ?, ?)";
            $params = array($nombreEquipo, $institucion, $departamento, $municipio, $direccion, $telefono);
            $insert = $this->conexion->prepare($sql);
            return $insert->execute($params);
        } catch (Exception $e) {
            return false;
        }
    }

    // Método para obtener todos los equipos
    public function obtenerEquipos() {
        $sql = "SELECT * FROM equipos ORDER BY idEquipo ASC";
        $result = $this->conexion->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un equipo por nombre
    public function obtenerEquipoPorNombre($nombreEquipo) {
        $sql = "SELECT * FROM equipos WHERE nombreEquipo = ?";
        $params = array($nombreEquipo);
        $query = $this->conexion->prepare($sql);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
