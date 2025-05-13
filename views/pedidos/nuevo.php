<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo Pedido</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        input[type="number"] {
            width: 60px;
        }
    </style>
</head>

<body>

    <h2>Registrar nuevo pedido</h2>

    <form action="index.php?controlador=pedido&accion=guardar" method="POST" onsubmit="return prepararPedido()">
        <label for="cliente">Nombre del cliente:</label><br>
        <input type="text" name="cliente" id="cliente" required><br><br>

        <table>
            <thead>
                <tr>
                    <th>Tipo de Empanada</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empanadas as $emp) : ?>
                    <tr>
                        <td><?= htmlspecialchars($emp['tipo']) ?></td>
                        <td>$<?= number_format($emp['precio'], 2) ?></td>
                        <td>
                            <input type="number" name="cantidad[<?= $emp['id'] ?>]" min="0" value="0" data-precio="<?= $emp['precio'] ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <input type="hidden" name="items_json" id="items_json">
        <button type="submit">Guardar Pedido</button>
    </form>

    <script>
        function prepararPedido() {
            const inputs = document.querySelectorAll('input[type="number"][name^="cantidad"]');
            const items = [];

            inputs.forEach(input => {
                const cantidad = parseInt(input.value);
                if (cantidad > 0) {
                    const id = input.name.match(/\d+/)[0];
                    const precio = parseFloat(input.dataset.precio);
                    items.push({
                        id: id,
                        cantidad: cantidad,
                        precio: precio
                    });
                }
            });

            document.getElementById('items_json').value = JSON.stringify(items);
            return true;
        }
    </script>

</body>

</html>