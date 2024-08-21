<?php
// Archivo: get_courses_by_semester.php
require_once("../config/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_tutoria_estudiante = $_POST['id_tutoria_estudiante'];

    try {
        // Preparar la consulta

        $stmt = $connection->prepare("UPDATE tutoria_estudiante set active = 0 where id = :id_tutoria_estudiante");
        
        // Enlazar los parámetros
        $stmt->bindParam(':id_tutoria_estudiante', $id_tutoria_estudiante);
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados
        $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Devolver los resultados como JSON
        echo json_encode(true);
    } catch (PDOException $e) {
        // Manejar errores
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
