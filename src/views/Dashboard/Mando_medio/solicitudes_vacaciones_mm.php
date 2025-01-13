<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_mandomedio.php"); ?>
<?php require("../component/header_page.php"); ?>



<!-- Main content -->
<section class="content">

    <?php $id_area_user = $_SESSION['id_area'];
    $id_cargo_user = $_SESSION['id_cargo'];
    $id_user = $_SESSION['id_usuario'];
    ?>

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
                                        <th>APROVACION JEFE ÁREA</th>
                                        <th>APROVACION RH</th>
                                        <th>DIAS SOLICITADOS</th>
                                        <th>FECHA INICIO</th>
                                        <th>FECHA TERMINO</th>
                                        <th>FECHA INICIO LABORES</th>
                                        <th>FECHA SOLICITUD </th>
                                        <th>ACCIONES </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $consulta = mysqli_query($conexion, "SELECT s.id_solicitud, u.nombre_usuario, u.apellidos, a.nombre AS nombre_area, s.estado, s.aprobado_por_jefe_area, s.aprobado_por_rh, s.dias_solicitados, s.fecha_inicio, s.fecha_termino, u.fecha_creacion_usuario, s.fecha_solicitud FROM solicitudes_vacaciones s JOIN usuarios u ON s.id_usuario =  u.id_usuario JOIN areas a ON s.id_area = a.id_area JOIN cargos c ON u.id_cargo = c.id_cargo WHERE c.id_cargo != $id_cargo_user AND a.id_area = $id_area_user ORDER BY s.fecha_solicitud DESC, s.id_solicitud DESC;");

                                    while ($row = mysqli_fetch_assoc($consulta)) {

                                    ?>
                                        <tr>
                                            <td id="id_solicitud"><?php echo $row["id_solicitud"] ?></td>
                                            <td id="nombre_usuario">
                                                <?php echo $row["nombre_usuario"] . ' ' . $row['apellidos'] ?></td>
                                            <td id="nombre"><?php echo $row["nombre_area"] ?></td>
                                            <td id="estado"> <span
                                                    class="font-weight-bold"><?php echo $row["estado"] ?></span>
                                            </td>
                                            <td id="aprobado_por_jefe_area"
                                                class="estado-<?php echo $row['id_solicitud'] ?>"><span
                                                    class="font-weight-bold"><?php echo $row["aprobado_por_jefe_area"] ?></span>
                                            </td>
                                            <td id="aprobado_por_rh"> <span class="font-weight-bold">
                                                    <?php echo $row["aprobado_por_rh"] ?></span>
                                            </td>
                                            <td id="dias_solicitados"><?php echo $row["dias_solicitados"] ?></td>
                                            <td id="fecha_inicio"><?php echo $row["fecha_inicio"] ?></td>
                                            <td id="fecha_termino"><?php echo $row["fecha_termino"] ?></td>
                                            <td id="fecha_creacion_usuario"><?php echo $row["fecha_creacion_usuario"] ?>
                                            </td>
                                            <td id="fecha_solicitud"><?php echo $row["fecha_solicitud"] ?></td>
                                            <td><button class="btn btn-warning"
                                                    onclick="actualizarEstado(<?php echo $row['id_solicitud']; ?>, 'Pendiente')">Pendiente</button>
                                                <button class="btn btn-success"
                                                    onclick="actualizarEstado(<?php echo $row['id_solicitud']; ?>, 'Aprobado')">Aprobado</button>
                                                <button class="btn btn-danger"
                                                    onclick="actualizarEstado(<?php echo $row['id_solicitud']; ?>, 'Rechazado')">Rechazar</button>
                                            </td>
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
                                        <th>FECHA INICIO</th>
                                        <th>FECHA TERMINO</th>
                                        <th>FECHA INICIO LABORES</th>
                                        <th>FECHA SOLICITUD </th>
                                        <th>ACCIONES </th>
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
    // Función para cambiar el color según el valor
    function cambiarColorPorEstado() {
        // Obtener todas las celdas con los estados a través de su id
        var celdasEstado = document.querySelectorAll("#estado");
        var celdasAprobadoPorJefe = document.querySelectorAll("#aprobado_por_jefe_area");
        var celdasAprobadoPorRh = document.querySelectorAll("#aprobado_por_rh");

        // Función para cambiar el color de una celda dependiendo del valor
        function cambiarColor(celda, valor) {
            if (valor === "Pendiente") {
                celda.style.backgroundColor = "yellow";
            } else if (valor === "Aprobado") {
                celda.style.backgroundColor = "green";
                celda.style.color = "white";
            } else if (valor === "Rechazado") {
                celda.style.backgroundColor = "red";
                celda.style.color = "white";
            }
        }

        // Aplica el color de fondo a todas las celdas con la clase correspondiente
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

    // Se llama a la función para cambiar el color una vez que la página haya cargado
    window.onload = cambiarColorPorEstado;
</script>

<script>
    // Función para actualizar el campo 'estado' de la tabla 
    function actualizarEstado(id_solicitud, nuevo_estado) {
        var formData = new FormData();
        formData.append('id_solicitud', id_solicitud);
        formData.append('nuevo_estado', nuevo_estado);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../../../controllers/actualizar_estado_solicitud_mm.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                if (respuesta.success) {
                    // Actualizar de el campo 'estado' en la tabla solicitud vacaciones
                    var estadoElemento = document.querySelector('.estado-' + id_solicitud);
                    if (estadoElemento) {
                        estadoElemento.textContent = nuevo_estado
                    }
                    cambiarColorPorEstado()
                    alert(respuesta.mensaje); // Mensaje de éxito
                    location.reload();

                } else {
                    alert(respuesta.error); // Mensaje de error
                }
            } else {
                alert("Error al realizar la solicitud.");
            }
        };

        xhr.send(formData);
    }
</script>

<?php require("../component/footer_dashboard.php"); ?>