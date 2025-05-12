<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro_pacientes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se recibieron los datos del formulario y el ID del paciente
if (isset($_POST['id_paciente']) && is_numeric($_POST['id_paciente'])) {
    $id_paciente = $_POST['id_paciente'];
    $tipo_doc = $_POST['tipo_doc'];
    $documento = $_POST['documento'];
    $fecha = $_POST['fecha'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $sexo = $_POST['sexo'];

    // Preparar la consulta SQL para actualizar los datos
    $sql = "UPDATE pacientes SET tipo_doc=?, documento=?, fecha=?, nombre=?, apellidos=?, sexo=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $tipo_doc, $documento, $fecha, $nombre, $apellidos, $sexo, $id_paciente);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir de vuelta a la lista con un mensaje de éxito
        header("Location: listar_pacientes.php?mensaje=actualizado");
        exit();
    } else {
        // Mostrar un mensaje de error
        echo "Error al actualizar el paciente: " . $stmt->error;
    }

    // Cerrar la sentencia
    $stmt->close();
} else {
    echo "ID de paciente no válido.";
}

// Cerrar la conexión
$conn->close();
?>