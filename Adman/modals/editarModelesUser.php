<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Includes/load.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Adman/subPantallas/lista_usuarios.php';

$tableUsuarios = tableUsuarios();



?>



<?php foreach ($tableUsuarios as $tableUsuarios)  { ?>
<div class="modal fade" id="modaleditarUsuarioRol_<?php echo $tableUsuarios['Id_Usuario']; ?>" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title fs-5" id="tituloModalEditarUser">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ModalsEditarUsuario" name="ModalsEditarUsuario" action="/Includes/sqluser.php"
                    method="POST">
                   
                    <input type="hidden" name="UserId" id="UserId"
                        value="<?php  echo $tableUsuarios['Id_Usuario']?>">

                    <div class="form-group">
                        <label for="nuevoDNI">DNI:</label>
                        <input type="number" class="form-control" name="dniUserEditar" id="dniUserEditar"
                            value="<?php  echo $tableUsuarios['fk_DNI']?>">
                    </div>
                    

                    <div class="form-group">
                        <label for="control-label">Clave:</label>
                        <input type="password" class="form-control" name="claveeditaruser" id="claveeditaruser"
                            value="<?php echo $tableUsuarios['Password']; ?>">

                    </div>


                    <div class="form-group">
                        <label for="control-label">Plan:</label>
                        <select class="form-control" name="planUserEditar" id="planUserEditar">
                            <option value="<?php echo $tableUsuarios['fk_Plan']; ?>" selected>
                                <?php echo $tableUsuarios['fk_Plan']; ?></option>
                            <option value="">--Seleccione otro plan--</option>
                            <option value="CURBAR">Barberia</option>
                            <option value="CURCOL">Colorimetría</option>
                            <!-- Agrega más opciones aquí si es necesario -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="control-label">Rol:</label>
                        <select class="form-control" name="rolUserEditar" id="rolUserEditar">
                            <option value="<?php echo $tableUsuarios['fk_Rol']; ?>" selected>
                                <?php echo $tableUsuarios['fk_Rol']; ?></option>
                            <option value="">--Selecione--</option>
                            <option value="3">Administrador</option>
                            <option value="1">Alumno</option>
                            <option value="2">Profesor</option>
                            <!-- Agrega más opciones aquí si es necesario -->
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button id="btnActionEditarUsuarios" class="btn btn-primary btn-open-modal" type="submit"
                            name="btnmodificarUsuario">
                            <span id="btnEditarUser">Guardar</span>
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

function openModalsUserEdi(UserId) {
    document.getElementById('UserId').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.getElementById('btnActionEditarUsuarios').classList.replace("btn-info", "btn-open-modal");
    document.getElementById('btnEditarUser').innerHTML = 'Guardar';
    document.getElementById('tituloModalEditarUser').innerHTML = 'Modificar Usuario';
    document.getElementById('ModalsEditarUsuario').reset();
    var modalId = "#modaleditarUsuarioRol_" + UserId;
    $(modalId).modal('show');

}

$(document).ready(function() {
    var tableusuarios = $('#tableUsuariosRol').DataTable();

    $('.btn-open-modal').on('click', function() {
        openModalsUserEdi();
    });

    var formUsuario = document.getElementById('ModalsEditarUsuario');

    // ... Resto del código ...

    // Evento al enviar el formulario de edición de usuario
    $("#ModalsEditarUsuario").on("submit", function(event) {
        event.preventDefault();

        // Obtener los valores del formulario
        var UserId = $("#UserId").val();
        var dniUserEditar = $("#dniUserEditar").val();
        var Legajoeditar = $("#Legajoeditar").val();
        var claveeditaruser = $("#claveeditaruser").val();
        var libromatrizEditar = $("#libromatrizEditar").val();
        var planUserEditar = $("#planUserEditar").val();
        var rolUserEditar = $("#rolUserEditar").val();
       

        // Realizar la petición AJAX para actualizar el usuario
        $.ajax({
            url: "/Includes/sqluser.php",
            type: "POST",
            data: {
                UserId: UserId,
                dniUserEditar: dniUserEditar,
                Legajoeditar: Legajoeditar,
                claveeditaruser: claveeditaruser,
                libromatrizEditar: libromatrizEditar,
                rolUserEditar: rolUserEditar,
                planUserEditar: planUserEditar,
            
       

                btnmodificarUsuario: 1 // Agrega una marca para indicar que es una solicitud de modificación
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