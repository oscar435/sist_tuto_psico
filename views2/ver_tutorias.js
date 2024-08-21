document.addEventListener("DOMContentLoaded", function() {
    const verTutoriasLink = document.getElementById("ver-tutorias");
    const tutoriaGrupalLink = document.getElementById("tutoria-grupal");
    const mainContent = document.getElementById("main-content");

    function clearContent() {
        mainContent.innerHTML = '';  // Limpia el contenido previo
    }

    verTutoriasLink.addEventListener("click", function(event) {
        event.preventDefault();
        clearContent();  // Limpia antes de cargar nuevo contenido

        // Realizar la solicitud AJAX al servidor para obtener las tutorías
        fetch('../views2/get_tutorias.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    mainContent.innerHTML = `<p>Error: ${data.error}</p>`;
                } else {
                    // Generar la tabla HTML con todas las columnas especificadas
                    let tablaHTML = '<table>';
                    tablaHTML += `
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Nombre del Estudiante</th>                           
                                <th>Código del Estudiante</th>
                                <th>Correo Institucional</th>
                                <th>Escuela</th>
                                <th>Fecha</th>
                                <th>Hora de Inicio</th>
                                <th>Hora Fin</th>
                                <th>Modalidad</th>
                                <th>Motivo</th>

                            </tr>
                        </thead>
                        <tbody>`;

                    data.tutorias.forEach(tutoria => {
                        tablaHTML += `
                            <tr>
                                <td>${tutoria.curso}</td>
                                <td>${tutoria.nombre_estudiante}</td>
                                <td>${tutoria.codigo_estudiante}</td>
                                <td>${tutoria.estudiante_correo_institucional}</td>
                                <td>${tutoria.estudiante_escuela}</td>
                                <td>${tutoria.fecha_tutoria}</td>
                                <td>${tutoria.tutoria_hora_inicio}</td>
                                <td>${tutoria.tutoria_hora_fin}</td>
                                <td>${tutoria.modalidad}</td>
                                <td>${tutoria.motivo}</td>
                            </tr>`;
                    });

                    tablaHTML += '</tbody></table>';
                    mainContent.innerHTML = tablaHTML;
                }
            })
            .catch(error => {
                mainContent.innerHTML = `<p>Error: ${error.message}</p>`;
            });
    });

    // Manejar "asignacion de tutorias" para evitar congelamiento
    tutoriaGrupalLink.addEventListener("click", function(event) {
        event.preventDefault();
        clearContent();  // Limpia antes de cargar nuevo contenido

        // Aquí deberías cargar la asignación de tutorías, similar al método para ver tutorías.
        // Ejemplo simple:
        mainContent.innerHTML = "<p>Cargando la asignación de tutorías...</p>";
        
        // Puedes agregar la lógica específica de "asignacion de tutorias" aquí.
    });
});
