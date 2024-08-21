<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Tutor</title>
    <link rel="stylesheet" href="../assets/css/logins/loginTutor.css">
    <link rel="stylesheet" href="../assets/css/logins/loginfooter2Tutor.css">
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

        <?php include '../views3/resetPasswordModalTutor.php'; ?>
        <?php include '../views3/registerUserTutor.php'; ?>
        <!-- Título del login -->
        <header>
            <h1>TUTOR</h1>
            <h3>INICIA SESION</h3>
        </header>

        <!-- Formulario de login -->
        <main>
            <form action="../controllers/loginControllerTutor.php" method="post">
                <input type="text" name="teacher_code" id="teacher_code" placeholder="Código de docente" required>

                <input type="password" name="tutor_password" id="tutor_password" placeholder="Contraseña" required>

                <input type="submit" name="loginTutor" value="Entrar">
            </form>
        </main>

        <!-- Espacio para mostrar mensajes de error -->
        <div class="smsErrorTutor">
            <?php require '../includes/smsErrorTutor.php'; ?>
        </div>


        <footer class="footer2">
            <?php require '../includes/footerOlvidarResgisTutor.php'; ?>
        </footer>


        <!-- Footer para regresar al inicio -->
        <footer class="footer">
            <?php require '../includes/headerLogin.php'; ?>
        </footer>
    </div>

    <script src="../views3/resetPasswordModalTutor.js"></script>
    <script src="../views3/registerUserTutor.js"></script>
    <script src="../assets/js/sms/messgConfirmRegisTutor.js"></script>
    <script src="../assets/js/sms/passwordResetSuccessTutor.js"></script>
</body>

</html>