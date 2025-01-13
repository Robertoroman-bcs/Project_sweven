<?php
/*
$usuario = $_POST["usuario_id"];

require_once("../../config/config.php");
// Archivos esperados
$archivos = [
    'archivo' => '../Document/ACTAS_DE_NACIMIENTO/',
    'archivo_domicilio' => '../Document/DOMICILIO/',
    'archivo_ine' => '../Document/INE/',
    'archivo_curp' => '../Document/CURP/',
    'archivo_rfc' => '../Document/RFC/',
    'archivo_nss' => '../Document/NSS/',
    'archivo_cv' => '../Document/CV/',
    'archivo_infonavit' => '../Document/INFONAVIT/',
    'archivo_alimenticia' => '../Document/ALIMENTACION/'
];

// Validar que todos los archivos sean subidos
foreach ($archivos as $campo => $destino) {
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        echo "Error en el archivo: $campo";
        exit;
    }
}

// Validación de extensiones de archivos
$extensiones_permitidas = ['pdf', 'doc', 'docx'];
foreach ($archivos as $campo => $destino) {
    $extension = strtolower(pathinfo($_FILES[$campo]['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $extensiones_permitidas)) {
        echo "Extensión de archivo no permitida: $campo";
        exit;
    }
}

// Crear las carpetas si no existen
foreach ($archivos as $destino) {
    if (!is_dir($destino)) {
        if (!mkdir($destino, 0755, true)) {
            echo "Error al crear la carpeta: $destino";
            exit;
        }
    }
}

// Mover los archivos a sus destinos
$archivos_guardados = [];
foreach ($archivos as $campo => $destino) {
    $nombre_archivo = basename($_FILES[$campo]['name']);
    if (move_uploaded_file($_FILES[$campo]['tmp_name'], $destino . $nombre_archivo)) {
        $archivos_guardados[$campo] = $nombre_archivo;
    } else {
        echo "Error al subir el archivo: $campo";
        exit;
    }
}

// Insertar los datos en la base de datos
// Usar una consulta preparada para evitar inyecciones SQL
$stmt = $conexion->prepare("INSERT INTO documentos 
    (acta_doc, comprobante_domicilio_doc, ine_doc, curp_doc, rfc_doc, nss_doc, cv_doc, aviso_retencion_infonavit_doc, aviso_pension_alimenticia_doc, id_usuario)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "ssssssssss",
    $archivos_guardados['archivo'],
    $archivos_guardados['archivo_domicilio'],
    $archivos_guardados['archivo_ine'],
    $archivos_guardados['archivo_curp'],
    $archivos_guardados['archivo_rfc'],
    $archivos_guardados['archivo_nss'],
    $archivos_guardados['archivo_cv'],
    $archivos_guardados['archivo_infonavit'],
    $archivos_guardados['archivo_alimenticia'],
    $usuario
);

if ($stmt->execute()) {

    header("Location: ../admin/vistas_admin/lista_documentos.php");
} else {
    echo "Error al subir los datos: " . $stmt->error;
}

// Cerrar la consulta
$stmt->close();
$conexion->close();
*/


/*
$usuario = $_POST["usuario_id"];

require_once("../../config/config.php");

// Archivos esperados
$archivos = [
    'archivo' => '../Document/ACTAS_DE_NACIMIENTO/',
    'archivo_domicilio' => '../Document/DOMICILIO/',
    'archivo_ine' => '../Document/INE/',
    'archivo_curp' => '../Document/CURP/',
    'archivo_rfc' => '../Document/RFC/',
    'archivo_nss' => '../Document/NSS/',
    'archivo_cv' => '../Document/CV/',
    'archivo_infonavit' => '../Document/INFONAVIT/',
    'archivo_alimenticia' => '../Document/ALIMENTACION/'
];

// Validar que todos los archivos sean subidos
foreach ($archivos as $campo => $destino) {
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        echo "Error en el archivo: $campo";
        exit;
    }
}

// Validación de extensiones de archivos
$extensiones_permitidas = ['pdf', 'doc', 'docx'];
foreach ($archivos as $campo => $destino) {
    $extension = strtolower(pathinfo($_FILES[$campo]['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $extensiones_permitidas)) {
        echo "Extensión de archivo no permitida: $campo";
        exit;
    }
}

// Obtener el nombre del usuario a partir del ID
$sql = "SELECT nombre_usuario FROM usuarios WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario);
$stmt->execute();
$stmt->bind_result($nombre_usuario);
$stmt->fetch();
$stmt->close();

// Crear las carpetas si no existen
foreach ($archivos as $destino) {
    if (!is_dir($destino)) {
        if (!mkdir($destino, 0755, true)) {
            echo "Error al crear la carpeta: $destino";
            exit;
        }
    }
}

// Mover los archivos a sus destinos con el nombre del usuario
$archivos_guardados = [];
foreach ($archivos as $campo => $destino) {
    // Obtener la extensión del archivo
    $extension = strtolower(pathinfo($_FILES[$campo]['name'], PATHINFO_EXTENSION));

    // Crear el nuevo nombre del archivo usando el nombre del usuario
    $nombre_archivo = $nombre_usuario . "_" . basename($_FILES[$campo]['name']);

    // Asegurarse que el archivo tiene una extensión permitida
    if (in_array($extension, $extensiones_permitidas)) {
        // Mover el archivo al destino con el nuevo nombre
        if (move_uploaded_file($_FILES[$campo]['tmp_name'], $destino . $nombre_archivo)) {
            $archivos_guardados[$campo] = $nombre_archivo;
        } else {
            echo "Error al subir el archivo: $campo";
            exit;
        }
    } else {
        echo "Extensión no permitida para el archivo: $campo";
        exit;
    }
}

// Insertar los datos en la base de datos
$stmt = $conexion->prepare("INSERT INTO documentos 
    (acta_doc, comprobante_domicilio_doc, ine_doc, curp_doc, rfc_doc, nss_doc, cv_doc, aviso_retencion_infonavit_doc, aviso_pension_alimenticia_doc, id_usuario)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "ssssssssss",
    $archivos_guardados['archivo'],
    $archivos_guardados['archivo_domicilio'],
    $archivos_guardados['archivo_ine'],
    $archivos_guardados['archivo_curp'],
    $archivos_guardados['archivo_rfc'],
    $archivos_guardados['archivo_nss'],
    $archivos_guardados['archivo_cv'],
    $archivos_guardados['archivo_infonavit'],
    $archivos_guardados['archivo_alimenticia'],
    $usuario
);

if ($stmt->execute()) {
    header("Location: ../views/Dashboard/Administrador/lista_documentacion.php");
} else {
    echo "Error al subir los datos: " . $stmt->error;
}

// Cerrar la consulta
$stmt->close();
$conexion->close();
*/

