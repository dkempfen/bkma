<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
</head>

<?php

require_once('load.php');

function showConfirmationMessages($message) {
    echo "<script>
        Swal.fire({
            icon: '" . $message['type'] . "',
            title: '" . $message['text'] . "',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {                                  
            window.location.href = '/Adman/Pantallas/lista_personas.php';
        });
    </script>";
}     

function showConfirmationMessageAltaUser($messageAltaUser) {
    echo "<script>
        Swal.fire({
            icon: '" . $messageAltaUser['type'] . "',
            title: '" . $messageAltaUser['text'] . "',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {                                  
            window.location.href = '/Adman/Pantallas/lista_personas.php';
        });
    </script>";
} 

function showConfirmationMessagesMateria($message) {
    echo "<script>
        Swal.fire({
            icon: '" . $message['type'] . "',
            title: '" . $message['text'] . "',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {                                  
            window.location.href = '/Adman/subPantallas/lista_materia.php';
        });
    </script>";
}  

function showConfirmationMessagesFechaFinal($messageFecha) {
    echo "<script>
        Swal.fire({
            icon: '" . $messageFecha['type'] . "',
            title: '" . $messageFecha['text'] . "',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {                                  
            window.location.href = '/Adman/Pantallas/finales.php';
        });
    </script>";
}  






    function actualizarUser($dni, $nombre, $apellido,$generoEditar,$fechanacimiento, $telefono, $email, $domicilio, $inscripto) {
        session_start();
        global $pdo;
        

        $sql = "UPDATE Persona SET Nombre = ?, Apellido = ?,sexo=?, Fechanacimiento = ?, Telefono = ?, Email = ?, Domicilio = ?, Inscripto=? 
        WHERE DNI = ?";
        $stmt = $pdo->prepare($sql);

        // Verifica si los valores son nulos antes de ejecutar la consulta
        $stmt->execute([$nombre, $apellido,$generoEditar, $fechanacimiento, $telefono, $email, $domicilio,$inscripto,$dni]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Datos de persona actualizados exitosamente'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Ha ocurrido un error al actualizar los datos de persona.'
            ];
        }

        header("Location: /Adman/Pantallas/lista_personas.php");
        exit();
    }

    // Verificar si se ha enviado una solicitud de edición (update)
    if (isset($_POST['btnmodificar'])) {
        $dni = $_POST['nuevoDNI'];
        $nombre = $_POST['nombreeditar'];
        $apellido = $_POST['apellidoeditar'];
        $generoEditar = $_POST['generoEditar'];
        $fechanacimiento = $_POST['fechanacimientoeditar'];
        $telefono = $_POST['telefonoeditar'];
        $email = $_POST['emailoeditar'];
        $domicilio = $_POST['domicilioeditar'];
        $inscripto= $_POST['inscriptoeditar'];


        // Llamar a la función EditarPersona solo si los campos requeridos no están vacíos
        actualizarUser($dni, $nombre, $apellido,$generoEditar, $fechanacimiento, $telefono, $email, $domicilio,$inscripto);

        header("Location: /Adman/Pantallas/lista_personas.php");
        exit();
    }


function AltaPersona($dni, $nombre, $apellido, $generoAlta, $fechanacimiento, $telefono, $mail, $domicilio, $inscripto) {
    global $pdo;

    try {
        // Verificar si el DNI ya existe en la base de datos
        $sqlCheckDNI = "SELECT COUNT(*) FROM Persona WHERE DNI = ?";
        $stmtCheckDNI = $pdo->prepare($sqlCheckDNI);
        $stmtCheckDNI->execute([$dni]);
        $dniExists = $stmtCheckDNI->fetchColumn();

        if ($dniExists > 0) {
            // El DNI ya existe, mostrar un mensaje de error
            $_SESSION['messageAltaUser'] = [
                'type' => 'error',
                'text' => 'El DNI ya está registrado en la base de datos.'
            ];
        } else {
            $sql = "INSERT INTO persona (DNI, Nombre, Apellido, sexo, Fechanacimiento, Telefono, Email, Domicilio, Inscripto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$dni, $nombre, $apellido, $generoAlta, $fechanacimiento, $telefono, $mail, $domicilio, $inscripto]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['messageAltaUser'] = [
                    'type' => 'success',
                    'text' => 'Datos de persona insertados exitosamente'
                ];
            } else {
                $_SESSION['messageAltaUser'] = [
                    'type' => 'error',
                    'text' => 'Ha ocurrido un error al insertar los datos de persona.'
                ];
            }
        }
    } catch (PDOException $e) {
        error_log('Error en la inserción de persona: ' . $e->getMessage());
        $_SESSION['messageAltaUser'] = [
            'type' => 'error',
            'text' => 'Ha ocurrido un error al insertar los datos de persona.'
        ];
    }

    header("Location: /Adman/Pantallas/lista_personas.php");
    exit();
}

// Verificar si se ha enviado una solicitud de inserción
if (isset($_POST['btnaltaPersona'])) {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $generoAlta = $_POST['generoAlta'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $telefono = $_POST['telefono'];
    $mail = $_POST['mail'];
    $domicilio = $_POST['domicilio'];
    $inscripto = ($_POST['inscripto']); // Valor por defecto 0 si no está marcado

    AltaPersona($dni, $nombre, $apellido,$generoAlta, $fechanacimiento, $telefono, $mail, $domicilio, $inscripto);

    header("Location: /Adman/Pantallas/lista_personas.php");
    exit();
}


///////////////Actualizar Datos Materia///////////////////////

function actualizarMateria($nombreMateriaeditar, $promocionaleditar, $nivelCarrera, $materiaeditar) {
    session_start();
    global $pdo;



    $sql = "UPDATE Materia SET Descripcion = ?, Promocional = ?, Anio_Carrera = ? WHERE id_Materia = ?";
    $stmt = $pdo->prepare($sql);

    try {
        // Verifica si los valores son nulos antes de ejecutar la consulta
        $stmt->execute([$nombreMateriaeditar, $promocionaleditar, $nivelCarrera, $materiaeditar]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Datos de materia actualizados exitosamente'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'No se encontraron registros actualizados en la base de datos.'
            ];
        }
    } catch (PDOException $e) {
        // Registra el mensaje de error en un archivo de registro
        $error_message = 'Error en la base de datos: ' . $e->getMessage();
        error_log($error_message, 3, '/archivo_de_registro.log'); // Reemplaza '/ruta/al/archivo_de_registro.log' con la ruta correcta
        
        // Configura un mensaje de error genérico para mostrar al usuario
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'Ha ocurrido un error al actualizar los datos de la materia. Por favor, inténtelo nuevamente más tarde.'
        ];
    }

    
}

