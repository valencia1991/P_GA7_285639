<?php
// Conexión a la base de datos (reemplaza con tus credenciales SI ES NECESARIO,
// pero si usas las mismas que en listar_pacientes.php, no necesitas cambiar)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro_pacientes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se recibió el ID del paciente
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_paciente = $_GET['id'];

    // Consulta SQL para eliminar el registro
    $sql = "DELETE FROM pacientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_paciente);

    if ($stmt->execute()) {
        // Redirigir de vuelta a la lista con un mensaje de éxito
        header("Location: listar_pacientes.php?mensaje=eliminado");
        exit();
    } else {
        // Mostrar un mensaje de error
        header("Location: listar_pacientes.php?mensaje=error:Error al eliminar el paciente");
        exit();
    }

    $stmt->close();
} else {
    // Mostrar un mensaje de error si el ID no es válido
    header("Location: listar_pacientes.php?mensaje=error:ID de paciente no válido");
    exit();
}

$conn->close();
?>