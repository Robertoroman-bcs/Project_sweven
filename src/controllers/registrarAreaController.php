<?php
/*
require_once("../../config/config.php");


$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_area = $_POST['nombre_area'];
    $descripcion = $_POST['descripcion'];
    $mision = $_POST['mision'];
    $vision = $_POST['vision'];

    $sql_check_area = "SELECT COUNT(*) FROM areas WHERE nombre = ?";
    $stmt_check = $conexion->prepare($sql_check_area);
    if ($stmt_check === false) {
        die("Error al preparar la consulta de validación: " . $conexion->error);
    }

    $stmt_check->bind_param("s", $nombre_area);
    $stmt_check->execute();
    $stmt_check->bind_result($nombre_area_count);
    $stmt_check->fetch();
    $stmt_check->close();

    function msjerrorArea()
    {
        header("location:../views/Dashboard/Administrador/lista_areas.php?errorarea=1");
    }

    if ($nombre_area_count > 0) {
        return msjerrorArea();
    } else {



        $sql = "INSERT INTO areas (nombre, descripcion, mision, vision) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            return die("Error al preparar la consulta: " . $conexion->error);
        }
        // Vincular los parámetros para la inserción
        $stmt->bind_param(
            "ssss",
            $nombre_area,
            $descripcion,
            $mision,
            $vision
        );
        if ($stmt->execute()) {
            // Redirige a la página de lista de usuarios si la inserción fue exitosa
            header("Location: ../views/Dashboard/Administrador/lista_areas.php");
            exit();
        } else {
            echo "ERROR";
        }
    }
}
*/
require_once("../../config/config.php");

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_area = $_POST['nombre_area'];
    $descripcion = $_POST['descripcion'];
    $mision = $_POST['mision'];
    $vision = $_POST['vision'];

    // Consulta para verificar si el nombre del área ya existe
    $sql_check_area = "SELECT COUNT(*) FROM areas WHERE nombre = ?";
    $stmt_check = $conexion->prepare($sql_check_area);
    if ($stmt_check === false) {
        die("Error al preparar la consulta de validación: " . $conexion->error);
    }

    $stmt_check->bind_param("s", $nombre_area);
    $stmt_check->execute();
    $stmt_check->bind_result($nombre_area_count);
    $stmt_check->fetch();
    $stmt_check->close();

    // Función para redirigir con el error
    function msjerrorArea($error_code)
    {
        header("Location: ../views/Dashboard/Administrador/lista_areas.php?errorarea=" . $error_code);
        exit(); // Es importante usar exit() después de header para detener la ejecución del script
    }

    // Si el área ya existe, redirigimos con el error
    if ($nombre_area_count > 0) {
        msjerrorArea(1); // 1 es el código para indicar que el nombre del área ya está registrado
    } else {
        // Si no existe el área, procedemos a insertarlo
        $sql = "INSERT INTO areas (nombre, descripcion, mision, vision) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        // Vincular los parámetros para la inserción
        $stmt->bind_param(
            "ssss",
            $nombre_area,
            $descripcion,
            $mision,
            $vision
        );

        if ($stmt->execute()) {
            // Redirige a la página de lista de áreas si la inserción fue exitosa
            header("Location: ../views/Dashboard/Administrador/lista_areas.php");
            exit();
        } else {
            echo "Error en la inserción del área.";
        }
    }
}
