
    // Obtén el modal
    var modal = document.getElementById("resetPasswordModalTutor");

    // Obtén el botón que abre el modal
    var btn = document.querySelector(".footer-linkTuto[href='#']"); // Asegúrate de que esto selecciona el enlace correcto

    // Obtén el <span> que cierra el modal
    var span = document.getElementsByClassName("close-button")[0];

    // Cuando el usuario haga clic en el botón, abre el modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Cuando el usuario haga clic en <span> (x), cierra el modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cuando el usuario haga clic fuera del modal, cierra el modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
