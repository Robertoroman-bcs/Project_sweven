<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_trj.php"); ?>
<?php require("../component/header_page.php"); ?>



<section class="content">
    <?php
    $id_area_user = $_SESSION['id_area'];
    $id_cargo_user = $_SESSION['id_cargo'];
    $id_users = $_SESSION['id_usuario'];
    ?>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->


        <!-- Left col -->
        <?php

        $consulta = mysqli_query($conexion, "SELECT a.nombre, a.descripcion, a.mision, a.vision FROM usuarios u JOIN areas a ON u.id_area = a.id_area WHERE u.id_usuario = $id_users;");
        while ($row = mysqli_fetch_assoc($consulta)) {
        ?>
            <div class="row p-5" style=" height: 30vh; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 14px;">
                <div class="descripcion">
                    <h2><?php echo $row["nombre"] ?> </h2>
                    <p><?php echo $row["descripcion"] ?> </p>
                </div>
            </div>
            <div class="descripcion" style="display: flex; flex-direction: row; gap: 16px; margin-top: 16px; ">
                <div class="p-4" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 14px;">
                    <h4>MISIÓN</h4>
                    <p><?php echo $row["mision"] ?> </p>
                </div>
                <div class="p-4" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 14px;  ">
                    <h3>VISIÓN</h3>
                    <p><?php echo $row["vision"] ?> </p>
                </div>
            </div>

        <?php } ?>


        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <div class="container-fluid mt-3">
        <h2>Solicitudes</h2>
        <div> <?php $consulta = mysqli_query($conexion, "SELECT s.id_solicitud, u.nombre_usuario, u.apellidos , a.nombre , s.estado, s.aprobado_por_jefe_area, s.aprobado_por_rh, s.dias_solicitados, s.fecha_inicio, s.fecha_termino, u.fecha_creacion_usuario, s.fecha_solicitud  FROM solicitudes_vacaciones s JOIN usuarios u ON s.id_usuario = u.id_usuario JOIN areas a ON s.id_area = a.id_area WHERE u.id_usuario = $id_users");
                $estado_solicitud = '';
                if ($consulta->num_rows > 0) {
                    //$row = $result->fetch_assoc();
                    $row = mysqli_fetch_assoc($consulta);
                    $estado_solicitud = $row['estado'];
                    if ($estado_solicitud == 'Pendiente') {
                        echo '<div class="mi-clase text-center" id="mi-id" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 14px; background-color: yellow; height: 120px; width: 236px;" ><p class="pt-3" style="font-size:17px; font-weight: 600;">Solicitud Vacaciones: </p><p style="font-size:17px; font-weight: 600;">Pendientes</p></div>';
                    } else if ($estado_solicitud == 'Aprobado') {
                        echo '<div class="mi-clase text-center" id="mi-id" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 14px; background-color: green; height: 120px; width: 236px;" ><p class="pt-3" style="font-size:17px; font-weight: 600; color: white;">Solicitud Vacaciones: </p><p style="font-size:17px; font-weight: 600; color: white;">Aprobadas</p></div>';
                    } else {
                        echo '<div class="mi-clase text-center" id="mi-id" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 14px; background-color: red; height: 120px; width: 236px;" ><p class="pt-3" style="font-size:17px; font-weight: 600; color: white;">Solicitud Vacaciones: </p><p style="font-size:17px; font-weight: 600; color: white;">Rechazadas</p></div>';
                    }
                } else {
                    echo "No se encontró el usuario";
                }



                ?></div>
    </div>
    <style>

    </style>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
























<?php require("../component/footer_dashboard.php"); ?>