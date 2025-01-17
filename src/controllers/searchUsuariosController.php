<?php
include '../../config/config.php';

// Recibir el término de búsqueda desde la solicitud GET
$search = $_GET['q'] ?? '';
$searchTerm = '%' . $search . '%'; // Añadir comodines para el operador LIKE

// Consulta SQL
$sql = "
    SELECT 
        u.id_usuario, 
        u.nombre_usuario, 
        u.apellidos,
        a.nombre
    FROM 
        usuarios u
    JOIN areas a ON u.id_area = a.id_area
    LEFT JOIN 
        datos_generales_usuarios dg 
    ON 
        u.id_usuario = dg.id_usuario 
    WHERE 
        dg.id_usuario IS NULL AND (u.nombre_usuario LIKE ? OR u.apellidos LIKE ?)
";

// Preparar y ejecutar la consulta
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// Construir el resultado como JSON
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Enviar el resultado al frontend
header('Content-Type: application/json');
echo json_encode($data);  // Solo esta línea es necesaria

// Cerrar la conexión
$stmt->close();
$conexion->close();
