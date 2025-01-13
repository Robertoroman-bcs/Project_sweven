<?php
/*
session_start();
include '../../config/config.php';

// Verificar si el usuario tiene permisos (opcional)
if (!isset($_SESSION['usuario'])) {
    die("Acceso no autorizado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos enviados desde el frontend
    $id_solicitud = $_POST['id_solicitud']; // ID de la solicitud a actualizar
    $nuevo_estado = $_POST['nuevo_estado']; // El nuevo estado (Pendiente, Aceptado, Rechazado)

    // Validar el estado recibido
    if (!in_array($nuevo_estado, ['Pendiente', 'Aprobado', 'Rechazado'])) {
        die("Estado inválido.");
    }

    // Consulta SQL para actualizar el estado
    $sql = "UPDATE solicitudes_vacaciones SET aprobado_por_rh = ? WHERE id = ?";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    // Vincular los parámetros y ejecutar la consulta
    $stmt->bind_param('si', $nuevo_estado, $id_solicitud);
    if ($stmt->execute()) {

        header("Location: ../views/Dashboard/Rh/solicitudes_vacaciones_rh.php");
    } else {
        echo "Error al actualizar el estado: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}*/


session_start();
include '../../config/config.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    die("Acceso no autorizado.");
}

// Obtener los datos enviados por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_solicitud = $_POST['id_solicitud'];
    $nuevo_estado = $_POST['nuevo_estado'];

    // Validar el estado recibido
    if (!in_array($nuevo_estado, ['Pendiente', 'Aprobado', 'Rechazado'])) {
        echo json_encode(["error" => "Estado inválido."]);
        exit;
    }

    // Consulta SQL para actualizar el estado
    $sql = "UPDATE solicitudes_vacaciones SET aprobado_por_rh = ? WHERE id_solicitud = ?";

    // Preparamos la consulta
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


        $stmt->close();
    } else {
        // Si no se ejecuta la consulta enviamos error 
        echo json_encode(["error" => "Error al preparar la consulta: " . $conexion->error]);
    }

    // Cerrar la conexión
    $conexion->close();
}
