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
                        <h5 class="m-0">LISTA DOCUMENTACION</h5>
                        <?php if (isset($_GET['msjerrordocument']) && $_GET['msjerrordocument'] == '1') {
                            echo '<div class="contentMsjError bg-danger text-center"> <div class="msjColor"></div>  <p class="msjError" style="Color: white; font-weight: 600;font-size: 22px;"> El usuario que deseas ingresar ya cuenta con documentos. </p></div>';
                        } ?>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal_agregar_documentos">
                                Agregar Documentación
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NOMBRE</th>
                                        <th scope="col">ACTA DE NACIMIENTO </th>
                                        <th scope="col">COMPROBANTE DE DOMICILIO</th>
                                        <th scope="col">IDENTIFICACIÓN OFICIAL (INE)</th>
                                        <th scope="col">CURP</th>
                                        <th scope="col">RFC</th>
                                        <th scope="col">NÚMERO DE SEGURO SOCIAL (NSS)</th>
                                        <th scope="col">CV ACTUALIZADO</th>
                                        <th scope="col">AVISO DE RETENCIÓN INFONAVIT</th>
                                        <th scope="col">AVISO DE PENIÓN ALIMENTICIA</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Consultamos los documentos y los datos del usuario
                                    $consulta = mysqli_query($conexion, "SELECT 
            d.id_documento,
            u.id_usuario, 
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
            JOIN usuarios u ON d.id_usuario = u.id_usuario;");

                                    // Iteramos sobre cada fila de resultados
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                    ?>

                                    <tr>
                                        <td id="id_documento"><?php echo $row["id_documento"] ?></td>
                                        <td id="nombre"><?php echo $row["nombre_usuario"] . ' ' . $row["apellidos"] ?>
                                        </td>
                                        <td id="acta_doc">

                                            <?php if (!empty($row["acta_doc"])) { ?>
                                            <a href="../../../Document/ACTAS_DE_NACIMIENTO/<?php echo $row["acta_doc"]; ?>"
                                                target="_blank">
                                                <?php echo $row["acta_doc"]; ?>
                                            </a>
                                            <?php } else {
                                                    echo "No disponible";
                                                } ?>
                                        </td>
                                        <td id="comprobante_domicilio_doc">
                                            <?php if (!empty($row["comprobante_domicilio_doc"])) { ?>
                                            <a href="../../../Document/DOMICILIO/<?php echo $row["comprobante_domicilio_doc"] ?>"
                                                target="_blank">
                                                <?php echo $row["comprobante_domicilio_doc"]; ?>
                                            </a>
                                            <?php } else {
                                                    echo "No disponible";
                                                } ?>
                                        </td>
                                        <td id="ine_doc">

                                            <?php if (!empty($row["ine_doc"])) { ?>
                                            <a href="../../../Document/INE/<?php echo $row["ine_doc"] ?>"
                                                target="_blank">
                                                <?php echo $row["ine_doc"]; ?>
                                            </a>
                                            <?php } else {
                                                    echo "No disponible";
                                                } ?>
                                        </td>
                                        <td id="curp_doc">
                                            <?php if (!empty($row["curp_doc"])) { ?>
                                            <a href="../../../Document/CURP/<?php echo $row["curp_doc"] ?>"
                                                target="_blank">
                                                <?php echo $row["curp_doc"]; ?>
                                            </a>
                                            <?php } else {
                                                    echo "No disponible";
                                                } ?>
                                        </td>
                                        <td id="rfc_doc">

                                            <?php if (!empty($row["rfc_doc"])) { ?>
                                            <a href="../../../Document/RFC/<?php echo $row["rfc_doc"] ?>"
                                                target="_blank">
                                                <?php echo $row["rfc_doc"]; ?>
                                            </a>
                                            <?php } else {
                                                    echo "No disponible";
                                                } ?>
                                        </td>
                                        <td id="nss_doc">

                                            <?php if (!empty($row["nss_doc"])) { ?>
                                            <a href="../../../Document/NSS/<?php echo $row["nss_doc"] ?>"
                                                target="_blank">
                                                <?php echo $row["nss_doc"]; ?>
                                            </a>
                                            <?php } else {
                                                    echo "No disponible";
                                                } ?>
                                        </td>
                                        <td id="cv_doc">
                                            <?php if (!empty($row["cv_doc"])) { ?>
                                            <a href="../../../Document/CV/<?php echo $row["cv_doc"] ?>" target="_blank">
                                                <?php echo $row["cv_doc"]; ?>
                                            </a>
                                            <?php } else {
                                                    echo "No disponible";
                                                } ?>
                                        </td>
                                        <td id="aviso_retencion_infonavit_doc">

                                            <?php if (!empty($row["aviso_retencion_infonavit_doc"])) { ?>
                                            <a href="../../../Document/INFONAVIT/<?php echo $row["aviso_retencion_infonavit_doc"] ?>"
                                                target="_blank">
                                                <?php echo $row["aviso_retencion_infonavit_doc"]; ?>
                                            </a>
                                            <?php } else {
                                                    echo "No disponible";
                                                } ?>
                                        </td>
                                        <td id="aviso_pension_alimenticia_doc">

                                            <?php if (!empty($row["aviso_pension_alimenticia_doc"])) { ?>
                                            <a href="../../../Document/ALIMENTACION/<?php echo $row["aviso_pension_alimenticia_doc"] ?>"
                                                target="_blank">
                                                <?php echo $row["aviso_pension_alimenticia_doc"]; ?>
                                            </a>
                                            <?php } else {
                                                    echo "No disponible";
                                                } ?>
                                        </td>

                                        <td>
                                            <div style="display: flex;" class="btn-action">
                                                <!-- Botón de eliminar con icono -->
                                                <form action="../../../controllers/eliminarDocumentoController.php"
                                                    method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar los documentos de <?php echo $row['nombre_usuario']; ?> ?')">
                                                    <input type="hidden" name="id_documento"
                                                        value="<?php echo $row['id_documento']; ?>">
                                                    <button class="btn btn-danger btn-icon" type="submit"
                                                        title="Eliminar Documento">
                                                        <i class="fas fa-trash-alt"></i>
                                                        <!-- Icono de Font Awesome -->
                                                    </button>
                                                </form>
                                            </div>


                                            <div style="display: flex;" class="btn-action">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal_editar_documentos"
                                                    onclick="cargarDatosDocumentos(<?php echo $row['id_usuario']; ?>)">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </div>




                                        </td>

                                    </tr>



                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NOMBRE</th>
                                        <th scope="col">ACTA DE NACIMIENTO </th>
                                        <th scope="col">COMPROBANTE DE DOMICILIO</th>
                                        <th scope="col">IDENTIFICACIÓN OFICIAL (INE)</th>
                                        <th scope="col">CURP</th>
                                        <th scope="col">RFC</th>
                                        <th scope="col">NÚMERO DE SEGURO SOCIAL (NSS)</th>
                                        <th scope="col">CV ACTUALIZADO</th>
                                        <th scope="col">AVISO DE RETENCIÓN INFONAVIT</th>
                                        <th scope="col">AVISO DE PENIÓN ALIMENTICIA</th>
                                        <th scope="col">Acciones</th>
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
<div class="modal fade" id="modal_agregar_documentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="../../../controllers/registrarDocumentosController.php" method="post"
                    enctype="multipart/form-data">
                    <div class=" row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">SELECCIONE USUARIO</label>
                                <select class="form-select form-select-sm " id="usuario_id" name="usuario_id" required>
                                    <option value="">Nombre del usuario</option>
                                    <?php
                                    $consulta = mysqli_query($conexion, "SELECT id_usuario, nombre_usuario, apellidos  FROM usuarios;");
                                    while ($row = mysqli_fetch_assoc($consulta)) {
                                        echo "<option value='" . $row['id_usuario'] . "'>" . $row['nombre_usuario'] .  ' ' .  $row['apellidos'] .  "</option>"
                                    ?>

                                    <?php } ?>
                                </select><br><br>
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label h6">Seleccione Acta de
                                    nacimiento</label>
                                <input class="form-control" type="file" name="archivo" id="archivo"
                                    accept=".doc,.docx,.pdf" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label h6">Seleccione Comprobante de
                                    Domicilio</label>
                                <input class="form-control" type="file" name="archivo_domicilio" id="archivo"
                                    accept=".doc,.docx,.pdf" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label h6">Seleccione INE</label>
                                <input class="form-control" type="file" name="archivo_ine" id="archivo"
                                    accept=".doc,.docx,.pdf" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label h6">Seleccione CURP</label>
                                <input class="form-control" type="file" name="archivo_curp" id="archivo"
                                    accept=".doc,.docx,.pdf" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label h6">Seleccione RFC</label>
                                <input class="form-control" type="file" name="archivo_rfc" id="archivo"
                                    accept=".doc,.docx,.pdf" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label h6">Seleccione Número de Seguro
                                    Social</label>
                                <input class="form-control" type="file" name="archivo_nss" id="archivo"
                                    accept=".doc,.docx,.pdf" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label h6">Seleccione CV Actualizado</label>
                                <input class="form-control" type="file" name="archivo_cv" id="archivo"
                                    accept=".doc,.docx,.pdf" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label h6">Seleccione Aviso De
                                    Retención</label>
                                <input class="form-control" type="file" name="archivo_infonavit" id="archivo"
                                    accept=".doc,.docx,.pdf" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label h6">Seleccione Aviso De
                                    Pensión
                                    Alimentarias</label>
                                <input class="form-control" type="file" name="archivo_alimenticia" id="archivo"
                                    accept=".doc,.docx,.pdf" required>
                            </div>
                        </div>
                        <!-- 
                        <div class="col-12">
                            <div class="form-group">
                                <label>Minimal</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                        </div>/.container-fluid -->
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL ACTUALIZAR DATOS -->

<div class="modal fade" id="modal_editar_documentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_editar_documentos" enctype="multipart/form-data">
                    <input type="hidden" id="editar_usuario_id" name="usuario_id">
                    <div class="row">
                        <!-- Acta de nacimiento -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="editar_archivo_acta" class="form-label h6">Acta de Nacimiento</label>
                                <input class="form-control" type="file" name="archivo_acta" id="editar_archivo_acta"
                                    accept=".doc,.docx,.pdf">
                                <span id="archivo_acta_actual" class="text-muted"></span>
                            </div>
                        </div>
                        <!-- Comprobante de Domicilio -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="editar_archivo_domicilio" class="form-label h6">Comprobante de
                                    Domicilio</label>
                                <input class="form-control" type="file" name="archivo_domicilio"
                                    id="editar_archivo_domicilio" accept=".doc,.docx,.pdf">
                                <span id="archivo_domicilio_actual" class="text-muted"></span>
                            </div>
                        </div>
                        <!-- INE -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="editar_archivo_ine" class="form-label h6">INE</label>
                                <input class="form-control" type="file" name="archivo_ine" id="editar_archivo_ine"
                                    accept=".doc,.docx,.pdf">
                                <span id="archivo_ine_actual" class="text-muted"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="editar_archivo_curp" class="form-label h6">Curp</label>
                                <input class="form-control" type="file" name="archivo_curp" id="editar_archivo_curp"
                                    accept=".doc,.docx,.pdf">
                                <span id="archivo_curp_actual" class="text-muted"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="editar_archivo_rfc" class="form-label h6">RFC</label>
                                <input class="form-control" type="file" name="archivo_rfc" id="editar_archivo_rfc"
                                    accept=".doc,.docx,.pdf">
                                <span id="archivo_rfc_actual" class="text-muted"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="editar_archivo_nss" class="form-label h6">Numero de Seguro Social</label>
                                <input class="form-control" type="file" name="archivo_nss" id="editar_archivo_nss"
                                    accept=".doc,.docx,.pdf">
                                <span id="archivo_nss_actual" class="text-muted"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="editar_archivo_cv" class="form-label h6">CV Actualizado</label>
                                <input class="form-control" type="file" name="archivo_cv" id="editar_archivo_cv"
                                    accept=".doc,.docx,.pdf">
                                <span id="archivo_cv_actual" class="text-muted"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="editar_archivo_infonavit" class="form-label h6">Aviso de Retención
                                    Infonavit</label>
                                <input class="form-control" type="file" name="archivo_infonavit"
                                    id="editar_archivo_infonavit" accept=".doc,.docx,.pdf">
                                <span id="archivo_infonavit_actual" class="text-muted"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="editar_archivo_alimenticia" class="form-label h6">Aviso de Retención
                                    Infonavit</label>
                                <input class="form-control" type="file" name="archivo_alimenticia"
                                    id="editar_archivo_alimenticia" accept=".doc,.docx,.pdf">
                                <span id="archivo_alimenticia_actual" class="text-muted"></span>
                            </div>
                        </div>

                        <!-- Puedes agregar el resto de los documentos siguiendo el mismo formato -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
function cargarDatosDocumentos(usuarioId) {

    $.ajax({
        url: '../../../controllers/obtenerDocumentosController.php',
        type: 'GET',
        data: {
            usuario_id: usuarioId
        },
        dataType: 'json',
        success: function(data) {
            if (data.error) {
                alert(data.error);
            } else {
                $('#editar_usuario_id').val(data.id_usuario);
                console.log(data.id_usuario);
                $('#archivo_acta_actual').text('Archivo actual: ' + data.acta_doc || 'No disponible');
                $('#archivo_domicilio_actual').text('Archivo actual: ' + data.comprobante_domicilio_doc ||
                    'No disponible');
                $('#archivo_ine_actual').text('Archivo actual: ' + data.ine_doc || 'No disponible');
                $('#archivo_curp_actual').text('Archivo actual: ' + data.curp_doc || 'No disponible');
                $('#archivo_rfc_actual').text('Archivo actual: ' + data.rfc_doc || 'No disponible');
                $('#archivo_nss_actual').text('Archivo actual: ' + data.nss_doc || 'No disponible');
                $('#archivo_cv_actual').text('Archivo actual: ' + data.cv_doc || 'No disponible');
                $('#archivo_infonavit_actual').text('Archivo actual: ' + data
                    .aviso_retencion_infonavit_doc || 'No disponible');
                $('#archivo_alimenticia_actual').text('Archivo actual: ' + data
                    .aviso_pension_alimenticia_doc || 'No disponible');


                // Resto de los documentos...
                $('#modal_editar_documentos').modal('show');

            }
        },
        error: function(err) {
            console.error('Error al cargar datos:', err.responseText);
        }
    });
}



$('#form_editar_documentos').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '../../../controllers/actualizarDocumentosController.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log("PASO POR AQUI");
            alert('Documentos actualizados correctamente');
            //$('#modal_editar_documentos').modal('hide');
        },
        error: function(err) {
            console.error('Error al actualizar documentos:', err.responseText);
            alert('Error al actualizar los documentos');
        }
    });
});
</script>















<?php require("../component/footer_dashboard.php"); ?>