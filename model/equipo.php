<?php 
$url_base="http://localhost:80/projects/CRUD/CRUD-Taller-Tecnologico/"; 
$fecha_actual = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <div class="col-12">
                        <h3>Equipos:</h3>
                        <ul>
                            <li>Equipo 1</li>
                            <li>Equipo 2</li>
                        </ul>
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
                                    <form>
                                        <div class="mb-3">
                                            <label for="codigo" class="form-label">Codigo del Equipo</label>
                                            <input type="text" class="form-control" id="codigo" name="codigo">
                                        </div>
                                        <label for="tipo">Tipo:</label>
                                        <select class="form-control" id="tipo" name="tipo">
                                            <option>PC</option>
                                            <option>Portátil</option>
                                        </select>
                                        <select class="form-control" id="tipo" name="tipo">
                                            <option>PC</option>
                                            <option>Portátil</option>
                                        </select>
                                        <select class="form-control" id="tipo" name="tipo">
                                            <option>PC</option>
                                            <option>Portátil</option>
                                        </select>
                                        <label for="fecha" class="form-label">Selecciona una fecha:</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>">
                                        <button type="submit" class="btn btn-primary">Registrar</button>
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
`   
    <script>
        // Función para mostrar el formulario cuando se hace clic en el enlace "Registrar Equipo"
        document.getElementById('showForm').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('equipoForm').style.display = 'block';
        });
    </script>
</body>
</html>