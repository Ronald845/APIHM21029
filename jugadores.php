<?php
require_once("./Controlador/JugadoresController.php");

$jugadoresController = new JugadoresController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        // Endpoint: jugadores.php
        // Parámetros: nombres, apellidos, fechaNacimiento, genero, posicion, idEquipo
        if (isset($_POST['nombres'], $_POST['apellidos'], $_POST['fechaNacimiento'], $_POST['genero'], $_POST['posicion'], $_POST['idEquipo'])) {
            $jugadoresController->agregarJugador($_POST['nombres'], $_POST['apellidos'], $_POST['fechaNacimiento'], $_POST['genero'], $_POST['posicion'], $_POST['idEquipo']);
        } else {
            http_response_code(400);
            $respuesta = array("Estado" => "Error", "Mensaje" => "Todos los campos son obligatorios");
            echo json_encode($respuesta);
        }
        break;

    case 'GET':
        // Endpoint: jugadores.php
        // Parámetros: nombres o ninguno
        if (isset($_GET['nombres'])) {
            // Método para obtener un jugador específico
            $jugadoresController->obtenerJugadorPorNombre($_GET['nombres']);
        } else {
            // Método para obtener todos los jugadores
            $jugadoresController->obtenerJugadores();
        }
        break;

    default:
        http_response_code(405);
        $respuesta = array("Estado" => "Error", "Mensaje" => "Método no permitido");
        echo json_encode($respuesta);
        break;
}
?>
