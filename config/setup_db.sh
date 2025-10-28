#!/bin/bash

set -a
source .env
set +a

#: "${DB_NAME:=inase_muestras}"
#: "${DB_USER:=inase_user}"
#: "${DB_PASS:=secret}"
#: "${DB_HOST:=localhost}"
#: "${MYSQL_ROOT_USER:=root}"
#: "${MYSQL_ROOT_PASS:=admin}"

echo "Creando Base de Datos '${DB_NAME}' y usuario '${DB_USERNAME}'..."

envsubst < schema/crear_db_inase_muestras.template.sql > schema/crear_db_inase_muestras.sql

mysql -u "$MYSQL_ROOT_USERNAME" -p"$MYSQL_ROOT_PASSWORD" -h "$DB_HOST" < "schema/crear_db_inase_muestras.sql"

echo "✅ Base de Datos '$DB_NAME' creada correctamente."
