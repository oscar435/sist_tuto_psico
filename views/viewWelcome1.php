<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="../assets/css/welcome/welcome1.css">
</head>
<body>
    
    <!-- Contenedor del botón de Administrador -->
    <div class="admin-container">
        <button class="admin-button" onclick="handleIngresar('administrador')">
            <img src="../images/iconos/adminIcon.png" alt="Icono de administrador">
            <span>Administrador</span>
        </button>
    </div>
    
    <!-- Contenedor principal -->
    <div class="container-main">
        <h1>BIENVENIDO AL SISTEMA DE TUTORIA DE FIEI!!</h1>
  
        <h2>Elija la siguiente opción de usuario</h2>
    </div>

    <!-- Contenedor de los botones de Estudiante y Tutor -->
    <div class="buttons-container">
        <!-- Características y funcionalidades del botón Estudiante -->
        <div class="button-group-estudiante">
            <button id="estudiante-btn" onclick="handleIngresar('estudiante')">
                <img src="../images/estudiantes.png" alt="Icono representando estudiante" class="button-icon">
                <span>Estudiante</span>
            </button>
        </div>

        <!-- Características y funcionalidades del botón Tutor -->
        <div class="button-group-tutor">
            <button id="tutor-btn" onclick="handleIngresar('tutor')">
                <img src="../images/tutor.png" alt="Icono representando tutor" class="button-icon">
                <span>Tutor</span>
            </button>
        </div>
    </div>

    <script>
        function handleIngresar(role) {
            switch (role) {
                case 'estudiante':
                    window.location.href = '../views/viewLoginEstudiante.php';
                    break;
                case 'tutor':
                    window.location.href = '../views3/view3LoginTutor.php';
                    break;
                case 'administrador':
                    window.location.href = '../views2/view2LoginAdmin.php';
                    break;
                default:
                    alert('Rol no reconocido.');
            }
        }
    </script>
</body>
</html>
