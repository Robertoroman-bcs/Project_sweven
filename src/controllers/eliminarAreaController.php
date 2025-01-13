<?php
// Conectar a la base de datos
require_once("../../config/config.php");

if (isset($_POST['id_area'])) {
    $id_area = $_POST['id_area'];

    // Consulta para eliminar el usuario
    $sql = "DELETE FROM areas WHERE id_area = ?";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("i", $id_area);

    if ($stmt->execute()) {
        header("Location: ../views/Dashboard/Administrador/lista_areas.php");
    } else {
        echo 'error'; // Respuesta de error
    }

    $stmt->close();
    $conexion->close();
}