<?php
require_once("../../config/config.php");

$error_message = '';  // Variable para almacenar el mensaje de error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener el ID del usuario a actualizar
    $id_usuario = $_POST['id_usuario'];  // Se asume que el ID del usuario se pasa por un formulario oculto

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

    // Validación de si el correo ya está registrado (para otros usuarios, no el actual)
    $sql_check_email = "SELECT COUNT(*) FROM usuarios WHERE email = ? AND id_usuario != ?";
    $stmt_check = $conexion->prepare($sql_check_email);
    if ($stmt_check === false) {
        die("Error al preparar la consulta de validación: " . $conexion->error);
    }

    // Vincular el email y el id_usuario para la consulta de verificación
    $stmt_check->bind_param("si", $email, $id_usuario);
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
                           WHERE c.nombre = 'Jefe de Área' AND a.id_area = ? AND u.id_usuario != ?";

        $stmt_check_jefe = $conexion->prepare($sql_check_jefe);
        if ($stmt_check_jefe === false) {
            die("Error al preparar la consulta de validación: " . $conexion->error);
        }

        // Vincular el área y el id_usuario para la consulta
        $stmt_check_jefe->bind_param("ii", $area_id, $id_usuario);
        $stmt_check_jefe->execute();
        $stmt_check_jefe->bind_result($jefe_count);
        $stmt_check_jefe->fetch();
        $stmt_check_jefe->close();

        // Si ya existe un jefe de departamento en el área, mostrar error y no permitir la actualización
        if ($jefe_count > 0) {
            return msjerrorcargo();
        }
    }

    // Si se ha cambiado la contraseña, encriptarla
    $password_hash = !empty($contraseña) ? password_hash($contraseña, PASSWORD_DEFAULT) : null;

    // Preparar la consulta para actualizar el usuario
    $sql = "UPDATE usuarios 
            SET nombre_usuario = ?, apellidos = ?, email = ?, fecha_nacimiento = ?, telefono = ?, 
                contraseña = IFNULL(?, contraseña), id_rol = ?, id_cargo = ?, id_area = ?
            WHERE id_usuario = ?";

    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $fechaFormateada = date('Y/m/d', strtotime($fecha_nacimiento));

    // Vincular los parámetros para la actualización
    $stmt->bind_param(
        "sssssssssi",
        $nombre,
        $apellidos,
        $email,
        $fechaFormateada,
        $telefono,
        $password_hash,
        $rol_user,
        $cargo_id,
        $area_id,
        $id_usuario
    );

    // Ejecutar la consulta de actualización
    if ($stmt->execute()) {
        // Redirige a la página de lista de usuarios si la actualización fue exitosa
        header("Location: ../views/Dashboard/Administrador/lista_usuarios.php");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}
