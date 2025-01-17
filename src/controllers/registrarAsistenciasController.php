<?php
include '../../config/config.php';
session_start();

$id_area_user = $_SESSION['id_area'];
$id_cargo_user = $_SESSION['id_cargo'];
$id_user = $_SESSION['id_usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperamos la fecha y los IDs de los empleados seleccionados
    $fecha = $_POST['fecha'];
    $empleados_seleccionados = isset($_POST['empleados']) ? json_decode($_POST['empleados']) : [];


    // Preparar la consulta para obtener todos los empleados de la base de datos
    $consulta_empleados = "SELECT u.id_usuario
                           FROM usuarios u
                           JOIN roles r ON u.id_rol = r.id_rol
                           JOIN cargos c ON u.id_cargo = c.id_cargo
                           JOIN areas a ON u.id_area = a.id_area
                           WHERE c.id_cargo != ? AND a.id_area = ?";

    // Preparamos la consulta para evitar inyecciones SQL
    $stmt = mysqli_prepare($conexion, $consulta_empleados);
    mysqli_stmt_bind_param($stmt, "ii", $id_cargo_user, $id_area_user);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Recoger los empleados de la consulta
    $empleados_db = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $empleados_db[] = $row['id_usuario'];
    }

    // Comenzamos una transacción para asegurarnos de que todos los datos se inserten correctamente
    mysqli_begin_transaction($conexion);

    try {
        // Insertamos o actualizamos las asistencias de todos los empleados
        $insertar_asistencias = "INSERT INTO asistencias_faltas (id_usuario, fecha, estado) VALUES (?, ?, ?)";
        $stmt_insertar = mysqli_prepare($conexion, $insertar_asistencias);

        foreach ($empleados_db as $empleado_id) {
            // Verificar si el empleado fue seleccionado
            $estado = in_array($empleado_id, $empleados_seleccionados) ? 1 : 0;

            // Ejecutar la inserción para cada empleado
            mysqli_stmt_bind_param($stmt_insertar, "isi", $empleado_id, $fecha, $estado);
            mysqli_stmt_execute($stmt_insertar);
        }

        // Confirmar los cambios realizados
        mysqli_commit($conexion);
        echo "Asistencias registradas correctamente.";
    } catch (Exception $e) {
        // Si ocurre algún error, revertir la transacción
        mysqli_rollback($conexion);
        echo "Hubo un error al registrar las asistencias. Inténtalo de nuevo.";
    }

    // Cerrar la conexión
    mysqli_stmt_close($stmt_insertar);
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}