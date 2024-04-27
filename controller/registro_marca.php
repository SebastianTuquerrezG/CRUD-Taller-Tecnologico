<?php
include "../conexion/conexion.php";

if(isset($_POST['btnregistrarmarca'])) {
    if(empty($_POST['nombremarca'])) {
        echo '<script>
                setTimeout(function() {
                    alert("Por favor, ingresa el nombre de la marca.");
                    window.location.href = "../model/marca.php";
                }, 100);
                </script>';
            exit();
    } else {
        $nombre_marca = $_POST['nombremarca'];

        $consulta = $conexion->prepare("SELECT nombremarca FROM marcas WHERE nombremarca = ?");
        $consulta->bind_param("s", $nombre_marca);
        $consulta->execute();
        $consulta->store_result();

        if($consulta->num_rows > 0) {
            echo '<script>
                    setTimeout(function() {
                        alert("La marca ya existe en la base de datos.");
                        window.location.href = "../model/marca.php";
                    }, 100); 
                    </script>';
            exit();
        } else {
            $stmt = $conexion->prepare("INSERT INTO marcas (nombremarca) VALUES (?)");
            $stmt->bind_param("s", $nombre_marca);

            if($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("Registro Exitoso");
                        window.location.href = "../model/marca.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error en consulta");
                        window.location.href = "../model/marca.php";
                    }, 100);
                    </script>';
                exit();
            }
        }

        $stmt->close();
    }
}

?>