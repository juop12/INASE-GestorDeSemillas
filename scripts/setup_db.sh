#!/bin/bash

set -a
source ../config/.env
set +a

#: "${DB_NAME:=inase_muestras}"
#: "${DB_USER:=inase_user}"
#: "${DB_PASS:=secret}"
#: "${DB_HOST:=localhost}"
#: "${MYSQL_ROOT_USER:=root}"
#: "${MYSQL_ROOT_PASS:=admin}"

readonly SQL_TEMPLATE=../config/schema/crear_db_inase_muestras.template.sql
readonly SQL_SUBSTITUIDO=../config/schema/crear_db_inase_muestras.sql

echo "Creando Base de Datos '${DB_NAME}' y usuario '${DB_USERNAME}'..."

envsubst < $SQL_TEMPLATE > $SQL_SUBSTITUIDO

mysql -u "$MYSQL_ROOT_USERNAME" -p"$MYSQL_ROOT_PASSWORD" -h "$DB_HOST" < "$SQL_SUBSTITUIDO"

echo "✅ Base de Datos '$DB_NAME' creada correctamente."
