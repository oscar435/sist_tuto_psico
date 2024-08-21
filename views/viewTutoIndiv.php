<?php
// Incluye el archivo de conexión a la base de datos al inicio del archivo
session_start();
require_once('../config/connection.php');

// Verificar si el código del estudiante está en la sesión
if (!isset($_SESSION['session_codigo'])) {
    die('Código del estudiante no encontrado.');
}

// Verificar si los datos del estudiante están en la sesión
if (isset($_SESSION['studentData'])) {
    $studentData = $_SESSION['studentData'];
    $studentCode = $_SESSION['session_codigo'];
    $studentName = $_SESSION['session_fullname'];
    $id_student_escuela = $_SESSION['session_id_escuela'];
} else {
    // Intentar obtener los datos del estudiante desde la base de datos
    $studentCode = $_SESSION['session_codigo'];

    try {
        $query = $connection->prepare('SELECT est.semestre as semestre, esc.nombre as escuela  FROM estudiante as est
        join escuela as esc on est.id_escuela= esc.id
        WHERE cod_estudiante = :cod_estudiante');
        $query->execute(['cod_estudiante' => $studentCode]);
        $studentData = $query->fetch(PDO::FETCH_ASSOC);

        if ($studentData) {
            $_SESSION['studentData'] = $studentData;
            $studentName = $_SESSION['session_fullname'];
        } else {
            die('Datos del estudiante no encontrados.');
        }
    } catch (PDOException $e) {
        die("Error al consultar la base de datos: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Tutoría </title>
    <link rel="stylesheet" href="../assets/css/formTutoIndiv/formTutoIndiv1.css">
    <script src="../assets/js/formularios/formIndiv.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="container" style="max-width: 80% !important;">
        <div>
            <div>
                <button class="btn btn-primary button-estudiante-opciones" onclick="window.location.href='get_all_tutorias_bandeja.php'">
                    <!-- <img src="../images/icon_individual.png" alt="Tutoría Individual" class="button-icon"> -->
                    <span>REGRESAR</span>
                </button>
                <h2>SOLICITUD DE TUTORIA</h2>
            </div>


            <form id="tutoriaIndividualForm" action="process_tuto_indiv.php" method="post">

                <!-- Campos ocultos para código del estudiante y nombre completo -->
                <input type="hidden" id="codigo_estudiante" name="codigo_estudiante" value="<?php echo htmlspecialchars($studentCode); ?>"> <!-- Cambiar a valor dinámico -->
                <input type="hidden" id="nombre_completo" name="nombre_completo" value="<?php echo htmlspecialchars($studentName); ?>"> <!-- Cambiar a valor dinámico -->
                <input type="hidden" id="id_tutoria_seleccionada" name="id_tutoria_seleccionada"> <!-- Cambiar a valor dinámico -->



                <div class="input-group">
                    <label for="motivo">Motivo de la solicitud: ¿Por qué estás solicitando tutoría?</label>
                    <select class="select1" id="motivo" name="motivo" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="Dificultades en la materia">Dificultades en un curso</option>
                        <option value="Preparación para exámenes">Preparación para exámenes</option>
                        <option value="Asesoramiento en proyectos">Asesoramiento en proyectos</option>
                        <option value="Orientación profesional">Orientación profesional</option>
                        <option value="Otro">Otro</option>
                    </select>
                    <textarea id="motivo_otro" name="motivo_otro" rows="4" placeholder="Por favor, especifique" style="display: none;"></textarea>
                </div>


                <?php
                // Consulta de docentes y generación del select
                try {
                    // Consulta para obtener tutores disponibles
                    $stmt = $connection->prepare('
                      SELECT * from cursos where id_escuela=:id_escuela
                  ');
                    $stmt->bindParam(':id_escuela', $_SESSION['session_id_escuela'], PDO::PARAM_INT);
                    $stmt->execute();
                    $cursosDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    $cursosDisponibles = []; // Dejar vacío si hay error
                    echo 'Error al cargar cursos: ' . $e->getMessage();
                }
                ?>

                <div class="input-group">
                    <label for="curso">Curso: </label>
                    <select id="curso" name="curso" required>
                        <option value="" disabled selected>Seleccione un curso</option>
                        <?php if (!empty($cursosDisponibles)) : ?>
                            <?php foreach ($cursosDisponibles as $curso) : ?>
                                <option value="<?php echo htmlspecialchars($curso['id']); ?>">
                                    <?php echo htmlspecialchars($curso['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">No hay cursos disponibles</option>
                        <?php endif; ?>
                    </select>
                </div>


                <div id="tableContainer"></div>

                <!-- Contenedor para mostrar las disponibilidades del docente seleccionado -->
                <div class="input-group" id="disponibilidad-container">
                    <!-- Aquí se cargarán las disponibilidades mediante AJAX -->
                </div>


                <!-- Titulos de preguntas con respecto a la tutoria-->

                <h3></h3>

                <!-- Pregunta tipo de tutoria
            <div class="input-group">
              <label for="tutoria">Tipo de tutoría que desea recibir:</label>
              <select id="tutoria" name="tutoria" required>
                <option value="" disabled selected>Seleccione un tipo de tutoría</option>
                <option value="Tutoría individual">Tutoría individual</option>
                <option value="Tutoría grupal">Tutoría grupal</option>
              </select><br><br>
            </div>-->



                <!--Primera Pregunta
            <div class="input-group">
                <label for="motivo">Motivo de la solicitud: ¿Por qué estás solicitando tutoría?</label>
                <select class="select1" id="motivo" name="motivo" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Dificultades en la materia">Dificultades en un curso</option>
                    <option value="Preparación para exámenes">Preparación para exámenes</option>
                    <option value="Asesoramiento en proyectos">Asesoramiento en proyectos</option>
                    <option value="Orientación profesional">Orientación profesional</option>
                    <option value="Otro">Otro</option>
                </select>
                <textarea id="motivo_otro" name="motivo_otro" rows="4" placeholder="Por favor, especifique" style="display: none;"></textarea>
            </div>-->


                <!--Tercera Pregunta
             <div class="input-group 3">
                <label for="expectativas">Expectativas de la tutoría: ¿Qué espera lograr a través de esta tutoría?</label>
                <select id="expectativas" name="expectativas" required>
                   <option value="" disabled selected>Seleccione una opción</option>
                   <option value="Mejorar en asignaturas específicas">Mejorar en asignaturas específicas</option>
                   <option value="Desarrollar habilidades de estudio">Desarrollar habilidades de estudio</option>
                   <option value="Asesoramiento para proyectos">Asesoramiento para proyectos</option>
                   <option value="Preparación para futuros estudios">Preparación para futuros estudios</option>
                   <option value="Otro">Otro</option>
                </select>
                  <textarea id="expectativas_otro" name="expectativas_otro" rows="4" placeholder="Por favor, especifique" style="display: none;"></textarea>
            </div>-->

                <!--Cuarta Pregunta
             <div class="input-group">
                <label for="preferencia">¿Cómo prefieres recibir la tutoría?</label>
                <select id="preferencia" name="preferencia" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Presencial">Presencial</option>
                    <option value="En línea">En línea</option>
                    <option value="Combinación de ambas(Presencial y en Linea)">Combinación de ambas (presencial y en línea)</option>
                </select>
             </div>-->

                <!-- Quinta Pregunta-->
                <!--<div class="input-group">
                <label for="tiempo">¿Cuánto tiempo estás dispuesto a dedicar a la tutoría semanalmente?</label>
                <select id="tiempo" name="tiempo" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="1-2 horas">1-2 horas</option>
                    <option value="3-5 horas">3-5 horas</option>
                    <option value="Más de 5 horas">Más de 5 horas</option>
                </select>
            </div>-->

                <!-- Sexta pregunta -->
                <!--<div class="input-group">
                <label for="recursos">¿Qué recursos consideras más útiles para tu aprendizaje?seleccione:</label>
                <select id="recursos" name="recursos[]" multiple required>
                    <option value="Materiales de lectura adicionales">Materiales de lectura adicionales</option>
                    <option value="Ejercicios prácticos">Ejercicios prácticos</option>
                    <option value="Sesiones de preguntas y respuestas">Sesiones de preguntas y respuestas</option>
                    <option value="Demostraciones prácticas">Demostraciones prácticas</option>
                </select>-->
        </div>

        <!--Septima Pregunta-->
        <!--<div class="input-group">
                <label for="requerimientos">¿Tienes algún requerimiento especial o necesidad de adaptación para la tutoría? Seleccione:</label>
                <select id="requerimientos" name="requerimientos[]" multiple required>
                    <option value="Acceso a materiales en formatos específicos">Acceso a materiales en formatos específicos</option>
                    <option value="Horario flexible debido a compromisos personales o laborales">Horario flexible debido a compromisos personales o laborales</option>
                    <option value="Otras necesidades">Otras necesidades</option>
                </select>
            </div>-->


        <!--Pregunta de correo y numero-->
        <!--<div class="input-group form-horizontal">
                  <h3>¿Necesitas más información? Bríndanos los siguientes datos:</h3>
                <div class="input-group-inner">
                   <div class="input-group telefono">
                     <label for="telefono">Teléfono:</label>
                     <input type="tel" id="telefono" name="telefono" placeholder="000-000-000" required>
                   </div>
                   <div class="input-group correo">
                     <label for="email">Correo personal:</label>
                    <input type="email" id="email" name="email" placeholder="ejemplo@gmail.com"  required>
                    </div>
                </div>
            </div>-->

        <button type="submit" value="Enviar solicitud">Enviar Solicitud</button>

        </form>
    </div>
    </div>
    <script src="../views/getDisponibilidadForm.js"></script>
    <script src="../views/obtenerNameDocentePDF.js"></script>

</body>

</html>