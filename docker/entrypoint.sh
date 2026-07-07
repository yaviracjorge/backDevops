#!/bin/sh
set -e

# Espera a que Postgres esté listo (por si el healthcheck no alcanza a tiempo)
until php artisan migrate --force; do
  echo "Esperando a que la base de datos esté lista..."
  sleep 3
done

php artisan config:cache
php artisan route:cache

exec "$@"