document.addEventListener('DOMContentLoaded', function() {
    const motivoSelect = document.getElementById('motivo');
    const motivoOtroTextarea = document.getElementById('motivo_otro');

    motivoSelect.addEventListener('change', function() {
        if (motivoSelect.value === 'Otro') {
            motivoOtroTextarea.style.display = 'block'; // Muestra el textarea
            motivoOtroTextarea.style.opacity = '1'; // Asegura que sea visible
            motivoOtroTextarea.style.height = 'auto'; // Ajusta la altura automáticamente
        } else {
            motivoOtroTextarea.style.opacity = '0'; // Hace el textarea invisible
            motivoOtroTextarea.style.height = '0'; // Reduce la altura a 0
            setTimeout(() => motivoOtroTextarea.style.display = 'none', 300); // Oculta el textarea después de la transición
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const expectativasSelect = document.getElementById('expectativas');
    const expectativasOtroTextarea = document.getElementById('expectativas_otro');

    expectativasSelect.addEventListener('change', function() {
        if (expectativasSelect.value === 'Otro') {
            expectativasOtroTextarea.style.display = 'block';
            expectativasOtroTextarea.focus();
        } else {
            expectativasOtroTextarea.style.display = 'none';
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const cursoSelect  = document.getElementById('curso');

    cursoSelect.addEventListener('change', function(event) {    

        fetch('../views/get_tutorias_disponibles.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'id_curso': document.getElementById('curso').value,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
                formContainer.innerHTML = '<p>Error al cargar los cursos.</p>';
            } else {
                console.log(data);
                crearTabla(data);
            }
        })
        .catch(error => {
            console.error('Error al cargar los cursos:', error);
        });
    });


    function crearTabla(data) {
        const tableContainer = document.getElementById('tableContainer');
        tableContainer.innerHTML = ''; // Limpiar contenido previo
        
        const table = document.createElement('table');
        table.classList.add('table', 'table-striped');

        const thead = document.createElement('thead');
        const headerRow = document.createElement('tr');
        const headers = ['Numero','Nombre del Curso', 'Modalidad', 'Fecha', 'Hora Inicio', 'Hora Fin', 'Comentario', 'Nombre del Tutor', 'Nombre del Ciclo', 'Nombre de la Escuela', 'Acción'];

        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;
            headerRow.appendChild(th);
        });

        thead.appendChild(headerRow);
        table.appendChild(thead);

        const tbody = document.createElement('tbody');

        data.forEach(item => {
            const row = document.createElement('tr');

            Object.keys(item).forEach(key => {
                const td = document.createElement('td');
                td.textContent = item[key];
                row.appendChild(td);
            });

            // Crear botón "Seleccionar"
            const selectTd = document.createElement('td');
            const selectButton = document.createElement('button');
            selectButton.textContent = 'Seleccionar';
            selectButton.classList.add('btn', 'btn-primary');

            selectButton.addEventListener('click', function(event) {
                event.preventDefault();
               // Quitar la clase 'selected-row' de cualquier fila que ya la tenga
               const selectedRow = table.querySelector('.selected-row');
               if (selectedRow) {
                   selectedRow.classList.remove('selected-row');
               }

               // Agregar la clase 'selected-row' a la fila seleccionada
               row.classList.add('selected-row');

                document.getElementById('id_tutoria_seleccionada').value=item.id_tutoria;

                //alert('Curso seleccionado: ' + item.nombre_curso);
                // Aquí puedes agregar lógica adicional para manejar la selección
            });

            selectTd.appendChild(selectButton);
            row.appendChild(selectTd);

            tbody.appendChild(row);
        });

        table.appendChild(tbody);
        tableContainer.appendChild(table);
    }
});
