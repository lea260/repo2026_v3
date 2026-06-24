<?php

use App\Config\Settings; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>index</h1>
    <?= $nombre; ?>
    <a href="<?= Settings::getUrlBase()  ?>autos/listar">listar Autos</a>
    <a href="<?= Settings::getUrlBase()  ?>productos/ver/5/verde">test</a>
    <a href="<?= Settings::getUrlBase()  ?>autos/nuevo">nuevo</a>
</body>

</html>