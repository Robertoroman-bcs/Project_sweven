<?php
/*
require_once("../../config/config.php");

$error_message = '';  // Variable para almacenar el mensaje de error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre_usuario'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];
    $rol_user = $_POST['rol_id'];
    $cargo_id = $_POST['id_cargo'];
    $area_id = $_POST['id_area'];


    // Validaciones
    if (empty($rol_user)) {
        die("Error: Debes seleccionar un tipo de usuario.");
    }
    if ($contraseña !== $confirmar_contraseña) {
        echo "Error: Las contraseñas no coinciden.";
        exit;
    }

    // Validación de si el correo ya está registrado
    $sql_check_email = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
    $stmt_check = $conexion->prepare($sql_check_email);
    if ($stmt_check === false) {
        die("Error al preparar la consulta de validación: " . $conexion->error);
    }

    // Vincular el email para la consulta de verificación
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->bind_result($email_count);
    $stmt_check->fetch();
    $stmt_check->close();

    function msjerroremail()
    {
        header("location:../admin/vistas_admin/lista_usuarios.php?erroremail=1");
    }

    if ($email_count > 0) {
        // Si el correo ya está registrado, guarda el mensaje de error
        return msjerroremail();
    } else {
        // Si todo está bien, encriptar la contraseña
        $password_hash = password_hash($contraseña, PASSWORD_DEFAULT);

        // Preparar la consulta para insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (nombre_usuario, apellidos, email, fecha_nacimiento, telefono, contraseña, id_rol, id_cargo, id_area) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conexion->error);
        }
        $fechaFormateada = date('Y/m/d', strtotime($fecha_nacimiento));

        // Vincular los parámetros para la inserción
        $stmt->bind_param(
            "sssssssss",
            $nombre,
            $apellidos,
            $email,
            $fechaFormateada,
            $telefono,
            $password_hash,
            $rol_user,
            $cargo_id,
            $area_id

        );

        // Ejecutar la consulta de inserción
        if ($stmt->execute()) {
            // Redirige a la página de lista de usuarios si la inserción fue exitosa
            header("Location: ../views/Dashboard/Administrador/lista_usuarios.php");
            exit();
        } else {
            echo "Error al guardar el registro: " . $stmt->error;
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
        $conexion->close();
    }
}*/



require_once("../../config/config.php");

$error_message = '';  // Variable para almacenar el mensaje de error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre_usuario'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];
    $rol_user = $_POST['rol_id'];
    $cargo_id = $_POST['id_cargo'];
    $area_id = $_POST['id_area'];


    // Validaciones
    if (empty($rol_user)) {
        die("Error: Debes seleccionar un tipo de usuario.");
    }
    if ($contraseña !== $confirmar_contraseña) {
        echo "Error: Las contraseñas no coinciden.";
        exit;
    }

    // Validación de si el correo ya está registrado
    $sql_check_email = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
    $stmt_check = $conexion->prepare($sql_check_email);
    if ($stmt_check === false) {
        die("Error al preparar la consulta de validación: " . $conexion->error);
    }

    // Vincular el email para la consulta de verificación
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->bind_result($email_count);
    $stmt_check->fetch();
    $stmt_check->close();

    function msjerroremail()
    {
        header("location:../views/Dashboard/Administrador/lista_usuarios.php?erroremail=1");
    }

    function msjerrorcargo()
    {
        header("location:../views/Dashboard/Administrador/lista_usuarios.php?errorcargo=1");
    }

    if ($email_count > 0) {
        // Si el correo ya está registrado, guarda el mensaje de error
        return msjerroremail();
    }

    // **Nueva validación para el cargo "Jefe de Departamento" en el área**
    if ($cargo_id == 1) { // 1 es el ID para "Jefe de Departamento"
        // Consultar si ya existe un jefe de departamento en el área seleccionada
        $sql_check_jefe = "SELECT COUNT(*) FROM usuarios u
                           JOIN cargos c ON u.id_cargo = c.id_cargo
                           JOIN areas a ON u.id_area = a.id_area
                           WHERE c.nombre = 'Jefe de Área' AND a.id_area = ?";

        $stmt_check_jefe = $conexion->prepare($sql_check_jefe);
        if ($stmt_check_jefe === false) {
            die("Error al preparar la consulta de validación: " . $conexion->error);
        }

        // Vincular el área para la consulta
        $stmt_check_jefe->bind_param("i", $area_id);
        $stmt_check_jefe->execute();
        $stmt_check_jefe->bind_result($jefe_count);
        $stmt_check_jefe->fetch();
        $stmt_check_jefe->close();

        // Si ya existe un jefe de departamento en el área, mostrar error y no permitir la inserción
        if ($jefe_count > 0) {
            return msjerrorcargo();
        }
    }

    // Si todo está bien, encriptar la contraseña
    $password_hash = password_hash($contraseña, PASSWORD_DEFAULT);

    // Preparar la consulta para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (nombre_usuario, apellidos, email, fecha_nacimiento, telefono, contraseña, id_rol, id_cargo, id_area) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    //$fechaFormateada = date('Y/m/d', strtotime($fecha_nacimiento));
    $fechaFormateada = date('Y-m-d', strtotime(str_replace('/', '-', $fecha_nacimiento)));

    // Vincular los parámetros para la inserción
    $stmt->bind_param(
        "sssssssss",
        $nombre,
        $apellidos,
        $email,
        $fechaFormateada,
        $telefono,
        $password_hash,
        $rol_user,
        $cargo_id,
        $area_id
    );

    // Ejecutar la consulta de inserción
    if ($stmt->execute()) {
        // Redirige a la página de lista de usuarios si la inserción fue exitosa
        header("Location: ../views/Dashboard/Administrador/lista_usuarios.php");
        exit();
    } else {
        echo "Error al guardar el registro: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}