<?php
require_once __DIR__ . '/../models/Empanada.php';

class EmpanadaController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Empanada();
    }

    public function index()
    {
        $empanadas = $this->modelo->obtenerTodas();
        require_once __DIR__ . '/../views/empanadas/listado.php';
    }

    public function crear($tipo, $precio)
    {
        $this->modelo->crear($tipo, $precio);
        header('Location: index.php?controlador=empanada&accion=index');
    }

    public function eliminar($id)
    {
        $this->modelo->eliminar($id);
        header('Location: index.php?controlador=empanada&accion=index');
    }
}
