#!/bin/sh

echo "[Entrypoint] Ejecutando composer dump-autoload..."

if [ -f /var/www/html/composer.json ]; then
    composer dump-autoload --no-interaction
else
    echo "composer.json no encontrado. Saltando dump-autoload."
fi

# Iniciar Apache
exec apache2-foreground
