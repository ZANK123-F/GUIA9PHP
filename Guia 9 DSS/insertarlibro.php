<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Resultados al agregar libro</title>
<link rel="stylesheet" href="css/vertical-nav.css" />
<link rel="stylesheet" href="css/links.css" />
<script src="js/modernizr.custom.lis.js"></script>
</head>
<body>
<header>
<h1 class="3d-text">Resultado al agregar libro a la base de datos</h1>
</header>
<section>
<article>





<?php
//Asignando los datos del formulario
//a variables locales con nombres cortos
$isbn = isset($_POST['isbn'])? addslashes (trim($_POST['isbn'])) : "";
$autor = isset($_POST['autor']) ? addslashes (trim($_POST['autor'])): "";
$titulo = isset($_POST['titulo']) ? addslashes (trim($_POST['titulo'])): "";
$precio = isset($_POST['precio']) ? doubleval (trim($_POST['precio'])) : "";
//Verificando que se hayan ingresado datos
//en todos los controles del formulario
if (empty($isbn) || empty($autor) || empty($titulo) || empty($precio)) {
$msg = "Existen campos en el formulario sin llenar. ";
$msg.= "Regrese al formulario y llene todos los campos. <br />\n";
$msg.= "[<a href=\"nuevolibro.html\">Volver</a>]\n";
echo $msg;
exit(0);
}
//Incluir librería de conexión a la base de datos
include_once ("db-mysqli.php");
//Realizando la consulta para insertar
//el nuevo registro a la base de datos









$planconsulta = "INSERT INTO libros (isbn, autor, titulo, precio) ";
$planconsulta. "VALUES (?, ?, ?, ?)";
$sentencia = $db->prepare($planconsulta);
$sentencia->bind_param("sssd", $isbn, $autor, $titulo, $precio); $sentencia->execute();
echo "<div class=\"query\">\n\t<p>\n\t\t";
echo $planconsulta . "<br />\n";
echo $sentencia->affected_rows . " libro(s) agregado(s) a la base de datos\n";
echo "</p>\n</div>\n";
$sentencia->close();









/* $consulta = "INSERT INTO libros (isbn, autor, titulo, precio) ";
$consulta. "VALUES ("" ")"; $isbn $autor $titulo "", $precio
$resultc $db->query($consulta);
if($resultc){
echo $db->affected_rows. libro agregado a la base de datos.";
} */
//Cerrar la conexión
$db->close();
?>
<br />
<a href="nuevolibro.php" class="a-btn">
<span class="a-btn-symbol">i</span>
<span class="a-btn-text">Agregar</span>
<span class="a-btn-slide-text">otro libro</span>
<span class="a-btn-slide-icon"></span>
</a>





<a href="menuopciones.html" class="a-btn">
<span class="a-btn-symbol">i</span>
<span class="a-btn-text">Regresar</span>
<span class="a-btn-slide-text">al menú</span>
<span class="a-btn-slide-icon"></span>
</a>
</article>
</section>
</body>
</html>








