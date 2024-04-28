<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombresala']) && !empty($_POST['nombresala'])) {
        $id_sala = $_POST['idsala'];
        $nuevo_nombre_sala = $_POST['nombresala'];
        $nuevo_nombre_sede = $_POST['nombresede'];

        $consulta = $conexion->prepare("SELECT nombresala FROM salas WHERE nombresala = ?");
        $consulta->bind_param("s", $nuevo_nombre_sala);
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
            $stmt_sede->bind_param("s", $nuevo_nombre_sede);
            $stmt_sede->execute();
            $stmt_sede->bind_result($id_sede);
            $stmt_sede->fetch();    
            $stmt_sede->close();  
            
            $stmt = $conexion->prepare("UPDATE salas SET nombresala = ?, idsede = ? WHERE id = ?");
            $stmt->bind_param("sii", $nuevo_nombre_sala, $id_sede, $id_sala);

            if ($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("La Marca se actualizo correctamente");
                        window.location.href = "../model/sala.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error al actualizar");
                        window.location.href = "../model/sala.php";
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
