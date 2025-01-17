<td id="estado"> <span class="font-weight-bold"><?php echo $row["estado"] ?></span>
</td>
<td id="aprobado_por_jefe_area"><span class="font-weight-bold"><?php echo $row["aprobado_por_jefe_area"] ?></span>
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
                        <?php $consulta = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre_usuario, u.apellidos, u.estado , u.fecha_creacion_usuario, a.id_area, a.nombre FROM usuarios u JOIN areas a ON u.id_area = a.id_area WHERE u.id_usuario = $id_user;");

                        if ($consulta->num_rows > 0) {
                            //$row = $result->fetch_assoc();
                            $row = mysqli_fetch_assoc($consulta);
                            $id_usuario = $row["id_usuario"];
                            $nombre_usuario = $row["nombre_usuario"] . ' ' . $row["apellidos"];
                            $estado = $row["estado"];
                            $id_area = $row["id_area"];
                            $nombre_area = $row["nombre"];
                            $fecha_creacion_usuario = $row["fecha_creacion_usuario"];



                        ?>

                        <div class="col-xs-12 col-md-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">ID USUARIO:</label>
                                <input type="text" value="<?php echo $id_usuario; ?>" id="id_usuario" name="id_usuario"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">NOMBRE:</label>
                                <input type="text" value="<?php echo $nombre_usuario; ?>" id="nombre_usuario"
                                    name="nombre_usuario" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">ID AREA:</label>
                                <input type="text" value="<?php echo $id_area; ?>" id="id_area" name="id_area"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">NOMBRE ÁREA:</label>
                                <input type="text" value="<?php echo $nombre_area; ?>" id="nombre_area"
                                    name="nombre_area" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">ESTADO:</label>
                                <input type="text" value="<?php echo $estado; ?>" id="estado" name="estado"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 ">
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

                        <div class="col-xs-12 col-md-6">
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

                        <div class="col-xs-12 col-md-6">
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
var mesesDeAntigüedad = hoy.getMonth() - ingreso.getMonth();

if (mesesDeAntigüedad < 0 || (mesesDeAntigüedad === 0 && hoy.getDate() < ingreso.getDate())) {
    añosDeAntigüedad--;
}

// Asignar días de vacaciones según la antigüedad
var diasVacaciones;
if (añosDeAntigüedad >= 3) {
    diasVacaciones = 16;
} else if (añosDeAntigüedad === 2) {
    diasVacaciones = 14;
} else if (añosDeAntigüedad === 1) {
    diasVacaciones = 12;
} else {
    diasVacaciones = 10; // Menos de 1 año
}

// Mostrar el resultado
document.getElementById('resultado').innerText = "Con derecho a : " + diasVacaciones + " de vacaciones";


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