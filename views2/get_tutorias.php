<?php
require_once("../config/connection.php");

try {
    $stmt = $connection->prepare("SELECT curso.nombre as curso, CONCAT(est.nombre, ' ',est.apellido) as nombre_estudiante, est.cod_estudiante as codigo_estudiante,
        est.correo_institucional as estudiante_correo_institucional, escuela.nombre as estudiante_escuela, tuto.fecha as fecha_tutoria, tuto.horaInicio as tutoria_hora_inicio,
        tuto.horaInicio as tutoria_hora_fin, tuto.Modalidad as modalidad, te.motivo as motivo
        FROM tutoria_estudiante as te
        join estudiante as est on te.id_estudiante=est.id   
        join tutoria as tuto on tuto.id =te.id_tutoria
        join cursos as curso on curso.id = tuto.id_curso
        join escuela as escuela on escuela.id= est.id_escuela
        where te.active= 1
        ");
    $stmt->execute();
    $tutorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'tutorias' => $tutorias
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
