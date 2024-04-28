<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombremonitor']) && !empty($_POST['nombremonitor'])) {
        $id_monitor = $_POST['idmonitor'];
        $nuevo_nombre_monitor = $_POST['nombremonitor'];

        $consulta = $conexion->prepare("SELECT nombremonitor FROM monitores WHERE nombremonitor = ?");
        $consulta->bind_param("s", $nuevo_nombre_monitor);
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
            $stmt = $conexion->prepare("UPDATE monitores SET nombremonitor = ? WHERE id = ?");
            $stmt->bind_param("si", $nuevo_nombre_monitor, $id_monitor);

            if ($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("La Marca se actualizo correctamente");
                        window.location.href = "../model/monitor.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error al actualizar");
                        window.location.href = "../model/monitor.php";
                    }, 100);
                    </script>';
                exit();
            }
        }
        $stmt->close();
        $conexion->close();
    } else {
        echo '<script>
                setTimeout(function() {
                    alert("Parametros incorrectos");
                    window.location.href = "../model/monitor.php";
                }, 100);
                </script>';
        exit();
    }
} else {
    echo '<script>
                setTimeout(function() {
                    alert("Acceso denegado");
                    window.location.href = "../model/monitor.php";
                }, 100);
                </script>';
            exit();
}
?>
