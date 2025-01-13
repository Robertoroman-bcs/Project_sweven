<?php
require_once("../../config/config.php");

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_cargo = $_POST['nombre_cargo'];
    $descripcion = $_POST['descripcion'];

    // Consulta para verificar si el nombre del cargo ya se encuentra en la DB
    $sql_check_area = "SELECT COUNT(*) FROM cargos WHERE nombre = ?";
    $stmt_check = $conexion->prepare($sql_check_area);
    if ($stmt_check === false) {
        die("Error al preparar la consulta de validación: " . $conexion->error);
    }

    $stmt_check->bind_param("s", $nombre_cargo);
    $stmt_check->execute();
    $stmt_check->bind_result($nombre_cargo_count);
    $stmt_check->fetch();
    $stmt_check->close();

    // Función para redirigir con el error
    function msjerrorCargo($error_code)
    {
        header("Location: ../views/Dashboard/Administrador/lista_cargos.php?errorcargo=" . $error_code);
        exit(); // Es importante usar exit() después de header para detener la ejecución del script
    }

    // Si el área ya existe redirigimos con el error
    if ($nombre_cargo_count > 0) {
        msjerrorCargo(1); // 1 es el código para indicar que el nombre del área ya está registrado
    } else {
        // Si no existe el área, procedemos a insertarlo a la base de datos
        $sql = "INSERT INTO cargos (nombre, descripcion) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        // Vincular los parámetros para la inserción de los datos
        $stmt->bind_param(
            "ss",
            $nombre_cargo,
            $descripcion
        );

        if ($stmt->execute()) {
            // Redirige a la página de lista de cargos si la inserción fue exitosa
            header("Location: ../views/Dashboard/Administrador/lista_cargos.php");
            exit();
        } else {
            echo "Error en la inserción del área.";
        }
    }
}
