<?php
require_once("../../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar que los datos de entrada estén completos
    $id_usuario = isset($_POST['id_usuario']) ? trim($_POST['id_usuario']) : null;
    $nombre_banco = isset($_POST['nombre_banco']) ? trim($_POST['nombre_banco']) : null;
    $num_cuenta = isset($_POST['num_cuenta']) ? trim($_POST['num_cuenta']) : null;
    $clabe_interbancaria = isset($_POST['clabe_interbancaria']) ? trim($_POST['clabe_interbancaria']) : null;
    $sueldo = isset($_POST['sueldo']) ? trim($_POST['sueldo']) : null;
    $solicitud_tarjeta = isset($_POST['solicitud_tarjeta']) ? trim($_POST['solicitud_tarjeta']) : null;

    // Comprobación de datos vacíos
    if (empty($id_usuario) || empty($nombre_banco) || empty($num_cuenta) || empty($clabe_interbancaria) || empty($sueldo) || empty($solicitud_tarjeta)) {
        die("Todos los campos son obligatorios.");
    }

    // Validar que el ID de usuario sea un número entero
    if (!is_numeric($id_usuario)) {
        die("El ID de usuario no es válido.");
    }

    try {
        // Preparar la consulta para actualizar los datos bancarios
        $sql_update = "UPDATE tbl_bancarios 
                       SET nom_banco = ?, 
                           num_cuenta = ?, 
                           clabe_interbancaria = ?, 
                           sueldo_neto_mensual = ?, 
                           solicitud_tarj_nominal = ?
                       WHERE id_usuario = ?";
        $stmt = $conexion->prepare($sql_update);
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta de actualización: " . $conexion->error);
        }

        // Vincular los parámetros
        $stmt->bind_param("ssssss", $nombre_banco, $num_cuenta, $clabe_interbancaria, $sueldo, $solicitud_tarjeta, $id_usuario);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar el registro: " . $stmt->error);
        }

        // Cerrar la declaración
        $stmt->close();

        // Respuesta de éxito
        echo json_encode(["success" => true, "message" => "Datos actualizados correctamente."]);
    } catch (Exception $e) {
        // Respuesta de error
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        // Cerrar la conexión
        $conexion->close();
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
