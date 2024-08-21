<?php
session_start();
require_once('../config/connection.php');

// Obtener el ID del tutor desde la sesión
$tutor_id = $_SESSION['tutor_id'];

header('Content-Type: application/json');

try {
    // Consultar todas las disponibilidades del tutor
    $query = "SELECT c.nombre as curso, t.fecha as fecha, t.horaInicio as hora_inicio, t.horaFin as hora_fin, t.Modalidad as modalidad, cl.nombre as ciclo,
    e.nombre as escuela, t.comentarios as comentarios
         FROM tutoria as t 
         join cursos as c on t.id_curso = c.id
         join ciclos as cl on cl.id = t.id_ciclo
         join escuela as e on t.id_escuela = e.id
    WHERE id_tutor = :tutor_id";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':tutor_id', $tutor_id);
    $stmt->execute();
    $disponibilidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Devolver los resultados en formato JSON
    echo json_encode($disponibilidades);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al obtener disponibilidades: ' . $e->getMessage()]);
}
?>
