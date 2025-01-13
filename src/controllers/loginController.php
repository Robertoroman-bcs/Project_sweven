<?php

/*
$email = $_POST['email'];
$password = $_POST['password'];

session_start();

$_SESSION['usuario'] = $email;

include '../../config/config.php';


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    msjerror();
    exit;
}

$sql = "SELECT * FROM usuarios WHERE email = '$email' AND contraseña = '$password'";
$result = mysqli_query($conexion, $sql);

$filas = mysqli_fetch_array($result);


function msjerror()
{
    header("location:../login/login.php?error=1");
}



if (!$filas) {
    return msjerror();
}
if ($filas['id_rol'] == 1) {
    header("location:../views/Dashboard/Administrador/administrador.php");
} else if ($filas['id_rol'] == 2) {
    header("location:../views/Dashboard/Mando_medio/mando_medio.php");
} else if ($filas['id_rol'] == 3) {
    header("location:../views/Dashboard/Trabajador/trabajador.php");
} else if ($filas['id_rol'] == 4) {

    header("location:../views/Dashboard/Rh/recursos_humanos.php");
}

mysqli_free_result($result);
mysqli_close($conexion);


*/
session_start();

// Configuración de la base de datos
include '../../config/config.php';

// Verificar si los datos fueron enviados por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar formato de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        msjerror("Formato de correo electrónico inválido.");
        exit;
    }

    // Consultar el usuario en la base de datos usando una consulta preparada
    $sql = "SELECT id_usuario, email, contraseña, id_rol, id_cargo , id_area FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        msjerror("Error en la base de datos. Por favor, inténtelo de nuevo.");
        exit;
    }

    // Vincular el parámetro del correo electrónico y ejecutar la consulta
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    $user = $result->fetch_assoc();

    if (!$user) {
        msjerror("Correo o contraseña incorrectos.");
        exit;
    }

    // Verificar la contraseña con password_verify()
    if (!password_verify($password, $user['contraseña'])) {
        msjerror("Correo o contraseña incorrectos.");
        exit;
    }
    //$sql = "SELECT u.id_usuario, u.email, u.contraseña, r.id_rol , a.id_area, c.id_cargo FROM usuario_area ua JOIN usuarios u ON ua.id_usuario = u.id_usuario JOIN areas a ON ua.id_area = a.id_area JOIN cargo c ON ua.id_cargo = c.id_cargo JOIN roles r ON u.id_rol = r.id_rol";
    // Iniciar sesión y almacenar el usuario en la sesión
    $_SESSION['usuario'] = $user['email'];
    $_SESSION['id_usuario'] = $user['id_usuario'];
    $_SESSION['id_rol'] = $user['id_rol'];
    $_SESSION['id_cargo'] = $user['id_cargo'];
    $_SESSION['id_area'] = $user['id_area'];

    // Redirigir basado en el rol del usuario
    redirect_based_on_role($user['id_rol']);

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}

// Función para manejar el mensaje de error y redirigir
function msjerror($mensaje)
{
    // Almacenar el mensaje en la sesión para mostrarlo en el frontend
    $_SESSION['error_message'] = $mensaje;
    header("Location: ../login/login.php?error=1");
    exit;
}

// Función para redirigir basado en el rol del usuario
function redirect_based_on_role($role_id)
{
    switch ($role_id) {
        case 1:
            header("Location: ../views/Dashboard/Administrador/administrador.php");
            break;
        case 2:
            header("Location: ../views/Dashboard/Mando_medio/mando_medio.php");
            break;
        case 3:
            header("Location: ../views/Dashboard/Trabajador/trabajador.php");
            break;
        case 4:
            header("Location: ../views/Dashboard/Rh/recursos_humanos.php");
            break;
        default:
            msjerror("Acceso no autorizado.");
            break;
    }
    exit;
}
