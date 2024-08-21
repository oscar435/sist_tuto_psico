// Obtén el modal
var registerModal = document.getElementById("registerUserModalTutor");

// Obtén el botón que abre el modal
var registerBtn = document.querySelector(".footer-linkUserTuto"); // Asegúrate de que esto selecciona el enlace correcto

// Obtén el <span> que cierra el modal
var registerSpan = document.getElementsByClassName("close-button")[1]; // Asegúrate de que esto selecciona el <span> correcto

// Cuando el usuario haga clic en el botón, abre el modal
registerBtn.onclick = function() {
    registerModal.style.display = "block";
}

// Cuando el usuario haga clic en <span> (x), cierra el modal
registerSpan.onclick = function() {
    registerModal.style.display = "none";
}

// Cuando el usuario haga clic fuera del modal, cierra el modal
window.onclick = function(event) {
    if (event.target == registerModal) {
        registerModal.style.display = "none";
    }
}
