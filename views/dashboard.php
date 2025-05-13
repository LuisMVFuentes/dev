<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard de Pedidos</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
        h2 { margin-top: 40px; }
        form { display: inline; }
        button { padding: 5px 10px; }
    </style>
</head>
<body>

    <h1>Dashboard de Pedidos</h1>
    <a href="index.php?controlador=pedido&accion=nuevo">+ Nuevo Pedido</a>

    <!-- PEDIDOS PENDIENTES -->
    <h2>Pedidos Pendientes</h2>
    <?php if (count($pendientes) === 0): ?>
        <p>No hay pedidos pendientes.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendientes as $pedido): ?>
            <tr>
                <td><?= $pedido['id'] ?></td>
                <td><?= htmlspecialchars($pedido['cliente']) ?></td>
                <td>$<?= number_format($pedido['total'], 2) ?></td>
                <td><?= $pedido['fecha'] ?></td>
                <td>
                    <form action="index.php?controlador=pedido&accion=despachar&id=<?= $pedido['id'] ?>" method="POST">
                        <button type="submit">Marcar como despachado</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <!-- PEDIDOS DESPACHADOS -->
    <h2>Pedidos Despachados</h2>
    <?php if (count($despachados) === 0): ?>
        <p>No hay pedidos despachados.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($despachados as $pedido): ?>
            <tr>
                <td><?= $pedido['id'] ?></td>
                <td><?= htmlspecialchars($pedido['cliente']) ?></td>
                <td>$<?= number_format($pedido['total'], 2) ?></td>
                <td><?= $pedido['fecha'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

</body>
</html>
