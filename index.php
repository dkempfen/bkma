<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('Location: /Adman/Pantallas/home.php');
} else if (!empty($_SESSION[''])) {
  
} else if (!empty($_SESSION['activea'])) {
    header('Location:/Alumno/index.php');
}

$pageTitle = "Ingreso al Sistema"; // Define el título de la página
include './Includes/header.php';


?>

    <header class="main-header">
        <div class="main-cont">
            <div class="desc-header">
                <img src="/Imagenes/logoKMA.png" alt="image instituto">
                <p>Barberia y Estilismos</p>
            </div>
        </div>
        <div class="cont-header">
            <h1>Bienvenid@s</h1>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="" method='post' onsubmit="return validar()">
                        <?php

                        /*include "includes/conexion.php";*/
                        include "./Includes/loginAdman.php";
                        ?>
                        <label id="labelUsuario" for="usuario">Usuario</label>
                        <input type="text" class="input" name="usuario" id="usuario" placeholder="Nombre de usuario">
                        <label id="labelPassword" for="password">Contraseña</label>
                        <input type="password" name="pass" id="pass" placeholder="Contraseña">
                        <div id="messageUsuario"></div>
                        <div class="view">
                            <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                        </div>
                        <button class="clave" type="button" onclick="location.href='/Login/RecuperoClave.php'">
                            ¿Olvidaste la clave?</button>
                        <!--<input name="btningresar" id="btningresar" type="submit" class="btn" value="Iniciar Sesión">-->
                        <button id="loginUsuario" type="submit" name="btningresar">Iniciar Sesión</button>
                    </form>
                </div>
                <div class="text-center">
                    <h6>¿Desea inscribirse a un curso?</h6>
                    <a class="buttons button-large button-rounded botonfooter" id=""
                        href="/Login/registro.php">Inscripción</a>
                </div>
            </div>
        </div>
    </header>
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/plugins/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        </script>
</body>

</html>