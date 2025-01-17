<?php require("../component/heade_dashboard.php"); ?>


<?php require("../component/menu_dashboard_admin.php"); ?>
<?php require("../component/header_page.php"); ?>

<style>
    /* Opcional: Estilo para el contenedor de resultados */
    .result-item {
        padding: 10px;
        border: 1px solid #ddd;
        margin-bottom: 5px;
        cursor: pointer;
        background-color: #f8f9fa;
    }

    .result-item:hover {
        background-color: #e9ecef;
    }

    #results {
        display: none;
        /* Ocultar inicialmente */
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        background-color: #fff;
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
                        <h5 class="m-0">Lista Datos Usuarios</h5>
                        <?php if (isset($_GET['erroremail']) && $_GET['erroremail'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> El email ya se encutra registrado, ingrese otro. </p></div>';
                        } else if (isset($_GET['errorcargo']) && $_GET['errorcargo'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> Ya existe Jefe de departamento en el área, ingrese otro cargo </p></div>';
                        } ?>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_agregar_datos_usuario">
                                Agregar Datos Usuarios
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>FECHA INGRESO</th>
                                        <th>ANTIGUEDAD</th>
                                        <th>PUESTO</th>
                                        <th>CENTRO DE TRABAJO</th>
                                        <th>SALARIO DIARIO INTEGRADO</th>
                                        <th>TEMPORALIDAD DEL CONTRATO</th>
                                        <th>JORNADA LABORAL</th>
                                        <th>LUGAR DE NACIMIENTO</th>
                                        <th>CURP</th>
                                        <th>RFC</th>
                                        <th>No. IMSS</th>
                                        <th>CRÉDITO INFONAVIT NÚMERO</th>
                                        <th>PENSIÓN ALIMENTICIA</th>
                                        <th>SEXO</th>
                                        <th>ESTADO CIVIL</th>
                                        <th>CALLE Y NÚMERO DOMICILIO ACTUAL</th>
                                        <th>COLONIA</th>
                                        <th>DELEGACIÓN / MUNICIPIO</th>
                                        <th>ESTADO</th>
                                        <th>CODIGO POSTAL</th>
                                        <th>GRUPO SANGUÍNEO</th>
                                        <th>CONTACTO DE EMERGENCIA</th>
                                        <th>Acciones </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $consulta = mysqli_query($conexion, "SELECT dt.id_datos, u.id_usuario, dt.fecha_ingreso , u.nombre_usuario, u.apellidos, dt.antiguedad,  dt.salario_diario_integrado, dt.jornada_laboral, dt.lugar_nacimiento, dt.curp, dt.rfc, dt.num_imss, dt.credito_infonavit, dt.pension_alimenticia, dt.sexo, dt.estado_civil, dt.calle_num_domicilio, dt.colonia, dt.delegacion_municipio, dt.estado, dt.codigo_postal, dt.grupo_sanguineo, dt.contactos_emergencia  FROM datos_generales_usuarios dt JOIN usuarios u ON dt.id_usuario = u.id_usuario;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                    ?>
                                        <tr>
                                            <td id="id_datos"><?php echo $row["id_datos"]  ?></td>
                                            <td id="nombre_usuario">
                                                <?php echo $row["nombre_usuario"]  . " " . $row["apellidos"] ?></td>
                                            <td id="fecha_ingreso"><?php echo $row["fecha_ingreso"]  ?></td>
                                            <td id="antiguedad"><?php echo $row["antiguedad"]  ?></td>
                                            <td id="puesto"><?php echo "Por asiganar" ?></td>
                                            <td id="centroTrabajo"><?php echo "Por asiganar" ?></td>
                                            <td id="salario_diario_integrado">
                                                <?php echo $row["salario_diario_integrado"]  ?></td>
                                            <td id="temporalidad"><?php echo "Por asiganar" ?></td>
                                            <td id="jornada_laboral"><?php echo $row["jornada_laboral"]  ?></td>
                                            <td id="lugar_nacimiento"><?php echo $row["lugar_nacimiento"]  ?></td>
                                            <td id="curp"><?php echo $row["curp"]  ?></td>
                                            <td id="rfc"><?php echo $row["rfc"]  ?></td>
                                            <td id="num_imss"><?php echo $row["num_imss"]  ?></td>
                                            <td id="credito_infonavit"><?php echo $row["credito_infonavit"]  ?></td>
                                            <td id="pension_alimenticia"><?php echo $row["pension_alimenticia"]  ?></td>
                                            <td id="sexo"><?php echo $row["sexo"]  ?></td>
                                            <td id="estado_civil"><?php echo $row["estado_civil"]  ?></td>
                                            <td id="calle_num_domicilio"><?php echo $row["calle_num_domicilio"]  ?></td>
                                            <td id="colonia"><?php echo $row["colonia"]  ?></td>
                                            <td id="delegacion_municipio"><?php echo $row["delegacion_municipio"]  ?></td>
                                            <td id="estado"><?php echo $row["estado"]  ?></td>
                                            <td id="codigo_postal"><?php echo $row["codigo_postal"]  ?></td>
                                            <td id="grupo_sanguineo"><?php echo $row["grupo_sanguineo"]  ?></td>
                                            <td id="contactos_emergencia"><?php echo $row["contactos_emergencia"]  ?></td>
                                            <td></td>

                                        </tr>

                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>FECHA INGRESO</th>
                                        <th>ANTIGUEDAD</th>
                                        <th>PUESTO</th>
                                        <th>CENTRO DE TRABAJO</th>
                                        <th>SALARIO DIARIO INTEGRADO</th>
                                        <th>TEMPORALIDAD DEL CONTRATO</th>
                                        <th>JORNADA LABORAL</th>
                                        <th>LUGAR DE NACIMIENTO</th>
                                        <th>CURP</th>
                                        <th>RFC</th>
                                        <th>No. IMSS</th>
                                        <th>CRÉDITO INFONAVIT NÚMERO</th>
                                        <th>PENSIÓN ALIMENTICIA</th>
                                        <th>SEXO</th>
                                        <th>ESTADO CIVIL</th>
                                        <th>CALLE Y NÚMERO DOMICILIO ACTUAL</th>
                                        <th>COLONIA</th>
                                        <th>DELEGACIÓN / MUNICIPIO</th>
                                        <th>ESTADO</th>
                                        <th>CODIGO POSTAL</th>
                                        <th>GRUPO SANGUÍNEO</th>
                                        <th>CONTACTO DE EMERGENCIA</th>
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


<!-- Modal Agregar Datos Usuarios -->
<div class="modal fade" id="modal_agregar_datos_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Datos Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../../controllers/registrarUsuarioController.php" method="post">
                    <div class="row shadow p-3 mb-5 bg-white rounded">
                        <div class="col-12">
                            <div class="mb-3">



                                <div class="container mt-4">
                                    <h2 class="mb-4">Búsqueda Dinámica con PHP y MySQL</h2>
                                    <input type="text" id="searchInput" class="form-control mb-3"
                                        placeholder="Buscar...">
                                    <div id="results"></div>
                                </div>

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
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Evento de clic para mostrar resultados
        $('#searchInput').on('focus', function() {
            $('#results').fadeIn(); // Mostrar el contenedor de resultados

            // Realizar la búsqueda cuando el input recibe foco (mostrar todos los resultados si el input está vacío)
            const query = $(this).val(); // Tomar el valor actual del input

            // Si el campo está vacío, mostrar todos los resultados
            if (query === '') {
                fetchResults('');
            }
        });

        // Evento de búsqueda en tiempo real
        $('#searchInput').on('keyup', function() {
            const query = $(this).val();

            // Llamada AJAX al servidor
            fetchResults(query);
        });

        // Función para hacer la llamada AJAX y actualizar los resultados
        function fetchResults(query) {
            $.ajax({
                url: '../../../controllers/searchUsuariosController.php', // Archivo PHP que maneja la búsqueda
                method: 'GET',
                data: {
                    q: query
                }, // Enviar término de búsqueda
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    let resultsHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            resultsHTML += `
                            <div class="result-item" data-id="${item.id_usuario}" data-name="${item.nombre_usuario}" data-apellido="${item.apellidos}">
                                <strong>${item.nombre_usuario}</strong><br>
                                <small>${item.apellidos}</small>
                            </div>
                        `;
                        });
                    } else {
                        resultsHTML =
                            '<p class="text-muted px-2">No se encontraron resultados</p>';
                    }

                    $('#results').html(resultsHTML);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    $('#results').html(
                        `<p class="text-danger px-2">Error al buscar datos: ${error}</p>`
                    );
                }
            });
        }

        // Ocultar resultados al hacer clic en un resultado
        $(document).on("click", ".result-item", function() {
            const id = $(this).data("id");
            const name = $(this).data("name");
            const apellido = $(this).data("apellido");
            const nombrecompleto = name + ' ' + apellido;
            $("#searchInput").val(nombrecompleto); // Poner el id en el input
            $("#results").fadeOut(); // Ocultar los resultados
        });

        // Ocultar resultados al hacer clic fuera del input
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchInput, #results').length) {
                $('#results').fadeOut();
            }
        });
    });
</script>









<?php require("../component/footer_dashboard.php"); ?>