<?php
$controlador = $_GET['controlador'] ?? 'pedido';
$accion = $_GET['accion'] ?? 'dashboard';

require_once "controllers/" . ucfirst($controlador) . "Controller.php";
$clase = ucfirst($controlador) . "Controller";
$instancia = new $clase();

if (method_exists($instancia, $accion)) {
    $instancia->$accion();
} else {
    echo "Acción no válida.";
}
