<?php $url_base="http://localhost:80/projects/CRUD/CRUD-Taller-Tecnologico/"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/875b3ce1f0.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid row">
        <section class="col-md-3 bg-info text-dark text-center d-flex align-items-center" style="height: 100vh;">
            <div class="sidebar">
                <h3 class="p-3">Mantenimiento de Equipos</h3>
                <ul class="nav flex-column">
                    <li class="nav-item bg-warning mx-auto mb-2">
                        <a class="nav-link text-dark" href="<?php echo $url_base;?>model/equipo.php" aria-current="page">Equipos</a>
                    </li>
                    <li class="nav-item bg-warning mx-auto mb-2">
                        <a class="nav-link text-light" href="#">Mantenimientos</a>
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
        </section>
        <section class="col-md-9 bg-light d-flex" style="height: 100vh;">
            <div class="body text-center container-fluid row justify-content-center align-items-center">
                <div class="col-12 p-4">
                        <table class="table">
                            <thead>
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
                                <tr>
                                    <td>532423</td> 
                                    <td>Preventivo</td>
                                    <td>Jaime</td>
                                    <td>Polvo</td>
                                    <td>Ventiladores Sucios</td>
                                    <td>15/01/2022</td>
                                    <td>15/01/2022</td>
                                    <td>
                                        <a class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
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
                                <form>
                                    <label for="tipo">Equipo para Mantenimiento</label>
                                    <select class="form-control mb-3" id="tipo" name="tipo">
                                        <option>PC</option>
                                        <option>Portátil</option>
                                    </select>
                                    <label for="codigo" class="form-label">Tipo de Mantenimiento</label>
                                    <select class="form-control mb-3" id="tipo" name="tipo">
                                        <option>Preventivo</option>
                                        <option>Correctivo</option>
                                    </select>
                                    <label for="fecha" class="form-label">Fecha Inicio de Mantenimiento del Equipo</label>
                                    <input type="date" class="form-control mb-3" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>">
                                    <label for="codigo" class="form-label">Problema del Equipo</label>
                                        <input type="text" class="form-control mb-3" id="codigo" name="codigo">
                                    <label for="exampleTextarea" class="form-label">Descripcion del Problema</label>
                                    <textarea class="form-control mb-3" id="exampleTextarea" rows="3"></textarea>                                    
                                    <label for="codigo" class="form-label">Nombre de Monitor</label>
                                    <select class="form-control mb-3" id="tipo" name="tipo">
                                        <option>PC</option>
                                        <option>Portátil</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>