<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_mandomedio.php"); ?>
<?php require("../component/header_page.php"); ?>

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

<section class="content">
    <?php $id_area_user = $_SESSION['id_area'];
    $id_cargo_user = $_SESSION['id_cargo'];
    $id_user = $_SESSION['id_usuario'];
    ?>


    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- /.col-md-6 -->



            <div class="col-lg-12 col-sm-6">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="pt-2 px-3">
                                <h3 class="card-title">Panel Control</h3>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                                    href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
                                    aria-selected="true">Registro de asistencia del área</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile"
                                    aria-selected="false">Tabla de Asistencias del área</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages"
                                    aria-selected="false">Mis Documentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill"
                                    href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings"
                                    aria-selected="false">Información General</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
                                aria-labelledby="custom-tabs-two-home-tab">


                                <div id='calendar'></div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-two-profile-tab">

                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>

                                                <th scope="col">ID </th>
                                                <th scope="col">NOMBRE</th>
                                                <th scope="col">EMAIL</th>
                                                <th scope="col">TELEFONO</th>
                                                <th scope="col">ASISTENCIA</th>
                                                <th scope="col">FECHA</th>
                                                <th scope="col"> ROL</th>
                                                <th scope="col">CARGO</th>
                                                <th scope="col">ÁREA</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Consultamos los documentos y los datos del usuario
                                            $consulta = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre_usuario, u.apellidos, u.email, u.telefono, af.estado, af.fecha, r.nombre_rol AS nombre_rol, c.nombre AS nombre_cargo, a.nombre AS nombre_area
FROM usuarios u
JOIN roles r ON u.id_rol = r.id_rol
JOIN cargos c ON u.id_cargo = c.id_cargo
JOIN areas a ON u.id_area = a.id_area
JOIN asistencias_faltas af ON u.id_usuario = af.id_usuario
WHERE c.id_cargo != $id_cargo_user AND a.id_area = $id_area_user  
ORDER BY af.fecha DESC;");

                                            // Iteramos sobre cada fila de resultados
                                            while ($row = mysqli_fetch_assoc($consulta)) {
                                            ?>
                                            <?php $estado_asistencia =  $row["estado"];
                                                if ($estado_asistencia == 1) {
                                                ?>

                                            <tr class="bg-success">

                                                <?php } else {

                                                    ?>
                                            <tr class="bg-danger">
                                                <?php

                                                } ?>
                                                <td id="id_usuario"><?php echo $row["id_usuario"] ?></td>
                                                <td id="nombre_usuario"><?php echo $row["nombre_usuario"] ?>
                                                    <?php echo $row["apellidos"] ?></td>
                                                <td id="email"><?php echo $row["email"] ?></td>
                                                <td id="telefono"><?php echo $row["telefono"] ?></td>
                                                <td id="estado">
                                                    <?php if ($row["estado"] != 0) {
                                                        ?>
                                                    <span
                                                        class="badge badge-primary font-weight-bold"><?php echo 'Presente' ?></span>
                                                    <?php  } else { ?>


                                                    <span
                                                        class="badge badge-danger font-weight-bold"><?php echo 'Falta' ?></span>

                                                    <?php } ?>
                                                </td>
                                                <td id="estado"><?php echo $row["fecha"] ?></td>
                                                <td id="nombre_rol">
                                                    <?php echo $row["nombre_rol"] ?>
                                                </td>
                                                <td id="nombre_cargo">
                                                    <?php echo $row["nombre_cargo"] ?>
                                                </td>
                                                <td id="nombre_area">
                                                    <?php echo $row["nombre_area"] ?>
                                                </td>
                                            </tr>





                                            <?php } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">ID </th>
                                                <th scope="col">NOMBRE</th>
                                                <th scope="col">EMAIL</th>
                                                <th scope="col">TELEFONO</th>
                                                <th scope="col">ASISTENCIA</th>
                                                <th scope="col">FECHA</th>
                                                <th scope="col"> ROL</th>
                                                <th scope="col">CARGO</th>
                                                <th scope="col">ÁREA</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-two-messages-tab">

                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel"
                                aria-labelledby="custom-tabs-two-settings-tab">

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


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





<?php require("../component/footer_dashboard.php"); ?>