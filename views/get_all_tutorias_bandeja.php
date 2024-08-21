<?php
session_start();
if (!isset($_SESSION['session_codigo'])) {
    header("Location: ../views/viewLoginEstudiante.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/home/header_estudiante.css">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>

    <?php include '../includes/headerHome1.php'; ?>
    <div class="row align-buttons-end mt-2">
    <div class="col-3 ">
        <button class="btn btn-primary button-estudiante-opciones" onclick="window.location.href='viewTutoIndiv.php'">
            <i class="fa-solid fa-chalkboard-user"></i>
            <!-- <img src="../images/icon_individual.png" alt="Tutoría Individual" class="button-icon"> -->
            <span>REGISTRAR TUTORIA</span>
        </button>
    </div>
    </div>

    <div class="container">
        <?php
        require_once('../config/connection.php');

        try {
            // Consulta para obtener cursos basados en el ciclo seleccionado
            $stmt = $connection->prepare('SELECT  te.id as tutoria_id, te.motivo as motivo, t.fecha as fecha, t.horaInicio hora_inicio,
            t.horaFin as hora_fin, t.Modalidad as modalidad, esc.nombre as escuela, tutor.nombre as tutor_nombre,
            curso.nombre as curso_nombre
            FROM tutoria_estudiante AS te 
            join tutoria as t on te.id_tutoria = t.id
            join cursos as curso on curso.id =t.id_curso
            join escuela as esc on t.id_escuela = esc.id
            join tutor as tutor on  tutor.id = t.id_tutor
            WHERE te.id_estudiante =:id_estudiante  and te.active=1');
            $stmt->bindParam(':id_estudiante', $_SESSION['id_estudiante'], PDO::PARAM_INT);
            $stmt->execute();
            $tutorias_alumno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error al cargar los alumnos: ' . $e->getMessage();
        }


        // Verificar si hay datos para mostrar
        if (!empty($tutorias_alumno)) {
            echo '<table class="table table-striped table-bordered" style="margin-top:20px">';
            echo '<thead class="thead-dark">';
            echo '<tr><th>Tutor</th><th>Curso</th><th>Fecha</th><th>Hora Inicio</th><th>Hora Fin</th><th>Escuela</th><th>Modalidad</th><th>Motivo</th><th>Acciones</th></tr>';
            echo '</thead>';
            echo '<tbody>';

            // Iterar sobre los resultados para construir la tabla
            // Iterar sobre los resultados para construir la tabla
            foreach ($tutorias_alumno as $tutoria) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($tutoria['tutor_nombre']) . '</td>';
                echo '<td>' . htmlspecialchars($tutoria['curso_nombre']) . '</td>';
                echo '<td>' . htmlspecialchars($tutoria['fecha']) . '</td>';
                echo '<td>' . htmlspecialchars($tutoria['hora_inicio']) . '</td>';
                echo '<td>' . htmlspecialchars($tutoria['hora_fin']) . '</td>';
                echo '<td>' . htmlspecialchars($tutoria['escuela']) . '</td>';
                echo '<td>' . htmlspecialchars($tutoria['modalidad']) . '</td>';
                echo '<td>' . htmlspecialchars($tutoria['motivo']) . '</td>';
                echo '<td>';
                echo '<a href="editar_tutoria.php?id=' . htmlspecialchars($tutoria['tutoria_id']) . '" class="btn btn-primary btn-sm" style="margin-bottom: 2px">Editar</a> ';
                echo '<button class="btn btn-danger btn-sm" onclick="confirmarEliminar(' . htmlspecialchars($tutoria['tutoria_id']) . ')">Eliminar</button>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'No se encontraron tutorías para este estudiante.';
        }
        ?>
    </div>

</body>
<script src="../views/get_all_tutorias_bandeja.js"></script>

</html>