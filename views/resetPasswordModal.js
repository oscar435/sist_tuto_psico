document.addEventListener("DOMContentLoaded", function() {
    // Obtén el modal
    var modal = document.getElementById("resetPasswordModal");

    // Obtén el botón que abre el modal
    var btn = document.querySelector(".footer-link"); // Asegúrate de que esto selecciona el enlace correcto

    // Obtén el <span> que cierra el modal (usa el selector correcto si hay más de un elemento con esta clase)
    var span = document.querySelector(".close-buttonPass"); // Cambié a querySelector para un solo elemento

    // Cuando el usuario haga clic en el botón, abre el modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Cuando el usuario haga clic en <span> (x), cierra el modal
    span.onclick = function() {
        modal.style.display = "none";
    }


    
});
