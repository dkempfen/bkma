<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Includes/load.php';

?>
<?php

$nueva_foto = cambiarFotoPerfil('cambio_foto_perfil');

?>


<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user" style="margin: -4px;">
        <img class="app-sidebar__user-avatar" src="/Imagenes/profiles/<?php echo $nueva_foto; ?>"
            alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><?= $_SESSION['nombre']?></p>
            <p class="app-sidebar__user-designation"><?= $_SESSION['nombre_rol']?>
            </p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item ignore-submenu" href="/Adman/Pantallas/home.php">
                <i class="app-menu__icon fas fa-home"></i><span class="app-menu__label">Home</span></a></li>
        <li><a class="app-menu__item ignore-submenu" href="/Adman/Pantallas/lista_personas.php">
                <i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">Personas</span></a></li>
        <li><a class="app-menu__item ignore-submenu" href="/Adman/Pantallas/pantalla_Usuario.php">
                <i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">Usuarios</span></a></li>
        <li><a class="app-menu__item ignore-submenu" href="/Adman/Pantallas/carreras.php">
                <i class="app-menu__icon fas fa-graduation-cap"></i><span class="app-menu__label">Cursos</span></a>
        </li>
        <li><a class="app-menu__item ignore-submenu" href="/Adman/Pantallas/alumnos-cuotas.php">
                <i class="app-menu__icon fas fa-dollar-sign "></i><span class="app-menu__label">Cursos-Pago</span></a>
        </li>
        <li><a class="app-menu__item ignore-submenu" href="/Adman/Pantallas/turnos.php">
            <i class="app-menu__icon fas fa-calendar-alt"></i><span class="app-menu__label">Turnos</span></a>
        </li>

        <li>

        <li><a class="app-menu__item ignore-submenu" href="/Adman/Pantallas/finales.php">
                <i class="app-menu__icon fas fa-edit"></i><span class="app-menu__label">Notificaciones</span></a></li>
        <li><a class="app-menu__item ignore-submenu" href="/Adman/Pantallas/documentacion.php">
                <i class="app-menu__icon fas fa-list-alt"></i><span class="app-menu__label">Documentación</span></a>
        </li>
        <li><a class="app-menu__item ignore-submenu" href="/Login/logout.php">
                <i class="app-menu__icon fas fa-sign-out-alt"></i><span class="app-menu__label">Logout</span></a></li>
    </ul>
</aside>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Script para manejar la expansión/cierre de módulos
    $(document).ready(function() {
        // Oculta los submenús de Redes y Analista al principio
        $("#redes-seccion, #analista-seccion").hide();

        // Al hacer clic en el enlace de Curso
        $("#curso-link").click(function(e) {
            e.preventDefault();

            // Muestra u oculta los submenús de Redes y Analista
            $("#redes-seccion, #analista-seccion").toggle();

            // Oculta los submenús de Redes y Analista si están abiertos
            $("#redes-modules, #analista-modules").hide();
        });

        // Al hacer clic en el enlace de Redes
        $("#redes-link").click(function(e) {
            e.preventDefault();

            // Muestra u oculta el módulo de Redes
            $("#redes-modules").toggle();

            // Oculta el módulo de Analista
            $("#analista-modules").hide();
        });

        // Al hacer clic en el enlace de Analista
        $("#analista-link").click(function(e) {
            e.preventDefault();

            // Muestra u oculta el módulo de Analista
            $("#analista-modules").toggle();

            // Oculta el módulo de Redes
            $("#redes-modules").hide();
        });
    });
</script>
