<?php
include "../conexion/conexion.php";

if(isset($_POST['btnregistrarsede'])) {
    if(empty($_POST['nombresede'])) {
        echo '<script>
                setTimeout(function() {
                    alert("Por favor, ingresa el nombre de la sede.");
                    window.location.href = "../model/sede.php";
                }, 100);
                </script>';
            exit();
    } else {
        $nombre_sede = $_POST['nombresede'];

        $consulta = $conexion->prepare("SELECT nombresede FROM sedes WHERE nombresede = ?");
        $consulta->bind_param("s", $nombre_sede);
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
            $stmt = $conexion->prepare("INSERT INTO sedes (nombresede) VALUES (?)");
            $stmt->bind_param("s", $nombre_sede);

            if($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("Registro Exitoso");
                        window.location.href = "../model/sede.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error en consulta");
                        window.location.href = "../model/sede.php";
                    }, 100);
                    </script>';
                exit();
            }
        }

        $stmt->close();
    }
}

?>