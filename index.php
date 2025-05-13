<?php
$controlador = $_GET['controlador'] ?? 'pedido';
$accion = $_GET['accion'] ?? 'dashboard';
$id = $_GET['id'] ?? null;

require_once "controllers/" . ucfirst($controlador) . "Controller.php";
$clase = ucfirst($controlador) . "Controller";
$instancia = new $clase();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($id)) {
    $instancia->$accion($id); // Ej: despachar
} else {
    $instancia->$accion();    // dashboard, nuevo, etc.
}
