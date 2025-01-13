<?php
header('Content-Type: application/json');
require_once("../../config/config.php");

$usuario_id = $_GET['usuario_id'] ?? null;

if (!$usuario_id) {
    echo json_encode(['error' => 'ID de usuario no proporcionado']);
    exit;
}

$sql = "SELECT * FROM documentos WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode($data ?: ['error' => 'No se encontraron documentos para este usuario']);