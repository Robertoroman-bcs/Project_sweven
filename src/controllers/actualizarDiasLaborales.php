<?php

/*
session_start();
include '../../config/config.php';


// Días de la semana
$dias_semana = [
    'lunes' => 1,
    'martes' => 2,
    'miércoles' => 3,
    'jueves' => 4,
    'viernes' => 5,
    'sábado' => 6,
    'domingo' => 7
];

// Recorrer cada día y actualizar en la base de datos
foreach ($dias_semana as $nombre_dia => $dia_semana) {
    $es_laboral = isset($_POST[$nombre_dia]) ? 1 : 0;

    $sql = "UPDATE dias_laborales SET es_laboral = ? WHERE dia_semana = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ii', $es_laboral, $dia_semana);
    $stmt->execute();
}

// Confirmar la operación


// Cerrar conexión
$conexion->close();
*/


session_start();
include '../../config/config.php';

try {
    // Días de la semana
    $dias_semana = [
        'lunes' => 1,
        'martes' => 2,
        'miércoles' => 3,
        'jueves' => 4,
        'viernes' => 5,
        'sábado' => 6,
        'domingo' => 7
    ];

    // Recorrer cada día y actualizar en la base de datos
    foreach ($dias_semana as $nombre_dia => $dia_semana) {
        $es_laboral = isset($_POST[$nombre_dia]) ? 1 : 0;

        $sql = "UPDATE dias_laborales SET es_laboral = ? WHERE dia_semana = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('ii', $es_laboral, $dia_semana);
        $stmt->execute();
    }

    // Confirmar la operación
    //$_SESSION['mensaje'] = "Días laborales actualizados correctamente.";
    header("Location: ../views/Dashboard/Administrador/lista_dias_laborales.php");
    exit();
} catch (Exception $e) {
    // Capturar errores y registrar un mensaje
    error_log($e->getMessage());
    $_SESSION['error'] = "Ocurrió un error al actualizar los días laborales.";
} finally {
    // Cerrar conexión
    $conexion->close();
}
