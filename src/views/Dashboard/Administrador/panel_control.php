<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_admin.php"); ?>
<?php require("../component/header_page.php"); ?>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            selectable: true,
            dateClick: function(info) {
                // Obtener la fecha seleccionada
                var selectedDate = info.dateStr;

                // Mostrar la fecha en el modal
                document.getElementById('selected-date').textContent = "Fecha seleccionada: " +
                    selectedDate;

                // Mostrar el modal de Bootstrap
                var myModal = new bootstrap.Modal(document.getElementById('modal_asistencia_usuario'));
                myModal.show();
            }
        });
        calendar.render();
    });
</script>

<section class="content">

    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Panel De Control Del Personal</h5>
                        <?php if (isset($_GET['erroremail']) && $_GET['erroremail'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> El email ya se encutra registrado, ingrese otro. </p></div>';
                        } else if (isset($_GET['errorcargo']) && $_GET['errorcargo'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> Ya existe Jefe de departamento en el área, ingrese otro cargo </p></div>';
                        } ?>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_agregar_datos_usuario">
                                Agregar Datos Usuarios
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id='calendar'></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
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
                <span id="selected-date"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../../controllers/registrarUsuarioController.php" method="post">


                </form>
            </div>
        </div>
    </div>
</div>



<?php require("../component/footer_dashboard.php"); ?>