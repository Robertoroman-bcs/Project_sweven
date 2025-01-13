<?php
$HOST = "localhost";
$USER = "root";
$PASS = "";
$DB = "database_sweven";
$URL = "http://localhost/www/pruebas_vacaciones";
define("APP_NAME", "SYSTEM SWEVEN");



$conexion = mysqli_connect($HOST, $USER, $PASS, $DB);
if (!$conexion) {
    echo "Error de conexion con la base de datos";
}