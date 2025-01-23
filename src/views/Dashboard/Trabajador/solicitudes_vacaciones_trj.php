<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_trj.php"); ?>
<?php require("../component/header_page.php"); ?>

<?php $id_user = $_SESSION['id_usuario'];  ?>

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

                            <?php $consulta = mysqli_query($conexion, "SELECT CASE WHEN DATEDIFF(CURDATE(), dg.fecha_ingreso) >= 365 THEN 'Habilitar' ELSE 'Deshabilitar' END AS estado_boton FROM usuarios u JOIN datos_generales_usuarios dg ON u.id_usuario = dg.id_usuario WHERE u.id_usuario = $id_user;");
                            $estado_boton = '';
                            if ($consulta->num_rows > 0) {
                                $row = mysqli_fetch_assoc($consulta);
                                $estado_boton = $row['estado_boton'];
                            } else {
                                echo "No se encontró el usuario";
                            }



                            ?>


                            <button id="btn-solicitud-vacaciones" type="button" class="btn btn-primary"
                                data-toggle="modal" data-target="#crear-solicitud-vacaciones">
                                Crear Solicituda
                            </button>
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
                                        <th>FECHA REGRESO</th>
                                        <th>FECHA DE INCORPORACIÓN</th>
                                        <th>FECHA SOLICITUD </th>
                                        <th>ACCIONES </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $consulta = mysqli_query($conexion, "SELECT s.id_solicitud, u.nombre_usuario, u.apellidos , a.nombre , s.estado, s.aprobado_por_jefe_area, s.aprobado_por_rh, s.dias_solicitados, s.fecha_inicio, s.fecha_termino, S.fecha_inicio_labores ,dg.fecha_ingreso AS FECHA_INGRESO , s.fecha_solicitud  FROM solicitudes_vacaciones s JOIN usuarios u ON s.id_usuario = u.id_usuario JOIN areas a ON s.id_area = a.id_area JOIN datos_generales_usuarios dg ON s.id_usuario = dg.id_usuario WHERE u.id_usuario = $id_user ORDER BY s.fecha_solicitud DESC;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {

                                    ?>
                                    <tr>
                                        <td id="id"><?php echo $row["id_solicitud"] ?></td>
                                        <td id="nombre_usuario">
                                            <?php echo $row["nombre_usuario"] . ' ' . $row["apellidos"]  ?></td>
                                        <td id="nombre"><?php echo $row["nombre"] ?>
                                        </td>
                                        <td id="estado"> <span
                                                class="font-weight-bold"><?php echo $row["estado"] ?></span>
                                        </td>
                                        <td id="aprobado_por_jefe_area"><span
                                                class="font-weight-bold"><?php echo $row["aprobado_por_jefe_area"] ?></span>
                                        </td>
                                        <td id="aprobado_por_rh"> <span class="font-weight-bold">
                                                <?php echo $row["aprobado_por_rh"] ?></span>
                                        </td>
                                        <td id="dias_solicitados"><?php echo $row["dias_solicitados"] ?></td>
                                        <td id="fecha_inicio"><?php echo $row["fecha_inicio"] ?></td>
                                        <td id="fecha_termino"><?php echo $row["fecha_termino"] ?></td>
                                        <td id="fecha_inicio_labores"><?php echo $row["fecha_inicio_labores"] ?></td>
                                        <td id="fecha_creacion_usuario"><?php echo $row["FECHA_INGRESO"] ?>
                                        </td>
                                        <td id="fecha_solicitud"><?php echo $row["fecha_solicitud"] ?></td>
                                        <td>
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
                                        <th>FECHA REGRESO</th>
                                        <th>FECHA DE INCORPORACIÓN</th>
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


<!-- Modal -->
<div class="modal fade" id="crear-solicitud-vacaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitud Vacaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="resultado"></h4>
                <form action="../../../controllers/registrarSolicitudVacacionesController.php" method="post">
                    <div class="row shadow p-3 mb-5 bg-white rounded">
                        <?php $consulta = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre_usuario, u.apellidos, u.estado , dg.fecha_ingreso AS FECHA_INGRESO, a.id_area, a.nombre FROM usuarios u JOIN areas a ON u.id_area = a.id_area JOIN datos_generales_usuarios dg ON u.id_usuario = dg.id_usuario WHERE u.id_usuario = $id_user;");

                        if ($consulta->num_rows > 0) {
                            //$row = $result->fetch_assoc();
                            $row = mysqli_fetch_assoc($consulta);
                            $id_usuario = $row["id_usuario"];
                            $nombre_usuario = $row["nombre_usuario"] . ' ' . $row["apellidos"];
                            $estado = $row["estado"];
                            $id_area = $row["id_area"];
                            $nombre_area = $row["nombre"];
                            $fecha_creacion_usuario = $row["FECHA_INGRESO"];



                        ?>

                        <div class="col-xs-12 col-md-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">ID USUARIO:</label>
                                <input type="text" value="<?php echo $id_usuario; ?>" id="id_usuario" name="id_usuario"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">NOMBRE:</label>
                                <input type="text" value="<?php echo $nombre_usuario; ?>" id="nombre_usuario"
                                    name="nombre_usuario" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">ID AREA:</label>
                                <input type="text" value="<?php echo $id_area; ?>" id="id_area" name="id_area"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">NOMBRE ÁREA:</label>
                                <input type="text" value="<?php echo $nombre_area; ?>" id="nombre_area"
                                    name="nombre_area" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">ESTADO:</label>
                                <input type="text" value="<?php echo $estado; ?>" id="estado" name="estado"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <label>FECHA DE INICIO:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="col-6">
                            <label>FECHA DE TERMINO:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="fecha_termino" name="fecha_termino"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="col-6">
                            <label>FECHA INICIO DE LABORES:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="fecha_inicio_labores"
                                    name="fecha_inicio_labores" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask />
                            </div>
                            <!-- /.input group -->
                        </div>



                        <?php

                        } else {
                            echo "No se encontró el usuario";
                        }



                        ?>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal"
                            aria-label="Close">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>









<script>
// PHP inserta el valor de $estado_boton en el código JavaScript
var estado_boton = '<?php echo $estado_boton; ?>';

// Habilitar o deshabilitar el botón según el estado
if (estado_boton === 'Habilitar') {
    document.getElementById('btn-solicitud-vacaciones').disabled = false;
} else {
    document.getElementById('btn-solicitud-vacaciones').disabled = true;
}
</script>


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



<script>
var fecha_ingreso = '<?php echo $fecha_creacion_usuario; ?>';
var ingreso = new Date(fecha_ingreso);
var hoy = new Date();

// Calcular la diferencia en años
var añosDeAntigüedad = hoy.getFullYear() - ingreso.getFullYear();

// Ajustar si el mes y día actuales aún no han alcanzado el mes y día de ingreso
if (
    hoy.getMonth() < ingreso.getMonth() ||
    (hoy.getMonth() === ingreso.getMonth() && hoy.getDate() < ingreso.getDate())
) {
    añosDeAntigüedad--;
}

// Asignar días de vacaciones según la antigüedad
var diasVacaciones;
if (añosDeAntigüedad >= 6 && añosDeAntigüedad <= 10) {
    diasVacaciones = 22;
} else if (añosDeAntigüedad === 5) {
    diasVacaciones = 20;
} else if (añosDeAntigüedad === 4) {
    diasVacaciones = 18;
} else if (añosDeAntigüedad === 3) {
    diasVacaciones = 16;
} else if (añosDeAntigüedad === 2) {
    diasVacaciones = 14;
} else if (añosDeAntigüedad === 1) {
    diasVacaciones = 12;
} else {
    diasVacaciones = 0; // Menos de 1 año
}


// Mostrar los días de vacaciones calculados
console.log(`Fecha Ingreso: ${fecha_ingreso}`);
console.log(`Fecha Actual: ${hoy}`);
console.log(`Años de antigüedad: ${añosDeAntigüedad}`);
console.log(`Días de vacaciones: ${diasVacaciones}`);

// Mostrar el resultado
document.getElementById('resultado').innerText = "Con derecho a : " + diasVacaciones + " días de vacaciones";


//FUNCION PARA CALCULAR LOS DIAS QUE SE TOMARA DE VACACIONES
function calcularDias() {
    const fechaInicio = new Date(document.getElementById('fecha_inicio').value);
    const fechaFin = new Date(document.getElementById('fecha_termino').value);
    const diferenciaTiempo = fechaFin - fechaInicio;
    const diferenciaDias = Math.ceil(diferenciaTiempo / (1000 * 60 * 60 * 24));
    document.getElementById('resultado_dias').textContent = diferenciaDias;
}
</script>

<?php require("../component/footer_dashboard.php"); ?>