<?php
// Iniciar sesión
session_start();

// Verificar y mostrar el mensaje de éxito
if (isset($_SESSION['message'])) {
    echo '<script>alert("' . $_SESSION['message'] . '");</script>';
    // Limpiar el mensaje de la sesión después de mostrarlo
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Estudiante</title>
    <link rel="stylesheet" href="../assets/css/logins/loginEstudiante.css">
    <link rel="stylesheet" href="../assets/css/logins/loginfooter2.css">
    <link rel="stylesheet" href="../assets/css/logins/viewOlvidarContra.css">
    <!-- Incluir SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Incluir SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .error-message {
            color: red;
            font-size: 1em;
            margin-top: 1em;
        }
        
    </style>

</head>

<body>
    <!-- Contenedor de login -->
    <div class="login-container">

        <?php include '../views/resetPasswordModal.php'; ?>



        <!-- Título del login -->
        <header>
            <h1>ESTUDIANTE</h1>
            <h3>INICIA SESION</h3>
        </header>

        <!-- Formulario de login -->
        <main>
            <form action="../controllers/loginController.php" method="post">
                <input type="text" name="codigo" id="codigo" placeholder="Codigo de estudiante" required>

                <input type="password" name="password" id="password" placeholder="contraseña" required>

                <input type="submit" name="login" value="Entrar">

            </form>
        </main>
        <!-- Espacio para mostrar mensajes de error -->
        <div class="smsError">
            <?php require '../includes/smsError.php'; ?>
        </div>

        <footer class="footer2">
            <?php require '../includes/footerOlvidarResgistrar.php'; ?>

        </footer>


        <!-- Footer para regresar al inicio -->
        <footer class="footer">
            <?php require '../includes/headerLogin.php'; ?>
        </footer>

    </div>


    <!-- Incluir el modal de registro -->
    <?php include '../views/registerUser.php'; ?>
    <script src="../views/resetPasswordModal.js"></script>
    <script src="../views/registerUser.js" defer></script>
    <script src="../assets/js/sms/messageConfirmacionRegist.js"></script>
    <script src="../assets/js/sms/passwordResetSuccess.js"></script>
    

</body>

</html>