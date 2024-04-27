<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombremarca']) && !empty($_POST['nombremarca'])) {
        $id_marca = $_POST['idmarca'];
        $nuevo_nombre_marca = $_POST['nombremarca'];

        $consulta = $conexion->prepare("SELECT nombremarca FROM marcas WHERE nombremarca = ?");
        $consulta->bind_param("s", $nuevo_nombre_marca);
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
            $stmt = $conexion->prepare("UPDATE marcas SET nombremarca = ? WHERE id = ?");
            $stmt->bind_param("si", $nuevo_nombre_marca, $id_marca);

            if ($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("La Marca se actualizo correctamente");
                        window.location.href = "../model/marca.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error al actualizar");
                        window.location.href = "../model/marca.php";
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
