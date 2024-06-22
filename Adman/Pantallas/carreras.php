<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Adman/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Includes/load.php';
?>



<main class="app-content">
    <div class="custom-menu">
        <nav class="custom-nav">
            <div class="menu-group">
                <ul class="custom-menu-list">
                    <!-- Carreras -->
                    <li class="custom-menu-item">
                    <a class="custom-menu-link" href="/Adman/Pantallas/carreras.php">Nuestros Cursos</a>

                    </li>
                </ul>
            </div>

        </nav>
    </div>

    <section id="carrers">
        <div class="container-carrera">
            <div class="row">
                <div class="col-md-6" id="columna1">
                    <a href="<?php echo '/Adman/subPantallas/carrera_analista.php'; ?>"  class="card">
                        <img src="/Imagenes/curso_barberia.jpeg" alt="Analista de Sistemas" />
                        <div class="centrado">
                            <h3>Barberia</h3> <!-- Título centrado -->
                            <span class="button button__secundary">Ver más</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6" id="columna2">
                    <a href="<?php echo '/Adman/subPantallas/carrera_redes.php'; ?>"  class="card">
                        <img src="/Imagenes/curso-colimentria.jpeg" alt="Redes Informáticas" />
                        <div class="centrado">
                            <h3>Colimetria</h3> <!-- Título centrado -->
                            <span class="button button__secundary">Ver más</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require_once '../includes/footer.php';
?>