<?php
// **Importante:** Reemplaza esto con tus credenciales de la base de datos SI SON DIFERENTES
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro_pacientes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener la lista de pacientes
$sql = "SELECT id, nombre, apellidos, tipo_doc, documento, fecha, sexo FROM pacientes";
$resultado = $conn->query($sql);

// Cerrar la conexión al final de la página
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Lista de Pacientes Registrados</h5>
            </div>
            <div class="card-body">
                <?php
                // Verificar si hay un mensaje en la URL y mostrar la alerta
                if (isset($_GET['mensaje'])) {
                    $mensaje = $_GET['mensaje'];
                    $clase_alerta = '';
                    $mensaje_texto = '';

                    if ($mensaje === 'eliminado') {
                        $clase_alerta = 'alert-success';
                        $mensaje_texto = 'Paciente eliminado exitosamente.';
                    } elseif ($mensaje === 'actualizado') {
                        $clase_alerta = 'alert-success';
                        $mensaje_texto = 'Información del paciente actualizada exitosamente.';
                    } elseif ($mensaje === 'registrado') {
                        $clase_alerta = 'alert-success';
                        $mensaje_texto = 'Paciente registrado exitosamente.';
                    } elseif (strpos($mensaje, 'error') === 0) {
                        $clase_alerta = 'alert-danger';
                        $mensaje_texto = str_replace('error:', '', $mensaje);
                    }

                    if (!empty($mensaje_texto)) {
                        echo '<div class="alert ' . $clase_alerta . ' alert-dismissible fade show" role="alert">';
                        echo $mensaje_texto;
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                        echo '</button>';
                        echo '</div>';
                    }
                }
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Tipo Doc.</th>
                            <th>Documento</th>
                            <th>Fecha Nac.</th>
                            <th>Sexo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultado->num_rows > 0) {
                            while ($row = $resultado->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['nombre'] . '</td>';
                                echo '<td>' . $row['apellidos'] . '</td>';
                                echo '<td>' . $row['tipo_doc'] . '</td>';
                                echo '<td>' . $row['documento'] . '</td>';
                                echo '<td>' . $row['fecha'] . '</td>';
                                echo '<td>' . $row['sexo'] . '</td>';
                                echo '<td>';
                                echo '<a href="editar_paciente.php?id=' . $row['id'] . '" class="btn btn-sm btn-warning">Editar</a> ';
                                echo '<a href="eliminar_paciente.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger">Eliminar</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7">No se encontraron pacientes registrados.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <a href="formulario.php" class="btn btn-secondary">Registrar Nuevo Paciente</a>
                <a href="index.php" class="btn btn-light mt-3">← Volver al Inicio</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>