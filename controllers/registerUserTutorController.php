<?php
// Incluir el archivo de conexión a la base de datos
require_once('../config/connection.php');

// Verificar si la conexión se estableció correctamente
if (!isset($connection)) {
    die('No se pudo establecer la conexión con la base de datos.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recoger y limpiar los datos del formulario
        $codigo = $_POST['codigo'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $escuela = $_POST['escuela'];
        $telefono = $_POST['telefono'];
        $dni = $_POST['dni'];
        $correo = $_POST['correo'];
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

        // Consulta para verificar si el código de docente ya está registrado
        $check_query = "SELECT * FROM tutor WHERE codigo_docente = :codigo";
        $stmt = $connection->prepare($check_query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            throw new Exception("El código de docente ya está registrado.");
        }

        // Consulta para verificar si el DNI ya está registrado
        $check_query_dni = "SELECT * FROM tutor WHERE dni = :dni";
        $stmt = $connection->prepare($check_query_dni);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            throw new Exception("El DNI ya está registrado.");
        }

        // Consulta para verificar si el correo electrónico ya está registrado
        $check_query_correo = "SELECT * FROM tutor WHERE correo_institucional = :correo";
        $stmt = $connection->prepare($check_query_correo);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            throw new Exception("El correo institucional ya está registrado.");
        }

        // Consulta para insertar los datos en la base de datos
        $insert_query = "INSERT INTO tutor (nombre, apellido, telefono, correo_institucional, id_escuela, dni, codigo_docente, password) 
                         VALUES (:nombres, :apellidos, :telefono, :correo, :escuela, :dni, :codigo, :password)";
        $stmt = $connection->prepare($insert_query);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':escuela', $escuela);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            // Redirige a la página de éxito
            header("Location: ../views3/view3LoginTutor.php?success=1");
            exit();
        } else {
            throw new Exception("Error al registrar el tutor.");
        }

    } catch (PDOException $e) {
        // Manejo de errores de PDO
        error_log("PDO Error: " . $e->getMessage()); // Registrar error en el archivo de logs
        header("Location: ../views3/view3LoginTutor.php?error=1");
        exit();
    } catch (Exception $e) {
        // Manejo de otros errores
        error_log("Exception: " . $e->getMessage()); // Registrar error en el archivo de logs
        header("Location: ../views3/view3LoginTutor.php.php?error=1");
        exit();
    }
} else {
    // Redirige si el acceso no es por método POST
    header("Location: ../views3/view3LoginTutor.php");
    exit();
}
?>
