<?php
// Archivo: getTutoriaAdminDataController.php

require_once('../config/connection.php'); // Incluye el archivo de conexión

// Consulta SQL actualizada para obtener los datos del estudiante
$sql = "
    SELECT 
        es.nombre AS nombre,
        es.apellido AS apellido,
        es.cod_estudiante AS codigo_estudiante,
        es.telefono AS telefono,
        es.correo_institucional AS correo_institucional
    FROM estudiante es
    JOIN tutoria tu ON es.id = tu.id_estudiante
";
$stmt = $connection->prepare($sql);
$stmt->execute();

// Fetch de los resultados
$tutorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los datos en formato JSON
echo json_encode($tutorias);
?>
