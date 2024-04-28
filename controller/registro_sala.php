<?php
include "../conexion/conexion.php";

if(isset($_POST['btnregistrarsala'])) {
    if(empty($_POST['nombresala'])) {
        echo '<script>
                setTimeout(function() {
                    alert("Por favor, ingresa el nombre de la sala.");
                    window.location.href = "../model/sala.php";
                }, 100);
                </script>';
            exit();
    } else {
        $nombre_sala = $_POST['nombresala'];
        $nombre_sede = $_POST['nombresede'];

        $consulta = $conexion->prepare("SELECT nombresala FROM salas WHERE nombresala = ?");
        $consulta->bind_param("s", $nombre_sala);
        $consulta->execute();
        $consulta->store_result();

        if($consulta->num_rows > 0) {
            echo '<script>
                    setTimeout(function() {
                        alert("La sala ya existe en la base de datos.");
                        window.location.href = "../model/sala.php";
                    }, 100); 
                    </script>';
            exit();
        } else {
            $stmt_sede = $conexion->prepare("SELECT id FROM sedes WHERE nombresede = ?");
            $stmt_sede->bind_param("s", $nombre_sede);
            $stmt_sede->execute();
            $stmt_sede->bind_result($id_sede);
            $stmt_sede->fetch();    
            $stmt_sede->close();        

            $stmt = $conexion->prepare("INSERT INTO salas (nombresala, idsede) VALUES (?, ?)");
            $stmt->bind_param("si", $nombre_sala, $id_sede);

            if($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("Registro Exitoso");
                        window.location.href = "../model/sala.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error en consulta");
                        window.location.href = "../model/sala.php";
                    }, 100);
                    </script>';
                exit();
            }
        }

        $stmt->close();
    }
}

?>