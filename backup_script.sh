#!/bin/bash

# Variables
USER="your_username"
PASSWORD="your_password"
DATABASE="your_database"
BACKUP_DIR="/path/to/backup/directory"
DATE=$(date +%F_%T)
BACKUP_FILE="$BACKUP_DIR/$DATABASE_$DATE.sql"

# Crear directorio de respaldo si no existe
mkdir -p $BACKUP_DIR

# Comando para hacer el respaldo de la base de datos
mysqldump -u $USER -p$PASSWORD $DATABASE > $BACKUP_FILE

# Imprimir mensaje de éxito
echo "Backup realizado: $BACKUP_FILE"
