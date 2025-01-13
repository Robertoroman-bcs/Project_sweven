<?php
/*
require_once("../../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nombre_banco = $_POST['nombre_banco'];
    $num_cuenta = $_POST['num_cuenta'];
    $clabe_interbancaria = $_POST['clabe_interbancaria'];
    $sueldo = $_POST['sueldo'];
    $solicitud_tarjeta = $_POST['solicitud_tarjeta'];


    // Validación de si el correo ya está registrado
    $sql_check_user = "SELECT COUNT(*) FROM tbl_bancarios WHERE id_usuario = ?";
    $stmt_check = $conexion->prepare($sql_check_user);
    if ($stmt_check === false) {
        die("Error al preparar la consulta de validación: " . $conexion->error);
    }

    // Vincular el email para la consulta de verificación
    $stmt_check->bind_param("s", $id_usuario);
    $stmt_check->execute();
    $stmt_check->bind_result($usuario_count);
    $stmt_check->fetch();
    $stmt_check->close();

    function msjerroremail()
    {
        header("location:../views/Dashboard/Administrador/lista_bancaria.php?errorusuario=1");
    }



    if ($usuario_count > 0) {
        // Si el correo ya está registrado, guarda el mensaje de error
        return msjerroremail();
    } else {
        // Preparar la consulta para insertar el nuevo usuario
        $sql = "INSERT INTO tbl_bancarios (nom_banco, num_cuenta, clabe_interbancaria, sueldo_neto_mensual, solicitud_tarj_nominal, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        // Vincular los parámetros para la inserción
        $stmt->bind_param(
            "ssssss",
            $nombre_banco,
            $num_cuenta,
            $clabe_interbancaria,
            $sueldo,
            $solicitud_tarjeta,
            $id_usuario
        );

        // Ejecutar la consulta de inserción
        if ($stmt->execute()) {
            // Redirige a la página de lista de usuarios si la inserción fue exitosa
            header("Location: ../views/Dashboard/Administrador/lista_bancaria.php");
            exit();
        } else {
            echo "Error al guardar el registro: " . $stmt->error;
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
        $conexion->close();
    }
}
    */

/*
require_once("../../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nombre_banco = $_POST['nombre_banco'];
    $num_cuenta = $_POST['num_cuenta'];
    $clabe_interbancaria = $_POST['clabe_interbancaria'];
    $sueldo = $_POST['sueldo'];
    $solicitud_tarjeta = $_POST['solicitud_tarjeta'];

    // Validación de si el usuario ya existe en tbl_bancarios
    $sql_check_user = "SELECT COUNT(*) FROM tbl_bancarios WHERE id_usuario = ?";
    $stmt_check = $conexion->prepare($sql_check_user);
    if ($stmt_check === false) {
        die("Error al preparar la consulta de validación: " . $conexion->error);
    }

    // Vincular el id_usuario para la consulta de verificación
    $stmt_check->bind_param("s", $id_usuario);
    $stmt_check->execute();
    $stmt_check->bind_result($usuario_count);
    $stmt_check->fetch();
    $stmt_check->close();

    // Función para redirigir con mensaje de error
    function msjerroremail()
    {
        header("location:../views/Dashboard/Administrador/lista_bancaria.php?errorusuario=1");
        exit();
    }

    // Verificar si el usuario ya está en la tabla tbl_bancarios
    if ($usuario_count > 0) {
        // Si el usuario ya está registrado, redirigir con error
        msjerroremail();
    } else {
        // Preparar la consulta para insertar los datos bancarios
        $sql = "INSERT INTO tbl_bancarios (nom_banco, num_cuenta, clabe_interbancaria, sueldo_neto_mensual, solicitud_tarj_nominal, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            die("Error al preparar la consulta de inserción: " . $conexion->error);
        }

        // Vincular los parámetros para la inserción
        $stmt->bind_param(
            "ssssss",
            $nombre_banco,
            $num_cuenta,
            $clabe_interbancaria,
            $sueldo,
            $solicitud_tarjeta,
            $id_usuario
        );

        // Ejecutar la consulta de inserción
        if ($stmt->execute()) {
            // Redirigir a la página de lista bancaria si la inserción fue exitosa
            header("Location: ../views/Dashboard/Administrador/lista_bancaria.php");
            exit();
        } else {
            echo "Error al guardar el registro: " . $stmt->error;
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
*/

