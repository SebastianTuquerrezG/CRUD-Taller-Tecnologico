<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['idsala'])) {
        $id_sala = $_POST['idsala'];
        $stmt = $conexion->prepare("DELETE FROM salas WHERE id = ?");
        $stmt->bind_param("i", $id_sala);

        if ($stmt->execute()) {
            echo '<script>
                setTimeout(function() {
                    alert("La Sala se elimino correctamente");
                    window.location.href = "../model/sala.php";
                }, 100);
                </script>';
            exit();
        } else {
            echo '<script>
                setTimeout(function() {
                    alert("Error al eliminar la sala");
                    window.location.href = "../model/sala.php";
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
                    window.location.href = "../model/sala.php";
                }, 100);
                </script>';
        exit();
    }
} else {
    echo '<script>
                setTimeout(function() {
                    alert("Acceso denegado");
                    window.location.href = "../model/sala.php";
                }, 100);
                </script>';
            exit();
}
?>
