<?php
include '../../config/config.php';
session_start();

$id_area_user = $_SESSION['id_area'];
$id_cargo_user = $_SESSION['id_cargo'];
$id_user = $_SESSION['id_usuario'];


$consulta = "SELECT u.id_usuario, u.nombre_usuario, u.apellidos  FROM usuarios u JOIN roles r ON u.id_rol = r.id_rol JOIN cargos c ON u.id_cargo = c.id_cargo JOIN areas a ON u.id_area = a.id_area WHERE c.id_cargo != $id_cargo_user AND a.id_area = $id_area_user;";
$resultado = mysqli_query($conexion, $consulta);

$empleados = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $empleados[] = $row;
}

echo json_encode($empleados);
