<?php
include "../conexion/conexion.php";

if(isset($_POST['btnregistrarmonitor'])) {
    if(empty($_POST['nombremonitor'])) {
        echo '<script>
                setTimeout(function() {
                    alert("Por favor, ingresa el nombre del monitor.");
                    window.location.href = "../model/monitor.php";
                }, 100);
                </script>';
            exit();
    } else {
        $nombre_monitor = $_POST['nombremonitor'];

        $consulta = $conexion->prepare("SELECT nombremonitor FROM monitores WHERE nombremonitor = ?");
        $consulta->bind_param("s", $nombre_monitor);
        $consulta->execute();
        $consulta->store_result();

        if($consulta->num_rows > 0) {
            echo '<script>
                    setTimeout(function() {
                        alert("El monitor ya existe en la base de datos.");
                        window.location.href = "../model/monitor.php";
                    }, 100); 
                    </script>';
            exit();
        } else {
            $stmt = $conexion->prepare("INSERT INTO monitores (nombremonitor) VALUES (?)");
            $stmt->bind_param("s", $nombre_monitor);

            if($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("Registro Exitoso");
                        window.location.href = "../model/monitor.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error en consulta");
                        window.location.href = "../model/monitor.php";
                    }, 100);
                    </script>';
                exit();
            }
        }

        $stmt->close();
    }
}

?>