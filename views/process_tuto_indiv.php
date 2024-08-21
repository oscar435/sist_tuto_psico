<?php

session_start(); // Inicia la sesión
require_once('../config/connection.php'); // Incluir la conexión PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // Obtener datos del formulario
        $id_tutoria_seleccionada = $_POST['id_tutoria_seleccionada'];
        $motivo = $_POST['motivo'] ?? $_POST['motivo_otro'];
        $id_estudiante = $_SESSION['id_estudiante'];

        // Insertar los datos en la base de datos usando PDO
        $sql = "INSERT INTO tutoria_estudiante (id_tutoria, id_estudiante, motivo, active)
                VALUES (:id_tutoria_seleccionada, :id_estudiante, :motivo, 1)";

        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id_tutoria_seleccionada', $id_tutoria_seleccionada);
        $stmt->bindParam(':motivo', $motivo);
        $stmt->bindParam(':id_estudiante', $id_estudiante);

        if ($stmt->execute()) {
            // Preparar los datos para el PDF
            $formData2 = array(
                'nombre_completo' => $_POST['nombre_completo'] ?? '',
                'codigo_estudiante' => $_POST['codigo_estudiante'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'cursos' => $_POST['cursos'] ?? '',
                'motivo' => $_POST['motivo'] ?? '',
                'motivo_otro' => $_POST['motivo_otro'] ?? '',
            );

            // Almacenar los datos del formulario en la sesión para el PDF
            $_SESSION['tutoria_individual'] = $formData2;

            // Redirige al script de generación del PDF
            header('Location: generate_pdf_tutoIndiv.php');
            exit();
        } else {
            throw new Exception('Error al guardar la disponibilidad.');
        }
    } catch (PDOException $e) {
        echo 'Error de base de datos: ' . htmlspecialchars($e->getMessage());
    } catch (Exception $e) {
        echo 'Error: ' . htmlspecialchars($e->getMessage());
    }
}