$usuario = $_POST["usuario_id"];

require_once("../../config/config.php");

// Archivos esperados
$archivos = [
    'archivo' => '../Document/ACTAS_DE_NACIMIENTO/',
    'archivo_domicilio' => '../Document/DOMICILIO/',
    'archivo_ine' => '../Document/INE/',
    'archivo_curp' => '../Document/CURP/',
    'archivo_rfc' => '../Document/RFC/',
    'archivo_nss' => '../Document/NSS/',
    'archivo_cv' => '../Document/CV/',
    'archivo_infonavit' => '../Document/INFONAVIT/',
    'archivo_alimenticia' => '../Document/ALIMENTACION/'
];

// Validar si el usuario ya tiene documentos registrados
$sql = "SELECT COUNT(*) FROM documentos WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();


function msjerrordocument()
{
    header("location:../views/Dashboard/Administrador/lista_documentacion.php?msjerrordocument=1");
}

if ($count > 0) {
    msjerrordocument();
    exit;
}

// Validar que todos los archivos sean subidos
foreach ($archivos as $campo => $destino) {
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        echo "Error en el archivo: $campo";
        exit;
    }
}

// Validación de extensiones de archivos
$extensiones_permitidas = ['pdf', 'doc', 'docx'];
foreach ($archivos as $campo => $destino) {
    $extension = strtolower(pathinfo($_FILES[$campo]['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $extensiones_permitidas)) {
        echo "Extensión de archivo no permitida: $campo";
        exit;
    }
}

// Obtener el nombre del usuario a partir del ID
$sql = "SELECT nombre_usuario FROM usuarios WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario);
$stmt->execute();
$stmt->bind_result($nombre_usuario);
$stmt->fetch();
$stmt->close();

// Crear las carpetas si no existen
foreach ($archivos as $destino) {
    if (!is_dir($destino)) {
        if (!mkdir($destino, 0755, true)) {
            echo "Error al crear la carpeta: $destino";
            exit;
        }
    }
}

// Mover los archivos a sus destinos con el nombre del usuario
$archivos_guardados = [];
foreach ($archivos as $campo => $destino) {
    // Obtener la extensión del archivo
    $extension = strtolower(pathinfo($_FILES[$campo]['name'], PATHINFO_EXTENSION));

    // Crear el nuevo nombre del archivo usando el nombre del usuario
    $nombre_archivo = $nombre_usuario . "_" . basename($_FILES[$campo]['name']);

    // Asegurarse que el archivo tiene una extensión permitida
    if (in_array($extension, $extensiones_permitidas)) {
        // Mover el archivo al destino con el nuevo nombre
        if (move_uploaded_file($_FILES[$campo]['tmp_name'], $destino . $nombre_archivo)) {
            $archivos_guardados[$campo] = $nombre_archivo;
        } else {
            echo "Error al subir el archivo: $campo";
            exit;
        }
    } else {
        echo "Extensión no permitida para el archivo: $campo";
        exit;
    }
}

// Insertar los datos en la base de datos
$stmt = $conexion->prepare("INSERT INTO documentos 
    (acta_doc, comprobante_domicilio_doc, ine_doc, curp_doc, rfc_doc, nss_doc, cv_doc, aviso_retencion_infonavit_doc, aviso_pension_alimenticia_doc, id_usuario)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "ssssssssss",
    $archivos_guardados['archivo'],
    $archivos_guardados['archivo_domicilio'],
    $archivos_guardados['archivo_ine'],
    $archivos_guardados['archivo_curp'],
    $archivos_guardados['archivo_rfc'],
    $archivos_guardados['archivo_nss'],
    $archivos_guardados['archivo_cv'],
    $archivos_guardados['archivo_infonavit'],
    $archivos_guardados['archivo_alimenticia'],
    $usuario
);

if ($stmt->execute()) {
    header("Location: ../views/Dashboard/Administrador/lista_documentacion.php");
} else {
    echo "Error al subir los datos: " . $stmt->error;
}

// Cerrar la consulta
$stmt->close();
$conexion->close();