<?php
require_once("../config/connection.php");
ini_set('session.gc_maxlifetime', 86400); // 1 día en segundos
session_set_cookie_params(86400); // 1 día en segundos
session_start();

if (isset($_POST["login"])) {
    if (!empty($_POST['codigo']) && !empty($_POST['password'])) {
        $codigo = $_POST['codigo'];
        $password = $_POST['password'];

        $query = $connection->prepare("SELECT * FROM estudiante WHERE cod_estudiante = :codigo");
        $query->bindParam(":codigo", $codigo, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $message = "Código de estudiante o contraseña inválida.";
        } else {
            // Verificar la contraseña usando password_verify
            if (password_verify($password, $result['password'])) {
                // Guardar la información del estudiante en la sesión
                $_SESSION['session_codigo'] = $codigo;
                $_SESSION['session_fullname'] = $result['nombre'] . ' ' . $result['apellido'];
                $_SESSION['session_semestre'] = $result['semestre'];
                $_SESSION['session_escuela'] = $result['escuela'];
                $_SESSION['session_id_escuela'] = $result['id_escuela'];
                $_SESSION['id_estudiante'] = $result['id'];

                
                header("Location: ../views/viewHome1.php");
                exit();
            } else {
                $message = "Código de estudiante o contraseña inválida.";
            }
        }
    } else {
        $message = "Todos los campos son requeridos.";
    }

    // Redirigir al formulario con un mensaje de error
    if (!empty($message)) {
        header("Location: ../views/viewLoginEstudiante.php?error=" . urlencode($message));
        exit();
    }
}
