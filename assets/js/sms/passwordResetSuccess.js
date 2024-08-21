// messageConfirmacionReset.js
document.addEventListener('DOMContentLoaded', (event) => {
    // Mostrar SweetAlert2 si el parámetro de éxito de reseteo está en la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('reset_success')) {
        Swal.fire({
            title: '¡Contraseña restablecida!',
            text: 'Tu contraseña ha sido actualizada con éxito.',
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
