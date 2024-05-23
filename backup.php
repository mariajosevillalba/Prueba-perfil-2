<?php
$backup_file = 'backups/mi_base_de_datos_backup_' . date('Y-m-d_H-i-s') . '.sql';
$command = "mysqldump --user=root --password=tu_contraseña mi_base_de_datos > $backup_file";

system($command, $output);

if ($output === 0) {
    echo "Copia de seguridad creada exitosamente en: $backup_file";
} else {
    echo "Error al crear la copia de seguridad";
}
?>
