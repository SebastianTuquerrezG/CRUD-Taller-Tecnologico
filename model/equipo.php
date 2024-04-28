<?php 
$url_base="http://localhost:80/projects/CRUD/CRUD-Taller-Tecnologico/"; 
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
    <title>Equipos</title>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 bg-info text-dark text-center d-flex align-items-center" style="height: 100vh;">
                <div class="sidebar">
                    <h3 class="p-3">Mantenimiento de Equipos</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item bg-warning mx-auto mb-2">
                            <a class="nav-link text-light" href="#" aria-current="page">Equipos</a>
                        </li>
                        <li class="nav-item bg-warning mx-auto mb-2">
                            <a class="nav-link text-dark" href="<?php echo $url_base;?>model/mantenimiento.php">Mantenimientos</a>
                        </li>
                        <hr class="border-bottom">
                        <h5 class="p-3">Informacion</h5>
                        <li class="nav-item bg-warning mx-auto mb-2">
                            <a class="nav-link text-dark" href="<?php echo $url_base;?>model/monitor.php">Monitores</a>
                        </li>
                        <li class="nav-item bg-warning mx-auto mb-2">
                            <a class="nav-link text-dark" href="<?php echo $url_base;?>model/sede.php">Sedes</a>
                        </li>
                        <li class="nav-item bg-warning mx-auto mb-2">
                            <a class="nav-link text-dark" href="<?php echo $url_base;?>model/sala.php">Salas</a>
                        </li>
                        <li class="nav-item bg-warning mx-auto mb-2">
                            <a class="nav-link text-dark" href="<?php echo $url_base;?>model/marca.php">Marcas</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 bg-light d-flex" style="height: 100vh;">
                <div class="body text-center container-fluid row justify-content-center align-items-center">
                    <div class="col-12 p-4 table-container">
                        <table class="table">
                            <thead class="thead-fixed">
                                <tr>
                                    <th class="bg-primary" scope="col">NOMBRE/CODIGO</th>
                                    <th class="bg-primary" scope="col">TIPO</th>
                                    <th class="bg-primary" scope="col">MARCA</th>
                                    <th class="bg-primary" scope="col">SALA</th>
                                    <th class="bg-primary" scope="col">FECHA INGRESO</th>
                                    <th class="bg-primary" scope="col">ULTIMO MANTENIMIENTO</th>
                                    <th class="bg-primary" scope="col">SIGUIENTE MANTENIMIENTO</th>
                                    <th class="bg-primary" scope="col">ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "../conexion/conexion.php";
                                $sql = $conexion->query("SELECT 
                                    equipos.id AS equipo_id, 
                                    equipos.codigo AS codigo_equipo,    
                                    equipos.tipo AS tipo_equipo,
                                    marcas.nombremarca AS marca_equipo,
                                    salas.nombresala AS sala_equipo,
                                    equipos.fechaingreso AS fecha_ingreso_equipo,
                                    MAX(mantenimientos.fechafin) AS fecha_ultimo_mantenimiento,
                                    DATE_ADD(MAX(mantenimientos.fechafin), INTERVAL 6 MONTH) AS fecha_siguiente_mantenimiento,
                                    equipos.estado AS estado_equipo
                                FROM
                                    equipos
                                INNER JOIN
                                    marcas ON equipos.idmarca = marcas.id
                                INNER JOIN
                                    salas ON equipos.idsala = salas.id
                                INNER JOIN
                                    sedes ON salas.idsede = sedes.id
                                LEFT JOIN
                                    mantenimientos ON equipos.id = mantenimientos.idequipo
                                GROUP BY
                                    equipos.id, equipos.codigo, equipos.tipo, marcas.nombremarca, salas.nombresala, equipos.fechaingreso, equipos.estado
                                ORDER BY
                                    equipos.id;
                                ");                                
                                while($datos = $sql->fetch_object()){                                     
                                    if($datos->estado_equipo == 1){
                                        $estado= "En Funcionamiento";
                                    } else {
                                        $estado = "En Mantenimiento";
                                    }
                                    
                                    if ($datos->fecha_ultimo_mantenimiento == null) {
                                        $fecha_siguiente_mantenimiento = date('Y-m-d', strtotime($datos->fecha_ingreso_equipo . ' + 6 months'));
                                    } else {
                                        $fecha_siguiente_mantenimiento = $datos->fecha_siguiente_mantenimiento;
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $datos->codigo_equipo ?></td> 
                                        <td><?= $datos->tipo_equipo ?></td> 
                                        <td><?= $datos->marca_equipo ?></td> 
                                        <td><?= $datos->sala_equipo ?></td> 
                                        <td><?= $datos->fecha_ingreso_equipo ?></td> 
                                        <td><?= $datos->fecha_ultimo_mantenimiento ?></td> 
                                        <td><?= $fecha_siguiente_mantenimiento ?></td> 
                                        <td><?= $estado ?></td>
                                        <td>
                                            <a class="btn btn-small btn-warning" data-bs-toggle="modal" data-idequipo="<?= $datos->equipo_id ?>" data-nombreequipo="<?= $datos->codigo_equipo ?>" data-bs-target="#actualizarModal"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-small btn-danger" data-bs-toggle="modal" data-idequipo="<?= $datos->equipo_id ?>" data-nombreequipo="<?= $datos->codigo_equipo ?>" data-bs-target="#eliminarModal" ><i class="fa-solid fa-trash"></i></a>
                                            <a class="btn btn-small btn-info" data-bs-toggle="modal" data-idequipo="<?= $datos->equipo_id ?>" data-nombreequipo="<?= $datos->codigo_equipo ?>" data-bs-target="#mantenimientosModal"><i class="fa-solid fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>    
                        </table>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroModal">
                            Registrar Equipo
                        </button>
                    </div>
                    <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registrar Equipo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="../controller/registro_equipo.php">
                                        <label for="codigo" class="form-label">Codigo o Nombre del Equipo</label>
                                        <input type="text" class="form-control mb-3" id="codigo" name="codigo">
                                        <label for="tipo">Tipo de Equipo</label>
                                        <select class="form-control mb-3" id="tipo" name="tipo">
                                            <option>PC</option>
                                            <option>Portátil</option>
                                        </select>
                                        <label for="codigo" class="form-label">Marca del Equipo</label>
                                        <select class="form-control mb-3" id="name" name="marca">
                                            <?php
                                            include "../conexion/conexion.php";
                                            $sql = $conexion->query("select * from marcas");
                                            while($datos = $sql->fetch_object()){ ?>
                                                <option><?= $datos->nombremarca ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        <label for="codigo" class="form-label">Sala de Ingreso del Equipo</label>
                                        <select class="form-control mb-3" id="sala" name="sala">
                                            <?php
                                            include "../conexion/conexion.php";
                                            $sql = $conexion->query("select * from salas");
                                            while($datos = $sql->fetch_object()){ ?>
                                                <option><?= $datos->nombresala ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        <label for="fecha" class="form-label">Fecha de Ingreso del Equipo</label>
                                        <input type="date" class="form-control mb-3" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>">
                                        <label for="estado" class="form-label">Estado del Equipo: </label>
                                        <input class="form-check-input" type="checkbox" id="estado" name="estado">
                                        <label class="form-check-label" for="flexSwitchCheckDefault" id="switchLabel">En Mantenimiento</label>
                                        <hr class="border-bottom"></hr>
                                        <button type="submit" class="btn btn-primary" value="ok" name="btnregistrarequipo">Registrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Equipo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="../updates/actualizar_equipo.php">
                                        <label for="codigo" class="form-label">Codigo o Nombre del Equipo</label>
                                        <input type="text" class="form-control mb-3" id="codigo_actualizar" name="codigo">
                                        <label for="tipo">Tipo de Equipo</label>
                                        <select class="form-control mb-3" id="tipo" name="tipo">
                                            <option>PC</option>
                                            <option>Portátil</option>
                                        </select>
                                        <label for="codigo" class="form-label">Marca del Equipo</label>
                                        <select class="form-control mb-3" id="marca" name="marca">
                                            <?php
                                            include "../conexion/conexion.php";
                                            $sql = $conexion->query("select * from marcas");
                                            while($datos = $sql->fetch_object()){ ?>
                                                <option><?= $datos->nombremarca ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        <label for="codigo" class="form-label">Sala de Ingreso del Equipo</label>
                                        <select class="form-control mb-3" id="sala" name="sala">
                                            <?php
                                            include "../conexion/conexion.php";
                                            $sql = $conexion->query("select * from salas");
                                            while($datos = $sql->fetch_object()){ ?>
                                                <option><?= $datos->nombresala ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        <label for="fecha" class="form-label">Fecha de Ingreso del Equipo</label>
                                        <input type="date" class="form-control mb-3" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>">
                                        <label for="estado" class="form-label">Estado del Equipo: </label>
                                        <input class="form-check-input" type="checkbox" id="estado_actualizar" name="estado">
                                        <label class="form-check-label" for="flexSwitchCheckDefault" id="switchLabel_actualizar">En Mantenimiento</label>
                                        <input type="hidden" id="id_actualizar" name="id_equipo">
                                        <hr class="border-bottom"></hr>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
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
                    <div class="modal fade" id="mantenimientosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Mantenimientos del Equipo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de que deseas eliminar el equipo "<span id="aequipo_a_eliminar"></span>"?</p>        
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
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        var switchElement = document.getElementById('estado');
        
        var labelElement = document.getElementById('switchLabel');
        
        switchElement.addEventListener('change', function() {
            if (this.checked) {
                labelElement.textContent = 'En Funcionamiento';
            } else {
                labelElement.textContent = 'En Mantenimiento';
            }
        });
    </script>

    <script>
        var switchElement = document.getElementById('estado_actualizar');
        
        var labelElement = document.getElementById('switchLabel_actualizar');
        
        switchElement.addEventListener('change', function() {
            if (this.checked) {
                labelElement.textContent = 'En Funcionamiento';
            } else {
                labelElement.textContent = 'En Mantenimiento';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var actualizarLinks = document.querySelectorAll('[data-bs-target="#actualizarModal"]');
            actualizarLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    var nombreequipo = this.getAttribute('data-nombreequipo');
                    var idequipo = this.getAttribute('data-idequipo');
                    var inputEquipo = document.getElementById('codigo_actualizar');
                    var inputId = document.getElementById('id_actualizar');
                    inputEquipo.value = nombreequipo;
                    inputId.value = idequipo;
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var eliminarLinks = document.querySelectorAll('[data-bs-target="#eliminarModal"]');
            eliminarLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    var nombreequipo = this.getAttribute('data-nombreequipo');
                    var idequipo = this.getAttribute('data-idequipo');
                    var spanEquipo = document.getElementById('equipo_a_eliminar');
                    var inputId = document.getElementById('id_equipo_eliminar');
                    spanEquipo.textContent = nombreequipo;
                    inputId.value = idequipo;
                });
            });
        });
    </script>
</body>
</html>