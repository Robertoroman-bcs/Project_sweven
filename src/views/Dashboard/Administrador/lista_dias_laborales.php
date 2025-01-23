<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_admin.php"); ?>
<?php require("../component/header_page.php"); ?>

<style>
    input[type="checkbox"]:disabled {
        opacity: 1;
        /* Mantener la opacidad */
        cursor: not-allowed;
        /* Cambiar el cursor */
        background-color: #f0f0f0;
        /* Fondo gris claro */
        border: 2px solid #ccc;
        /* Borde gris */
    }

    input[type="checkbox"]:disabled:checked {
        background-color: #d1e7dd;
        /* Fondo verde claro */
        border: 2px solid #0f5132;
        /* Borde verde oscuro */
    }
</style>


<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">DÍAS LABORALES</h5>
                        <?php if (isset($_GET['erroremail']) && $_GET['erroremail'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> El email ya se encutra registrado, ingrese otro. </p></div>';
                        } ?>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_dias_laborales">
                                Actualizar dias laborales
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>DIAS</th>
                                        <th>LABORAL</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dias_semana = [
                                        1 => 'lunes',
                                        2 => 'martes',
                                        3 => 'miércoles',
                                        4 => 'jueves',
                                        5 => 'viernes',
                                        6 => 'sábado',
                                        7 => 'domingo'
                                    ];


                                    $consulta = mysqli_query($conexion, "SELECT dia_semana, es_laboral FROM dias_laborales;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                        $dia_semana = $row['dia_semana']; // Número del día
                                        $es_laboral = $row['es_laboral']; // Estado laboral
                                        $nombre_dia = $dias_semana[$dia_semana]; // Nombre del día
                                    ?>


                                        <tr>
                                            <td>
                                                <label>
                                                    <?php echo ucfirst($nombre_dia); ?>

                                                </label>
                                            </td>
                                            <td>
                                                <input disabled type="checkbox" name="<?php echo $nombre_dia; ?>" value="1"
                                                    <?php echo ($es_laboral == 1) ? 'checked' : ''; ?>>
                                            </td>



                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>

                                        <th>ID</th>
                                        <th>LUNES</th>
                                        <th></th>

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


<div class="modal fade" id="modal_dias_laborales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar días laborales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



                <form action="../../../controllers/actualizarDiasLaborales.php" method="POST">
                    <?php
                    $dias_semana = [
                        1 => 'lunes',
                        2 => 'martes',
                        3 => 'miércoles',
                        4 => 'jueves',
                        5 => 'viernes',
                        6 => 'sábado',
                        7 => 'domingo'
                    ];


                    $consulta = mysqli_query($conexion, "SELECT dia_semana, es_laboral FROM dias_laborales;");
                    while ($row = mysqli_fetch_assoc($consulta)) {
                        $dia_semana = $row['dia_semana']; // Número del día
                        $es_laboral = $row['es_laboral']; // Estado laboral
                        $nombre_dia = $dias_semana[$dia_semana]; // Nombre del día
                    ?>
                        <label>
                            <?php echo ucfirst($nombre_dia); ?>
                            <input type="checkbox" name="<?php echo $nombre_dia; ?>" value="1"
                                <?php echo ($es_laboral == 1) ? 'checked' : ''; ?>>
                        </label>
                        <br>
                    <?php
                    }
                    ?>
                    <button type="submit">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
// Cerrar conexión
$conexion->close();
?>











<?php require("../component/footer_dashboard.php"); ?>