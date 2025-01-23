<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            selectable: true,
            events: '../../../controllers/cargarAsistenciasController.php',
            validRange: {
                start: new Date().toISOString().split('T')[0]
            },
            dateClick: function(info) {
                // Obtener la fecha seleccionada
                var selectedDate = info.dateStr;
                document.getElementById('selected-date').innerHTML = selectedDate;


                // Cargar empleados desde la base de datos
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "../../../controllers/cargarEmpleadosController.php", true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var empleados = JSON.parse(xhr.responseText);
                        var empleadosList = document.getElementById('empleadosList');
                        empleadosList.innerHTML = ''; // Limpiar la lista

                        // Crear checkbox para cada empleado
                        empleados.forEach(function(empleado) {
                            var div = document.createElement('div');
                            div.classList.add('form-check');
                            div.innerHTML = `
                                <input class="form-check-input" type="checkbox" id="empleado_${empleado.id_usuario}" value="${empleado.id_usuario}">
                                <label class="form-check-label" for="empleado_${empleado.id_usuario}">
                                    ${empleado.nombre_usuario}
                                </label>
                            `;
                            empleadosList.appendChild(div);
                        });

                        // Mostrar el modal
                        var myModal = new bootstrap.Modal(document.getElementById(
                            'modalAsistencia'));
                        myModal.show();
                    }
                };
                xhr.send();

                // Mostrar la fecha en el modal


                // Mostrar el modal de Bootstrap
                var myModal = new bootstrap.Modal(document.getElementById('modal_asistencia_usuario'));
                myModal.show();


            },
        });
        calendar.render();
        // Guardar las asistencias
        document.getElementById('guardarAsistencias').addEventListener('click', function() {
            var fecha = document.getElementById('selected-date');
            var valor_fecha = fecha.innerText;

            var empleadosAsistentes = [];

            // Recoger los empleados con asistencia marcada
            var checkboxes = document.querySelectorAll('#empleadosList input[type="checkbox"]:checked');
            checkboxes.forEach(function(checkbox) {
                empleadosAsistentes.push(checkbox.value);
            });

            // Enviar la asistencia de los empleados seleccionados
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../../../controllers/registrarAsistenciasController.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    location.reload();
                    var myModal = bootstrap.Modal.getInstance(document.getElementById(
                        'modalAsistencia'));
                    myModal.hide();

                } else {
                    alert("Hubo un error al guardar.");
                }
            };

            xhr.send("fecha=" + valor_fecha + "&empleados=" + JSON.stringify(empleadosAsistentes));
        });
    });
</script>





<div id='calendar'></div>




<!-- Modal Agregar ASISTENCIAS -->
<div class="modal fade" id="modal_asistencia_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asistencias Usuario</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formAsistencia">
                    <input type="hidden" id="fechaSeleccionada">
                    <p>Selecciona el estado de los empleados para el día: <span id="selected-date"></span></p>
                    <div id="empleadosList"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarAsistencias">Guardar</button>
            </div>

        </div>
    </div>
</div>