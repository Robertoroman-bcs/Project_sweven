<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_rh.php"); ?>
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
                        <h5 class="m-0">LISTA EMPLEADOS RH</h5>
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
                                        <th>CONTRASEÑA</th>
                                        <th>FECHA INGRESO</th>
                                        <th>ESTADO</th>
                                        <th>TIPO USUARIO</th>
                                        <th>Acciones </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $consulta = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre_usuario, u.apellidos, u.email, u.fecha_nacimiento, u.telefono, u.contraseña, u.fecha_creacion_usuario, u.estado, r.nombre_rol  FROM usuarios u JOIN roles r ON u.id_rol = r.id_rol WHERE r.nombre_rol != 'Administrador' ORDER BY u.id_usuario ASC;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                    ?>
                                        <tr>
                                            <td id="id"><?php echo $row["id_usuario"] ?></td>
                                            <td id="nombre_usuario"><?php echo $row["nombre_usuario"] ?></td>
                                            <td id="apellidos"><?php echo $row["apellidos"] ?></td>
                                            <td id="email"><?php echo $row["email"] ?></td>
                                            <td id="fecha_nacimiento">
                                                <?php echo $row["fecha_nacimiento"] ?>
                                            </td>
                                            <td id="telefono"><?php echo $row["telefono"] ?></td>
                                            <td id="contraseña">
                                                <?php echo $row["contraseña"] ?>
                                            </td>
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
                                            <td>
                                                <div style="display: flex;" class="btn-action">
                                                    <button style="display: flex;
    justify-content: center;
    align-items: center;" class="btn bg-success btneditar" type="submit" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop"><img src="" alt=""> <img
                                                            style="width: 15px;" src="../../../asset/acercarse.png"
                                                            alt=""></button>
                                                    <button style="display: flex;
    justify-content: center;
    align-items: center;" class="btn bg-warning btneditar" type="submit" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop"><img src="" alt=""> <img
                                                            style="width: 15px;" src="../../../asset/boton-editar.png"
                                                            alt=""></button>
                                                    <button style="display: flex;
    justify-content: center;
    align-items: center;" class="btn btn-danger"><img style="width: 15px;" src="../../../asset/borrar.png"
                                                            alt=""></button>
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
                                        <th>E-MAIL</th>
                                        <th>FECHA DE NACIMIENTO</th>
                                        <th>TELEFONO</th>
                                        <th>CONTRASEÑA</th>
                                        <th>FECHA INGRESO</th>
                                        <th>ESTADO</th>
                                        <th>TIPO USUARIO</th>
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





























<?php require("../component/footer_dashboard.php"); ?>