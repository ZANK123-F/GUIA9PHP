<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Ingresar nuevo usuario con PDO</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-offset-2 col-md-8">
                    <h1>Crear un nuevo usuario</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-offset-2 col-md-8">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <a href="index.php" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form action="create.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" />
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" placeholder="Apellido" name="apellido" id="apellido" />
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" />
                </div>
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="text" class="form-control" placeholder="Edad" name="edad" id="edad" />
                </div>
                <div class="form-group">
                    <label for="genero">Género</label>
                    <select name="genero" id="genero" class="form-control">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" id="ciudad" />
                </div>
                <button type="submit" class="btn btn-success">Enviar</button>
            </form>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Implementación de la clase Autoloader
if (!function_exists('classAutoLoader')) {
    function classAutoLoader($classname)
    {
        $classname = strtolower($classname);
        $classFile = $classname . '.php';
        if (is_file($classFile) && !class_exists($classname))
            include $classFile;
    }
}

// Registrando la clase Autoloader
spl_autoload_register('classAutoLoader');

// Procesamiento del formulario cuando se envía
if (!empty($_POST)) {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST['apellido']);
    $password = md5(trim($_POST['password']));
    $edad = trim($_POST['edad']);
    $genero = trim($_POST['genero']);
    $ciudad = trim($_POST['ciudad']);

    // Conexión a la base de datos
    $cn = Database::connect();
    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Preparar y ejecutar la consulta de inserción
    $query = $cn->prepare("INSERT INTO usuario (nombre, apellido, codigo, edad, genero, ciudad) VALUES (?, ?, ?, ?, ?, ?)");
    $query->execute(array($nombre, $apellido, $password, $edad, $genero, $ciudad));

    // Desconectar de la base de datos
    Database::disconnect();
}
?>