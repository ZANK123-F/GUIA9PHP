<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Ejemplo de uso del patrón Singleton con extensión MySQLi de PHP</title>
<link rel="stylesheet" href="css/basic.css" />
<link rel="stylesheet" href="css/button.css" />
</head>
<body>
<section>
<div id="content">
<?php
//Implementar la autocarga de objetos cuando se intente instanciar
//o crear un objeto de la clase
function _autoload($classname)
{
}
require_once ("class/" . $classname . ".class.php");
// Procesando el envío del formulario a través del método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Procesar los datos del formulario, sólo si fueron
// enviados mediante el método POST
// Validar que los campos contengan un valor y no estén vacíos
$isbn= isset($_POST['isbn']) ? trim($_POST['isbn']): null;
$autor = isset($_POST['author']) ? trim($_POST['author']) : null;
$titulo = isset($_POST['title'])? trim($_POST['title']): null;
$precio = isset($_POST['price']) ? trim($_POST['price']): null;
// Creando el objeto conexión con el patrón Singleton
$db = Database::getInstance();
$mysqli = $db->getConnection();
// Definiendo una matriz para manejar los errores que se
// puedan producir al validar los datos ingresados
$errors = array();
// Escapando caracteres especiales para evitar problemas
// con comillas simples, barras invertidas, etc al insertar
$isbn= $mysqli->real_escape_string($isbn); 
$autor= $mysqli->real_escape_string($autor);
$titulo = $mysqli->real_escape_string($titulo);
$precio = $mysqli->real_escape_string($precio);
// Validación del ISBN con filter_var()
$opciones = array(
"options" => array(
"regexp" => "/^(97[89]){1}\-\d{2}\-\d{3}\-\d{4}\-\d{1}$/"
)
);
if (!filter_var($isbn, FILTER_VALIDATE_REGEXP, $opciones)) {
    $errors[] = "El ISBN no es válido";
}
// Validación del nombre del autor con filter_var()
$opciones = array("options" => array("regexp" => "/^([A-Za-zÑñÁáÉéíóóŰúÜü]+\s?)+([AZa-zÑñÁáÉéÍíóóÚù]+$){1}/"));
if (!filter_var($autor, FILTER_VALIDATE_REGEXP, $opciones)) {
$errors[] = "El nombre del autor no es válido";
}
// Validación del título del libro usando filter_var()
if (!filter_var($titulo, FILTER_SANITIZE_STRING)) {
$errors[] = "El título del libro parece no ser correcto";
}
if (!filter_var($precio, FILTER_VALIDATE_FLOAT)) {
$errors[]= "El precio no es válido";
}
/************** 
// Esta validación
$isbn = $mysqli->filter_var($isbn);
$autor= $mysqli->real_escape_string($autor);
$titulo = $mysqli->real_escape_string($titulo);
$precio = $mysqli->real_escape_string($isbn);
*********/
// Verificando que no hubo errores en el ingreso de datos
if (count($errors) == 0) {
// La consulta SQL de inserción que se desea ejecutar,
// usando marcadores con signo de interrogación para
// los valores que el usuario ingresó en el formulario 
$sql = "INSERT INTO libros (isbn, autor, titulo, precio) VALUES (?, ?, ?, ?)";
// Preparando la consulta con el método prepare()
$stmt = $mysqli->prepare($sql);
// Vinculando los valores de los campos proporcionando
// el tipo de dato de cada uno de ellos
$stmt->bind_param("sssd", $isbn, $autor, $titulo, $precio);
// Ejecutar la consulta con el método execute()
$stmt->execute();
// Mostrando información de las filas afectadas
// después de ejecutar la sentencia INSERT
echo "<p>{$stmt->affected_rows} Fila(s) insertada(s).\n</p>"; 
// Cerrar la sentencias y la conexión a la base de datos
    // antes de salir del script para liberar recursos
    $stmt->close();
    $mysqli->close();
    //header("Location: libros-insert-singleton.php");
    } else {
    $listerrors = "\t\t\t<ul>\n";
    for ($i=0; $i<count($errors); $i++) {
    $listerrors.= "\t\t\t\t<li>" . $errors[$i]."</li>\n";
    }
    $listerrors. "\t\t\t</ul>\n";
    echo $listerrors;
    }
    } else {
    die("<p>Los datos del formulario no se han enviado por el método adecuado.</p>");
    }
    ?>
    </div>
    <div id="button">
    <a href="libros-insert-singleton.php" data-icon="#" class="button orange shield glossy">Regresar</a>
    </div>
    </section>
    </body>
    </html>