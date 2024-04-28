<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['idmonitor'])) {
        $id_monitor = $_POST['idmonitor'];
        $stmt = $conexion->prepare("DELETE FROM monitores WHERE id = ?");
        $stmt->bind_param("i", $id_monitor);

        if ($stmt->execute()) {
            echo '<script>
                setTimeout(function() {
                    alert("El monitor se elimino correctamente");
                    window.location.href = "../model/monitor.php";
                }, 100);
                </script>';
            exit();
        } else {
            echo '<script>
                setTimeout(function() {
                    alert("Error al eliminar el monitor");
                    window.location.href = "../model/monitor.php";
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
