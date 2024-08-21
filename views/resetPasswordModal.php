<!-- resetPasswordModal.php -->
<div id="resetPasswordModal" class="modalOlvidar">
    <div class="modal-contentOlvidar">
        <span class="close-buttonPass">&times;</span>
        <h2>Restablecer Contraseña</h2>
        
        <form action="../controllers/resetPasswordController.php" method="post">
            <input type="text" name="codigo_estudiante" placeholder="Ingresa código de estudiante" required>
            <label for="">Dato necesario para corroborar su identidad:</label>
            <input type="text" name="DNI" placeholder="Ingresa DNI" required>
            <label for="">Digite una nueva contraseña: </label>
            <input type="password" name="nueva_contraseña" placeholder="Nueva contraseña" required>
            <input type="password" name="confirmar_contraseña" placeholder="Confirmar contraseña" required>
            <input type="submit" value="Cambiar contraseña">
        </form>

    </div>
</div>

<style>
    /* Estilos del modal */
    /* Estilos para el modal */
    .modalOlvidar {
        display: none;
        /* Ocultar el modal por defecto */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        /* Fondo oscuro translúcido */
    }

    .modal-contentOlvidar {
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        /* Ajusta el ancho del modal */
        margin-top: 6em;
        margin-left: 28em;

    }
    .modal-contentOlvidar label{
        margin-left: 6em;
        margin-top: 1em;
    }

    .modal-contentOlvidar {
        background-color: white;
        border-radius: 2em;
    }

    .modal-contentOlvidar input {
        width: 70%;
        margin-left: 5em;
    }


    .close-buttonPass {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close-buttonPass:hover,
    .close-buttonPass:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>