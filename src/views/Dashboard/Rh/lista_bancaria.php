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

                                    $consulta = mysqli_query($conexion, "SELECT u.id_usuario, b.id_banco, u.nombre_usuario, u.apellidos, b.nom_banco, b.num_cuenta, b.clabe_interbancaria, FORMAT(b.sueldo_neto_mensual, 2) AS sueldo_formateado  , b.solicitud_tarj_nominal  FROM tbl_bancarios b JOIN usuarios u ON b.id_usuario = u.id_usuario;");
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
                                                            <!--<i class="fas fa-trash-alt"></i>-->
                                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                                width="34" height="34" fill="none">
                                                                <style>
                                                                @keyframes rotate-tr {
                                                                    0% {
                                                                        transform: rotate(0)
                                                                    }

                                                                    to {
                                                                        transform: rotate(20deg)
                                                                    }
                                                                }
                                                                </style>
                                                                <path fill="#0A0A30"
                                                                    d="M16.773 10.083a.75.75 0 00-1.49-.166l1.49.166zm-1.535 7.027l.745.083-.745-.083zm-6.198 0l-.745.083.745-.083zm-.045-7.193a.75.75 0 00-1.49.166l1.49-.166zm5.249 7.333h-4.21v1.5h4.21v-1.5zm1.038-7.333l-.79 7.11 1.491.166.79-7.11-1.49-.166zm-5.497 7.11l-.79-7.11-1.49.166.79 7.11 1.49-.165zm.249.223a.25.25 0 01-.249-.222l-1.49.165a1.75 1.75 0 001.739 1.557v-1.5zm4.21 1.5c.892 0 1.64-.67 1.74-1.557l-1.492-.165a.25.25 0 01-.248.222v1.5z" />
                                                                <path fill="#265BFF" fill-rule="evenodd"
                                                                    d="M11 6a1 1 0 00-1 1v.25H7a.75.75 0 000 1.5h10a.75.75 0 000-1.5h-3V7a1 1 0 00-1-1h-2z"
                                                                    clip-rule="evenodd"
                                                                    style="animation:rotate-tr 1s cubic-bezier(1,-.28,.01,1.13) infinite alternate-reverse both;transform-origin:right center" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                                <button class="openModalBtn btn-warning" style="display: flex;
justify-content: center;
align-items: center;" class="btn bg-primary btneditar" type="submit" data-toggle="modal"
                                                    data-target="#modal_actualizar_banco"
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
                                                <button
                                                    style="display: flex; justify-content: center; align-items: center;"
                                                    class="btn btn-primary openModalBtn" data-toggle="modal"
                                                    data-target="#modal_ver_banco"
                                                    data-id="<?php echo $row["id_usuario"] ?>">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <style>
                                                        .eye-1 {
                                                            animation: eye 2.4s infinite;
                                                        }

                                                        .eye-2 {
                                                            animation: squeeze 2.4s infinite;
                                                        }

                                                        @keyframes eye {
                                                            90% {
                                                                transform: none;
                                                                animation-timing-function: ease-in;
                                                            }

                                                            93% {
                                                                transform: translateY(15px) scaleY(0)
                                                            }

                                                            100% {
                                                                animation-timing-function: ease-out;
                                                            }
                                                        }

                                                        @keyframes squeeze {
                                                            90% {
                                                                transform: none;
                                                                animation-timing-function: ease-in;
                                                            }

                                                            93% {
                                                                transform: translateY(3px) scaleY(0.8)
                                                            }

                                                            100% {
                                                                animation-timing-function: ease-out;
                                                            }
                                                        }
                                                        </style>
                                                        <path class="eye-1" stroke="#0A0A30" stroke-width="1.5"
                                                            d="M19.195 11.31c.325.41.325.97 0 1.38-1.114 1.4-3.916 4.45-7.195 4.45-3.28 0-6.08-3.05-7.195-4.45a1.097 1.097 0 010-1.38C5.92 9.91 8.721 6.86 12 6.86c3.28 0 6.08 3.05 7.195 4.45z" />
                                                        <circle class="eye-2" cx="12" cy="12" r="1.972" stroke="#000000"
                                                            stroke-width="1.5" />
                                                    </svg>

                                                </button>
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




