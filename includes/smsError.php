<?php
if (isset($_GET['error'])):
?>
    <div class="error-message" id="error-message">
        <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php
endif;
?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            // Ocultar el mensaje después de 5 segundos
            setTimeout(() => {
                errorMessage.style.display = 'none';
                // Redirigir para eliminar el parámetro de error de la URL
                const url = new URL(window.location);
                url.searchParams.delete('error');
                window.history.replaceState({}, document.title, url.toString());
            }, 3000);

            // También al hacer clic en el mensaje mismo
            errorMessage.addEventListener('click', () => {
                errorMessage.style.display = 'none';
                // Redirigir para eliminar el parámetro de error de la URL
                const url = new URL(window.location);
                url.searchParams.delete('error');
                window.history.replaceState({}, document.title, url.toString());
            });
        }
    });
</script>
