<?php
session_start();
require_once('../config/connection.php'); // Incluir la conexión PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Verificar que el ID del tutor esté disponible en la sesión
        if (!isset($_SESSION['tutor_id'])) {
            throw new Exception('ID del tutor no disponible en la sesión.');
        }

        // Obtener el ID del tutor desde la sesión

        $idCiclo = $_POST['ciclo'];
        $idCurso = $_POST['curso'];
        $fecha = $_POST['fecha'];
        $horaInicio = $_POST['horaInicio'];
        $horaFin = $_POST['horaFin'];
        $modalidad = $_POST['modalidad'];
        $comentarios = $_POST['comentarios'];
        $id_escuela = $_SESSION['id_escuela'];
        $id_tutor = $_SESSION['tutor_id'];


// // Insertar los datos en la base de datos usando PDO
$sql = "INSERT INTO tutoria (id_curso,fecha,horaInicio,horaFin,Modalidad,comentarios,id_tutor,id_ciclo,id_escuela)
        VALUES (:id_curso, :fecha, :horaInicio, :horaFin, :Modalidad, :comentarios, :id_tutor, :id_ciclo, :id_escuela)";


        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id_curso', $idCurso);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':horaInicio', $horaInicio);
        $stmt->bindParam(':horaFin', $horaFin);
        $stmt->bindParam(':Modalidad', $modalidad);
        $stmt->bindParam(':comentarios', $comentarios);
        $stmt->bindParam(':id_tutor', $id_tutor);
        $stmt->bindParam(':id_ciclo', $idCiclo);
        $stmt->bindParam(':id_escuela', $id_escuela);

   // Ejecutar la consulta
        if ($stmt->execute()) {
            header("Location: view3homeTutor.php?success=1");
            exit();
        } else {
            throw new Exception('Error al guardar la disponibilidad.');
        }





        // // Obtener los datos del formulario
        // $cursos = isset($_POST['cursos']) ? $_POST['cursos'] : array();
        // $curso_1 = isset($cursos[0]) ? $cursos[0] : null;
        // $curso_2 = isset($cursos[1]) ? $cursos[1] : null;
        // $curso_3 = isset($cursos[2]) ? $cursos[2] : null;
        // $curso_4 = isset($cursos[3]) ? $cursos[3] : null;
        // $fecha = $_POST['fecha'];
        // $turno = $_POST['turno'];
        // $horas = $_POST['horas'];
        // $modalidad = $_POST['modalidad'];
        // $comentarios = $_POST['comentarios'];

        // // Verificar que los campos obligatorios no estén vacíos
        // if (empty($fecha) || empty($turno) || empty($horas) || empty($modalidad)) {
        //     throw new Exception('Por favor, complete todos los campos obligatorios.');
        // }

        // // Insertar los datos en la base de datos usando PDO
        // $sql = "INSERT INTO disponibilidad_docentes (tutor_id, curso_1, curso_2, curso_3, curso_4, fecha, turno, horas, modalidad, comentarios)
        //         VALUES (:tutor_id, :curso_1, :curso_2, :curso_3, :curso_4, :fecha, :turno, :horas, :modalidad, :comentarios)";

        // $stmt = $connection->prepare($sql);
        // $stmt->bindParam(':tutor_id', $tutor_id);
        // $stmt->bindParam(':curso_1', $curso_1);
        // $stmt->bindParam(':curso_2', $curso_2);
        // $stmt->bindParam(':curso_3', $curso_3);
        // $stmt->bindParam(':curso_4', $curso_4);
        // $stmt->bindParam(':fecha', $fecha);
        // $stmt->bindParam(':turno', $turno);
        // $stmt->bindParam(':horas', $horas);
        // $stmt->bindParam(':modalidad', $modalidad);
        // $stmt->bindParam(':comentarios', $comentarios);

        // // Ejecutar la consulta
        // if ($stmt->execute()) {
        //     header("Location: view3homeTutor.php?success=1");
        //     exit();
        // } else {
        //     throw new Exception('Error al guardar la disponibilidad.');
        // }



    } catch (Exception $e) {
        echo 'Error: ' . htmlspecialchars($e->getMessage());
    } catch (PDOException $e) {
        echo 'Error de base de datos: ' . htmlspecialchars($e->getMessage());
    }
}
?>
