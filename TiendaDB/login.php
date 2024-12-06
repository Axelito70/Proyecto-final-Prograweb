<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./public/css/bootstrap.css">
    <link rel="stylesheet" href="./public/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="./public/js/jquery.js"></script>
    <script src="./public/js/popper.js"></script>
    <script src="./public/js/bootstrap.js"></script>

</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col mt-5">
                <div class="row justify-content-center" id="contenido">
                    <div class="card justify-content-center" style="width: 25rem; background-color: rgba(255, 255, 255, 0.5); border: 2px solid red;">
                        <div 
                            class="imagen-circulo mx-auto d-block mb-3" 
                            style="background-image: url('./public/img/img4.jpg'); width: 120px; height: 120px;">
                        </div>
                        <div class="card-body row justify-content-center">

                            <h1 class="fw-bold text-center">Login</h1>
                             <p class="text-center mt-3" style="font-size: 16px;">Taller mecanico</p>

                            <label class="fw-bold" for="usuario">Usuario</label>
                            <input name="usuario" id="usuario" class="form-control mb-3" type="text" placeholder="Usuario">

                            <label class="fw-bold" for="password">Contraseña</label>
                            <input name="password" id="password" class="form-control mb-3" type="password" placeholder="Contraseña">

                            <div class="col justify-content-center text-center">
                                <button id="btn_login" class="btn-rojo mb-2">Iniciar</button>
                                <br>
                                <a href="./registro.php" id="btn_registro" class="btn-link">
                                    <i class="fa-solid fa-chalkboard-user"></i> Registro
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./public/js/login.js"></script>

</body>

</html>
