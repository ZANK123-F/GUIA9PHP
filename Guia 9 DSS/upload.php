<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Actualizar información del usuario con PDO</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-offset-2 col-md-8">
                    <h1>Actualizar</h1>
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
        <div class="col-md-offset-2 col-md-8">
            <form action="update.php" method="POST">
                <?php
                $id = null;
                if (!empty($_GET)) {
                    $id = $_GET['id'];
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
                    $cn = Database::connect();
                    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = $cn->prepare("SELECT * FROM usuario where idusuario = ?");
                    $query->execute(array($_GET['id']));
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    echo '<div class="form-group">
                        <label for="idusuario">Idusuario</label>
                        <input type="text" value="' . $data["idusuario"] . '" placeholder="Idusuario" class="form-control" readonly="readonly" name="idusuario" id="idusuario" />
                        </div>
                        <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" value="' . $data["nombre"] . '" placeholder="Nombre" class="form-control" name="nombre" id="nombre" />
                        </div>
                        <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" value="' . $data["apellido"] . '" placeholder="Apellido" class="form-control" name="apellido" id="apellido" />
                        </div>
                        <div class="form-group">
                        <label for="edad">Edad</label>
                        <input type="text" value="' . $data["edad"] . '" placeholder="Edad" class="form-control" name="edad" id="edad" />
                        </div>
                        <div class="form-group">
                        <label for="genero">Género</label>
                        <input type="text" value="' . $data["genero"] . '" placeholder="Género" class="form-control" name="genero" id="genero" />
                        </div>
                        <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" value="' . $data["ciudad"] . '" placeholder="Ciudad" class="form-control" name="ciudad" id="ciudad" />
                        </div>';
                    Database::disconnect();
                }
                ?>
                <div>
                    <input type="submit" class="btn btn-success" value="Actualizar">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
if (!empty($_POST)) {
    include 'connection.php';
    $id = trim($_POST['idusuario']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $edad = trim($_POST['edad']);
    $genero = trim($_POST['genero']);
    $ciudad = trim($_POST['ciudad']);
    $cn = Database::connect();
    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $cn->prepare("UPDATE usuario SET nombre=?, apellido=?, edad=?, genero=?, ciudad=? WHERE idusuario=?");
    $query->execute(array($nombre, $apellido, $edad, $genero, $ciudad, $id));
    Database::disconnect();
    header("Location: index.php");
}
?>