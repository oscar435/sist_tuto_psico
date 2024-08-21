<!-- registerUserTutor.php -->
<div id="registerUserModalTutor" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Registro de nuevo tutor</h2>
        <form action="../controllers/registerUserTutorController.php" method="post">
            <!-- Código de estudiante con validación -->
            <input type="text" name="codigo" placeholder="Código de docente" required
            pattern="(19|20)[0-9]{5}" title="Digite un código de docente válido" maxlength="7">

            <!-- Nombres -->
            <input type="text" name="nombres" placeholder="Nombres" required>

            <!-- Apellidos -->
            <input type="text" name="apellidos" placeholder="Apellidos" required>


            <!-- Escuela (con opciones estáticas) -->
            <select name="escuela" required>
                <option value="" selected disabled>Seleccione escuela donde enseña</option>
                <option value="1">Informática</option>
                <option value="2">Electrónica</option>
                <option value="3">Telecomunicaciones</option>
                <option value="4">Mecatronica</option>
                <!-- Agrega más opciones según sea necesario -->
            </select>


            <!-- Teléfono -->
            <input type="text" name="telefono" placeholder="Teléfono" required
                pattern="9[0-9]{8}" title="El numero de telefono debe ser correcto" maxlength="9">

            <!-- DNI -->
            <input type="text" name="dni" placeholder="DNI" required
                pattern="[0-9]{8}" title="Digite un DNI verdadero" maxlength="8">

            <!-- correo educativo-->
            <input type="email" name="correo" placeholder="Correo institucional"  class="correo" required>
 
            <!-- Contraseña -->
            <input type="password" name="password" placeholder="Digite un contraseña" required>

            <!-- Confirmar contraseña -->
            <input type="password" name="confirm_password" placeholder="Confirmar la contraseña" required>

            <!-- Botón de registro -->
            <input class="botonRegistrar2" type="submit" value="Registrarse">
        </form>
    </div>
</div>

<style>
    /* Estilos del modal */
    .modal {
        display: none;
        /* Ocultar el modal por defecto */
        position: fixed;
        z-index: 1000;
        /* Asegura que el modal esté por encima de otros contenidos */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        /* Fondo oscuro translúcido */
    }

    .modal-content {
        background-color: #fefefe;
        margin-top: 0.2em;
        margin-left: 27em;
        /* Centra el modal verticalmente */
        padding: 1em;
        border: 1px solid #888;
        border-radius: 10px;
        /* Bordes redondeados */
        width: 50%;
        /* Ajusta el ancho del modal */
        max-width: 600px;
        /* Ancho máximo del modal */
    }

    .modal-content h2 {
        margin-left: 1.5em;
    }

    .modal-content input {
        display: block;
        width: calc(80% - 20px);
        /* Asegura que los inputs y el select se ajusten al contenedor */
        margin: 0.2em auto;
        /* Márgenes automáticos para centrar los elementos */
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 1em;
    }

    .modal-content select {
        display: block;
        width: 80%;
        /* Asegura que los inputs y el select se ajusten al contenedor */
        margin: 1em auto;
        /* Márgenes automáticos para centrar los elementos */
        padding: 10px;
        border-radius: 8em;
        border: 1px solid #ccc;
        font-size: 1em;
    }

    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-button:hover,
    .close-button:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Estilo básico del botón */
    /* Estilo básico del botón */
    .botonRegistrar2 {
        margin-top: 5em;
        background-color: orange;
        width: 10vh;
        height: 7vh;
        /* Ajusta la altura del botón */
        border: none;
        border-radius: 10em;
        color: black;
        font-size: 1.8vh;
        font-weight: bold;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
        /* Transición suave */
    }

    /* Efecto de zoom al pasar el cursor por encima */
    .botonRegistrar2:hover {
        transform: scale(1.1);
        /* Aumenta el tamaño del botón en un 10% */
    }

    /* Efecto de balanceo al hacer clic */
    .botonRegistrar2:active {
        animation: balanceo 0.5s;
    }

    /* Definición de la animación de balanceo */
    @keyframes balanceo {
        0% {
            transform: rotate(0deg);
        }

        20% {
            transform: rotate(-10deg);
        }

        40% {
            transform: rotate(10deg);
        }

        60% {
            transform: rotate(-10deg);
        }

        80% {
            transform: rotate(10deg);
        }

        100% {
            transform: rotate(0deg);
        }
    }
</style>