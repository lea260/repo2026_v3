<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Detalle del Auto</h2>
    <?php if ($auto): ?>
        <ul>
            <li><strong>ID:</strong> <?= htmlspecialchars($auto->getId()) ?></li>
            <li><strong>Patente:</strong> <?= htmlspecialchars($auto->getPatente()) ?></li>
            <li><strong>Marca:</strong> <?= htmlspecialchars($auto->getMarca()) ?></li>
            <li><strong>Modelo:</strong> <?= htmlspecialchars($auto->getModelo()) ?></li>
            <li><strong>Estado:</strong> <?= htmlspecialchars($auto->getEstado()) ?></li>
        </ul>
        <?php
        if ($auto->getEstado() === 'disponible'): ?>
            <p><strong>El auto está disponible para reservar o vender.</strong></p>

            <fieldset style="margin-bottom: 1em; padding: 1em;">
                <legend><strong>Reservar Auto</strong></legend>
                <form method="POST" action="<?= BASE_URL_CTRL ?>reserva/auto_controller.php">
                    <input type="hidden" name="id_auto" value="<?= htmlspecialchars($auto->getId()) ?>">

                    <label for="venta_usuario">ID vendedor:</label>
                    <input type="number" name="id_usuario" id="venta_usuario" required>
                    <br><br>

                    <button type="submit">Reservar</button>
                </form>
            </fieldset>

            <fieldset style="padding: 1em;">
                <legend><strong>Vender Auto</strong></legend>
                <form method="POST" action="<?= BASE_URL_CTRL ?>venta/vender_controller.php">
                    <input type="hidden" name="id_auto" value="<?= htmlspecialchars($auto->getId()) ?>">

                    <label for="venta_usuario">ID vendedor:</label>
                    <input type="number" name="id_usuario" id="venta_usuario" required>
                    <br><br>

                    <label for="precio">Precio:</label>
                    <input type="number" name="precio" id="precio" step="0.01" min="0" required placeholder="Ej: 35000.00">
                    <br><br>

                    <button type="submit">Comprar</button>
                </form>
            </fieldset>

        <?php elseif ($auto->getEstado() === 'reservado'): ?>
            <p>El auto está reservado.</p>
        <?php elseif ($auto->getEstado() === 'vendido'): ?>
            <p>El auto ha sido vendido.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>No se encontró información del auto.</p>
    <?php endif; ?>
    <p><a href="<?= BASE_URL ?>index.php">Volver al menú</a></p>
</body>

</html>