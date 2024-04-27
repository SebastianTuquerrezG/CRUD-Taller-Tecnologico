<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['idmarca'])) {
        $id_marca = $_POST['idmarca'];
        $stmt = $conexion->prepare("DELETE FROM marcas WHERE id = ?");
        $stmt->bind_param("i", $id_marca);

        if ($stmt->execute()) {
            echo '<script>
                setTimeout(function() {
                    alert("La Marca se elimino correctamente");
                    window.location.href = "../model/marca.php";
                }, 100);
                </script>';
            exit();
        } else {
            echo '<script>
                setTimeout(function() {
                    alert("Error al eliminar la sede");
                    window.location.href = "../model/marca.php";
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
                    window.location.href = "../model/marca.php";
                }, 100);
                </script>';
        exit();
    }
} else {
    echo '<script>
                setTimeout(function() {
                    alert("Acceso denegado");
                    window.location.href = "../model/marca.php";
                }, 100);
                </script>';
            exit();
}
?>
