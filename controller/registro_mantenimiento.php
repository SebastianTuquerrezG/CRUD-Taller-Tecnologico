<?php
include "../conexion/conexion.php";

if(isset($_POST['btnregistrarmantenimiento'])) {
    if(empty($_POST['equipo'])) {
        echo '<script>
                setTimeout(function() {
                    alert("Por favor, ingresa el codigo del equipo.");
                    window.location.href = "../model/mantenimiento.php";
                }, 100);
                </script>';
            exit();
    } else {
        $nombre_equipo = $_POST['equipo'];
        $nombre_tipo = $_POST['tipomantenimiento'];
        $nombre_fecha = date('Y-m-d', strtotime($_POST['fechainicio']));
        $problema_equipo = $_POST['problemamonitor'];
        $nombre_monitor = $_POST['nombremonitor'];

        $consulta = $conexion->prepare("SELECT id FROM equipos WHERE codigo = ?");
        $consulta->bind_param("s", $nombre_equipo);
        $consulta->execute();
        $consulta->bind_result($id_equipo);
        $consulta->fetch();
        $consulta->close();

        if($nombre_tipo == "Preventivo"){
            $nombre_tipo = 0;
        }else if ($nombre_tipo == "Correctivo"){
            $nombre_tipo = 1;
        }

        $stmt_monitor = $conexion->prepare("SELECT id FROM monitores WHERE nombremonitor = ?");
        $stmt_monitor->bind_param("s", $nombre_monitor);
        $stmt_monitor->execute();
        $stmt_monitor->bind_result($id_monitor);
        $stmt_monitor->fetch();
        $stmt_monitor->close();

        $stmt = $conexion->prepare("INSERT INTO MANTENIMIENTOS (idequipo, tipomantenimiento, problema, fechainicio, idmonitor) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iissi", $id_equipo, $nombre_tipo, $problema_equipo, $nombre_fecha, $id_monitor);

        if($stmt->execute()) {          
            $stmt_actualizar_equipo = $conexion->prepare("UPDATE equipos SET estado = 0 WHERE id = ?");
            $stmt_actualizar_equipo->bind_param("i", $id_equipo);
            $stmt_actualizar_equipo->execute();
            $stmt_actualizar_equipo->close();
            echo '<script>
                setTimeout(function() {
                    alert("Registro Exitoso");
                    window.location.href = "../model/mantenimiento.php";
                }, 100);
                </script>';
            exit();
        } else {
            echo '<script>
                setTimeout(function() {
                    alert("Error en consulta");
                    window.location.href = "../model/mantenimiento.php";
                }, 100);
                </script>';
            exit();
        }       

        $stmt->close();
    }
}

?>