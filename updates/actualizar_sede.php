<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombresede']) && !empty($_POST['nombresede'])) {
        $id_sede = $_POST['idsede'];
        $nuevo_nombre_sede = $_POST['nombresede'];

        $consulta = $conexion->prepare("SELECT nombresede FROM sedes WHERE nombresede = ?");
        $consulta->bind_param("s", $nuevo_nombre_sede);
        $consulta->execute();
        $consulta->store_result();

        if($consulta->num_rows > 0) {
            echo '<script>
                    setTimeout(function() {
                        alert("La sede ya existe en la base de datos.");
                        window.location.href = "../model/sede.php";
                    }, 100); 
                    </script>';
            exit();
        } else {
            $stmt = $conexion->prepare("UPDATE sedes SET nombresede = ? WHERE id = ?");
            $stmt->bind_param("si", $nuevo_nombre_sede, $id_sede);

            if ($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("La Sede se actualizo correctamente");
                        window.location.href = "../model/sede.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error al actualizar");
                        window.location.href = "../model/sede.php";
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
