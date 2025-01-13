<?php
// Conectar a la base de datos
require_once("../../config/config.php");

if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    // Consulta para eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        header("Location: ../views/Dashboard/Administrador/lista_usuarios.php");
    } else {
        echo 'error'; // Respuesta de error
    }

    $stmt->close();
    $conexion->close();
}
