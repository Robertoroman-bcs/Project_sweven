<?php
require_once("../../config/config.php");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = isset($_POST['id_usuario']) ? trim($_POST['id_usuario']) : null;

    $id_area = isset($_POST['id_area']) ? trim($_POST['id_area']) : null;
    $fecha_inicio = isset($_POST['fecha_inicio']) ? trim($_POST['fecha_inicio']) : null;
    $fecha_termino = isset($_POST['fecha_termino']) ? trim($_POST['fecha_termino']) : null;
    $fecha_inicio_labores = isset($_POST['fecha_inicio_labores']) ? trim($_POST['fecha_inicio_labores']) : null;





    // Comprobación de datos vacíos
    if (empty($id_usuario) || empty($id_area) || empty($fecha_inicio) || empty($fecha_termino) || empty($fecha_inicio_labores)) {
        die("Todos los campos son obligatorios.");
    }

    // Validar que el ID de usuario sea un número entero (esto es una medida adicional de seguridad)
    if (!is_numeric($id_usuario)) {
        die("El ID de usuario no es válido.");
    }






    // Convertir las fechas al formato 'YYYY-MM-DD' usando DateTime
    $fecha_inicio_objeto = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
    $fecha_fin_objeto = DateTime::createFromFormat('d/m/Y', $fecha_termino);
    $fecha_labores_objeto = DateTime::createFromFormat('d/m/Y', $fecha_inicio_labores);


    $fecha_inicio_format = $fecha_inicio_objeto->format('Y-m-d');
    $fecha_fin_format = $fecha_fin_objeto->format('Y-m-d');
    $fecha_labores_format = $fecha_labores_objeto->format('Y-m-d');





    function calcularDiasLaboralesDB($fechaInicial, $fechaFinal, $conexion)
    {

        $inicio = $fechaInicial;
        $fin = $fechaFinal;
        $fin->modify('+1 day'); // Incluir la fecha de finalización
        $intervalo = new DatePeriod($inicio, new DateInterval('P1D'), $fin);

        $consulta = mysqli_query($conexion, "SELECT dia_semana FROM dias_laborales WHERE es_laboral = 1");

        $diasLaborales = [];
        while ($fila = $consulta->fetch_assoc()) {
            $diasLaborales[] = $fila['dia_semana'];
        }

        $conteo = 0;
        foreach ($intervalo as $fecha) {
            $diaSemana = $fecha->format('N'); // 1 (Lunes) a 7 (Domingo)
            if (in_array($diaSemana, $diasLaborales)) {
                $conteo++;
            }
        }

        return $conteo;
    }



    $dias_solicitados = calcularDiasLaboralesDB($fecha_inicio_objeto, $fecha_fin_objeto, $conexion);

    //echo '       FECHA INICIO: '  . $fecha_inicio_format . '        FECHA FIN: ' . $fecha_fin_format . '        FECHA REGRESO A TRABAJO: ' . $fecha_labores_format . ' Dias que faltara: ' . $dias_solicitados;

    /*

    // Calcular la diferencia entre fecha_inicio y fecha_fin
    $diferencia = $fecha_fin_objeto->diff($fecha_inicio_objeto);
    $dias_solicitados = $diferencia->days;  // Total de días entre las dos fechas
*/
    // Para obtener las fechas en el formato adecuado para MySQL, si es necesario


    /*


    $fecha_inicio_format = $fecha_inicio_objeto->format('Y-m-d');
    $fecha_fin_format = $fecha_fin_objeto->format('Y-m-d');
    $fecha_labores_format = $fecha_labores_objeto->format('Y-m-d');
*/



    $sql = "INSERT INTO solicitudes_vacaciones (id_usuario , id_area ,  dias_solicitados, fecha_inicio, fecha_termino, fecha_inicio_labores) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param(
        "ssssss",  // Tipo de datos de los parámetros (s para string)
        $id_usuario,
        $id_area,
        $dias_solicitados,
        $fecha_inicio_format,   // Fecha de inicio en formato 'YYYY-MM-DD'
        $fecha_fin_format,      // Fecha de término en formato 'YYYY-MM-DD'
        $fecha_labores_format   // Fecha de labores en formato 'YYYY-MM-DD'
    );

    if ($stmt->execute()) {
        // Redirige a la página de lista de usuarios si la inserción fue exitosa
        header("Location: ../views/Dashboard/Trabajador/solicitudes_vacaciones_trj.php");
        exit();
    } else {
        echo "Error al guardar el registro: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}