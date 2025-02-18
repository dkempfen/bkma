<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Adman/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Includes/load.php';
$datos_json = obtenerDatosParaGrafico(); // Reemplaza con tu propia lógica
$datos_json_edades = obtenerDatosParaGraficoEdades();

?>


<main class="app-content">
    <div class="container">
        <!-- Agregamos un contenedor Bootstrap -->
        <div class="row justify-content-center align-items-center mt-4">
            <!-- Agregamos mt-4 para margen superior -->
            <!-- Centramos la fila horizontalmente y verticalmente -->
            <div class="col-md-12">
                <div src="" alt="imagen terciario"></div>
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <!-- Centramos la fila horizontalmente -->
            <div class="col-xl-4 col-md-6 mb-4">
                <!-- Aumentamos el ancho de las tarjetas y dejamos 'mb-4' -->
                <div class="card bg-primary text-white">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-tie fa-3x"></i>
                        <div class="ml-4">
                            <h5 class="card-title">Administrativos</h5>
                            <a href="<?php echo '/Adman/subPantallas/lista_usuarios.php?rol=3';?>"
                                class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?php echo '/Adman/subPantallas/lista_usuarios.php?rol=3';?>" class="text-white">Ver
                            detalle</a>
                        <span><?php echo $totalAdmins ?></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <!-- Aumentamos el ancho de las tarjetas y dejamos 'mb-4' -->
                <div class="card bg-success text-white">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-graduate fa-3x"></i>
                        <div class="ml-4">
                            <h5 class="card-title">Alumnos</h5>
                            <a href="<?php echo '/Adman/subPantallas/lista_usuarios.php?rol=1';?>"
                                class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?php echo '/Adman/subPantallas/lista_usuarios.php?rol=1';?>" class="text-white">Ver
                            detalle</a>
                        <span><?php echo $totalAlumnos?></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <!-- Aumentamos el ancho de las tarjetas y dejamos 'mb-4' -->
                <div class="card bg-danger text-white">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-chalkboard-teacher fa-3x"></i>
                        <div class="ml-4">
                            <h5 class="card-title">Profesores</h5>
                            <a href="<?php echo '/Adman/subPantallas/lista_usuarios.php?rol=2';?>"
                                class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?php echo '/Adman/subPantallas/lista_usuarios.php?rol=2';?>" class="text-white">Ver
                            detalle</a>
                        <span><?php echo $totalProfesores ?></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body d-flex align-items-center">
                        <span style="position: relative; font-size: 24px;">
                            <i class="fas fa-male" style="position: absolute; top: 0; left: 0;"></i>
                            <i class="fas fa-female" style="position: absolute; top: 0; left: 0;"></i>
                        </span>
                        <div class="ml-4">
                            <h5 class="card-title">Todos los Usuarios</h5>
                            <a href="<?php echo '/Adman/subPantallas/lista_usuarios.php';?>" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?php echo '/Adman/subPantallas/lista_usuarios.php';?>" class="text-white">Ver detalle</a>
                        <span><?php echo $totalUsuarios ?></span>
                    </div>
                </div>
            </div>




        </div>

        <div class="row justify-content-center">

            <div class="col-md-6 mb-4">
            <button class="export-button" onclick="exportarExcel('miGraficoPastel', 'GraficoPastel')">Exportar Pastel a Excel</button>

                <div class="col-md-12">
                    <canvas id="miGraficoPastel" width="600" height="600"></canvas>
                </div>
            </div>
            <!-- Agrega la clase 'mb-4' para agregar margen inferior -->
            <div class="col-md-6 mb-4">
                <button class="export-button" onclick="exportarExcel('miGraficoBarras', 'GraficoBarras')">Exportar Barras a Excel</button>

                <div class="col-md-12">
                    <canvas id="miGraficoBarras" width="600" height="600"></canvas>
                </div>
            </div>
        </div>
    </div>

</main>

<?php
require_once '../includes/footer.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Recupera los datos JSON generados por PHP
var datos = <?php echo $datos_json; ?>;

// Obtén el contexto del lienzo
var contextoPastel = document.getElementById('miGraficoPastel').getContext('2d');

// Crea el gráfico de pastel
var miGraficoPastel = new Chart(contextoPastel, {
    type: 'pie',
    data: {
        labels: datos.sexos,
        datasets: [{
            data: datos.cantidades,
            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"]
        }]
    }
});

// Recupera los datos JSON generados por PHP
var datosEdades = <?php echo $datos_json_edades; ?>;

// Obtén el contexto del lienzo
var contextoBarras = document.getElementById('miGraficoBarras').getContext('2d');

// Crea el gráfico de barras
var miGraficoBarras = new Chart(contextoBarras, {
    type: 'bar',
    data: {
        labels: datosEdades.etiquetas,
        datasets: [{
            label: 'Cantidad de Usuarios por Edad',
            data: datosEdades.datos,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Cantidad de Usuarios'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Edad'
                }
            }
        }
    }
});

function exportarExcel(canvasId, sheetName) {
    var canvas = document.getElementById(canvasId);
    var dataURL = canvas.toDataURL('image/png');

    // Guardar la imagen en el servidor y obtener la ruta
    // Necesitas ajustar esta lógica según tu entorno y cómo manejas las imágenes
    var rutaImagen = '/path/to/your/image.png';

    // Crear un objeto de trabajo de libro de Excel
    var workbook = XLSX.utils.book_new();

    // Crear una hoja de trabajo para los datos del gráfico
    var worksheetData = XLSX.utils.aoa_to_sheet([
        ['Sexo', 'Cantidad'],
        ['Hombre', 10],
        ['Mujer', 15],
        // ... Agrega más filas según tus datos
    ]);

    // Agregar la imagen a la hoja de trabajo
    var img = new Image();
    img.src = dataURL;
    var ctx = document.createElement('canvas').getContext('2d');
    ctx.canvas.width = img.width;
    ctx.canvas.height = img.height;
    ctx.drawImage(img, 0, 0);
    var imageData = ctx.getImageData(0, 0, img.width, img.height);

    // Agregar las hojas de trabajo al libro de Excel
    XLSX.utils.book_append_sheet(workbook, worksheetData, 'Datos del Gráfico');
    XLSX.utils.book_append_sheet(workbook, {
        "!type": "png",
        "!data": imageData
    }, 'Imagen del Gráfico');

    // Guardar el libro de Excel
    try {
        XLSX.writeFile(workbook, 'reporte_grafico_' + sheetName + '.xlsx');
    } catch (error) {
        console.error('Error al exportar a Excel:', error);
    }
}
</script>