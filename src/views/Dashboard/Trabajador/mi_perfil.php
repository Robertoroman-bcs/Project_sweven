<?php require("../component/heade_dashboard.php"); ?>
<?php require("../component/menu_dashboard_trj.php"); ?>
<?php require("../component/header_page.php"); ?>

<section class="content">
    <?php $id_user = $_SESSION['id_usuario'];  ?>
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-sm-6">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="pt-2 px-3">
                                <h3 class="card-title">Mi Perfil</h3>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                                    href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
                                    aria-selected="true">Mi Información</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile"
                                    aria-selected="false">Mis Datos Bancarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages"
                                    aria-selected="false">Mis Documentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill"
                                    href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings"
                                    aria-selected="false">Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
                                aria-labelledby="custom-tabs-two-home-tab">


                                <?php

                                $consulta = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre_usuario, u.apellidos, u.email, u.fecha_nacimiento, u.telefono, u.contraseña, u.fecha_creacion_usuario, u.estado, r.nombre_rol, c.nombre AS nombre_cargo, a.nombre AS nombre_area  FROM usuarios u JOIN roles r ON u.id_rol = r.id_rol JOIN cargos c ON u.id_cargo = c.id_cargo JOIN areas a ON u.id_area = a.id_area WHERE u.id_usuario = $id_user ;");
                                while ($row = mysqli_fetch_assoc($consulta)) {

                                ?>

                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">ID USUARIO:</label>
                                            <input type="text" value="<?php echo $row["id_usuario"] ?>"
                                                name="id_usuario" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">NOMBRE:</label>
                                            <input type="text" value="<?php echo $row["nombre_usuario"] ?>"
                                                name="nombre_usuario" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">APELLIDOS:</label>
                                            <input type="text" value="<?php echo $row["apellidos"] ?>" name="apellidos"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">EMAIL:</label>
                                            <input type="text" value="<?php echo $row["email"] ?>" name="email"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">FECHA NACIMIENTO:</label>
                                            <input type="text" value="<?php echo $row["fecha_nacimiento"] ?>"
                                                name="fecha_nacimiento" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">TELEFONO:</label>
                                            <input type="text" value="<?php echo $row["telefono"] ?>" name="telefono"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">CONTRASEÑA:</label>
                                            <input type="text" value="<?php echo $row["contraseña"] ?>"
                                                name="contraseña" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">CREACIÓN USUARIO:</label>
                                            <input type="text" value="<?php echo $row["fecha_creacion_usuario"] ?>"
                                                name="fecha_creacion_usuario" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">ESTADO:</label>
                                            <br>
                                            <?php if ($row["estado"] != 'Inactivo') {
                                                ?>
                                            <span
                                                class="btn btn-primary col-3 font-weight-bold disabled"><?php echo $row["estado"] ?></span>
                                            <?php  } else { ?>


                                            <span
                                                class="badge badge-danger col-3  font-weight-bold disabled"><?php echo $row["estado"] ?></span>

                                            <?php } ?>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">ROL:</label>
                                            <input type="text" value="<?php echo $row["nombre_rol"] ?>"
                                                name="nombre_rol" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">CARGO:</label>
                                            <input type="text" value="<?php echo $row["nombre_cargo"] ?>"
                                                name="fecha_creacion_usuario" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">ÁREA:</label>
                                            <input type="text" value="<?php echo $row["nombre_area"] ?>"
                                                name="fecha_creacion_usuario" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>


                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-two-profile-tab">
                                <?php

                                $consulta = mysqli_query($conexion, "SELECT b.id_banco, b.nom_banco, b.num_cuenta, b.clabe_interbancaria, FORMAT(b.sueldo_neto_mensual, 2) AS sueldo_formateado, b.solicitud_tarj_nominal FROM tbl_bancarios b JOIN usuarios u ON b.id_usuario = u.id_usuario  WHERE u.id_usuario = $id_user;");
                                while ($row = mysqli_fetch_assoc($consulta)) {

                                ?>

                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">ID:</label>
                                            <input type="text" value="<?php echo $row["id_banco"] ?>" name="id_banco"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">NOMBRE BANCO:</label>
                                            <input type="text" value="<?php echo $row["nom_banco"] ?>" name="nom_banco"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">NUMERO DE CUENTA:</label>
                                            <input type="text" value="<?php echo $row["num_cuenta"] ?>"
                                                name="num_cuenta" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">CLABE INTERBANCARIA:</label>
                                            <input type="text" value="<?php echo $row["clabe_interbancaria"] ?>"
                                                name="clabe_interbancaria" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">SUELDO NETO:</label>
                                            <input type="text" value="$ <?php echo $row["sueldo_formateado"] ?>"
                                                name="sueldo_formateado" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-3">
                                        <div class="mb-3">
                                            <label for="Titulo" class="form-label">TARJETA SOLICITUD NOMINAL:</label>
                                            <input type="text" value="<?php echo $row["solicitud_tarj_nominal"] ?>"
                                                name="solicitud_tarj_nominal" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-two-messages-tab">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>

                                            <th scope="col">ACTA DE NACIMIENTO </th>
                                            <th scope="col">COMPROBANTE DE DOMICILIO</th>
                                            <th scope="col">IDENTIFICACIÓN OFICIAL (INE)</th>
                                            <th scope="col">CURP</th>
                                            <th scope="col">RFC</th>
                                            <th scope="col">NÚMERO DE SEGURO SOCIAL (NSS)</th>
                                            <th scope="col">CV ACTUALIZADO</th>
                                            <th scope="col">AVISO DE RETENCIÓN INFONAVIT</th>
                                            <th scope="col">AVISO DE PENIÓN ALIMENTICIA</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Consultamos los documentos y los datos del usuario
                                        $consulta = mysqli_query($conexion, "SELECT 
            d.id_documento, 
            u.nombre_usuario, 
            u.apellidos, 
            d.acta_doc, 
            d.comprobante_domicilio_doc, 
            d.ine_doc, 
            d.curp_doc, 
            d.rfc_doc, 
            d.nss_doc, 
            d.cv_doc, 
            d.aviso_retencion_infonavit_doc, 
            d.aviso_pension_alimenticia_doc 
            FROM documentos d 
            JOIN usuarios u ON d.id_usuario = u.id_usuario WHERE u.id_usuario = $id_user;");

                                        // Iteramos sobre cada fila de resultados
                                        while ($row = mysqli_fetch_assoc($consulta)) {
                                        ?>


                                        <tr>

                                            <!-- ACTA DE NACIMIENTO -->
                                            <td id="id">
                                                <?php if (!empty($row["acta_doc"])) { ?>
                                                <a href="../../../Document/ACTAS_DE_NACIMIENTO/<?php echo $row["acta_doc"]; ?>"
                                                    target="_blank">
                                                    <?php echo $row["acta_doc"]; ?>
                                                </a>
                                                <?php } else {
                                                        echo "No disponible";
                                                    } ?>
                                            </td>

                                            <!-- COMPROBANTE DE DOMICILIO -->
                                            <td id="id">
                                                <?php if (!empty($row["comprobante_domicilio_doc"])) { ?>
                                                <a href="../../../Document/DOMICILIO/<?php echo $row["comprobante_domicilio_doc"]; ?>"
                                                    target="_blank">

                                                    <?php echo $row["comprobante_domicilio_doc"]; ?>
                                                </a>
                                                <?php } else {
                                                        echo "No disponible";
                                                    } ?>
                                            </td>

                                            <!-- IDENTIFICACIÓN OFICIAL (INE) -->
                                            <td id="id">
                                                <?php if (!empty($row["ine_doc"])) { ?>
                                                <a href="../../../Document/INE/<?php echo $row["ine_doc"]; ?>"
                                                    target="_blank">
                                                    <?php echo $row["ine_doc"]; ?>
                                                </a>
                                                <?php } else {
                                                        echo "No disponible";
                                                    } ?>
                                            </td>

                                            <!-- CURP -->
                                            <td id="id">
                                                <?php if (!empty($row["curp_doc"])) { ?>
                                                <a href="../../../Document/CURP/<?php echo $row["curp_doc"]; ?>"
                                                    target="_blank">
                                                    <?php echo $row["curp_doc"]; ?>
                                                </a>
                                                <?php } else {
                                                        echo "No disponible";
                                                    } ?>
                                            </td>

                                            <!-- RFC -->
                                            <td id="id">
                                                <?php if (!empty($row["rfc_doc"])) { ?>
                                                <a href="../../../Document/RFC/<?php echo $row["rfc_doc"]; ?>"
                                                    target="_blank">
                                                    <?php echo $row["rfc_doc"]; ?>
                                                </a>
                                                <?php } else {
                                                        echo "No disponible";
                                                    } ?>
                                            </td>

                                            <!-- NÚMERO DE SEGURO SOCIAL (NSS) -->
                                            <td id="id">
                                                <?php if (!empty($row["nss_doc"])) { ?>
                                                <a href="../../../Document/NSS/<?php echo $row["nss_doc"]; ?>"
                                                    target="_blank">
                                                    <?php echo $row["nss_doc"]; ?>
                                                </a>
                                                <?php } else {
                                                        echo "No disponible";
                                                    } ?>
                                            </td>

                                            <!-- CV ACTUALIZADO -->
                                            <td id="id">
                                                <?php if (!empty($row["cv_doc"])) { ?>
                                                <a href="../../../Document/CV/<?php echo $row["cv_doc"]; ?>"
                                                    target="_blank">
                                                    <?php echo $row["cv_doc"]; ?>
                                                </a>
                                                <?php } else {
                                                        echo "No disponible";
                                                    } ?>
                                            </td>

                                            <!-- AVISO DE RETENCIÓN INFONAVIT -->
                                            <td id="id">
                                                <?php if (!empty($row["aviso_retencion_infonavit_doc"])) { ?>
                                                <a href="../../../Document/INFONAVIT/<?php echo $row["aviso_retencion_infonavit_doc"]; ?>"
                                                    target="_blank">

                                                    <?php echo $row["aviso_retencion_infonavit_doc"]; ?>"
                                                </a>
                                                <?php } else {
                                                        echo "No disponible";
                                                    } ?>
                                            </td>

                                            <!-- AVISO DE PENSIÓN ALIMENTICIA -->
                                            <td id="id">
                                                <?php if (!empty($row["aviso_pension_alimenticia_doc"])) { ?>
                                                <a href="../../../Document/ALIMENTACION/<?php echo $row["aviso_pension_alimenticia_doc"]; ?>"
                                                    target="_blank">

                                                    <?php echo $row["aviso_pension_alimenticia_doc"]; ?>
                                                </a>
                                                <?php } else {
                                                        echo "No disponible";
                                                    } ?>
                                            </td>

                                            <!-- Acciones -->

                                        </tr>





                                        <?php } ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="col">ACTA DE NACIMIENTO </th>
                                            <th scope="col">COMPROBANTE DE DOMICILIO</th>
                                            <th scope="col">IDENTIFICACIÓN OFICIAL (INE)</th>
                                            <th scope="col">CURP</th>
                                            <th scope="col">RFC</th>
                                            <th scope="col">NÚMERO DE SEGURO SOCIAL (NSS)</th>
                                            <th scope="col">CV ACTUALIZADO</th>
                                            <th scope="col">AVISO DE RETENCIÓN INFONAVIT</th>
                                            <th scope="col">AVISO DE PENIÓN ALIMENTICIA</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel"
                                aria-labelledby="custom-tabs-two-settings-tab">
                                Pellentesque vestibulum commodo nibh nec blandit.
                                Maecenas neque magna, iaculis tempus turpis ac, ornare
                                sodales tellus. Mauris eget blandit dolor. Quisque
                                tincidunt venenatis vulputate. Morbi euismod molestie
                                tristique. Vestibulum consectetur dolor a vestibulum
                                pharetra. Donec interdum placerat urna nec pharetra.
                                Etiam eget dapibus orci, eget aliquet urna. Nunc at
                                consequat diam. Nunc et felis ut nisl commodo dignissim.
                                In hac habitasse platea dictumst. Praesent imperdiet
                                accumsan ex sit amet facilisis.
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>



</section>
</div>
<!-- /.content-wrapper -->


<?php require("../component/footer_dashboard.php"); ?>