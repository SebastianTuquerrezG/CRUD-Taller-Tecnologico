<?php
include "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['codigo']) && !empty($_POST['codigo'])) {
        $id_equipo = $_POST['id_equipo'];
        $nuevo_nombre_codigo = $_POST['codigo'];
        $nuevo_nombre_tipo = $_POST['tipo'];
        $nuevo_nombre_marca = $_POST['marca'];
        $nuevo_nombre_sala = $_POST['sala'];
        $nuevo_nombre_fecha = date('Y-m-d', strtotime($_POST['fecha']));
        $nuevo_estado = isset($_POST['estado']) ? 1 : 0;

        $consulta = $conexion->prepare("SELECT codigo FROM equipos WHERE codigo = ? AND id <> ?");
        $consulta->bind_param("si", $nuevo_nombre_codigo, $id_equipo);
        $consulta->execute();
        $consulta->store_result();

        if($consulta->num_rows > 1) {
            echo '<script>
                    setTimeout(function() {
                        alert("El equipo ya existe en la base de datos.");
                        window.location.href = "../model/equipo.php";
                    }, 100); 
                    </script>';
            exit();
        } else {            
            $stmt_marca = $conexion->prepare("SELECT id FROM marcas WHERE nombremarca = ?");
            $stmt_marca->bind_param("s", $nuevo_nombre_marca);
            $stmt_marca->execute();
            $stmt_marca->bind_result($id_marca);
            $stmt_marca->fetch();
            $stmt_marca->close();

            $stmt_sala = $conexion->prepare("SELECT id FROM salas WHERE nombresala = ?");
            $stmt_sala->bind_param("s", $nuevo_nombre_sala);
            $stmt_sala->execute();
            $stmt_sala->bind_result($id_sala);
            $stmt_sala->fetch();
            $stmt_sala->close();

            $stmt = $conexion->prepare("UPDATE equipos SET codigo = ?, tipo = ?, idmarca = ?, idsala =?, fechaingreso = ?, estado = ? WHERE id = ?");
            $stmt->bind_param("ssiisii", $nuevo_nombre_codigo, $nuevo_nombre_tipo, $id_marca, $id_sala, $nuevo_nombre_fecha, $nuevo_estado, $id_equipo);

            if ($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("El equipo se actualizo correctamente");
                        window.location.href = "../model/equipo.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error al actualizar");
                        window.location.href = "../model/equipo.php";
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
