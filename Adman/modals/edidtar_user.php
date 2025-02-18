<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Includes/load.php';
require_once '../Pantallas/lista_personas.php';

$DatosUsuarios = DatosUsuarios();
$DatosPersonas = DatosPersonas();



?>



<?php foreach ($DatosUsuarios as $usuario) ;foreach ($DatosPersonas as $persona) { ?>
<div class="modal fade" id="modaleditarUsuario_<?php echo $persona['DNI']; ?>" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title fs-5" id="tituloModalEditar">Editar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarUsuario" name="formEditarUsuario" action="/Includes/slqeditar.php"
                    method="POST">
                    <input type="hidden" name="idusuarioeditar" id="idusuarioeditar"
                        value="<?php  echo $usuario['Id_Usuario']?>" required>
                    <input type="hidden" name="dni_a_editar" id="dni_a_editar" value="<?php  echo $persona['DNI']?>"
                        required>

                    <div class="form-group">
                        <label for="nuevoDNI">DNI:</label>
                        <input type="number" class="form-control" name="nuevoDNI" id="nuevoDNI"
                            value="<?php  echo $persona['DNI']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreeditar">Nombre:</label>
                        <input type="text" class="form-control" name="nombreeditar" id="nombreeditar"
                            value="<?php echo $persona['Nombre']; ?>" required>

                    </div>

                    <div class="form-group">
                        <label for="control-label">Apellido:</label>
                        <input type="text" class="form-control" name="apellidoeditar" id="apellidoeditar"
                            value="<?php echo $persona['Apellido']; ?>" required>

                    </div>

                    <div class="form-group">
                        <label for="listRol">Fecha Nacimiento</label>
                        <input type="date" class="form-control" name="fechanacimientoeditar" id="fechanacimientoeditar"
                            value="<?php echo $persona['Fechanacimiento']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="generoEditar">Género:</label>
                        <select class="form-control" name="generoEditar" id="generoEditar">
                            <option value="">--Seleccione--</option>
                            <option value="M" <?php echo ($persona['sexo'] == 'M') ? 'selected' : ''; ?>>Mujer</option>
                            <option value="H" <?php echo ($persona['sexo'] == 'H') ? 'selected' : ''; ?>>Hombre</option>
                            <option value="ND" <?php echo ($persona['sexo'] == 'ND') ? 'selected' : ''; ?>>No definido
                            </option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="control-label">Telefono:</label>
                        <input type="number" class="form-control" name="telefonoeditar" id="telefonoeditar"
                            value="<?php echo $persona['Telefono']; ?>" required>

                    </div>
                    <div class="form-group">
                        <label for="control-label">Email:</label>
                        <input type="email" class="form-control" name="emailoeditar" id="emailoeditar"
                            value="<?php echo $persona['Email']; ?>" required>

                    </div>
                    <div class="form-group">
                        <label for="control-label">Domicilio:</label>
                        <input type="text" class="form-control" name="domicilioeditar" id="domicilioeditar"
                            value="<?php echo $persona['Domicilio']; ?>" required>

                    </div>

                    <label for="inscriptoeditar">Promocional:</label>
                    <select class="form-control" name="inscriptoeditar" id="inscriptoeditar">
                        <option value="">--Seleccione--</option>
                        <option value="0" <?php echo ($persona['Inscripto'] == 0) ? 'selected' : ''; ?>>NO
                        </option>
                        <option value="1" <?php echo ($persona['Inscripto'] == 1) ? 'selected' : ''; ?>>SI
                        </option>
                    </select>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="btnActionEditarForm" class="btn btn-primary btn-open-modal" type="submit"
                    name="btnmodificar">
                    <span id="btnEditartext">Guardar</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php } ?>

<!-- Agrega SweetAlert2 y jQuery a tu página -->

<script>
function isValidInput(value) {
    return value.trim() !== '';
}

function openModals(dni) {
    document.getElementById('idusuarioeditar').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById('btnActionEditarForm').classList.replace("btn-info", "btn-open-modal");
    document.getElementById('btnEditartext').innerHTML = 'Guardar';
    document.getElementById('tituloModalEditar').innerHTML = 'Modificar Usuario';
    document.getElementById('formEditarUsuario').reset();
    var modalId = "#modaleditarUsuario_" + dni;
    $(modalId).modal('show');

}

$(document).ready(function() {
    var tableusuarios = $('#tableUsuarios').DataTable();

    $('.btn-open-modal').on('click', function() {
        openModals();
    });

    var formUsuario = document.getElementById('formEditarUsuario');

    // ... Resto del código ...

    // Evento al enviar el formulario de edición de usuario
    $("#formEditarUsuario").on("submit", function(event) {
        event.preventDefault();

        // Obtener los valores del formulario
        var dni = $("#dnioeditar").val();
        var nombre = $("#nombreeditar").val();
        var apellido = $("#apellidoeditar").val();
        var fechanacimiento = $("#fechanacimientoeditar").val();
        var telefono = $("#telefonoeditar").val();
        var email = $("#emailoeditar").val();
        var domicilio = $("#domicilioeditar").val();
        var roleditar = $("#roleditar").val();
        var idusuarioeditar = $("#idusuarioeditar").val();
        var inscripto = $("#inscriptoeditar").val();
        var generoEditar = $("#generoEditar").val();


        // Realizar la petición AJAX para actualizar el usuario
        $.ajax({
            url: "/Includes/slqeditar.php",
            type: "POST",
            data: {
                idusuarioeditar: idusuarioeditar,
                dnioeditar: dni,
                nombreeditar: nombre,
                apellidoeditar: apellido,
                fechanacimientoeditar: fechanacimiento,
                telefonoeditar: telefono,
                emailoeditar: email,
                domicilioeditar: domicilio,
                roleditar: roleditar,
                inscriptoeditar: inscripto,
                generoEditar: generoEditar,

                btnmodificar: 1 // Agrega una marca para indicar que es una solicitud de modificación
            },
            success: function(response) {
                // Verificar la respuesta del servidor
                if (response.success) {
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Datos actualizados exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    // Mostrar mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al actualizar los datos',
                        text: response.message
                    });
                }
            },
            error: function(error) {
                console.log("Error en la solicitud AJAX:", error);
            }
        });
    });
});
</script>