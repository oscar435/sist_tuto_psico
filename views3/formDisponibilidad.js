document.addEventListener('DOMContentLoaded', function () {
  const gestionButton = document.getElementById('btn-gestion-disponibilidad');
  const formContainer = document.getElementById('form-container');


 // Selector para el curso


  gestionButton.addEventListener('click', function (event) {
      event.preventDefault(); // Evita el comportamiento por defecto del enlace 
      fetch('../views3/formDisponibilidad.php')
          .then(response => response.text())
          .then(data => {
              formContainer.innerHTML = data; // Actualiza el contenido del contenedor con el formulario
              // Completa los campos del formulario con los datos del docente
              document.getElementById('nombre-docente').value = window.docenteData.nombre;
              document.getElementById('apellido-docente').value = window.docenteData.apellido;
              document.getElementById('codigo-docente').value = window.docenteData.codigo;
              // Añade validación de horas
              const horaInicio = document.getElementById('horaInicio');
              const horaFin = document.getElementById('horaFin');

              horaInicio.addEventListener('change', validarHoras);
              horaFin.addEventListener('change', validarHoras);

              function validarHoras() {
                  if (horaInicio.value && horaFin.value && horaInicio.value >= horaFin.value) {
                      alert('La hora de inicio debe ser anterior a la hora de fin.');
                      horaFin.value = ''; // Resetea el campo horaFin si no es válido
                  }
              }
              const cicloSelect = document.getElementById('ciclo');
              cicloSelect.addEventListener('change', manejarCambioCiclo);
          })
          .catch(error => {
              console.error('Error al cargar el formulario:', error);
          });
  });


  function manejarCambioCiclo(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del enlace

    const cicloSelect = event.target;
    const idCiclo = cicloSelect.value;
    const cursoSelect = document.getElementById('curso');

    fetch('../views3/get_courses_by_semester.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'id_ciclo': idCiclo,
            'id_escuela':  window.docenteData.id_escuela
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error:', data.error);
            formContainer.innerHTML = '<p>Error al cargar los cursos.</p>';
        } else {
            cursoSelect.innerHTML = '<option value="">Seleccione curso</option>';

            // Agrega las opciones nuevas
            data.forEach(curso => {
                const option = document.createElement('option');
                option.value = curso.id;
                option.textContent = curso.nombre;
                cursoSelect.appendChild(option);
            });
        }
    })
    .catch(error => {
        console.error('Error al cargar los cursos:', error);
    });
}

//   btnDisponibilidadSubmit.addEventListener('submit', function(event){
    
//     var idCiclo = document.getElementById('ciclo').value;
//     var idCurso = document.getElementById('curso').value;
//     var fecha = document.getElementById('fecha').value;
//     var horaInicio = document.getElementById('horaInicio').value;
//     var horaFin = document.getElementById('horaFin').value;
//     var modalidad = document.getElementById('modalidad').value;
//     var comentarios = document.getElementById('comentarios').value;

//     var id_escuela = window.docenteData.id_escuela;
//     var id_tutor  =  window.docenteData.id_tutor;
    
//     console.log(idCiclo);
//     console.log(idCurso);
//     console.log(fecha);
//     console.log(horaInicio);
//     console.log(horaFin);
//     console.log(modalidad);
//     console.log(comentarios);
//     console.log(id_escuela);
//     console.log(id_tutor);


    
//   })

});
