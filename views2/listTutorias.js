document.addEventListener('DOMContentLoaded', function () {
    const btnTutoriaGrupal = document.getElementById('tutoria-grupal');

    if (btnTutoriaGrupal) {
        btnTutoriaGrupal.addEventListener('click', function (e) {
            e.preventDefault();

            // Limpiar contenido anterior
            const mainContent = document.querySelector('.dashboard');
            mainContent.innerHTML = '';

            // Crear y mostrar la tabla para las tutorías
            mainContent.innerHTML = `
                <div id="tutoria-list">
                    <h3>Lista de Tutorías</h3>
                    <table id="tutoria-table" border="1">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Código de Estudiante</th>
                                <th>Teléfono</th>
                                <th>Correo Institucional</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            `;

            // Fetch para obtener los datos de las tutorías
            fetch('../controllers/getTutoriaAdminDataController.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#tutoria-table tbody');
                    
                    data.forEach(tutoria => {
                        const row = `
                            <tr>
                                <td>${tutoria.nombre}</td>
                                <td>${tutoria.apellido}</td>
                                <td>${tutoria.codigo_estudiante}</td>
                                <td>${tutoria.telefono}</td>
                                <td>${tutoria.correo_institucional}</td>
                                <td>
                                    <button class="ver-pdf" data-id="${tutoria.id}">Ver PDF</button>
                                    <button class="eliminar-tutoria" data-id="${tutoria.id}">Eliminar</button>
                                </td>
                            </tr>
                        `;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });

                    // Event listeners for the action buttons
                    document.querySelectorAll('.ver-pdf').forEach(button => {
                        button.addEventListener('click', function () {
                            const tutoriaId = this.getAttribute('data-id');
                            window.open(`../controllers/generateTutoriaPDF.php?id=${tutoriaId}`, '_blank');
                        });
                    });

                    document.querySelectorAll('.eliminar-tutoria').forEach(button => {
                        button.addEventListener('click', function () {
                            const tutoriaId = this.getAttribute('data-id');
                            if (confirm('¿Estás seguro de que deseas eliminar esta tutoría?')) {
                                fetch(`../controllers/deleteTutoria.php?id=${tutoriaId}`, {
                                    method: 'DELETE',
                                })
                                .then(response => response.text())
                                .then(data => {
                                    if (data === 'success') {
                                        alert('Tutoría eliminada con éxito.');
                                        this.closest('tr').remove();
                                    } else {
                                        alert('Error al eliminar la tutoría.');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error al eliminar la tutoría:', error);
                                });
                            }
                        });
                    });
                })
                .catch(error => {
                    console.error('Error fetching tutoria data:', error);
                });
        });
    } else {
        console.error('Botón "tutoria-grupal" no encontrado');
    }
});