require_once("../../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar que los datos de entrada estén completos
    $id_usuario = isset($_POST['id_usuario']) ? trim($_POST['id_usuario']) : null;
    $nombre_banco = isset($_POST['nombre_banco']) ? trim($_POST['nombre_banco']) : null;
    $num_cuenta = isset($_POST['num_cuenta']) ? trim($_POST['num_cuenta']) : null;
    $clabe_interbancaria = isset($_POST['clabe_interbancaria']) ? trim($_POST['clabe_interbancaria']) : null;
    $sueldo = isset($_POST['sueldo']) ? trim($_POST['sueldo']) : null;
    $solicitud_tarjeta = isset($_POST['solicitud_tarjeta']) ? trim($_POST['solicitud_tarjeta']) : null;

    // Comprobación de datos vacíos
    if (empty($id_usuario) || empty($nombre_banco) || empty($num_cuenta) || empty($clabe_interbancaria) || empty($sueldo) || empty($solicitud_tarjeta)) {
        die("Todos los campos son obligatorios.");
    }

    // Validar que el ID de usuario sea un número entero (esto es una medida adicional de seguridad)
    if (!is_numeric($id_usuario)) {
        die("El ID de usuario no es válido.");
    }

    // Iniciar transacción para mayor seguridad
    $conexion->begin_transaction();


    function errorusuario()
    {
        header("location:../views/Dashboard/Administrador/lista_bancaria.php?errorusuario=1");
    }



    try {
        // Validación de si el usuario ya existe en tbl_bancariose
        $sql_check_user = "SELECT COUNT(*) FROM tbl_bancarios WHERE id_usuario = ?";
        $stmt_check = $conexion->prepare($sql_check_user);
        if ($stmt_check === false) {
            throw new Exception("Error al preparar la consulta de validación: " . $conexion->error);
        }

        // Vincular el id_usuario para la consulta de verificación
        $stmt_check->bind_param("s", $id_usuario);
        $stmt_check->execute();
        $stmt_check->bind_result($usuario_count);
        $stmt_check->fetch();
        $stmt_check->close();

        // Si el usuario ya está registrado, redirigir con error
        if ($usuario_count > 0) {
            return errorusuario();
        }

        // Preparar la consulta para insertar los datos bancarios
        $sql = "INSERT INTO tbl_bancarios (nom_banco, num_cuenta, clabe_interbancaria, sueldo_neto_mensual, solicitud_tarj_nominal, id_usuario) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta de inserción: " . $conexion->error);
        }

        // Vincular los parámetros para la inserción
        $stmt->bind_param("ssssss", $nombre_banco, $num_cuenta, $clabe_interbancaria, $sueldo, $solicitud_tarjeta, $id_usuario);

        // Ejecutar la consulta de inserción
        if (!$stmt->execute()) {
            throw new Exception("Error al guardar el registro: " . $stmt->error);
        }

        // Commit de la transacción
        $conexion->commit();

        // Redirigir a la página de lista bancaria si la inserción fue exitosa
        header("Location: ../views/Dashboard/Administrador/lista_bancaria.php");
        exit();
    } catch (Exception $e) {
        // Si ocurre algún error, hacemos rollback de la transacción
        $conexion->rollback();

        // Registrar el error (esto podría guardarse en un archivo de log, por ejemplo)
        error_log($e->getMessage());

        // Redirigir con un mensaje de error
        header("Location: ../views/Dashboard/Administrador/lista_bancaria.php?errorusuario=" . urlencode($e->getMessage()));
        exit();
    } finally {
        // Cerrar la declaración y la conexión
        if (isset($stmt_check)) {
            $stmt_check->close();
        }
        if (isset($stmt)) {
            $stmt->close();
        }
        $conexion->close();
    }
}
