<?php
require_once("../../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_usuario = isset($_GET['id_usuario']) ? trim($_GET['id_usuario']) : null;

    if (empty($id_usuario) || !is_numeric($id_usuario)) {
        echo json_encode(["success" => false, "message" => "ID de usuario no válido."]);
        exit();
    }

    try {
        $sql = "SELECT id_usuario, nom_banco, num_cuenta, clabe_interbancaria, sueldo_neto_mensual, solicitud_tarj_nominal 
                FROM tbl_bancarios WHERE id_usuario = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        $stmt->bind_param("s", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo json_encode(["success" => true, "data" => $data]);
        } else {
            echo json_encode(["success" => false, "message" => "Usuario no encontrado."]);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        $conexion->close();
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}