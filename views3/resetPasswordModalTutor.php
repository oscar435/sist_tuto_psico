<!-- resetPasswordModal.php -->
<div id="resetPasswordModalTutor" class="modalOlvidar">
    <div class="modal-contentOlvidar">
        <span class="close-button">&times;</span>
        <h2>Restablecer Contraseña</h2>
        <form action="../controllers/resetPasswordControllerTutor.php" method="post">
        <input type="text" name="codigo_docente" placeholder="Ingrese código de docente" required>
            <label for="">Dato necesario para corroborar su identidad:</label>
            <input type="text" name="DNI" placeholder="Ingrese su DNI" required>
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
    display: none; /* Ocultar el modal por defecto */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4); /* Fondo oscuro translúcido */
}

.modal-contentOlvidar {
    background-color: #fefefe;
    margin: 6em auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%; /* Ajusta el ancho del modal */
}
.modal-contentOlvidar{
    background-color: white;
    border-radius: 2em;
}
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>
