<?php
// Incluir el archivo de conexión a la base de datos
require_once('../config/connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recoge y limpia los datos del formulario
        $codigo = $_POST['codigo'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $escuela = $_POST['escuela'];
        $telefono = $_POST['telefono'];
        $dni = $_POST['dni'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validación de contraseñas
        if ($password !== $confirm_password) {
            throw new Exception("Las contraseñas no coinciden.");
        }

        // Hash de la contraseña para mayor seguridad
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Generar correo institucional
        $correo_institucional = $codigo . "@unfv.edu.pe";

        // Consulta para verificar si el código de estudiante ya está registrado
        $check_query = "SELECT * FROM estudiante WHERE cod_estudiante = :codigo";
        $stmt = $connection->prepare($check_query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            throw new Exception("El código de estudiante ya está registrado.");
        }

        // Consulta para insertar los datos en la base de datos
        $insert_query = "INSERT INTO estudiante (cod_estudiante, nombre, apellido, telefono, correo_institucional, password, id_escuela, dni) 
                         VALUES (:codigo, :nombres, :apellidos, :telefono, :correo_institucional, :password, :escuela, :dni)";
        $stmt = $connection->prepare($insert_query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo_institucional', $correo_institucional);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':escuela', $escuela);
        $stmt->bindParam(':dni', $dni);

        if ($stmt->execute()) {
            // Redirige a la página de login con parámetro de éxito
            header("Location: ../views/viewLoginEstudiante.php?success=1");
            exit();
        } else {
            throw new Exception("Error al registrar el estudiante.");
        }

    } catch (PDOException $e) {
        // Manejo de errores de PDO
        // Puedes redirigir a una página de error si lo deseas
        header("Location: ../views/viewLoginEstudiante.php?error=1");
        exit();
    } catch (Exception $e) {
        // Manejo de otros errores
        // Puedes redirigir a una página de error si lo deseas
        header("Location: ../views/viewLoginEstudiante.php?error=1");
        exit();
    }
} else {
    // Redirige si el acceso no es por método POST
    header("Location: ../views/viewLoginEstudiante.php");
    exit();
}
?>
