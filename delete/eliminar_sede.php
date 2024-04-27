<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['idsede'])) {
        $id_sede = $_POST['idsede'];

        $stmt_verificar = $conexion->prepare("SELECT COUNT(*) FROM salas WHERE idsede = ?");
        $stmt_verificar->bind_param("i", $id_sede);
        $stmt_verificar->execute();
        $stmt_verificar->bind_result($num_salas_relacionadas);
        $stmt_verificar->fetch();
        $stmt_verificar->close();

        if ($num_salas_relacionadas > 0) {
            echo '<script>
                alert("Debe eliminar las salas relacionadas a esta sede antes de eliminar la sede.");
                window.location.href = "../model/sede.php";
            </script>';
            exit();
        }
        
        $stmt = $conexion->prepare("DELETE FROM sedes WHERE id = ?");
        $stmt->bind_param("i", $id_sede);

        if ($stmt->execute()) {
            echo '<script>
                setTimeout(function() {
                    alert("La Sede se elimino correctamente");
                    window.location.href = "../model/sede.php";
                }, 100);
                </script>';
            exit();
        } else {
            echo '<script>
                setTimeout(function() {
                    alert("Error al eliminar la sede");
                    window.location.href = "../model/sede.php";
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
                    window.location.href = "../model/sede.php";
                }, 100);
                </script>';
        exit();
    }
} else {
    echo '<script>
                setTimeout(function() {
                    alert("Acceso denegado");
                    window.location.href = "../model/sede.php";
                }, 100);
                </script>';
            exit();
}
?>
