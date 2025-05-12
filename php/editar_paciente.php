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

// Verificar si se recibió el ID del paciente
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_paciente = $_GET['id'];

    // Consulta SQL para obtener los datos del paciente
    $sql = "SELECT id, tipo_doc, documento, fecha, nombre, apellidos, sexo FROM pacientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_paciente);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $row = $resultado->fetch_assoc();
    } else {
        // Si no se encuentra el paciente, puedes mostrar un mensaje de error o redirigir
        echo "Paciente no encontrado.";
        exit();
    }

    $stmt->close();
} else {
    echo "ID de paciente no válido.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card text-center">
            <div class="card-header bg-warning text-white">
                <h5>EDITAR INFORMACIÓN DEL PACIENTE</h5>
            </div>
            <div class="card-body">
                <form action="actualizar_paciente.php" id="form" class="form-horizontal" method="POST">
                    <input type="hidden" name="id_paciente" id="id_paciente" value="<?php echo $row['id'] ?? ''; ?>">

                    <div class="form-group">
                        <label for="tipo_doc">Tipo de Documento</label>
                        <select name="tipo_doc" id="tipo_doc" class="form-control">
                            <option value="">Seleccione el tipo de documento</option>
                            <option value="CC" <?php if (isset($row['tipo_doc']) && $row['tipo_doc'] === 'CC') echo 'selected'; ?>>Cédula de Ciudadanía</option>
                            <option value="TI" <?php if (isset($row['tipo_doc']) && $row['tipo_doc'] === 'TI') echo 'selected'; ?>>Tarjeta de Identidad</option>
                            <option value="CE" <?php if (isset($row['tipo_doc']) && $row['tipo_doc'] === 'CE') echo 'selected'; ?>>Cédula de Extranjería</option>
                            <option value="RC" <?php if (isset($row['tipo_doc']) && $row['tipo_doc'] === 'RC') echo 'selected'; ?>>Registro Civil</option>
                            <option value="NIT" <?php if (isset($row['tipo_doc']) && $row['tipo_doc'] === 'NIT') echo 'selected'; ?>>NIT</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento</label>
                        <input type="text" name="documento" id="documento" class="form-control" placeholder="Ingrese su documento" value="<?php echo $row['documento'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha de Nacimiento</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $row['fecha'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese su nombre" value="<?php echo $row['nombre'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese sus apellidos" value="<?php echo $row['apellidos'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="">Elija su sexo</option>
                            <option value="Masculino" <?php if (isset($row['sexo']) && $row['sexo'] === 'Masculino') echo 'selected'; ?>>Masculino</option>
                            <option value="Femenino" <?php if (isset($row['sexo']) && $row['sexo'] === 'Femenino') echo 'selected'; ?>>Femenino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-block">Guardar Cambios</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="listar_pacientes.php" class="btn btn-light">← Volver a la Lista</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>