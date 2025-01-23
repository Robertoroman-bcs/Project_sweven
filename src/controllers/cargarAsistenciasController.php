<?php
include '../../config/config.php';

$sql = "SELECT a.fecha, u.nombre_usuario AS empleado, a.estado FROM asistencias_faltas a INNER JOIN usuarios u ON a.id_usuario = u.id_usuario;";

$query = $conexion->prepare($sql);
$query->execute();

// Obtener los resultados usando get_result() para MySQLi
$resultado = $query->get_result();

// Crear un array para almacenar los resultados
$eventos = [];

while ($row = $resultado->fetch_assoc()) {


    $estado = $row['estado'] ? 'Asistió' : 'Faltó';
    $color = $row['estado'] ? '#28a745' : '#dc3545'; // Verde para asistencia, rojo para falta

    $eventos[] = [
        'title' => $row['empleado'] . ' (' . $estado . ')',
        'start' => $row['fecha'],
        'color' => $color
    ];
}

// Imprimir los resultados


echo json_encode($eventos);
