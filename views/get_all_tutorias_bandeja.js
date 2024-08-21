function confirmarEliminar(id_tutoria_estudiante) {
    if (confirm('¿Estás seguro de que deseas eliminar esta tutoría?')) {
        // Aquí puedes realizar una petición AJAX para eliminar la tutoría

        fetch('delete_tutoria_estudiante.php', {
            method: 'POST', // O 'GET' si prefieres
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'id_tutoria_estudiante': id_tutoria_estudiante,
            })
        })
        .then(response => response.text())
        .then(data => {
            // Maneja la respuesta del servidor
            alert(data);
            location.reload(); // Recargar la página
        })
        .catch(error => console.error('Error:', error));


    }
}