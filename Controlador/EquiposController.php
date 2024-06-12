<?php
require_once("./Modelo/EquiposModel.php");
header('Content-Type: application/json');

class EquiposController {
    private $equiposModel;

    public function __construct() {
        $this->equiposModel = new EquiposModel();
    }

    // Método para agregar un equipo nuevo
    public function agregarEquipo($nombreEquipo, $institucion, $departamento, $municipio, $direccion, $telefono) {
        $resultado = $this->equiposModel->agregarEquipo($nombreEquipo, $institucion, $departamento, $municipio, $direccion, $telefono);
        $respuesta = array();
        if ($resultado) {
            http_response_code(201);
            $respuesta["Estado"] = "Exito";
            $respuesta["Mensaje"] = "Equipo $nombreEquipo registrado exitosamente";
        } else {
            http_response_code(400);
            $respuesta["Estado"] = "Error";
            $respuesta["Mensaje"] = "No se pudo registrar el equipo $nombreEquipo, el equipo ya existe";
        }
        echo json_encode($respuesta);
    }

    // Método para obtener todos los equipos
    public function obtenerEquipos() {
        $equipos = $this->equiposModel->obtenerEquipos();
        $respuesta = array();
        if ($equipos) {
            http_response_code(200);
            $respuesta["Estado"] = "Exito";
            $respuesta["Mensaje"] = "Equipos recuperados exitosamente";
            $respuesta["data"] = $equipos;
        } else {
            http_response_code(404);
            $respuesta["Estado"] = "Error";
            $respuesta["Mensaje"] = "No se encontraron equipos";
            $respuesta["data"] = [];
        }
        echo json_encode($respuesta);
    }

    // Método para obtener un equipo por nombre
    public function obtenerEquipoPorNombre($nombreEquipo) {
        $equipo = $this->equiposModel->obtenerEquipoPorNombre($nombreEquipo);
        $respuesta = array();
        if ($equipo) {
            http_response_code(200);
            $respuesta["Estado"] = "Exito";
            $respuesta["Mensaje"] = "Equipo $nombreEquipo encontrado";
            $respuesta["data"] = $equipo;
        } else {
            http_response_code(404);
            $respuesta["Estado"] = "Error";
            $respuesta["Mensaje"] = "Equipo $nombreEquipo no encontrado";
            $respuesta["data"] = [];
        }
        echo json_encode($respuesta);
    }
}
?>
