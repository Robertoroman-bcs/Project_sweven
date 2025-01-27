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
                        <h5 class="m-0">LISTA EMPLEADOS</h5>
                        <?php if (isset($_GET['erroremail']) && $_GET['erroremail'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> El email ya se encutra registrado, ingrese otro. </p></div>';
                        } else if (isset($_GET['errorcargo']) && $_GET['errorcargo'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> Ya existe Jefe de departamento en el área, ingrese otro cargo </p></div>';
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
                                        <th>E-MAIL</th>
                                        <th>TELEFONO</th>
                                        <th>ESTADO</th>
                                        <th>TIPO USUARIO</th>
                                        <th>CARGO</th>
                                        <th>ÁREA</th>
                                        <th>Acciones </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $consulta = mysqli_query($conexion, "SELECT u.id_usuario, u.nombre_usuario, u.apellidos, u.email, u.fecha_nacimiento, u.telefono, u.contraseña, u.fecha_creacion_usuario, u.estado, r.nombre_rol, c.nombre AS nombre_cargo, a.nombre AS nombre_area FROM usuarios u JOIN roles r ON u.id_rol = r.id_rol JOIN cargos c ON u.id_cargo = c.id_cargo JOIN areas a ON u.id_area = a.id_area ORDER BY U.fecha_creacion_usuario DESC;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                    ?>
                                        <tr>
                                            <td id="id_usuario"><?php echo $row["id_usuario"]  ?></td>
                                            <td id="nombre_usuario">
                                                <?php echo $row["nombre_usuario"] . ' ' . $row["apellidos"] ?></td>

                                            <td id="email"><?php echo $row["email"] ?></td>

                                            <td id="telefono"><?php echo $row["telefono"] ?></td>


                                            <td id="estado">
                                                <?php if ($row["estado"] != 'Inactivo') {
                                                ?>
                                                    <span
                                                        class="badge badge-primary font-weight-bold"><?php echo $row["estado"] ?></span>
                                                <?php  } else { ?>


                                                    <span
                                                        class="badge badge-danger font-weight-bold"><?php echo $row["estado"] ?></span>

                                                <?php } ?>
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
                                                <div class="d-flex">
                                                    <div style="display: flex;" class="btn-action">
                                                        <!-- Botón de eliminar con icono -->
                                                        <form action="../../../controllers/eliminarUsuarioController.php"
                                                            method="POST"
                                                            onsubmit="return confirm('¿Estás seguro de eliminar a este Usuario?')">
                                                            <input type="hidden" name="id_usuario"
                                                                value="<?php echo $row['id_usuario']; ?>">
                                                            <button class="btn btn-danger btn-icon" type="submit"
                                                                title="Eliminar Usuario">
                                                                <i class="fas fa-trash-alt"></i>
                                                                <!-- Icono de Font Awesome -->
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div style="display: flex;" class="btn-action">
                                                        <button class="openModalBtn btn-warning" style="display: flex;
justify-content: center;
align-items: center;" class="btn bg-primary btneditar" type="submit" data-toggle="modal"
                                                            data-target="#modal_actualizar_usuario"
                                                            data-id="<?php echo $row["id_usuario"] ?>">
                                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                width="34" height="34" fill="none">
                                                                <style>
                                                                    @keyframes rotate-center {
                                                                        0% {
                                                                            transform: rotate(0)
                                                                        }

                                                                        to {
                                                                            transform: rotate(360deg)
                                                                        }
                                                                    }
                                                                </style>
                                                                <g style="animation:rotate-center 1.5s ease-in-out infinite both;transform-origin:center center"
                                                                    stroke-width="1.5">
                                                                    <path stroke="#0A0A30" stroke-linecap="round"
                                                                        d="M6.883 11.778a5 5 0 018.473-3.597m1.761 4.131a5 5 0 01-8.473 3.597" />
                                                                    <path fill="#265BFF" stroke="#265BFF"
                                                                        d="M17.078 10.145l-2.308-.347a.066.066 0 01-.018-.005.026.026 0 01-.007-.005.056.056 0 01-.015-.024.056.056 0 01-.002-.03l.003-.007a.069.069 0 01.012-.015l1.995-1.964a.064.064 0 01.015-.012.028.028 0 01.007-.003.056.056 0 01.029.003c.012.004.02.01.024.015a.03.03 0 01.005.007.069.069 0 01.004.019l.313 2.312a.046.046 0 01-.015.042.045.045 0 01-.043.014zm-10.156 3.8l2.308.348.018.005a.03.03 0 01.007.005c.004.003.01.011.015.024a.056.056 0 01.002.029.027.027 0 01-.003.007.065.065 0 01-.012.015l-1.995 1.965a.072.072 0 01-.015.012.03.03 0 01-.007.003.056.056 0 01-.029-.003.057.057 0 01-.024-.016.028.028 0 01-.005-.006.066.066 0 01-.004-.019l-.313-2.312a.046.046 0 01.002-.023.053.053 0 01.013-.02.052.052 0 01.02-.012.046.046 0 01.022-.002z" />
                                                                </g>
                                                            </svg>

                                                        </button>

                                                    </div>
                                                    <div style="display: flex;">
                                                        <button id="eliminarUser" type="button"
                                                            class="btn btn-warning eliminarUser" data-toggle="modal"
                                                            onclick="confirmarEliminacion(this)"
                                                            data-id="<?php echo $row['id_usuario']; ?>"
                                                            data-nombre="<?php echo $row['nombre_usuario']; ?>"
                                                            data-apellido="<?php echo $row['apellidos']; ?>"
                                                            data-email="<?php echo $row['email']; ?>"
                                                            data-fechanacimiento="<?php echo $row['fecha_nacimiento']; ?>"
                                                            data-telefono="<?php echo $row['telefono']; ?>"
                                                            data-contraseña="<?php echo $row['contraseña']; ?>"
                                                            data-creacionusuario="<?php echo $row['fecha_creacion_usuario']; ?>"
                                                            data-estado="<?php echo $row['estado']; ?>"
                                                            data-nomrol="<?php echo $row['nombre_rol']; ?>"
                                                            data-nomcargo="<?php echo $row['nombre_cargo']; ?>"
                                                            data-nomarea="<?php echo $row['nombre_area']; ?>">

                                                            <i class="fas fa-eye"></i></button>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>

                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>E-MAIL</th>

                                        <th>TELEFONO</th>


                                        <th>ESTADO</th>
                                        <th>TIPO USUARIO</th>
                                        <th>CARGO</th>
                                        <th>ÁREA</th>
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






<!-- Modal Agregar -->
<div class="modal fade" id="modal_agregar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../../controllers/registrarUsuarioController.php" method="post">
                    <div class="row shadow p-3 mb-5 bg-white rounded">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">NOMBRE:</label>
                                <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control"
                                    oninput="convertirAMayusculas(event)" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">APELLIDOS:</label>
                                <input type="text" id="apellido" name="apellidos" class="form-control"
                                    oninput="convertirAMayusculas(event)" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="Titulo" class="form-label">E-MAIL:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-6">
                            <!--<div class="mb-3">
                                <label for="Titulo" class="form-label">FECHA DE NACIMIENTO</label>
                                <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control"
                                    required>
                            </div>-->
                            <div class="form-group mb-3">
                                <label>FECHA DE NACIMIENTO:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="fecha_nacimiento"
                                        name="fecha_nacimiento" data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask />
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>TELEFONO:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        data-inputmask='"mask": "(999) 999-9999"' data-mask />
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">CONTRASEÑA:</label>
                                <input type="text" id="contraseña" name="contraseña" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">CONFIRMAR CONTRASEÑA:</label>
                                <input type="text" id="confirmar_contraseña" name="confirmar_contraseña"
                                    class="form-control" required>
                            </div>
                            <!-- Contenedor del mensaje de error -->
                            <p id="errorMensaje" style="color: red; display: none;">Las contraseñas no coinciden.</p>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="Titulo" class="form-label">DESIGNACIÓN DE ROL:</label>
                                <select class="form-control" id="rol_id" name="rol_id" required>
                                    <option value="">Tipo de Rol</option>
                                    <?php
                                    $consulta = mysqli_query($conexion, "SELECT id_rol, nombre_rol  FROM roles;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                        echo "<option value='" . $row['id_rol'] . "'>" . $row['nombre_rol'] . "</option>"
                                    ?>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="Titulo" class="form-label">DESIGNACIÓN DE CARGO:</label>
                                <select class="form-control" id="id_cargo" name="id_cargo" required>
                                    <option value="">Cargo</option>
                                    <?php
                                    $consulta = mysqli_query($conexion, "SELECT id_cargo, nombre  FROM cargos;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                        echo "<option value='" . $row['id_cargo'] . "'>" . $row['nombre'] . "</option>"
                                    ?>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="Titulo" class="form-label">DESIGNACIÓN DE ÁREA:</label>
                                <select class="form-control" id="id_area" name="id_area" required>
                                    <option value="">Área</option>
                                    <?php
                                    $consulta = mysqli_query($conexion, "SELECT id_area, nombre  FROM areas;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                        echo "<option value='" . $row['id_area'] . "'>" . $row['nombre'] . "</option>"
                                    ?>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            aria-label="Close">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btn_guardar_users">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal ACTUALIZAR USUARIOS -->
<div class="modal fade" id="modal_actualizar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <div class="row shadow p-3 mb-5 bg-white rounded">
                        <div class="col-12">
                            <div class="mb-3">

                                <input type="" class="form-control" name="id_usu" id="id_usu" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">NOMBRE:</label>
                                <input type="text" id="nom_usu" name="nom_usu" class="form-control"
                                    oninput="convertirAMayusculas(event)" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">APELLIDOS:</label>
                                <input type="text" id="apellido_usu" name="apellido_usu" class="form-control"
                                    oninput="convertirAMayusculas(event)" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="Titulo" class="form-label">E-MAIL:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" id="email_usu" name="email_usu" class="form-control"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="col-6">
                            <!--<div class="mb-3">
                                <label for="Titulo" class="form-label">FECHA DE NACIMIENTO</label>
                                <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control"
                                    required>
                            </div>-->
                            <div class="form-group mb-3">
                                <label>FECHA DE NACIMIENTO:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="fecha_nacimiento_usu"
                                        name="fecha_nacimiento_usu" data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask />
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>TELEFONO:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="telefono_usu" name="telefono_usu"
                                        data-inputmask='"mask": "(999) 999-9999"' data-mask />
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">CONTRASEÑA:</label>
                                <input type="text" id="contraseña_usu" name="contraseña_usu" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">CONFIRMAR CONTRASEÑA:</label>
                                <input type="text" id="confirmar_contraseña_usu" name="confirmar_contraseña"
                                    class="form-control" required>
                            </div>
                            <!-- Contenedor del mensaje de error -->
                            <p id="errorMensaje" style="color: red; display: none;">Las contraseñas no coinciden.</p>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="Titulo" class="form-label">DESIGNACIÓN DE ROL:</label>
                                <select class="form-control" id="rol_id_usu" name="rol_id_usu" required>
                                    <option value="">Tipo de Rol</option>
                                    <?php
                                    $consulta = mysqli_query($conexion, "SELECT id_rol, nombre_rol  FROM roles;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                        echo "<option value='" . $row['id_rol'] . "'>" . $row['nombre_rol'] . "</option>"
                                    ?>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="Titulo" class="form-label">DESIGNACIÓN DE CARGO:</label>
                                <select class="form-control" id="id_cargo_usu" name="id_cargo_usu" required>
                                    <option value="">Cargo</option>
                                    <?php
                                    $consulta = mysqli_query($conexion, "SELECT id_cargo, nombre  FROM cargos;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                        echo "<option value='" . $row['id_cargo'] . "'>" . $row['nombre'] . "</option>"
                                    ?>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="Titulo" class="form-label">DESIGNACIÓN DE ÁREA:</label>
                                <select class="form-control" id="id_area_usu" name="id_area_usu" required>
                                    <option value="">Área</option>
                                    <?php
                                    $consulta = mysqli_query($conexion, "SELECT id_area, nombre  FROM areas;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                        echo "<option value='" . $row['id_area'] . "'>" . $row['nombre'] . "</option>"
                                    ?>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            aria-label="Close">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btn_guardar_users">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>











<!-- Modal de confirmación de eliminación id="modalEliminar" -->

<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Informacion usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">ID:</label><br>
                            <span id="id_usuario_modal"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">NOMBRE USUARIO:</label><br>
                            <span id="nombre_usuario_modal"></span>
                            <span id="apellido_usuario_modal"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">EMAIL:</label><br>
                            <span id="email_usuario_modal"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">FECHA NACIMIENTO:</label><br>
                            <span id="fechanacimiento_usuario_modal"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">TELEFONO:</label><br>
                            <span id="telefono_usuario_modal"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">CONTRASEÑA:</label><br>
                            <span class="col-12" id="contraseña_usuario_modal"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">FECHA CREACION USUARIO:</label><br>
                            <span id="creacionusuario_usuario_modal"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">ESTADO:</label><br>
                            <span id="estado_usuario_modal"></span>
                            esta
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">ROL:</label><br>
                            <span id="nomrol_usuario_modal"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">CARGO:</label><br>
                            <span id="nomcargo_usuario_modal"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID" class="form-label">ÁREA:</label><br>
                            <span id="nomarea_usuario_modal"></span>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>

            </div>
        </div>
    </div>
</div>


<script>
    // Función para confirmar la eliminación
    function confirmarEliminacion(button) {
        var id_usuario = $(button).data('id'); // Obtener el ID del usuario a eliminar
        var nombre_usuario = $(button).data('nombre'); // Obtener el nombre del usuario
        var apellido = $(button).data('apellido');
        var email = $(button).data('email');
        var fechanacimiento = $(button).data('fechanacimiento');
        var telefono = $(button).data('telefono');
        var contraseña = $(button).data('contraseña');
        var creacionusuario = $(button).data('creacionusuario');
        var estado = $(button).data('estado');
        var nomrol = $(button).data('nomrol');
        var nomcargo = $(button).data('nomcargo');
        var nomarea = $(button).data('nomarea');
        // Mostrar el nombre del usuario en el modal de confirmación
        $('#id_usuario_modal').text(id_usuario);
        $('#nombre_usuario_modal').text(nombre_usuario);
        $('#apellido_usuario_modal').text(apellido);
        $('#email_usuario_modal').text(email);
        $('#fechanacimiento_usuario_modal').text(fechanacimiento);
        $('#telefono_usuario_modal').text(telefono);
        $('#contraseña_usuario_modal').text(contraseña);
        $('#creacionusuario_usuario_modal').text(creacionusuario);
        $('#estado_usuario_modal').text(estado);
        $('#nomrol_usuario_modal').text(nomrol);
        $('#nomcargo_usuario_modal').text(nomcargo);
        $('#nomarea_usuario_modal').text(nomarea);


        // Asignar el ID del usuario al botón de confirmación en el modal
        $('#confirmarEliminar').data('id', id_usuario);

        // Mostrar el modal de confirmación
        $('#modalEliminar').modal('show');
    }
</script>



<!-- SCRIPT PARA MOSTRAR DATOS EN UN MODAL -->
<script>
    /*
    function confirmarEliminacion(button) {
        var id_usuario = $(button).data('id_usuario'); // Obtener el ID del usuario a eliminar
        var nombre_usuario = $(button).data('nombre_usuario'); // Obtener el nombre del usuario

        console.log("ID Usuario: ", id_usuario);
        console.log("Nombre Usuario: ", nombre_usuario);
    }
*/




    /*

        $('#confirmarEliminar').click(function() {
            var id_usuario = $(this).data('id'); // Obtener el ID del usuario a eliminar

            console.log("ID del usuario a eliminar: " +
                id_usuario); // Debug: Verifica que el ID se obtiene correctamente

            // Crear un objeto FormData para enviar los datos por AJAX
            var formData = new FormData();
            formData.append('id_usuario', id_usuario);

            // Crear una nueva instancia de XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../../../controllers/eliminarUsuarioController.php', true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText); // Parsear la respuesta JSON del servidor

                    if (respuesta.success) {
                        // Cerrar el modal de confirmación
                        $('#modalEliminar').modal('hide');

                        // Eliminar la fila correspondiente del usuario en la tabla sin recargar la página
                        $('button[data-id="' + id_usuario + '"]').closest('tr').remove();

                        // Mostrar un mensaje de éxito
                        alert(respuesta.mensaje); // Mensaje de éxito
                    } else {
                        // Si hubo un error, mostrar un mensaje de error
                        alert(respuesta.error); // Mensaje de error
                    }
                } else {
                    alert("Error al realizar la solicitud.");
                }
            };

            xhr.send(formData); // Enviar los datos al servidor
        });


    */






    function convertirAMayusculas(event) {
        const input = event.target;
        input.value = input.value.toUpperCase();
    }


    const contraseña = document.getElementById('contraseña');
    const confirmarContraseña = document.getElementById('confirmar_contraseña');
    const mensajeError = document.getElementById('errorMensaje');
    const btncrearuser = document.getElementById('btn_guardar_users');

    function validarContraseñas() {
        const valorContraseña = contraseña.value.trim();
        const valorConfirmar = confirmarContraseña.value.trim();

        // Si ambos campos están vacíos, ocultar el mensaje de error
        if (valorContraseña === '' && valorConfirmar === '') {
            mensajeError.style.display = 'none';
            return;
        } else if (valorContraseña !== '' && valorConfirmar === '') {
            mensajeError.style.display = 'none';
            return;

        }

        // Mostrar error si las contraseñas no coinciden
        if (valorContraseña !== valorConfirmar) {
            mensajeError.style.display = 'block';
            mensajeError.textContent = 'Las contraseñas no coinciden.';
            btncrearuser.disabled = true;
        } else {
            mensajeError.style.display = 'none'; // Ocultar mensaje si coinciden
            btncrearuser.disabled = false;
        }
    }

    // Validar en tiempo real en ambos campos
    contraseña.addEventListener('input', validarContraseñas);
    confirmarContraseña.addEventListener('input', validarContraseñas);





    const modalButtons = document.querySelectorAll('.openModalBtn');

    // Agregar un evento a cada botón
    modalButtons.forEach((button) => {
        button.addEventListener('click', function() {
            // Obtener el ID del usuario desde el atributo data-id
            const userId = this.getAttribute('data-id');



            // Llamar a la función para cargar los datos en el formulario
            loadFormData(userId);
        });
    });

    async function loadFormData(idUsuario) {
        try {
            const response = await fetch(`../../../controllers/cargarUsuariosController.php?id_usuario=${idUsuario}`);
            const result = await response.json();

            if (result.success) {
                const data = result.data;

                console.log(data);
                document.getElementById('id_usu').value = idUsuario || '';
                document.getElementById('nom_usu').value = data.nombre_usuario || '';
                document.getElementById('apellido_usu').value = data.apellidos || '';
                document.getElementById('email_usu').value = data.email || '';
                document.getElementById('fecha_nacimiento_usu').value = data.fecha_nacimiento || '';
                document.getElementById('telefono_usu').value = data.telefono || '';
                document.getElementById('contraseña_usu').value = data.contraseña || '';
                document.getElementById('rol_id_usu').value = data.id_rol || '';
                document.getElementById('rol_id_usu').value = data.id_rol || '';
                document.getElementById('id_cargo_usu').value = data.id_cargo || '';
                document.getElementById('id_area_usu').value = data.id_area || '';
            } else {
                console.error("Error al cargar los datos:", result.message);
            }
        } catch (error) {
            console.error("Error en la solicitud:", error);
        }
    }
</script>



<?php require("../component/footer_dashboard.php"); ?>