<?php
$url_base = "http://localhost:80/projects/CRUD/CRUD-Taller-Tecnologico/";
$fecha_actual = date("Y-m-d");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/875b3ce1f0.js" crossorigin="anonymous"></script>
    <style>
        .table-container {
            max-height: 70vh;
            overflow-y: auto;
        }

        .thead-fixed th {
            position: sticky;
            top: 0;
            background-color: #f8f9fa;
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="container-fluid row">
        <section class="col-md-3 bg-info text-dark text-center d-flex align-items-center" style="height: 100vh;">
            <div class="sidebar">
                <h3 class="p-3">Mantenimiento de Equipos</h3>
                <ul class="nav flex-column">
                    <li class="nav-item bg-warning mx-auto mb-2">
                        <a class="nav-link text-dark" href="<?php echo $url_base; ?>model/equipo.php" aria-current="page">Equipos</a>
                    </li>
                    <li class="nav-item bg-warning mx-auto mb-2">
                        <a class="nav-link text-light" href="#">Mantenimientos</a>
                    </li>
                    <hr class="border-bottom">
                    <h5 class="p-3">Informacion</h5>
                    <li class="nav-item bg-warning mx-auto mb-2">
                        <a class="nav-link text-dark" href="<?php echo $url_base; ?>model/monitor.php">Monitores</a>
                    </li>
                    <li class="nav-item bg-warning mx-auto mb-2">
                        <a class="nav-link text-dark" href="<?php echo $url_base; ?>model/sede.php">Sedes</a>
                    </li>
                    <li class="nav-item bg-warning mx-auto mb-2">
                        <a class="nav-link text-dark" href="<?php echo $url_base; ?>model/sala.php">Salas</a>
                    </li>
                    <li class="nav-item bg-warning mx-auto mb-2">
                        <a class="nav-link text-dark" href="<?php echo $url_base; ?>model/marca.php">Marcas</a>
                    </li>
                </ul>
            </div>
        </section>
        <section class="col-md-9 bg-light d-flex" style="height: 100vh;">
            <div class="body text-center container-fluid row justify-content-center align-items-center">
                <div class="col-12 p-4 table-container">
                    <table class="table">
                        <thead class="thead-fixed">
                            <tr>
                                <th class="bg-primary" scope="col">NOMBRE EQUIPO</th>
                                <th class="bg-primary" scope="col">TIPO DE MANTENIMIENTO</th>
                                <th class="bg-primary" scope="col">MONITOR</th>
                                <th class="bg-primary" scope="col">PROBLEMA</th>
                                <th class="bg-primary" scope="col">DESCRIPCION</th>
                                <th class="bg-primary" scope="col">FECHA INICIO</th>
                                <th class="bg-primary" scope="col">FECHA FIN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../conexion/conexion.php";
                            $sql = $conexion->query("SELECT
                                    equipos.id AS ID_EQUIPO,
                                    equipos.codigo AS NOMBRE_EQUIPO,
                                    mantenimientos.id AS ID_MANTENIMIENTO,
                                    mantenimientos.tipomantenimiento AS TIPO_DE_MANTENIMIENTO,
                                    monitores.nombremonitor AS MONITOR,
                                    mantenimientos.problema AS PROBLEMA,
                                    mantenimientos.descripcion AS DESCRIPCION,
                                    IF(mantenimientos.fechainicio = '0000-00-00', '', mantenimientos.fechainicio) AS FECHA_INICIO,
                                    IF(mantenimientos.fechafin = '0000-00-00', '', mantenimientos.fechafin) AS FECHA_FIN
                                FROM
                                    mantenimientos
                                INNER JOIN
                                    equipos ON mantenimientos.idequipo = equipos.id
                                INNER JOIN
                                    monitores ON mantenimientos.idmonitor = monitores.id;
                                ");
                            while ($datos = $sql->fetch_object()) {
                                if ($datos->TIPO_DE_MANTENIMIENTO == 1) {
                                    $mantenimiento = "Preventivo";
                                } else {
                                    $mantenimiento = "Correctivo";
                                }
                            ?>
                                <tr>
                                    <td><?= $datos->NOMBRE_EQUIPO ?></td>
                                    <td><?= $mantenimiento ?></td>
                                    <td><?= $datos->MONITOR ?></td>
                                    <td><?= $datos->PROBLEMA ?></td>
                                    <td><?= $datos->DESCRIPCION ?></td>
                                    <td><?= $datos->FECHA_INICIO ?></td>
                                    <td><?= $datos->FECHA_FIN ?></td>
                                    <td>
                                        <a data-idmantenimiento="<?= $datos->ID_MANTENIMIENTO ?>" data-nombreequipo="<?= $datos->NOMBRE_EQUIPO ?>" data-fechafin="<?= $datos->FECHA_FIN ?>" data-tipomantenimiento="<?= $mantenimiento ?>" data-problema="<?= $datos->PROBLEMA ?>" class="btn btn-small btn-warning" data-bs-toggle="modal" data-fechainicio="<?= $datos->FECHA_INICIO ?>" data-bs-target="#actualizarModal" data-descripcion="<?= $datos->DESCRIPCION ?>" data-monitor="<?= $datos->MONITOR ?>">
                                            <i class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="btn btn-small btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroModal">
                        Registrar Mantenimiento
                    </button>
                </div>
                <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar Mantenimiento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="../controller/registro_mantenimiento.php">
                                    <label for="tipo">Equipo para Mantenimiento</label>
                                    <select class="form-control mb-3" id="equipo" name="equipo">
                                        <?php
                                        include "../conexion/conexion.php";
                                        $sql = $conexion->query("select * from equipos");
                                        while ($datos = $sql->fetch_object()) { ?>
                                            <option><?= $datos->codigo ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <label for="codigo" class="form-label">Tipo de Mantenimiento</label>
                                    <select class="form-control mb-3" id="tipomantenimiento" name="tipomantenimiento">
                                        <option>Preventivo</option>
                                        <option>Correctivo</option>
                                    </select>
                                    <label for="fecha" class="form-label">Fecha Inicio de Mantenimiento del Equipo</label>
                                    <input type="date" class="form-control mb-3" id="fechainicio" name="fechainicio" value="<?php echo $fecha_actual; ?>">
                                    <label for="codigo" class="form-label">Problema del Equipo</label>
                                    <input type="text" class="form-control mb-3" id="problemamonitor" name="problemamonitor">
                                    <label for="codigo" class="form-label">Nombre de Monitor</label>
                                    <select class="form-control mb-3" id="nombremonitor" name="nombremonitor">
                                        <?php
                                        include "../conexion/conexion.php";
                                        $sql = $conexion->query("select * from monitores");
                                        while ($datos = $sql->fetch_object()) { ?>
                                            <option><?= $datos->nombremonitor ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary" value="ok" name="btnregistrarmantenimiento">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Actualizar Mantenimiento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="../updates/actualizar_mantenimiento.php">
                                    <label for="tipo">Equipo para Mantenimiento</label>
                                    <select class="form-control mb-3" id="equipo_actualizar" name="equipo_actualizar">
                                        <?php
                                        include "../conexion/conexion.php";
                                        $sql = $conexion->query("select * from equipos");
                                        while ($datos = $sql->fetch_object()) { ?>
                                            <option><?= $datos->codigo ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <label for="codigo" class="form-label">Tipo de Mantenimiento</label>
                                    <select class="form-control mb-3" id="tipomantenimiento_actualizar" name="tipomantenimiento_actualizar">
                                        <option>Preventivo</option>
                                        <option>Correctivo</option>
                                    </select>
                                    <label for="fecha" class="form-label">Fecha Inicio de Mantenimiento del Equipo</label>
                                    <input type="date" class="form-control mb-3" id="fechainicio_actualizar" name="fechainicio_actualizar" value="<?php echo $fecha_actual; ?>">
                                    <label for="fecha" class="form-label">Fecha Fin de Mantenimiento del Equipo</label>
                                    <input type="date" class="form-control mb-3" id="fechafin_actualizar" name="fechafin_actualizar">
                                    <label for="codigo" class="form-label">Problema del Equipo</label>
                                    <input type="text" class="form-control mb-3" id="problemamonitor_actualizar" name="problemamonitor_actualizar">
                                    <label for="codigo" class="form-label">Descripcion del Problema del Equipo</label>
                                    <textarea class="form-control mb-3" name="descripcion_actualizar" id="descripcion_actualizar" rows="4"></textarea>
                                    <label for="codigo" class="form-label">Nombre de Monitor</label>
                                    <select class="form-control mb-3" id="nombremonitor_actualizar" name="nombremonitor_actualizar">
                                        <?php
                                        include "../conexion/conexion.php";
                                        $sql = $conexion->query("select * from monitores");
                                        while ($datos = $sql->fetch_object()) { ?>
                                            <option><?= $datos->nombremonitor ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <input type="hidden" id="id_actualizar" name="id_actualizar">
                                    <button type="submit" class="btn btn-primary" value="ok" name="btnregistrarmantenimiento">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Equipo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro de que deseas eliminar el equipo "<span id="equipo_a_eliminar"></span>"?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form id="form_eliminar" method="POST" action="../delete/eliminar_equipo.php">
                                    <input type="hidden" id="id_equipo_eliminar" name="idequipo">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var actualizarLinks = document.querySelectorAll('[data-bs-target="#actualizarModal"]');
            actualizarLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    var idmantenimiento = this.getAttribute('data-idmantenimiento');
                    var nombreequipo = this.getAttribute('data-nombreequipo');
                    var fechainicio = this.getAttribute('data-fechainicio');
                    var fechafin = this.getAttribute('data-fechafin');
                    var tipomantenimiento = this.getAttribute('data-tipomantenimiento');
                    var nombremonitor = this.getAttribute('data-monitor');
                    var problema = this.getAttribute('data-problema');
                    var descripcion = this.getAttribute('data-descripcion');
                    var idequipo = this.getAttribute('data-idequipo'); // Agrega esta línea

                    var inputEquipo = document.getElementById('equipo_actualizar');
                    var inputId = document.getElementById('id_actualizar');
                    var inputTipo = document.getElementById('tipomantenimiento_actualizar');
                    var inputFechaInicio = document.getElementById('fechainicio_actualizar');
                    var inputFechaFin = document.getElementById('fechafin_actualizar');
                    var inputMonitor = document.getElementById('nombremonitor_actualizar');
                    var inputProblema = document.getElementById('problemamonitor_actualizar');
                    var inputDescripcion = document.getElementById('descripcion_actualizar');

                    inputEquipo.value = nombreequipo;
                    inputId.value = idmantenimiento; // Cambia 'idequipo' por 'idmantenimiento'
                    inputTipo.value = tipomantenimiento;
                    inputFechaInicio.value = fechainicio;
                    inputFechaFin.value = fechafin;
                    inputMonitor.value = nombremonitor;
                    inputProblema.value = problema;
                    inputDescripcion.value = descripcion;
                });
            });
        });
    </script>
</body>

</html>