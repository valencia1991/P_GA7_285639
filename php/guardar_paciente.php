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

// Recibir los datos del formulario
$tipo_doc = $_POST['tipo_doc'];
$documento = $_POST['documento'];
$fecha = $_POST['fecha'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$sexo = $_POST['sexo'];

// Preparar la consulta SQL para insertar los datos
$sql = "INSERT INTO pacientes (tipo_doc, documento, fecha, nombre, apellidos, sexo) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $tipo_doc, $documento, $fecha, $nombre, $apellidos, $sexo);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Redirigir a la lista de pacientes con un mensaje de éxito
    header("Location: listar_pacientes.php?mensaje=registrado");
    exit();
} else {
    // Mostrar un mensaje de error
    echo "Error al registrar el paciente: " . $stmt->error;
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();
?>