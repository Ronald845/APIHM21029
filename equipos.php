<?php
require_once("./Controlador/EquiposController.php");

$equiposController = new EquiposController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        // Endpoint: equipos.php
        // Parámetros: nombreEquipo, institucion, departamento, municipio, direccion, telefono
        if (isset($_POST['nombreEquipo'], $_POST['institucion'], $_POST['departamento'], $_POST['municipio'], $_POST['direccion'], $_POST['telefono'])) {
            $equiposController->agregarEquipo($_POST['nombreEquipo'], $_POST['institucion'], $_POST['departamento'], $_POST['municipio'], $_POST['direccion'], $_POST['telefono']);
        } else {
            http_response_code(400);
            $respuesta = array("Estado" => "Error", "Mensaje" => "Todos los campos son obligatorios");
            echo json_encode($respuesta);
        }
        break;

    case 'GET':
        // Endpoint: equipos.php
        // Parámetros: nombreEquipo o ninguno
        if (isset($_GET['nombreEquipo'])) {
            // Método para obtener un equipo específico
            $equiposController->obtenerEquipoPorNombre($_GET['nombreEquipo']);
        } else {
            // Método para obtener todos los equipos
            $equiposController->obtenerEquipos();
        }
        break;

    default:
        http_response_code(405);
        $respuesta = array("Estado" => "Error", "Mensaje" => "Método no permitido");
        echo json_encode($respuesta);
        break;
}
?>
