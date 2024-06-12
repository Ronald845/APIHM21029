<?php
require_once("Conexion.php");

class JugadoresModel extends Conexion {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->getConexion();
    }

    // Método para agregar un nuevo jugador
    public function agregarJugador($nombres, $apellidos, $fechaNacimiento, $genero, $posicion, $idEquipo) {
        try {
            $sql = "INSERT INTO jugadores (nombres, apellidos, fechaNacimiento, genero, posicion, idEquipo) VALUES (?, ?, ?, ?, ?, ?)";
            $params = array($nombres, $apellidos, $fechaNacimiento, $genero, $posicion, $idEquipo);
            $insert = $this->conexion->prepare($sql);
            return $insert->execute($params);
        } catch (Exception $e) {
            return false;
        }
    }

    // Método para obtener todos los jugadores
    public function obtenerJugadores() {
        $sql = "SELECT * FROM jugadores ORDER BY idJugador ASC";
        $result = $this->conexion->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un jugador por nombre
    public function obtenerJugadorPorNombre($nombres) {
        $sql = "SELECT * FROM jugadores WHERE nombres = ?";
        $params = array($nombres);
        $query = $this->conexion->prepare($sql);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
