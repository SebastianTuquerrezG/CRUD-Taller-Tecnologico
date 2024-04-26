<?php $url_base="http://localhost:80/projects/CRUD/CRUD-Taller-Tecnologico/"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <div class="col-12">
                    <h3>Mantenimiento:</h3>
                    <ul>
                        <li>Equipo 1</li>
                        <li>Equipo 2</li>
                    </ul>
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
                                    <label for="codigo" class="form-label">Codigo del Equipo</label>
                                    <input type="text" class="form-control mb-3" id="codigo" name="codigo">
                                    <label for="tipo">Tipo de Equipo:</label>
                                    <select class="form-control mb-3" id="tipo" name="tipo">
                                        <option>PC</option>
                                        <option>Portátil</option>
                                    </select>
                                    <label for="codigo" class="form-label">Marca del Equipo</label>
                                    <select class="form-control mb-3" id="tipo" name="tipo">
                                        <option>PC</option>
                                        <option>Portátil</option>
                                    </select>
                                    <label for="codigo" class="form-label">Sala de Ingreso del Equipo</label>
                                    <select class="form-control mb-3" id="tipo" name="tipo">
                                        <option>PC</option>
                                        <option>Portátil</option>
                                    </select>
                                    <label for="fecha" class="form-label">Fecha de Ingreso del Equipo:</label>
                                    <input type="date" class="form-control mb-3" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>">
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