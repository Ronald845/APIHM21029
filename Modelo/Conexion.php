<?php
class Conexion {
    private $host = "localhost";
    private $user = "root";
    private $pass = "1234";
    private $db = "torneo_futbol";
    private $conexion;

    public function __construct() {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
        try {
            $this->conexion = new PDO($dsn, $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            $this->conexion = "Error de conexión";
            http_response_code(500);
            $respuesta = array();
            $respuesta["Estado"] = "Error";
            $respuesta["Mensaje"] = $e->getMessage();
            echo json_encode($respuesta);
            exit;
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
}
?>