if (isset($_POST['btnmodificarMateria'])) {
    $nombreMateriaeditar = $_POST['nombreMateriaeditar'];
    $promocionaleditar = $_POST['promocionaleditar'];
    $nivelCarrera = $_POST['nivelCarrera'];
    $materiaeditar = $_POST['materiaeditar'];

       // Agregar var_dump para depuración
       var_dump($nombreMateriaeditar);
       var_dump($promocionaleditar);
       var_dump($nivelCarrera);
       var_dump($materiaeditar);
   

    // Llamar a la función de actualización
    actualizarMateria($nombreMateriaeditar, $promocionaleditar, $nivelCarrera, $materiaeditar);

    // Redirige a la página de éxito o error según la sesión 'message'
    if ($_SESSION['message']['type'] === 'success') {
        header("Location: /Adman/subPantallas/lista_materia.php");
    } else {
        header("Location: /Adman/subPantallas/lista_materia.php");
    }
    exit();
}

/////////////////////Insery Modificar insertarNuevoProfesor/////////////////

function insertarOActualizarProfesor($materiaId, $profesorId) {
    global $pdo;
    session_start();

    // Consulta SQL para verificar si ya existe un registro para la materia
    $sqlVerificar = "SELECT COUNT(*) FROM Materia_Profesor WHERE id_Materia = ?";
    $stmtVerificar = $pdo->prepare($sqlVerificar);
    $stmtVerificar->execute([$materiaId]);
    $existeRegistro = $stmtVerificar->fetchColumn();

    if ($existeRegistro) {
        // Si ya existe un registro, actualiza el profesor
        $sqlActualizar = "UPDATE Materia_Profesor SET id_Profesor = ? WHERE id_Materia = ?";
        $stmtActualizar = $pdo->prepare($sqlActualizar);

        if ($stmtActualizar->execute([$profesorId, $materiaId])) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Profesor actualizado exitosamente en la materia.'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Ha ocurrido un error al actualizar al profesor en la materia.'
            ];
        }
    } else {
        // Si no existe un registro, inserta el profesor
        $sqlInsertar = "INSERT INTO Materia_Profesor (id_Materia, id_Profesor) VALUES (?, ?)";
        $stmtInsertar = $pdo->prepare($sqlInsertar);

        if ($stmtInsertar->execute([$materiaId, $profesorId])) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Profesor insertado exitosamente en la materia.'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Ha ocurrido un error al insertar al profesor en la materia.'
            ];
        }
    }
}

