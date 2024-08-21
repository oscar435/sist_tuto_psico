// messageConfirmacionRegist.js
document.addEventListener('DOMContentLoaded', (event) => {
    // Mostrar SweetAlert2 si el parámetro de éxito está en la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        Swal.fire({
            title: '¡Registro existoso!',
            text: 'Por favor, inicie sesión.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirige al login después de cerrar la alerta
                window.location.href = '../views/viewLoginEstudiante.php';
            }
        });
    }
});
