<?php
// Incluir el archivo de conexión a la base de datos
require_once('../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recoger y limpiar los datos del formulario
        $codigo_docente = $_POST['codigo_docente'];
        $dni = $_POST['DNI'];
        $nueva_contraseña = $_POST['nueva_contraseña'];
        $confirmar_contraseña = $_POST['confirmar_contraseña'];

        // Validación de contraseñas
        if ($nueva_contraseña !== $confirmar_contraseña) {
            throw new Exception("Las contraseñas no coinciden.");
        }

        // Hash de la nueva contraseña para mayor seguridad
        $hashed_password = password_hash($nueva_contraseña, PASSWORD_BCRYPT);

        // Consulta para verificar si el código de docente y el DNI coinciden
        $check_query = "SELECT * FROM tutor WHERE codigo_docente = :codigo_docente AND dni = :dni";
        $stmt = $connection->prepare($check_query);
        $stmt->bindParam(':codigo_docente', $codigo_docente);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();

        // Verificar si se encontró el docente
        if ($stmt->rowCount() > 0) {
            // Actualizar la contraseña del docente
            $update_query = "UPDATE tutor SET password = :password WHERE codigo_docente = :codigo_docente AND dni = :dni";
            $stmt = $connection->prepare($update_query);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':codigo_docente', $codigo_docente);
            $stmt->bindParam(':dni', $dni);

            if ($stmt->execute()) {
                // Redirigir con mensaje de éxito
                header("Location: ../views3/view3LoginTutor.php?reset_success=true");
                exit();
            } else {
                throw new Exception("Error al actualizar la contraseña.");
            }
        } else {
            throw new Exception("Código de docente o DNI incorrectos.");
        }

    } catch (PDOException $e) {
        // Manejo de errores de PDO
        header("Location: ../views3/view3LoginTutor.php?error=1");
        exit();
    } catch (Exception $e) {
        // Manejo de otros errores
        header("Location: ../views3/view3LoginTutor.php?error=1&message=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    // Redirigir si el acceso no es por método POST
    header("Location: ../views3/view3LoginTutor.php");
    exit();
}
?>
