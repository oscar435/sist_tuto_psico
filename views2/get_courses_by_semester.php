<?php
// Archivo: get_courses_by_semester.php
require_once("../config/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_ciclo = $_POST['id_ciclo'];
    $id_escuela = $_POST['id_escuela'];

    try {
        // Preparar la consulta

        $stmt = $connection->prepare("SELECT c.id, c.nombre  from cursos as c where id_ciclo= :id_ciclo and  id_escuela= :id_escuela");
        
        // Enlazar los parámetros
        $stmt->bindParam(':id_ciclo', $codigo_docente);
        $stmt->bindParam(':id_escuela', $id_escuela);
        // Ejecutar la consulta
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
