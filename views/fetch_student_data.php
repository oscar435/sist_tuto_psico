<?php
require_once('../config/connection.php'); // Incluye la conexión a la base de datos

// Verifica si los datos del estudiante ya están en la sesión
if (isset($_SESSION['studentData'])) {
    // Para el contexto de generación de PDF, no enviamos JSON
    return; // Terminamos la ejecución aquí
}

// Verifica si el código del estudiante está en la sesión
if (!isset($_SESSION['session_codigo'])) {
    throw new Exception('Código del estudiante no encontrado.');
}

$studentCode = $_SESSION['session_codigo'];


try {
    // Ajusta la consulta para incluir telefono y correo_institucional
    $query = $connection->prepare('
        SELECT 
            t.id_curso,
            c.nombre AS nombre_curso,
            t.fecha,
            t.horaInicio,
            t.horaFin,
            t.Modalidad,
            t.comentarios,
            t.id_tutor,
            u.nombre AS nombre_tutor,
            u.apellido AS apellido_tutor,
            t.id_ciclo,
            ci.nombre AS nombre_ciclo,
            t.id_escuela,
            e.nombre AS nombre_escuela
        FROM tutoria t
        JOIN cursos c ON t.id_curso = c.id
        JOIN tutor u ON t.id_tutor = u.id
        JOIN ciclos ci ON t.id_ciclo = ci.id
        JOIN escuela e ON t.id_escuela = e.id
        WHERE t.cod_estudiante = :cod_estudiante
    ');
    $query->execute(['cod_estudiante' => $studentCode]);
    $studentData = $query->fetch(PDO::FETCH_ASSOC);

    if ($studentData) {

        // Guardar los datos en la sesión
        $_SESSION['studentData'] = $studentData;
    } else {
        throw new Exception('Datos del estudiante no encontrados.');
    }
} catch (PDOException $e) {
    throw new Exception("Error al consultar la base de datos: " . $e->getMessage());
}
?>
