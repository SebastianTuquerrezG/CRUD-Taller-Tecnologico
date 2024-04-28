<?php
$url_base="http://localhost:80/projects/CRUD/CRUD-Taller-Tecnologico/"; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas</title>
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
                            <a class="nav-link text-dark" href="<?php echo $url_base;?>model/equipo.php" aria-current="page">Equipos</a>
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
                            <a class="nav-link text-light" href="#">Marcas</a>
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
                                    <th class="bg-primary" scope="col">NOMBRE MARCA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "../conexion/conexion.php";
                                $sql = $conexion->query("select * from marcas");
                                while($datos = $sql->fetch_object()){ ?>
                                    <tr>
                                        <td><?= $datos->nombremarca ?></td> 
                                        <td>
                                            <a class="btn btn-small btn-warning" data-bs-toggle="modal" data-idmarca="<?= $datos->id ?>" data-nombremarca="<?= $datos->nombremarca ?>" data-bs-target="#actualizarModal"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-small btn-danger" data-bs-toggle="modal" data-idmarca="<?= $datos->id ?>" data-bs-target="#eliminarModal" data-nombremarca="<?= $datos->nombremarca ?>"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>    
                        </table>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroModal">
                            Registrar Marca
                        </button>
                    </div>
                    <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registrar Marca</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="../controller/registro_marca.php"> 
                                        <label for="codigo" class="form-label">Nombre de la Marca</label>
                                        <input type="text" class="form-control mb-3" id="codigo" name="nombremarca">
                                        <button type="submit" class="btn btn-primary" value="ok" name="btnregistrarmarca">Registrar</button>   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Marca</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="../updates/actualizar_marca.php">
                                        <label for="codigo_actualizar" class="form-label">Nombre de la Marca</label>
                                        <input for="id_marca_actualizar" style="display: none;" id="id_actualizar" name="idmarca"></input>
                                        <input type="text" class="form-control mb-3" id="codigo_actualizar" name="nombremarca">
                                        <button type="submit" class="btn btn-primary" value="ok" name="btnregistrarmarca">Actualizar</button>   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Marca</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de que deseas eliminar la marca "<span id="marca_a_eliminar"></span>"?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form id="form_eliminar" method="POST" action="../delete/eliminar_marca.php">
                                        <input type="hidden" id="id_marca_eliminar" name="idmarca">
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
        document.addEventListener('DOMContentLoaded', function () {
            var actualizarLinks = document.querySelectorAll('[data-bs-target="#actualizarModal"]');
            actualizarLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    var nombremarca = this.getAttribute('data-nombremarca');
                    var idmarca = this.getAttribute('data-idmarca');
                    var inputMarca = document.getElementById('codigo_actualizar');
                    var inputId = document.getElementById('id_actualizar');
                    inputMarca.value = nombremarca;
                    inputId.value = idmarca;
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var eliminarLinks = document.querySelectorAll('[data-bs-target="#eliminarModal"]');
            eliminarLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    var nombremarca = this.getAttribute('data-nombremarca');
                    var idmarca = this.getAttribute('data-idmarca');
                    var spanMarca = document.getElementById('marca_a_eliminar');
                    var inputId = document.getElementById('id_marca_eliminar');
                    spanMarca.textContent = nombremarca;
                    inputId.value = idmarca;
                });
            });
        });
    </script>


</body>
</html>