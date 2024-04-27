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
    <script src="https://kit.fontawesome.com/875b3ce1f0.js" crossorigin="anonymous"></script>
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
                    <div class="col-12 p-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="bg-primary" scope="col">NOMBRE/CODIGO</th>
                                    <th class="bg-primary" scope="col">TIPO</th>
                                    <th class="bg-primary" scope="col">MARCA</th>
                                    <th class="bg-primary" scope="col">SALA</th>
                                    <th class="bg-primary" scope="col">SEDE</th>
                                    <th class="bg-primary" scope="col">FECHA INGRESO</th>
                                    <th class="bg-primary" scope="col">ULTIMO MANTENIMIENTO</th>
                                    <th class="bg-primary" scope="col">SIGUIENTE MANTENIMIENTO</th>
                                    <th class="bg-primary" scope="col">ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>532423</td>
                                    <td>Impresora HP COLOR LASER 6000</td>
                                    <td>HP</td>
                                    <td>Salon A</td>
                                    <td>Campus Sur</td>
                                    <td>27/08/2021</td>
                                    <td>27/12/2021</td>
                                    <td>15/01/2022</td>
                                    <td>Buen estado</td>
                                    <td>
                                        <a class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                                        <a class="btn btn-small btn-info"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
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
                                    <form>
                                        <label for="codigo" class="form-label">Codigo o Nombre del Equipo</label>
                                        <input type="text" class="form-control mb-3" id="codigo" name="codigo">
                                        <label for="tipo">Tipo de Equipo</label>
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
                                        <label for="fecha" class="form-label">Fecha de Ingreso del Equipo</label>
                                        <input type="date" class="form-control mb-3" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>">
                                        <label for="fecha" class="form-label">Estado del Equipo: </label>
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault" id="switchLabel"> En Mantenimiento</label>
                                        <hr class="border-bottom"></hr>
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
    <script>
        var switchElement = document.getElementById('flexSwitchCheckDefault');
        
        var labelElement = document.getElementById('switchLabel');
        
        switchElement.addEventListener('change', function() {
            if (this.checked) {
                labelElement.textContent = 'En Funcionamiento';
            } else {
                labelElement.textContent = 'En Mantenimiento';
            }
        });
    </script>
</body>
</html>