// Obtén el modal
var registerModal = document.getElementById("registerUserModal");

// Obtén el botón que abre el modal (usando el selector adecuado)
var registerBtn = document.querySelector(".footer-linkUser");


// Obtén el <span> que cierra el modal
var registerSpan = document.querySelector(".close-button");

// Cuando el usuario haga clic en el botón, abre el modal
registerBtn.onclick = function (event) {
    event.preventDefault(); // Evita el comportamiento predeterminado del enlace
    registerModal.style.display = "block";
}

// Cuando el usuario haga clic en <span> (x), cierra el modal
registerSpan.onclick = function () {
    registerModal.style.display = "none";
}
// Cuando el usuario haga clic fuera de cualquiera de los modales, cierra los modales
window.onclick = function (event) {
    if (event.target === registerModal) {
        registerModal.style.display = "none";
    } else if (event.target === resetPasswordModal) {
        resetPasswordModal.style.display = "none";
    }
}
