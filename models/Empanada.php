<?php
require_once __DIR__ . '/../config/database.php';

class Empanada {
    public $id;
    public $tipo;
    public $precio;

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Obtener todas las empanadas
    public function obtenerTodas() {
        $stmt = $this->db->query("SELECT * FROM empanadas ORDER BY tipo ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una empanada por ID
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM empanadas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nueva empanada
    public function crear($tipo, $precio) {
        $stmt = $this->db->prepare("INSERT INTO empanadas (tipo, precio) VALUES (?, ?)");
        return $stmt->execute([$tipo, $precio]);
    }

    // Actualizar empanada existente
    public function actualizar($id, $tipo, $precio) {
        $stmt = $this->db->prepare("UPDATE empanadas SET tipo = ?, precio = ? WHERE id = ?");
        return $stmt->execute([$tipo, $precio, $id]);
    }

    // Eliminar empanada
    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM empanadas WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
