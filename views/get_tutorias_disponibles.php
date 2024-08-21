<?php
// Archivo: get_tutorias_disponibles.php
require_once("../config/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_curso = $_POST['id_curso'];
    try {
        // Preparar la consulta

        $stmt = $connection->prepare

        ("SELECT t.id as id_tutoria,c.nombre as nombre_curso, t.modalidad as modalidad, t.fecha as fecha, t.horaInicio as hora_inicio, t.horaFin as hora_fin,
            t.comentarios as comentario, CONCAT(tut.nombre,' ',tut.apellido) as nombre_tutor, ciclo.nombre as nombre_ciclo,  e.nombre as nombre_escuela
            from tutoria  as t
            join cursos  as c on t.id_curso=c.id
            join tutor as tut on tut.id=t.id_tutor
            join ciclos as ciclo on ciclo.id = t.id_ciclo
            join escuela as e on e.id = t.id_escuela
            where id_curso = :id_ciclo and t.fecha >= NOW()");
        
        // Enlazar los parámetros
        $stmt->bindParam(':id_ciclo', $id_curso);
        //Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados
        $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Devolver los resultados como JSON
        echo json_encode($cursos);
    } catch (PDOException $e) {
        // Manejar errores
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
