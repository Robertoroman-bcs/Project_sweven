<?php
session_start();
include '../../config/config.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    die("Acceso no autorizado.");
}

// Obtener los datos enviados por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_solicitud = $_POST['id_solicitud'];  // ID de la solicitud a actualizar
    $nuevo_estado = $_POST['nuevo_estado'];  // Nuevo estado de la solicitud (Pendiente, Aceptado, Rechazado)

    // Validar el estado recibido
    if (!in_array($nuevo_estado, ['Pendiente', 'Aprobado', 'Rechazado'])) {
        echo json_encode(["error" => "Estado inválido."]);
        exit;
    }

    // Consulta SQL para actualizar el estado
    $sql = "UPDATE solicitudes_vacaciones SET aprobado_por_jefe_area = ? WHERE id_solicitud = ?";

    // Preparar la consulta
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros
        $stmt->bind_param('si', $nuevo_estado, $id_solicitud);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Respuesta exitosa
            echo json_encode(["success" => true, "mensaje" => "Respuesta a solicitud enviada."]);
        } else {
            // Si hay un error al ejecutar la consulta
            echo json_encode(["error" => "Error al actualizar el estado: " . $stmt->error]);
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        // Si no se pudo preparar la consulta
        echo json_encode(["error" => "Error al preparar la consulta: " . $conexion->error]);
    }

    // Cerrar la conexión
    $conexion->close();
}
