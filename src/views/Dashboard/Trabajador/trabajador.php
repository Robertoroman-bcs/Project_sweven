<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_trj.php"); ?>
<?php require("../component/header_page.php"); ?>
<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.3.0/dist/dotlottie-wc.js" type="module"></script>




<style>
.birthdayCard {
    position: relative;
    width: 200px;
    height: 300px;
    cursor: pointer;
    transform-style: preserve-3d;
    transform: perspective(2500px);
    transition: 1s;
    left: 20%;

}

.birthdayCard:hover {
    transform: perspective(2500px) rotate(5deg);
    box-shadow: inset 100px 20px 100px rgba(0, 0, 0, 0.2),
        0 10px 100px rgba(0, 0, 0, 0.5);
    left: 50%;
}

.birthdayCard:hover .cardFront {
    transform: rotateY(-160deg);
}

.birthdayCard:hover .happy {
    visibility: hidden;
}

.cardFront {
    position: relative;
    background-color: #fff;
    width: 250px;
    height: 350px;
    overflow: hidden;
    transform-origin: left;
    box-shadow: inset 100px 20px 100px rgba(0, 0, 0, 0.2),
        30px 0 50px rgba(0, 0, 0, 0.4);
    transition: 0.6s;
}

.happy {
    font-family: Tahoma, sans-serif;
    text-align: center;
    margin: 30px;
    background-image: linear-gradient(120deg, #ffd856 0%, #f98c6e 100%);
    transition: 0.1s;
}

.balloons {
    position: absolute;
}

.balloon-1,
.balloon-2,
.balloon-3,
.balloon-4 {
    position: absolute;
    width: 85px;
    height: 95px;
    border-radius: 50%;
}

.balloon-1 {
    background-color: rgba(255, 40, 90, 0.7);
    left: -10px;
    top: 50px;
}

.balloon-2 {
    background-color: rgba(9, 215, 160, 0.7);
    left: 50px;
    top: 20px;
}

.balloon-3 {
    background-color: rgba(255, 186, 26, 0.7);
    left: 110px;
    top: 50px;
}

.balloon-4 {
    background-color: rgba(12, 122, 159, 0.7);
    left: 170px;
    top: 50px;
}

.balloon-1::before,
.balloon-2::before,
.balloon-3::before,
.balloon-4::before {
    content: "";
    position: absolute;
    width: 1px;
    height: 155px;
    background-color: #ffc848;
    top: 95px;
    left: 43px;
}

.balloon-1::after,
.balloon-2::after,
.balloon-3::after,
.balloon-4::after {
    content: "";
    position: absolute;
    border-right: 7px solid transparent;
    border-left: 7px solid transparent;
    top: 94px;
    left: 37px;
}

.balloon-1::after {
    border-bottom: 10px solid #ff3e6b;
}

.balloon-2::after {
    border-bottom: 10px solid #04b183;
}

.balloon-3::after {
    border-bottom: 10px solid #ffc94c;
}

.balloon-4::after {
    border-bottom: 10px solid #13a9bd;
}

.cardInside {
    position: absolute;
    background-color: #fff;
    width: 250px;
    height: 350px;
    z-index: -1;
    left: 0;
    top: 0;
    box-shadow: inset 100px 20px 100px rgba(0, 0, 0, 0.2);
}

.cardInside h5 {
    color: black;
    font-weight: 600;
    text-align: center;
}

.cardInside p {
    font-family: 'Courier New', Courier, monospace;
    margin: 29px;
    color: #333;
}

.name {
    position: absolute;
    left: 150px;
    top: 200px;
    color: #333;
}

.back {
    font-family: Tahoma, sans-serif;
    color: #333;
    text-align: center;
    margin: 30px;
    outline-color: #333;
    outline-style: dotted;
}
</style>



<section class="content">
    <?php
    $id_area_user = $_SESSION['id_area'];
    $id_cargo_user = $_SESSION['id_cargo'];
    $id_users = $_SESSION['id_usuario'];
    ?>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">


            <?php

            $consulta = mysqli_query($conexion, "SELECT nombre_usuario, apellidos, fecha_nacimiento 
FROM usuarios 
WHERE MONTH(fecha_nacimiento) = MONTH(CURDATE()) 
AND DAY(fecha_nacimiento) = DAY(CURDATE())");
            while ($row = mysqli_fetch_assoc($consulta)) {
            ?>
            <div class="col-lg-4 col-sm-12  ">
                <dotlottie-wc style="width: 450px; height: 450px;" class=""
                    src="https://lottie.host/bd3bf80d-f435-4cfd-a552-6ca0cb179c00/EcaofKKABz.lottie" autoplay loop>
                </dotlottie-wc>

            </div>
            <div class="col-lg-4 col-sm-12 bg-danger ">
                <div class="birthdayCard ">
                    <div class="cardFront">
                        <h3 class="happy">Feliz Cumpleaños</h3>
                        <div class="balloons">
                            <div class="balloon-1"></div>
                            <div class="balloon-2"></div>
                            <div class="balloon-3"></div>
                            <div class="balloon-4"></div>
                        </div>
                    </div>
                    <div class="cardInside">
                        <h3 class="back">Feliz Cumpleaños</h3>
                        <h5><?php echo $row["nombre_usuario"] ?>
                            <?php echo $row["apellidos"] ?> </h5>
                        <p>
                            QUE TE LA PASES BIEN EN TU DÍA
                        <p class="card-text"><?php echo $row["fecha_nacimiento"]  ?></p>
                        </p>

                    </div>
                </div>




            </div>
            <div class="col-lg-4 col-sm-12  ">
                <dotlottie-wc style="width: 450px; height: 450px;" class=""
                    src="https://lottie.host/bd3bf80d-f435-4cfd-a552-6ca0cb179c00/EcaofKKABz.lottie" autoplay loop>
                </dotlottie-wc>

            </div>

            <?php } ?>





        </div>



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
                    echo '<div class="mi-clase text-center" id="mi-id" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 14px; background-color: #41a7f5; height: 120px; width: 236px;" ><p class="pt-3" style="font-size:17px; font-weight: 600; color: white;">Solicitud Vacaciones: </p><p style="font-size:17px; font-weight: 600; color: white;">No hay solicitud</p></div>';
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