if (isset($_POST['btnProfesorMateria'])) {
    // Recuperar el ID del profesor seleccionado y el ID de la materia
    $materiaId = $_POST['materiaId'];
    $profesorId = $_POST['profesorId'];

    // Llama a la función para insertar o actualizar al profesor en la materia
    insertarOActualizarProfesor($materiaId, $profesorId);

    header("Location: /Adman/subPantallas/lista_materia.php");
    exit();
}



////Insertar nota



// Devolver la respuesta como JSON


//////////////////////////////////Insertar Materia//////////////////////

function InsertarMateria($nombreMateria, $listEstado, $nivelCarrera, $promocional) {
    session_start();
    global $pdo;
    

    $sql = "INSERT INTO Materia (Descripcion, fk_Estado,Anio_Carrera, Promocional) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Verifica si los valores son nulos antes de ejecutar la consulta
    $stmt->execute([$nombreMateria, $listEstado, $nivelCarrera, $promocional]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['messageMateria'] = [
            'type' => 'success',
            'text' => 'Datos de la materia crear exitosamente'
        ];
    } else {
        $_SESSION['messageMateria'] = [
            'type' => 'error',
            'text' => 'Ha ocurrido un error al crear los datos de la materia.'
        ];
    }

    header("Location: /Adman/subPantallas/lista_materia.php");
    exit();
}

// Verificar si se ha enviado una solicitud de edición (update)
if (isset($_POST['btnCrearMateria'])) {
    $nombreMateria = $_POST['nombreMateria']; // Asegúrate de obtener el código de plan desde el formulario
    $listEstado = $_POST['listEstado'];
    $nivelCarrera = $_POST['nivelCarrera'];
    $promocional = $_POST['promocional'];
  

   

    // Llamar a la función EditarPersona solo si los campos requeridos no están vacíos
    InsertarMateria($nombreMateria, $listEstado, $nivelCarrera, $promocional);

    header("Location: /Adman/subPantallas/lista_materia.php");
    exit();
}



