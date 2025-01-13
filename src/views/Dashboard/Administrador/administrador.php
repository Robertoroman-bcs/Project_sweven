<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_admin.php"); ?>
<?php require("../component/header_page.php"); ?>

<!-- /.navbar -->




<!-- Main content -->
<section class="content">
    <?php echo $_SESSION['usuario'];  ?>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <!-- /.row -->
        <div class="row">

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">

                        <?php $consulta = mysqli_query($conexion, "SELECT COUNT(u.id_usuario) AS usuarios_total FROM usuarios u;");

                        if ($consulta->num_rows > 0) {
                            $fila = $consulta->fetch_assoc();
                            $usuarios_total = $fila['usuarios_total'];
                        } else {


                            $usuarios_total = 0;
                        }
                        ?>
                        <h3><?php echo $usuarios_total ?></h3>

                        <p>Usuarios Registrados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <?php $consulta = mysqli_query($conexion, "SELECT COUNT(u.estado) AS inactivos_users FROM usuarios u WHERE u.estado != 'Activo';");

                        if ($consulta->num_rows > 0) {
                            $fila = $consulta->fetch_assoc();
                            $inactivos_users = $fila['inactivos_users'];
                        } else {
                            $inactivos_users = 0;
                        }
                        ?>
                        <h3><?php echo $inactivos_users ?></h3>

                        <p>Usuarios Inactivos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <?php $consulta = mysqli_query($conexion, "SELECT COUNT(u.estado) AS activos_users FROM usuarios u WHERE u.estado = 'Activo';");

                        if ($consulta->num_rows > 0) {
                            $fila = $consulta->fetch_assoc();
                            $activos_users = $fila['activos_users'];
                        } else {
                            $activos_users = 0;
                        }
                        ?>
                        <h3><?php echo $activos_users ?></h3>

                        <p>Usuarior Activos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">

                        <?php $consulta = mysqli_query($conexion, "SELECT COUNT(u.id_usuario) AS cantidad_usuarios_sin_documentos FROM usuarios u LEFT JOIN documentos d ON u.id_usuario = d.id_usuario WHERE d.id_documento IS NULL;");

                        if ($consulta->num_rows > 0) {
                            $fila = $consulta->fetch_assoc();
                            $cantidad_usuarios_sin_documentos = $fila['cantidad_usuarios_sin_documentos'];
                        } else {


                            $cantidad_usuarios_sin_documentos = 0;
                        }
                        ?>
                        <h3><?php echo $cantidad_usuarios_sin_documentos ?> </h3>

                        <p>Usuarios sin Documentación</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->





            </section>

        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
// Cerrar la conexión
$conexion->close();
?>


<?php require("../component/footer_dashboard.php"); ?>