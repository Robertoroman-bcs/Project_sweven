<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_admin.php"); ?>
<?php require("../component/header_page.php"); ?>



<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">LISTA SOLICITUDES DE VACACIONES</h5>

                    </div>
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE USUARIO</th>
                                        <th>ÁREA</th>
                                        <th>ESTADO</th>
                                        <th>APROVACIÓN JEFE ÁREA</th>
                                        <th>APROVACIÓN RH</th>
                                        <th>DIAS SOLICITADOS</th>
                                        <th>DIAS DISPONIBLES</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA TERMINO</th>
                                        <th>FECHA INICIO LABORES</th>
                                        <th>FECHA SOLICITUD </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $consulta = mysqli_query($conexion, "SELECT s.id_solicitud, u.nombre_usuario, u.apellidos,  a.nombre , s.estado, s.aprobado_por_jefe_area, s.aprobado_por_rh, s.fecha_inicio, s.fecha_termino, u.fecha_creacion_usuario, s.fecha_solicitud, DATEDIFF(s.fecha_termino, s.fecha_inicio) + 1 AS dias_diferencia   FROM solicitudes_vacaciones s JOIN usuarios u ON s.id_usuario = u.id_usuario JOIN areas a ON s.id_area = a.id_area ORDER BY s.fecha_solicitud DESC, s.id_solicitud DESC;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {

                                    ?>
                                    <tr>
                                        <td id="id"><?php echo $row["id_solicitud"] ?></td>
                                        <td id="nombre_usuario">
                                            <?php echo $row["nombre_usuario"] . ' ' . $row['apellidos'] ?></td>
                                        <td id="nombre"><?php echo $row["nombre"] ?></td>
                                        <td id="estado"> <span
                                                class="font-weight-bold"><?php echo $row["estado"] ?></span>
                                        </td>
                                        <td id="aprobado_por_jefe_area"><span
                                                class="font-weight-bold"><?php echo $row["aprobado_por_jefe_area"] ?></span>
                                        </td>
                                        <td id="aprobado_por_rh"> <span class="font-weight-bold">
                                                <?php echo $row["aprobado_por_rh"] ?></span></td>
                                        <td id="dias_diferencia"><?php echo $row["dias_diferencia"] ?></td>


                                        <?php
                                            // Supongamos que $fecha_creacion_usuario contiene la fecha de ingreso del usuario (ejemplo: '2018-05-15')
                                            $fecha_creacion_usuario = $row["fecha_creacion_usuario"];
                                            // Convertimos la fecha de ingreso a un objeto DateTime
                                            $ingreso = new DateTime($fecha_creacion_usuario);
                                            $hoy = new DateTime();  // Fecha actual
                                            // Calculamos la diferencia en años
                                            $intervalo = $hoy->diff($ingreso);
                                            $añosDeAntigüedad = $intervalo->y;  // Años de antigüedad
                                            // Asignar días de vacaciones según la antigüedad
                                            $diasVacaciones = ($añosDeAntigüedad < 1) ? 0 : 12 + ($añosDeAntigüedad - 1) * 2;
                                            ?>


                                        <td id="dias_diferencia"><?php echo $diasVacaciones; ?></td>
                                        <td id="fecha_inicio"><?php echo $row["fecha_inicio"] ?></td>
                                        <td id="fecha_termino"><?php echo $row["fecha_termino"] ?></td>
                                        <td id="fecha_creacion_usuario"><?php echo $row["fecha_creacion_usuario"] ?>
                                        </td>
                                        <td id="fecha_solicitud"><?php echo $row["fecha_solicitud"] ?></td>
                                    </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE USUARIO</th>
                                        <th>ÁREA</th>
                                        <th>ESTADO</th>
                                        <th>APROVACION JEFE ÁREA</th>
                                        <th>APROVACION RH</th>
                                        <th>DIAS SOLICITADOS</th>
                                        <th>DIAS DISPONIBLES</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA TERMINO</th>
                                        <th>FECHA INICIO LABORES</th>
                                        <th>FECHA SOLICITUD </th>
                                    </tr>
                                </tfoot>
                            </table>
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
















<script>
// Función para cambiar el color de fondo según el valor
function cambiarColorPorEstado() {
    // Obtener todas las celdas con los estados a través de su clase
    var celdasEstado = document.querySelectorAll("#estado");
    var celdasAprobadoPorJefe = document.querySelectorAll("#aprobado_por_jefe_area");
    var celdasAprobadoPorRh = document.querySelectorAll("#aprobado_por_rh");

    // Función para cambiar el color de una celda dependiendo del valor
    function cambiarColor(celda, valor) {
        if (valor === "Pendiente") {
            celda.style.backgroundColor = "yellow"; // Color para pendientes
        } else if (valor === "Aprobado") {
            celda.style.backgroundColor = "green"; // Color para aprobado
            celda.style.color = "white"; // Asegurar que el texto se vea bien sobre el verde
        } else if (valor === "Rechazado") {
            celda.style.backgroundColor = "red"; // Color para rechazado
            celda.style.color = "white"; // Asegurar que el texto se vea bien sobre el rojo
        }
    }

    // Aplicar el color de fondo a todas las celdas con la clase correspondiente
    celdasEstado.forEach(function(celda) {
        cambiarColor(celda, celda.innerText.trim());
    });
    celdasAprobadoPorJefe.forEach(function(celda) {
        cambiarColor(celda, celda.innerText.trim());
    });
    celdasAprobadoPorRh.forEach(function(celda) {
        cambiarColor(celda, celda.innerText.trim());
    });
}

// Llamar a la función para cambiar colores una vez que la página haya cargado
window.onload = cambiarColorPorEstado;
</script>




<?php require("../component/footer_dashboard.php"); ?>