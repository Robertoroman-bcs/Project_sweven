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
                        <h5 class="m-0">LISTA EMPLEADOS MM</h5>
                        <?php if (isset($_GET['erroremail']) && $_GET['erroremail'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> El email ya se encutra registrado, ingrese otro. </p></div>';
                        } ?>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_agregar_usuario">
                                Agregar Usuario
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
                                        <th>E-MAIL</th>
                                        <th>FECHA DE NACIMIENTO</th>
                                        <th>TELEFONO</th>

                                        <th>FECHA INGRESO</th>
                                        <th>ESTADO</th>
                                        <th>TIPO USUARIO</th>
                                        <th>CARGO</th>
                                        <th>ÁREA</th>
                                        <th>ACCIONES </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $consulta = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre_usuario, u.apellidos, u.email, u.fecha_nacimiento, u.telefono, u.fecha_creacion_usuario, u.estado,  r.nombre_rol AS nombre_rol,c.nombre AS nombre_cargo, a.nombre AS nombre_area  FROM usuarios u JOIN roles r ON u.id_rol = r.id_rol JOIN cargos c ON u.id_cargo = c.id_cargo JOIN areas a ON u.id_area = a.id_area WHERE c.id_cargo != $id_cargo_user AND a.id_area = $id_area_user;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                    ?>
                                        <tr>
                                            <td id="id_usuario"><?php echo $row["id_usuario"] ?></td>
                                            <td id="nombre_usuario"><?php echo $row["nombre_usuario"] ?></td>
                                            <td id="apellidos"><?php echo $row["apellidos"] ?></td>
                                            <td id="email"><?php echo $row["email"] ?></td>
                                            <td id="fecha_nacimiento">
                                                <?php echo $row["fecha_nacimiento"] ?>
                                            </td>
                                            <td id="telefono"><?php echo $row["telefono"] ?></td>

                                            <td id="fecha_creacion_usuario">
                                                <?php echo $row["fecha_creacion_usuario"] ?>
                                            </td>
                                            <td id="estado">
                                                <span
                                                    class="badge badge-primary font-weight-bold"><?php echo $row["estado"] ?></span>
                                            </td>
                                            <td id="nombre_rol">
                                                <?php echo $row["nombre_rol"] ?>
                                            </td>
                                            <td id="nombre_cargo">
                                                <?php echo $row["nombre_cargo"] ?>
                                            </td>
                                            <td id="nombre_area">
                                                <?php echo $row["nombre_area"] ?>
                                            </td>
                                            <td>


                                            </td>


                                        </tr>

                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>APELLIDOS</th>
                                        <th>E-MAIL</th>
                                        <th>FECHA DE NACIMIENTO</th>
                                        <th>TELEFONO</th>

                                        <th>FECHA INGRESO</th>
                                        <th>ESTADO</th>
                                        <th>TIPO USUARIO</th>
                                        <th>CARGO</th>
                                        <th>ÁREA</th>
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


<?php require("../component/footer_dashboard.php"); ?>