<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['idequipo'])) {
        $id_equipo= $_POST['idequipo'];
        $stmt = $conexion->prepare("DELETE FROM equipos WHERE id = ?");
        $stmt->bind_param("i", $id_equipo);

        if ($stmt->execute()) {
            echo '<script>
                setTimeout(function() {
                    alert("El equipo se elimino correctamente");
                    window.location.href = "../model/equipo.php";
                }, 100);
                </script>';
            exit();
        } else {
            echo '<script>
                setTimeout(function() {
                    alert("Error al eliminar el equipo");
                    window.location.href = "../model/equipo.php";
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
                    window.location.href = "../model/equipo.php";
                }, 100);
                </script>';
        exit();
    }
} else {
    echo '<script>
                setTimeout(function() {
                    alert("Acceso denegado");
                    window.location.href = "../model/equipo.php";
                }, 100);
                </script>';
            exit();
}
?>
