<?php
require_once("../../config/config.php");

$usuario_id = $_POST['usuario_id'];

// Procesar archivos subidos y actualizar los datos en la base de datos
foreach ($_FILES as $campo => $archivo) {
    if ($archivo['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $archivo['name'];
        $rutaDestino = "../Documentos/" . $nombreArchivo;
        move_uploaded_file($archivo['tmp_name'], $rutaDestino);

        // Actualizar el campo correspondiente
        $campo_db = str_replace('editar_archivo_', '', $campo); // Por ejemplo, convierte "editar_archivo_acta" en "acta"
        $sql = "UPDATE documentos SET {$campo_db} = ? WHERE id_usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("si", $rutaDestino, $usuario_id);
        $stmt->execute();
    }
}

echo json_encode(['success' => true]);