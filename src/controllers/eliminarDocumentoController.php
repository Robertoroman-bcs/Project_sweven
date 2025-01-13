<?php
require_once("../../config/config.php");  // Asegúrate de incluir tu archivo de configuración

if (isset($_POST['id_documento'])) {
    $id_documento = $_POST['id_documento'];

    // Obtener la ruta de los archivos a eliminar desde la base de datos
    $consulta = mysqli_query($conexion, "SELECT 
        d.acta_doc, d.comprobante_domicilio_doc, d.ine_doc, d.curp_doc, 
        d.rfc_doc, d.nss_doc, d.cv_doc, d.aviso_retencion_infonavit_doc, 
        d.aviso_pension_alimenticia_doc 
        FROM documentos d 
        WHERE d.id_documento = $id_documento");

    // Verificamos si se encontró el documento
    if ($row = mysqli_fetch_assoc($consulta)) {
        // Rutas de los archivos
        $archivos = [
            'acta_doc' => '../Document/ACTAS_DE_NACIMIENTO/' . $row['acta_doc'],
            'comprobante_domicilio_doc' => '../Document/DOMICILIO/' . $row['comprobante_domicilio_doc'],
            'ine_doc' => '../Document/INE/' . $row['ine_doc'],
            'curp_doc' => '../Document/CURP/' . $row['curp_doc'],
            'rfc_doc' => '../Document/RFC/' . $row['rfc_doc'],
            'nss_doc' => '../Document/NSS/' . $row['nss_doc'],
            'cv_doc' => '../Document/CV/' . $row['cv_doc'],
            'aviso_retencion_infonavit_doc' => '../Document/INFONAVIT/' . $row['aviso_retencion_infonavit_doc'],
            'aviso_pension_alimenticia_doc' => '../Document/ALIMENTACION/' . $row['aviso_pension_alimenticia_doc'],
        ];

        // Eliminar los archivos del servidor
        foreach ($archivos as $campo => $ruta) {
            if (!empty($ruta) && file_exists($ruta)) {
                unlink($ruta);  // Elimina el archivo del servidor
            }
        }

        // Eliminar el registro de la base de datos
        $delete_query = "DELETE FROM documentos WHERE id_documento = $id_documento";
        if (mysqli_query($conexion, $delete_query)) {
            // Redirigir después de la eliminación

            header("Location: ../views/Dashboard/Administrador/lista_documentacion.php");
            exit();
        } else {
            echo "Error al eliminar el registro en la base de datos: " . mysqli_error($conexion);
        }
    } else {
        echo "El documento no existe.";
    }
} else {
    echo "No se ha proporcionado el ID del documento.";
}