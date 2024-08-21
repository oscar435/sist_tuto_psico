document.addEventListener('DOMContentLoaded', function () {
    const btnVerDisponibilidad = document.getElementById('btn-ver-disponibilidad');
    const formContainer = document.getElementById('form-container');

    btnVerDisponibilidad.addEventListener('click', function () {
        fetch('../views3/obtenerDisponibilidades.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    formContainer.innerHTML = `<p>Error: ${data.error}</p>`;
                } else {

                    displayDisponibilidades(data);
                }
            })
            .catch(error => {
                formContainer.innerHTML = `<p>Error: ${error.message}</p>`;
            });
    });

    function displayDisponibilidades(disponibilidades) {

        let html = '<h2>Disponibilidades Registradas</h2><table><thead><tr><th>Numero</th><th>Curso</th><th>Fecha</th><th>Hora de inicio</th><th>Horas</th><th>Modalidad</th><th>Ciclo</th><th>Escuela</th><th>Comentario</th> </tr></thead><tbody>';

        disponibilidades.forEach((disponibilidad, index) => {
            html += `<tr>
                <td>${index+1}</td>
                <td>${disponibilidad.curso}</td>
                <td>${disponibilidad.fecha}</td>
                <td>${disponibilidad.hora_inicio}</td>
                <td>${disponibilidad.hora_fin}</td>
                <td>${disponibilidad.modalidad}</td>
                <td>${disponibilidad.ciclo}</td>
                <td>${disponibilidad.escuela}</td>
                <td>${disponibilidad.comentarios}</td>
            </tr>`;
        });

        html += '</tbody></table>';
        formContainer.innerHTML = html;
    }
});
