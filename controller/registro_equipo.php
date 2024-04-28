<?php
include "../conexion/conexion.php";

if(isset($_POST['btnregistrarequipo'])) {
    if(empty($_POST['codigo'])) {
        echo '<script>
                setTimeout(function() {
                    alert("Por favor, ingresa el codigo del equipo.");
                    window.location.href = "../model/equipo.php";
                }, 100);
                </script>';
            exit();
    } else {
        $nombre_equipo = $_POST['codigo'];
        $nombre_tipo = $_POST['tipo'];
        $nombre_marca = $_POST['marca'];
        $nombre_sala = $_POST['sala'];
        $nombre_fecha = date('Y-m-d', strtotime($_POST['fecha']));
        $estado = isset($_POST['estado']) ? 1 : 0;

        $consulta = $conexion->prepare("SELECT codigo FROM equipos WHERE codigo = ?");
        $consulta->bind_param("s", $nombre_equipo);
        $consulta->execute();
        $consulta->store_result();

        if($consulta->num_rows > 0) {
            echo '<script>
                    setTimeout(function() {
                        alert("El equipo ya existe en la base de datos.");
                        window.location.href = "../model/equipo.php";
                    }, 100); 
                    </script>';
            exit();
        } else {
            $stmt_marca = $conexion->prepare("SELECT id FROM marcas WHERE nombremarca = ?");
            $stmt_marca->bind_param("s", $nombre_marca);
            $stmt_marca->execute();
            $stmt_marca->bind_result($id_marca);
            $stmt_marca->fetch();
            $stmt_marca->close();

            $stmt_sala = $conexion->prepare("SELECT id FROM salas WHERE nombresala = ?");
            $stmt_sala->bind_param("s", $nombre_sala);
            $stmt_sala->execute();
            $stmt_sala->bind_result($id_sala);
            $stmt_sala->fetch();
            $stmt_sala->close();

            $stmt = $conexion->prepare("INSERT INTO equipos (codigo, tipo, idmarca, idsala, fechaingreso, estado) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiisi", $nombre_equipo, $nombre_tipo, $id_marca, $id_sala, $nombre_fecha, $estado);

            if($stmt->execute()) {
                echo '<script>
                    setTimeout(function() {
                        alert("Registro Exitoso");
                        window.location.href = "../model/equipo.php";
                    }, 100);
                    </script>';
                exit();
            } else {
                echo '<script>
                    setTimeout(function() {
                        alert("Error en consulta");
                        window.location.href = "../model/equipo.php";
                    }, 100);
                    </script>';
                exit();
            }
        }

        $stmt->close();
    }
}

?>