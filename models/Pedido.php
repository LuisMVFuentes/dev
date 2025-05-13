<?php
require_once __DIR__ . '/../config/database.php';

class Pedido
{
    public $id;
    public $cliente;
    public $total;
    public $estado;
    public $fecha;

    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // Crear un nuevo pedido
    public function crear($cliente, $items)
    {
        try {
            $this->db->beginTransaction();

            // Calcular total
            $total = 0;
            foreach ($items as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            // Insertar en pedidos
            $stmt = $this->db->prepare("INSERT INTO pedidos (cliente, total, estado) VALUES (?, ?, 'pendiente')");
            $stmt->execute([$cliente, $total]);
            $pedidoId = $this->db->lastInsertId();

            // Insertar detalle de empanadas
            $stmtDetalle = $this->db->prepare("INSERT INTO pedido_empanadas (pedido_id, empanada_id, cantidad) VALUES (?, ?, ?)");
            foreach ($items as $item) {
                $stmtDetalle->execute([$pedidoId, $item['id'], $item['cantidad']]);
            }

            $this->db->commit();
            return $pedidoId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    // Obtener todos los pedidos con su estado
    public function obtenerTodos()
    {
        $stmt = $this->db->query("SELECT * FROM pedidos ORDER BY fecha DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener los pedidos por estado
    public function obtenerPorEstado($estado)
    {
        $stmt = $this->db->prepare("SELECT * FROM pedidos WHERE estado = ? ORDER BY fecha DESC");
        $stmt->execute([$estado]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cambiar estado del pedido
    public function despachar($pedidoId)
    {
        $stmt = $this->db->prepare("UPDATE pedidos SET estado = 'despachado' WHERE id = ?");
        return $stmt->execute([$pedidoId]);
    }

    // Obtener detalle de empanadas de un pedido
    public function obtenerDetalle($pedidoId)
    {
        $stmt = $this->db->prepare("
            SELECT e.tipo, e.precio, pe.cantidad
            FROM pedido_empanadas pe
            JOIN empanadas e ON pe.empanada_id = e.id
            WHERE pe.pedido_id = ?
        ");
        $stmt->execute([$pedidoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
