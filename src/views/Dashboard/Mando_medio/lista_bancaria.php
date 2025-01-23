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
                        <h5 class="m-0">LISTA Datos Bancarios</h5>
                        <?php if (isset($_GET['errorbanco']) && $_GET['errorbanco'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> El email ya se encutra registrado, ingrese otro. </p></div>';
                        } ?>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_agregar_banco">
                                Agregar Datos Bancarios
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>APELLIDOS</th>
                                        <th>NOMBRE BANCO</th>
                                        <th>NUMERO DE CUENTA</th>
                                        <th>CLABE INTERBANCARIA</th>
                                        <th>SUELDO NETO</th>
                                        <th>SOLICITUD TARJERTA NOMINAL</th>
                                        <th>Acciones </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $consulta = mysqli_query($conexion, "SELECT   b.id_banco, u.nombre_usuario, u.apellidos, b.nom_banco, b.num_cuenta, b.clabe_interbancaria, FORMAT(b.sueldo_neto_mensual, 2) AS sueldo_formateado  , b.solicitud_tarj_nominal  FROM tbl_bancarios b JOIN usuarios u ON b.id_usuario = u.id_usuario JOIN cargos c ON u.id_cargo = c.id_cargo JOIN areas a ON u.id_area = a.id_area WHERE c.id_cargo != $id_cargo_user AND a.id_area = $id_area_user;;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                    ?>
                                        <tr>
                                            <td id="id"><?php echo $row["id_banco"] ?></td>
                                            <td id="telefono"><?php echo $row["nombre_usuario"] ?></td>
                                            <td id="contraseña">
                                                <?php echo $row["apellidos"] ?>
                                            </td>
                                            <td id="nombre"><?php echo $row["nom_banco"] ?></td>
                                            <td id="apellidos"><?php echo $row["num_cuenta"] ?></td>
                                            <td id="email"><?php echo $row["clabe_interbancaria"] ?></td>
                                            <td id="email">$ <?php echo $row["sueldo_formateado"] ?></td>
                                            <td id="fecha_nacimiento">
                                                <?php echo $row["solicitud_tarj_nominal"] ?>
                                            </td>




                                            <td>
                                                <div style="display: flex;" class="btn-action">
                                                    <div style="display: flex;" class="btn-action">
                                                        <!-- Botón de eliminar con icono -->
                                                        <form action="../../../controllers/eliminarBancaController.php"
                                                            method="POST"
                                                            onsubmit="return confirm('¿Estás seguro de eliminar los datos bancarios de   <?php echo $row['nombre_usuario']; ?> ? ')">
                                                            <input type="hidden" name="id_banco"
                                                                value="<?php echo $row['id_banco']; ?>">
                                                            <button class="btn btn-danger btn-icon" type="submit"
                                                                title="Eliminar Cargo">
                                                                <i class="fas fa-trash-alt"></i>
                                                                <!-- Icono de Font Awesome -->
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <button style="display: flex;
justify-content: center;
align-items: center;" class="btn bg-warning btneditar" type="submit" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop"><img src="" alt=""> <img
                                                            style="width: 15px;" src="../../../asset/boton-editar.png"
                                                            alt=""></button>
                                                    <button style="display: flex;
justify-content: center;
align-items: center;" class="btn btn-danger"><img style="width: 15px;" src="../../../asset/borrar.png" alt=""></button>
                                                </div>

                                            </td>


                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>APELLIDOS</th>
                                        <th>NOMBRE BANCO</th>
                                        <th>NUMERO DE CUENTA</th>
                                        <th>CLABE INTERBANCARIA</th>
                                        <th>SUELDO NETO</th>
                                        <th>SOLICITUD TARJERTA NOMINAL</th>
                                        <th>Acciones </th>
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
<div class="modal fade" id="modal_agregar_banco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos Bancarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../../controllers/registroBancarioController.php" method="post">
                    <div class="row shadow p-3 mb-5 bg-white rounded">



                        <div class="col-12">
                            <div class="form-group">
                                <label for="id_usuario">SELECCIONE USUARIO</label>
                                <select class="form-control select2bs4" id="id_usuario" name="id_usuario"
                                    style="width: 100%;">
                                    <option value="" selected="selected">Seleccione un usuario</option>
                                    <?php
                                    $consulta = mysqli_query($conexion, "SELECT id_usuario, nombre_usuario, apellidos FROM usuarios;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                        echo "<option value='{$row['id_usuario']}'>" . htmlspecialchars($row['nombre_usuario'] . ' ' . $row['apellidos']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">NOMBRE BANCO</label>
                                <input type="text" id="nombre_banco_modal" name="nombre_banco" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">NUMERO DE CUENTA</label>
                                <input type="text" id="num_cuenta_modal" name="num_cuenta" class="form-control"
                                    placeholder="XXXX XXXX XX XXXXXXXXXX" oninput="validarInput(event)" required>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">CLABE INTERBANCARIA</label>
                                <input type="text" id="clabe_interbancaria_modal" name="clabe_interbancaria"
                                    class="form-control" placeholder="XXX XXX XXXXXXXXXXX X"
                                    oninput="validarInput(event)" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">SUELDO NETO</label>
                                <input type="text" id="sueldo_modal" name="sueldo" class="form-control"
                                    placeholder="$0,000.00" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">SOLICITUD TARJERTA NOMINAL</label>
                                <input type="text" id="solicitud_tarjeta_modal" name="solicitud_tarjeta"
                                    class="form-control" required>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function() {
        // Inicializa el select2 con configuración de búsqueda en tiempo real
        $('#id_usuario_search').select2({
            placeholder: 'Buscar usuario...',
            allowClear: true, // Opción para limpiar el campo
            minimumInputLength: 1, // Mínimo 1 carácter para empezar la búsqueda
            ajax: {
                url: 'buscar_usuarios.php', // Ruta al archivo PHP para la búsqueda
                dataType: 'json',
                delay: 300, // 300ms de retraso para evitar solicitudes en cada tecla
                data: function(params) {
                    return {
                        q: params.term // El término de búsqueda que el usuario escribe
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id_usuario,
                                text: item.nombre_usuario + ' ' + item.apellidos
                            };
                        })
                    };
                },
                cache: true // Habilita caché para las búsquedas previas
            }
        });
    });
</script>

<script>
    function validarInput(event) {
        const input = event.target;
        const valor = input
            .value;
        if (!/^\d{0,18}$/.test(valor)) {
            input.value = valor.slice(0, -1);
        }
    }
</script>















<?php require("../component/footer_dashboard.php"); ?>