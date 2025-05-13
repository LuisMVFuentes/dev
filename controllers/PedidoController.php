<?php
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Empanada.php';

class PedidoController
{
    private $modelo;
    private $empanadaModelo;

    public function __construct()
    {
        $this->modelo = new Pedido();
        $this->empanadaModelo = new Empanada();
    }

    public function dashboard()
    {
        $pendientes = $this->modelo->obtenerPorEstado('pendiente');
        $despachados = $this->modelo->obtenerPorEstado('despachado');
        require_once __DIR__ . '/../views/dashboard.php';
    }

    public function nuevo()
    {
        $empanadas = $this->empanadaModelo->obtenerTodas();
        require_once __DIR__ . '/../views/pedidos/nuevo.php';
    }

    public function guardar($cliente = null, $items = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente = $_POST['cliente'];
            $items = json_decode($_POST['items_json'], true);
            $this->modelo->crear($cliente, $items);
            header('Location: index.php?controlador=pedido&accion=dashboard');
        }
    }

    public function despachar($id)
    {
        $this->modelo->despachar($id);
        header('Location: index.php?controlador=pedido&accion=dashboard');
    }
}
