<form id="gestion-disponibilidad" method="POST" action="procesarDisponibilidad.php">
    <h2>Registro de Disponibilidad</h2>

    <!-- Información del Docente -->
    <div class="gestion-form-group">
        <h4>INFORMACIÓN DEL DOCENTE:</h4>
        <div class="gestion-horizontal-group">
            <div class="gestion-input-wrapper">
                <label for="nombre-docente">Nombre:</label>
                <input type="text" id="nombre-docente" name="nombre-docente" value="<?php echo htmlspecialchars($tutor_nombre); ?>" readonly>
            </div>
            <div class="gestion-input-wrapper">
                <label for="apellido-docente">Apellido:</label>
                <input type="text" id="apellido-docente" name="apellido-docente" value="<?php echo htmlspecialchars($tutor_apellido); ?>" readonly>
            </div>
            <div class="gestion-input-wrapper">
                <label for="codigo-docente">Código de Docente:</label>
                <input type="text" id="codigo-docente" name="codigo-docente" value="<?php echo htmlspecialchars($tutor_codigo); ?>" readonly>
            </div>
        </div>
    </div>

    <!-- Cursos que Enseña -->
    <div class="gestion-form-group">
        <h4>CURSOS QUE ENSEÑA: </h4>
        <div class="gestion-horizontal-group">
            <div class="gestion-input-wrapper">

                <label for="ciclo">Selecciona el Ciclo:</label>
                <div class="input-group">
                    <?php
                    require_once('../config/connection.php');

                    // Consulta de docentes y generación del select
                    try {
                        // Consulta para obtener tutores disponibles
                        $stmt = $connection->prepare('
                      SELECT c.id, c.nombre from ciclos as c;
                  ');
                        $stmt->execute();
                        $ciclosDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        $ciclosDisponibles = []; // Dejar vacío si hay error
                        echo 'Error al cargar ciclos: ' . $e->getMessage();
                    }
                    $selectedCiclo = isset($_GET['ciclo']) ? intval($_GET['ciclo']) : null;
                    $cursosDisponibles = [];

                    echo "Ciclo seleccionado: " . $selectedCiclo;

                    if ($selectedCiclo) {
                        try {
                            // Consulta para obtener cursos basados en el ciclo seleccionado
                            $stmt = $connection->prepare('SELECT c.id, c.nombre FROM cursos AS c WHERE c.id_ciclo = 1 AND c.id_escuela = 1');

                            $stmt->execute();
                            $cursosDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo 'Error al cargar cursos: ' . $e->getMessage();
                        }
                    }
                    ?>

                    <select id="ciclo" name="ciclo" required>
                    <option value="">Seleccionar ciclo</option>
                        <?php if (!empty($ciclosDisponibles)) : ?>
                            <?php foreach ($ciclosDisponibles as $ciclo) : ?>
                                <option value="<?php echo htmlspecialchars($ciclo['id']); ?>">
                                    <?php echo htmlspecialchars($ciclo['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">No hay docentes disponibles</option>
                        <?php endif; ?>
                    </select><br><br>

                    <div class="gestion-horizontal-group" id="cursos-wrapper">
                        <div class="gestion-input-wrapper">
                            <label for="curso">Curso:</label>
                            <select id="curso" name="curso">
                                <option value="">Seleccione curso</option>
                            </select>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <!-- Fecha, Turno, Horas y Modalidad -->
        <div class="gestion-form-group">
            <h4>FECHA, HORAS Y MODALIDAD EN LAS QUE DESEA DAR LA TUTORÍA:</h4>
            <div class="gestion-horizontal-group">
                <div class="gestion-input-wrapper">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" required min="2024-08-21" max="2024-12-25">
                </div>

                <div class="gestion-input-wrapper">
                    <label for="horaInicio">Hora de Inicio:</label>
                    <input type="time" id="horaInicio" name="horaInicio" required>
                </div>

                <div class="gestion-input-wrapper">
                    <label for="horaFin">Hora de Fin:</label>
                    <input type="time" id="horaFin" name="horaFin" required>
                </div>

                <div class="gestion-input-wrapper">
                    <label for="modalidad">Modalidad de Tutoría:</label>
                    <select id="modalidad" name="modalidad" required>
                        <option value="" disabled selected>Selecciona la modalidad</option>
                        <option value="virtual">Virtual</option>
                        <option value="presencial">Presencial</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Comentarios -->
        <div class="gestion-form-group">
            <h4>Comentarios</h4>
            <div class="gestion-input-wrapper">
                <label for="comentarios">Comentarios:</label>
                <textarea id="comentarios" name="comentarios" rows="3" placeholder="Ingrese algún comentario adicional"></textarea>
            </div>
        </div>

        <!-- Botón de Envío -->
        <div class="gestion-form-group gestion-buttons-container">
            <button type="submit" id="btn-gestion-disponibilidad">Registrar Disponibilidad</button>
        </div>
</form>