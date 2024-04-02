<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Ejemplo de uso del patrón Singleton con extensión MySQLi de PHP</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin|Roboto+Condensed" />
<link rel="stylesheet" href="css/boxes.css" />
</head>
<body>
<header>
<h1>Patrón Singleton con MySQLi</h1>
</header>
<?php
//Implementación de la clase classAutoLoader
if (!function_exists('classAutoLoader')) {
function classAutoLoader($classname)
{
$classname = strtolower($classname);
$classFile = "class/" . $classname . '.class.php';
if (is_file($classFile) && !class_exists($classname)) include $classFile;
}
}
//Registrando la clase classAutoLoader
spl_autoload_register('classAutoLoader');
// Probando el objeto conexión con el patrón Singleton
$db = Database::getInstance();
$mysqli = $db->getConnection();
// Creando una consulta para obtener el autor, titulo y precio
// de los libros registrados en la base de datos
$sql = "SELECT autor, titulo, precio FROM libros ORDER BY titulo, autor";
$rs = $mysqli->query($sql);
$list = "";
while ($row = $rs->fetch_object()) {
$list .= "\t\t<div class=\"block\">\n\t\t<ul>\n";
$list .= "\t\t\t\t<li>" . $row->autor. "</li>\n";
$list.= "\t\t\t\t<li>". $row->titulo. "</li>\n";
$list .= "\t\t\t\t<li>" . $row->precio. "</li>\n";
$list. "\t\t\t</ul>\t\t</div>\n";
}
echo $list;
// Obteniendo el número de registros obtenidos después de ejecutar la consulta 
echo "<p>Número de registros devueltos: {$rs->num_rows}</p>";
// Creando otra instancia del objeto
$dbdos = Database::getInstance();
$mysqlidos= $db->getConnection();
// Ahora la consulta obtendrá únicamente los títulos de los libros
// ordenados en orden descendente
$rsdos = $mysqlidos->query("SELECT titulo FROM libros WHERE titulo LIKE '%javascript%' ORDER BY titulo DESC");
$listdos = "";
while
($rowdos = $rsdos->fetch_object()) {
$listdos.= "\t\t<div class=\"block\">\n\t\t\t<ul>\n";
$listdos.= "\t\t\t\t<li>" . $rowdos->titulo. "</li>\n";
$listdos.= "\t\t\t</ul>\n\t\t</div>\n";
}
echo $listdos;
//Obteniendo el número de registros obtenidos después de ejecutar la consulta
echo "<p>Número de registros devuelto: {$rsdos->num_rows}</p>";
?>
</body>
</html>