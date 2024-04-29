<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['equipo_actualizar']) && !empty($_POST['equipo_actualizar'])) {
        $id_mantenimiento = $_POST['id_actualizar'];
        $nuevo_nombre_codigo = $_POST['equipo_actualizar'];
        $nuevo_nombre_tipo = $_POST['tipomantenimiento_actualizar'];
        $nuevo_nombre_fechainicio = date('Y-m-d', strtotime($_POST['fechainicio_actualizar']));
        $nuevo_nombre_problema = $_POST['problemamonitor_actualizar'];
        $nuevo_nombre_descripcion = $_POST['descripcion_actualizar'];
        $nuevo_nombre_monitor = $_POST['nombremonitor_actualizar'];
        
        $consulta = $conexion->prepare("SELECT id FROM equipos WHERE codigo = ?");
        $consulta->bind_param("s", $nuevo_nombre_codigo);
        $consulta->execute();
        $consulta->bind_result($id_equipo);
        $consulta->store_result();
        $consulta->fetch();
        $consulta->close();

        if (!empty($_POST['fechafin_actualizar'])) {
            $nuevo_nombre_fechafin = date('Y-m-d', strtotime($_POST['fechafin_actualizar']));
        } else {
            $nuevo_nombre_fechafin = "";
        }

        if($nuevo_nombre_tipo == "Preventivo"){
            $nuevo_nombre_tipo = 0;
        }else if ($nuevo_nombre_tipo == "Correctivo"){
            $nuevo_nombre_tipo = 1;
        }
        
        $stmt_monitor = $conexion->prepare("SELECT id FROM monitores WHERE nombremonitor = ?");
        $stmt_monitor->bind_param("s", $nuevo_nombre_monitor);
        $stmt_monitor->execute();
        $stmt_monitor->bind_result($id_monitor);
        $stmt_monitor->store_result();
        $stmt_monitor->fetch();
        $stmt_monitor->close();

        $stmt = $conexion->prepare("UPDATE mantenimientos SET idequipo = ?, tipomantenimiento = ?, problema = ?, fechainicio =?, idmonitor = ?, fechafin = ?, descripcion = ? WHERE id = ?");
        $stmt->bind_param("iississs", $id_equipo, $nuevo_nombre_tipo, $nuevo_nombre_problema, $nuevo_nombre_fechainicio, $id_monitor, $nuevo_nombre_fechafin, $nuevo_nombre_descripcion, $id_mantenimiento);

        if ($stmt->execute()) {
            echo '<script>
                setTimeout(function() {
                    alert("El equipo se actualizo correctamente");
                    window.location.href = "../model/mantenimiento.php";
                }, 100);
                </script>';
            exit();
        } else {
            echo '<script>
                setTimeout(function() {
                    alert("Error al actualizar");
                    window.location.href = "../model/mantenimiento.php";
                }, 100);
                </script>';
            exit();
        }
        $stmt->close();
        $conexion->close();
    } else {
        echo '<script>
                setTimeout(function() {
                    alert("Parametros incorrectos");
                    window.location.href = "../model/mantenimiento.php";
                }, 100);
                </script>';
        exit();
    }
} else {
    echo '<script>
                setTimeout(function() {
                    alert("Acceso denegado");
                    window.location.href = "../model/mantenimiento.php";
                }, 100);
                </script>';
            exit();
}
?>
