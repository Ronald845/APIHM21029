<?php
require_once("./Modelo/JugadoresModel.php");
header('Content-Type: application/json');

class JugadoresController {
    private $jugadoresModel;

    public function __construct() {
        $this->jugadoresModel = new JugadoresModel();
    }

    // Método para agregar un nuevo jugador
    public function agregarJugador($nombres, $apellidos, $fechaNacimiento, $genero, $posicion, $idEquipo) {
        $resultado = $this->jugadoresModel->agregarJugador($nombres, $apellidos, $fechaNacimiento, $genero, $posicion, $idEquipo);
        $respuesta = array();
        if ($resultado) {
            http_response_code(201);
            $respuesta["Estado"] = "Exito";
            $respuesta["Mensaje"] = "Jugador $nombres registrado exitosamente";
        } else {
            http_response_code(400);
            $respuesta["Estado"] = "Error";
            $respuesta["Mensaje"] = "No se pudo registrar el jugador $nombres";
        }
        echo json_encode($respuesta);
    }

    // Método para obtener todos los jugadores
    public function obtenerJugadores() {
        $jugadores = $this->jugadoresModel->obtenerJugadores();
        $respuesta = array();
        if ($jugadores) {
            http_response_code(200);
            $respuesta["Estado"] = "Exito";
            $respuesta["Mensaje"] = "Jugadores recuperados exitosamente";
            $respuesta["data"] = $jugadores;
        } else {
            http_response_code(404);
            $respuesta["Estado"] = "Error";
            $respuesta["Mensaje"] = "No se encontraron jugadores";
            $respuesta["data"] = [];
        }
        echo json_encode($respuesta);
    }

    // Método para obtener un jugador por nombre
    public function obtenerJugadorPorNombre($nombres) {
        $jugador = $this->jugadoresModel->obtenerJugadorPorNombre($nombres);
        $respuesta = array();
        if ($jugador) {
            http_response_code(200);
            $respuesta["Estado"] = "Exito";
            $respuesta["Mensaje"] = "Jugador $nombres encontrado";
            $respuesta["data"] = $jugador;
        } else {
            http_response_code(404);
            $respuesta["Estado"] = "Error";
            $respuesta["Mensaje"] = "Jugador $nombres no encontrado";
            $respuesta["data"] = [];
        }
        echo json_encode($respuesta);
    }
}
?>
