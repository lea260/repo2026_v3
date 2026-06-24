<?php

use App\Config\Settings;
// Si viene un objeto auto, cargamos sus datos, si no, campos vacíos
$isEdit = isset($auto);
$action = $isEdit ? "autos/actualizar" : "autos/crear";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= $isEdit ? 'Editar' : 'Registrar' ?> Auto</title>
</head>

<body>
    <h2><?= $isEdit ? 'Editar Auto: ' . $auto->getPatente() : 'Registrar Nuevo Auto' ?></h2>

    <form action="<?= Settings::getUrlBase() ?><?= $action ?>" method="POST">

        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $auto->getId() ?>">
            <input type="hidden" name="version" value="<?= $auto->getVersion() ?>">
        <?php endif; ?>

        <div>
            <label for="patente">Patente:</label>
            <input
                type="text" id="patente" name="patente" maxlength="7" required
                placeholder="Ej: ABC1234"
                value="<?= $isEdit ? $auto->getPatente() : '' ?>"
                <?= $isEdit ? 'readonly style="background-color: #eee;"' : '' ?>>
            <?php if ($isEdit): ?>
                <small>(La patente no se puede modificar)</small>
            <?php endif; ?>
        </div>

        <div>
            <label for="marca">Marca:</label>
            <input
                type="text" id="marca" name="marca" required
                value="<?= $isEdit ? $auto->getMarca() : '' ?>">
        </div>

        <div>
            <label for="modelo">Modelo:</label>
            <input
                type="text" id="modelo" name="modelo" required
                value="<?= $isEdit ? $auto->getModelo() : '' ?>">
        </div>

        <div>
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <?php
                $estados = ['disponible' => 'Disponible', 'reservado' => 'Reservado', 'vendido' => 'Vendido'];
                foreach ($estados as $val => $texto):
                    $selected = ($isEdit && $auto->getEstado() === $val) ? 'selected' : '';
                ?>
                    <option value="<?= $val ?>" <?= $selected ?>><?= $texto ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <button type="submit">
                <?= $isEdit ? 'Guardar Cambios' : 'Registrar Auto' ?>
            </button>

            <?php if ($isEdit): ?>
                <a href="<?= Settings::getUrlBase() ?>">Cancelar</a>
            <?php endif; ?>
        </div>
    </form>
</body>

</html>