//////////////////////////////////Insertar Fecha//////////////////////
function InsertarFecha($materiaFinal, $fechaFinal) {
    session_start();
    global $pdo;

    // Verificar si la materia está asociada a una carrera en la tabla Detalle_Plan
    $sqlVerificarMateria = "SELECT COUNT(*) AS count FROM Detalle_Plan WHERE fk_Materia = ?";
    $stmtVerificarMateria = $pdo->prepare($sqlVerificarMateria);
    $stmtVerificarMateria->execute([$materiaFinal]);
    $resultVerificarMateria = $stmtVerificarMateria->fetch(PDO::FETCH_ASSOC);

    if ($resultVerificarMateria['count'] > 0) {
        // La materia está asociada a una carrera, verificar si ya existe la fecha en FechasFinales
        $sqlVerificarFecha = "SELECT COUNT(*) AS count, MAX(Fecha) AS maxFecha FROM FechasFinales WHERE fk_Materia = ?";
        $stmtVerificarFecha = $pdo->prepare($sqlVerificarFecha);
        $stmtVerificarFecha->execute([$materiaFinal]);
        $resultVerificarFecha = $stmtVerificarFecha->fetch(PDO::FETCH_ASSOC);

        if ($resultVerificarFecha['count'] > 0) {
            // Ya existe una fecha con la misma materia
            $fechaExistente = new DateTime($resultVerificarFecha['maxFecha']);
            $fechaNueva = new DateTime($fechaFinal);

            // Verificar si ha pasado al menos tres meses desde la fecha existente
            $diferenciaMeses = $fechaExistente->diff($fechaNueva)->m;

            if ($diferenciaMeses >= 3) {
                // Proceder con la inserción
                $sql = "INSERT INTO FechasFinales (fk_Materia, Fecha, fk_Estado_Final) VALUES (?, ?, 1)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$materiaFinal, $fechaFinal]);

                if ($stmt->rowCount() > 0) {
                    $_SESSION['messageFecha'] = [
                        'type' => 'success',
                        'text' => 'Datos de la fecha fueron creados exitosamente'
                    ];
                } else {
                    $_SESSION['messageFecha'] = [
                        'type' => 'error',
                        'text' => 'Ha ocurrido un error al crear los datos de la fecha.'
                    ];
                }
            } else {
                // No han pasado tres meses, mostrar mensaje de error
                $_SESSION['messageFecha'] = [
                    'type' => 'error',
                    'text' => 'No puedes agregar una fecha para la misma materia antes de tres meses.'
                ];
            }
        } else {
            // No existe una fecha con la misma materia, proceder con la inserción
            $sql = "INSERT INTO FechasFinales (fk_Materia, Fecha, fk_Estado_Final) VALUES (?, ?, 1)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$materiaFinal, $fechaFinal]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['messageFecha'] = [
                    'type' => 'success',
                    'text' => 'Datos de la fecha fueron creados exitosamente'
                ];
            } else {
                $_SESSION['messageFecha'] = [
                    'type' => 'error',
                    'text' => 'Ha ocurrido un error al crear los datos de la fecha.'
                ];
            }
        }
    } else {
        // La materia no está asociada a una carrera, mostrar mensaje de error
        $_SESSION['messageFecha'] = [
            'type' => 'error',
            'text' => 'La materia no está asociada a una carrera. No se puede insertar la fecha.'
        ];
    }
}


// Verificar si se ha enviado una solicitud de inserción (insert)
if (isset($_POST['btnaltaFechaFinal'])) {
    $materiaFinal = $_POST['materiaFinal']; // Asegúrate de obtener el código de plan desde el formulario
    $fechaFinal = $_POST['fechaFinal'];

    // Llamar a la función InsertarFecha solo si los campos requeridos no están vacíos
    InsertarFecha($materiaFinal, $fechaFinal);

    // Redirigir después de llamar a la función
    header("Location: /Adman/Pantallas/finales.php");
    exit();
}


//////////////////////////////////Actualizar Final Fecha//////////////////////
function ActualizarFechaFInal($idMateriaActualFecha, $FechaFinalEditar) {
    session_start();
    global $pdo;

    // Formatear la fecha al formato "AAAA-MM-DD"
    $fechaFormateada = date("Y-m-d", strtotime($FechaFinalEditar));

    $sql = "UPDATE FechasFinales SET Fecha = ? WHERE Id_Fecha_Final = ?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$fechaFormateada, $idMateriaActualFecha]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['messageFecha'] = [
            'type' => 'success',
            'text' => 'Los datos fueron actualizados exitosamente.'
        ];
        // Agrega un mensaje al array de resultados para mostrar en la consola
        $result['consoleLog'] = 'Los datos fueron actualizados exitosamente.';
    } else {
        $_SESSION['messageFecha'] = [
            'type' => 'error',
            'text' => 'Ha ocurrido un error al actualizar los datos.'
        ];
        // Agrega un mensaje al array de resultados para mostrar en la consola
        $result['consoleLog'] = 'Error al actualizar los datos.';
    }

    header("Location: /Adman/Pantallas/finales.php");
    exit();
}


// Verificar si se ha enviado una solicitud de inserción (insert)
if (isset($_POST['btnmodificarFechaFInal'])) {
    $idMateriaActualFecha = $_POST['idMateriaActualFecha'];
    $FechaFinalEditar = $_POST['FechaFinalEditar'];

    // Llamar a la función InsertarFecha solo si los campos requeridos no están vacíos
    ActualizarFechaFInal($idMateriaActualFecha, $FechaFinalEditar);

    // Redirigir después de llamar a la función
    header("Location: /Adman/Pantallas/finales.php");
    exit();
}
?>