<!-- Modal Actualizar-->
<div class="modal fade" id="modal_actualizar_banco" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Datos Bancarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="updateForm">
                    <div class="mb-3">

                        <input type="hidden" class="form-control" name="id_usu" id="id_usu" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_banco" class="form-label">NOMBRE DEL BANCO</label>
                        <input type="text" class="form-control" name="nombre_banco" id="nombre_banco" required>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Titulo" class="form-label">NUMERO DE CUENTA</label>
                            <input type="text" id="num_cuenta" name="num_cuenta" class="form-control"
                                placeholder="XXXX XXXX XX XXXXXXXXXX" oninput="validarInput(event)" required>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Titulo" class="form-label">CLABE INTERBANCARIA</label>
                            <input type="text" id="clabe_interbancaria" name="clabe_interbancaria" class="form-control"
                                placeholder="XXX XXX XXXXXXXXXXX X" oninput="validarInput(event)" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Titulo" class="form-label">SUELDO NETO</label>
                            <input type="text" id="sueldo" name="sueldo" class="form-control" placeholder="$0,000.00"
                                required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="solicitud_tarjeta" class="form-label">Solicitud de Tarjeta</label>
                        <select class="form-select" name="solicitud_tarjeta" id="solicitud_tarjeta" required>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
                <div id="response"></div>
            </div>
        </div>
    </div>
</div>



<!-- Modal VER-->
<div class="modal fade" id="modal_ver_banco" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos Bancarios Del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="updateForm">
                    <div class="mb-3">

                        <input type="hidden" class="form-control" name="id_usu" id="id_usu" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_banco" class="form-label">NOMBRE DEL BANCO</label>
                        <input type="text" class="form-control" name="nombre_banco" id="nombre_banco" required>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Titulo" class="form-label">NUMERO DE CUENTA</label>
                            <input type="text" id="num_cuenta" name="num_cuenta" class="form-control"
                                placeholder="XXXX XXXX XX XXXXXXXXXX" oninput="validarInput(event)" required>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Titulo" class="form-label">CLABE INTERBANCARIA</label>
                            <input type="text" id="clabe_interbancaria" name="clabe_interbancaria" class="form-control"
                                placeholder="XXX XXX XXXXXXXXXXX X" oninput="validarInput(event)" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="Titulo" class="form-label">SUELDO NETO</label>
                            <input type="text" id="sueldo" name="sueldo" class="form-control" placeholder="$0,000.00"
                                required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="solicitud_tarjeta" class="form-label">Solicitud de Tarjeta</label>
                        <select class="form-select" name="solicitud_tarjeta" id="solicitud_tarjeta" required>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
                <div id="response"></div>
            </div>
        </div>
    </div>
</div>


openModalBtnVer







<script>
// Seleccionar todos los botones que abren el modal
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

// Función para cargar datos en el formulario (como se explicó anteriormente)
async function loadFormData(idUsuario) {
    try {
        const response = await fetch(`../../../controllers/cargarDatosBanco.php?id_usuario=${idUsuario}`);
        const result = await response.json();

        if (result.success) {
            const data = result.data;


            document.getElementById('id_usu').value = idUsuario || '';
            document.getElementById('nombre_banco').value = data.nom_banco || '';
            document.getElementById('num_cuenta').value = data.num_cuenta || '';
            document.getElementById('clabe_interbancaria').value = data.clabe_interbancaria || '';
            document.getElementById('sueldo').value = data.sueldo_neto_mensual || '';
            document.getElementById('solicitud_tarjeta').value = data.solicitud_tarj_nominal || '';
        } else {
            console.error("Error al cargar los datos:", result.message);
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
    }
}



document.getElementById('updateForm').addEventListener('submit', async function(e) {

    e.preventDefault();

    const formData = new FormData(this); // Recoge los datos del formulario
    // Imprimir el contenido de formData antes de enviarlo
    for (let [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
    }

    try {
        const response = await fetch('../../../controllers/actualizarDatosBancariosController.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();
        // Mostrar el resultado al usuario
        const responseDiv = document.getElementById('response');
        if (result.success) {
            responseDiv.textContent = "Datos actualizados correctamente.";
            responseDiv.style.color = "green";
            setTimeout(() => {
                $('#modal_actualizar_banco').modal('hide');
                responseDiv.textContent = " ";
                responseDiv.style.color = " ";
            }, 1500);

        } else {
            responseDiv.textContent = "Error: " + result.message;
            responseDiv.style.color = "red";
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
    }
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