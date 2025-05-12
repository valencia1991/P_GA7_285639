<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card text-center">
            <div class="card-header">
                <h5>FORMULARIO PARA EL REGISTRO DE PACIENTES</h5>
            </div>
            <div class="card-body">
                <form action="guardar_paciente.php" id="form" class="form-horizontal" method="POST">                    <input type="hidden" name="tipo_operacion" value="guardar">
                    
                    <!-- Tipo de documento -->
                    <div class="form-group">
                        <label for="tipo_doc">Tipo de Documento</label>
                        <select name="tipo_doc" id="tipo_doc" class="form-control">
                            <option value="">Seleccione el tipo de documento</option>
                            <option value="CC">Cédula de Ciudadanía</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CE">Cédula de Extranjería</option>
                            <option value="RC">Registro Civil</option>
                            <option value="NIT">NIT</option>
                        </select>
                    </div>
                    
                    <!-- Documento -->
                    <div class="form-group">
                        <label for="documento">Número de Documento</label>
                        <input type="text" name="documento" id="documento" class="form-control" placeholder="Ingrese su documento">
                    </div>
                    
                    <!-- Fecha de Nacimiento -->
                    <div class="form-group">
                        <label for="fecha">Fecha de Nacimiento</label>
                        <input type="date" name="fecha" id="fecha" class="form-control">
                    </div>
                    
                    <!-- Nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese su nombre">
                    </div>
                    
                    <!-- Apellidos -->
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese sus apellidos">
                    </div>
                    
                    <!-- Sexo -->
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="">Elija su sexo</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                    
                    <!-- Botón de enviar -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block">Aceptar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a class="nav-link" href="index.php">← Inicio</a>
            </div>
        </div>
    </div>
</body>
</html>
