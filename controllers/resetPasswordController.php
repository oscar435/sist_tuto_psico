<?php
// Incluir el archivo de conexión a la base de datos
require_once('../config/connection.php');

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recoge y limpia los datos del formulario
        $codigo_estudiante = $_POST['codigo_estudiante'];
        $dni = $_POST['DNI'];
        $nueva_contraseña = $_POST['nueva_contraseña'];
        $confirmar_contraseña = $_POST['confirmar_contraseña'];

        // Validación de contraseñas
        if ($nueva_contraseña !== $confirmar_contraseña) {
            throw new Exception("Las contraseñas no coinciden.");
        }

        // Hash de la nueva contraseña para mayor seguridad
        $hashed_password = password_hash($nueva_contraseña, PASSWORD_BCRYPT);

        // Verificar si el código de estudiante y el DNI coinciden
        $check_query = "SELECT * FROM estudiante WHERE cod_estudiante = :codigo_estudiante AND dni = :dni";
        $stmt = $connection->prepare($check_query);
        $stmt->bindParam(':codigo_estudiante', $codigo_estudiante);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Actualizar la contraseña
            $update_query = "UPDATE estudiante SET password = :password WHERE cod_estudiante = :codigo_estudiante";
            $stmt = $connection->prepare($update_query);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':codigo_estudiante', $codigo_estudiante);

            if ($stmt->execute()) {
                // Redirigir con el parámetro de éxito en la URL
                header("Location: ../views/viewLoginEstudiante.php?reset_success=true");
                exit();
            } else {
                throw new Exception("Error al actualizar la contraseña.");
            }
        } else {
            throw new Exception("Código de estudiante o DNI incorrecto.");
        }
    } catch (PDOException $e) {
        // Manejo de errores de PDO
        echo "Error en la base de datos: " . $e->getMessage();
    } catch (Exception $e) {
        // Manejo de otros errores
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirige si el acceso no es por método POST
    header("Location: ../views/viewLoginEstudiante.php");
    exit();
}
?>
