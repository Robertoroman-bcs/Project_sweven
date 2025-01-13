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
                        <h5 class="m-0">LISTA ÁREAS</h5>
                        <?php if (isset($_GET['errorarea']) && $_GET['errorarea'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> El email ya se encutra registrado, ingrese otro. </p></div>';
                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit;
                        } ?>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_agregar_area">
                                Agregar Área
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th>MISIÓN</th>
                                        <th>VISIÓN</th>
                                        <th>FECHA CREACIÓN</th>
                                        <th>ACCIONES </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id_user = $_SESSION['id_usuario'];
                                    $consulta = mysqli_query($conexion, "SELECT id_area, nombre, descripcion, mision, vision, fecha_creacion FROM areas;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                    ?>
                                    <tr>
                                        <td id="id"><?php echo $row["id_area"] ?></td>
                                        <td id="nombre"><?php echo $row["nombre"] ?></td>
                                        <td id="descripcion"><?php echo $row["descripcion"] ?></td>
                                        <td id="mision"><?php echo $row["mision"] ?></td>
                                        <td id="vision"><?php echo $row["vision"] ?></td>
                                        <td id="fecha_creacion"><?php echo $row["fecha_creacion"] ?></td>
                                        <td>
                                            <div style="display: flex;" class="btn-action">
                                                <div style="display: flex;" class="btn-action">
                                                    <!-- Botón de eliminar con icono -->
                                                    <form action="../../../controllers/eliminarAreaController.php"
                                                        method="POST"
                                                        onsubmit="return confirm('¿Estás seguro de eliminar el área   <?php echo $row['nombre']; ?> ? ')">
                                                        <input type="hidden" name="id_area"
                                                            value="<?php echo $row['id_area']; ?>">
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
                                        <th>DESCRIPCIÓN</th>
                                        <th>MISIÓN</th>
                                        <th>VISIÓN</th>
                                        <th>FECHA CREACIÓN</th>
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






<div class="modal fade" id="modal_agregar_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Área</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../../controllers/registrarAreaController.php" method="post">
                    <div class="row shadow p-3 mb-5 bg-white rounded">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">NOMBRE ÁREA:</label>
                                <input type="text" id="nombre_area" name="nombre_area" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">DESCRIPCIÓN:</label>

                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" cols="50"
                                    style="resize: both; resize: none;" placeholder="Escribe aquí..."></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">MISIÓN:</label>
                                <!--<input type="text" id="mision" name="mision" class="form-control" required>-->
                                <textarea class="form-control" id="mision" name="mision" rows="5" cols="50"
                                    style="resize: both; resize: none;" placeholder="Escribe aquí..."></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">VISIÓN:</label>
                                <textarea class="form-control" id="vision" name="vision" rows="5" cols="50"
                                    style="resize: both; resize: none;" placeholder="Escribe aquí..."></textarea>
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














<?php require("../component/footer_dashboard.php"); ?>