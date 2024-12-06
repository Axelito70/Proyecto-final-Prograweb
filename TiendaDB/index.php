<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:login.php");
    exit();
}

$usuario = $_SESSION['usuario']; 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="./public/css/bootstrap.css">
    <link rel="stylesheet" href="./public/css/index.css"> <!-- Archivo CSS específico para index.php -->
    <script src="./public/js/jquery.js"></script>
    <script src="./public/js/popper.js"></script>
    <script src="./public/js/bootstrap.js"></script>
</head>

<body>
    <!-- Barra superior con datos de usuario -->
    <div class="container mt-3">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6">
                <div class="barra-usuario card p-2">
                    <div class="d-flex align-items-center">
                        <!-- Imagen de perfil (opcional) -->
                        <div class="imagen-circulo" style="background-image: url('./public/img/img4.jpg');"></div>
                        <div class="usuario-info ms-3">
                            <h5 class="mb-0"><?php echo $usuario['nombre']; ?> <?php echo $usuario['apellido']; ?></h5>
                            <small><?php echo $usuario['usuario']; ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-cerrar-sesion" id="btn_cerrar_sesion">Cerrar Sesión</button>
            </div>
        </div>
    </div>

    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col mt-4 text-center">
                <h4 class="fw-bold">Bienvenido al Inventario</h4>
                <div class="row justify-content-center" id="contenido">
                    <div class="card p-3 rounded-3 mb-4">
                        <h1 class="fw-bold">Inventario</h1>
                        <div class="row justify-content-center">
                            <div class="col justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregarModal">
                                    Agregar Producto
                                </button>
                            </div>
                        </div>
                        <table class="table table-hover p-3 rounded-3">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Unidades</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody id="contenido_tabla">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Producto</span>
                            <input id="agre_producto" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Precio</span>
                            <input id="agre_precio" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Unidades</span>
                            <input id="agre_unidades" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">URL Imagen</span>
                            <input id="agre_imagen" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Fecha de Agregado</span>
                            <input id="agre_fecha" type="text" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="agregar" type="button" class="btn btn-primary" onclick="agregar_datos()">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./public/js/main.js"></script>
    <script src="./public/js/cerrar_login.js"></script>

</body>

</html>
