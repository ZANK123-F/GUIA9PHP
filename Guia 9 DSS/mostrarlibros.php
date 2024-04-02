<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Libros de la base de datos</title>
<link rel="stylesheet" href="css/vertical-nav.css" />
<link rel="stylesheet" href="css/libros.css" />
<link rel="stylesheet" href="css/links.css" />
<script src="js/modernizr.custom.lis.js"></script>
</head>
<header>
<h1 class="3d-text">Libros disponibles</h1>
</header>




<body>
<?php
//Incluir librería de conexión a la base de datos
include_once ("db-mysqli.php");
//Si se ha llamado esta página desde el formulario
//para modificar libros ejecutar primero la actualización
//del registro
if (isset($_POST['guardar'])) {
//Creando variables locales con los datos enviados.
//desde el formulario de modificación
$isbnx = isset($_GET['id'])? addslashes(trim($_GET['id'])) : "";
$isbn = isset($_POST['isbn'])? addslashes(trim($_POST['isbn'])): "";
$autor = isset($_POST['autor']) ? addslashes(trim($_POST['autor'])): "";
$titulo =  isset($_POST['titulo'])? addslashes (trim($_POST['titulo'])) : ""; 
$precio = isset($_POST['precio'])? doubleval (trim($_POST['precio'])) : "";


//Verificando que se hayan ingresado datos
//en todos los controles del formulario
if (empty($isbn) || empty($autor) || empty($titulo) || empty($precio)) {
    $msg = "Existen campos en el formulario sin llenar. ";
    $msg.= "Regrese al formulario y llene todos los campos. <br>\n";
    $msg.= "[<a href=\"modificar.php?id=" . $isbnx. "\">Volver</a>]\n";
    echo $msg;
    exit(0);
    }
    //Creando la consulta de actualización con los datos
    //enviados del formulario de modificación de libros
    $consulta = "UPDATE libros SET isbn='" . $isbn . "', autor='" . $autor;
    $consulta."', titulo='" . $titulo ."', precios". $precio. "WHERE isbn='".
    $isbnx. "";
    //Ejecutando la consulta de actualización
    $resultc = $db->query($consulta);
    //Obteniendo el número de registros actualizados
    $num_results = $db->affected_rows;
    echo "<div class=\"query\">\n\t<p>";
    echo "\t\t". $num_results ." fila(s) actualizada(s)\n";
    echo "\t</p>\n</div>\n";
    $_GET['opc'] = "modificar";
}






if (isset($_GET['del']) && $_GET['del'] == "s") {
    $consulta = "DELETE FROM libros WHERE isbn='".$_GET['id']."";
    $resultc = $db->query($consulta);
    $num_results = $db->affected_rows;
    echo "<div class=\"query\">\n\t<p>".$consulta. "</p>\n";
    echo "Se ha eliminado" . $num_results ." registro de isbn= " .$_GET['id'] .
    "\n</div>\n";
    }
    //Haciendo una consulta de todos los libros presentes
    //en la tabla libros
    $consulta = "SELECT FROM libros ORDER BY autor";
    //Ejecutando la consulta a través del objeto $db 
    $resultc = $db->query($consulta);
    //Obteniendo el número de registros devueltos
    $num_results = $resultc->num_rows;
    echo "<table class=\"color-table\">\n



    \t<colgroup>\n
\t\t<col class=\"isbn\">\n
\t</colgroup>\n
\t<colgroup>\n
\t\t<col class=\"info\">\n
\t\t<col class=\"info\">\n
\t</colgroup>\n
\t<colgroup>\n
\t\t<col class=\"price\">\n
\t</colgroup>\n
\t<colgroup>\n
\t\t<col class=\"action\">\n
\t</colgroup>\n
\t<thead>\n
\t\t<tr id=\"theader\">\n
\t\t\t<th>ISBN</th>\n
\t\t\t<th>AUTOR</th>\n
\t\t\t<th>TÍTULO</th>\n
\t\t\t<th>PRECIO</th>\n
\t\t\t<th>ACCIÓN</th>\n
\t\t</tr>\n
\t</thead>\n
\t<tbody>\n";






while ($row = $resultc->fetch_assoc()) {
    echo "\t\t<tr class=\"normal\" onmouseover=\"this.className='selected'\" 
    onmouseout=\"this.className='normal'\">\n";
    echo "\t\t\t<td>\n";
    echo "\t\t\t\t". $row['isbn']. "\n";
    echo "\t\t\t</td>\n\t\t\t\t<td>\n";
    echo "\t\t\t\t" . stripslashes($row['autor']). "\n";
    echo "\t\t\t</td>\n\t\t\t<td>\n";
    echo "\t\t\t\t". stripslashes($row['titulo']). "\n";
    echo "\t\t\t</td>\n\t\t\t<td>$ \n";
    echo "\t\t\t\t". $row['precio'];
    echo "\t\t\t</td>\n\t\t\t<td align=\"center\">\n";
    echo "\t\t\t\t[<a href=\"" . $_GET['opc']. ".php?id=" . $row['isbn'] . "\">\n";
    echo "\t\t\t\t\t" . $_GET['opc']."\n";
    echo "\t\t\t\t</a>]\n";
    echo "\t\t\t</td>\n\t\t</tr>\n";
    }






    echo "\t</tbody>\n";
echo "\t<tfoot>\n";
echo "\t\t<tr id=\"tfooter\">\n";
echo "\t\t\t<th colspan=\"3\">\n";
//Mostrando el número total de registros de la tabla libros echo "\t\t\t\tNúmero de registros: " $num_results. "\n";
echo "\t\t\t</th>\n";
echo "\t</tr>\n";
echo "\t</tfoot>\n";
echo "</table>\n";
?>
<a href="menuopciones.html" class="a-btn">
<span class="a-btn-symbol">i</span>
<span class="a-btn-text">Regresar</span>
<span class="a-btn-slide-text">al menú</span>
<span class="a-btn-slide-icon"></span>
</a>
</body>
</html>










