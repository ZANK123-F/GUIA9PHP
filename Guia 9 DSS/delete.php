<?php
// Incluir el archivo de conexión a la base de datos
include 'connection.php';

// Verificar si se ha enviado un ID válido a través de GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitizar y validar el ID del usuario
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // Verificar si el ID es un entero válido
    if ($id !== false) {
        try {
            // Establecer una conexión a la base de datos
            $db = Database::connect();

            // Establecer el modo de error de PDO para que lance excepciones en caso de errores
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Preparar la consulta SQL para eliminar el usuario con el ID proporcionado
            $query = $db->prepare("DELETE FROM usuario WHERE idusuario = ?");

            // Ejecutar la consulta con el ID como parámetro
            $query->execute([$id]);

            // Redirigir de nuevo a la página principal después de eliminar el usuario
            header("Location: index.php");
            exit(); // Terminar el script después de redirigir
        } catch (PDOException $e) {
            // Mostrar un mensaje de error si ocurre algún problema con la base de datos
            echo "Error al intentar eliminar el usuario: " . $e->getMessage();
        }
    } else {
        // Si el ID no es un entero válido, mostrar un mensaje de error
        echo "ID de usuario no válido.";
    }
} else {
    // Si no se proporcionó un ID válido, mostrar un mensaje de error
    echo "ID de usuario no proporcionado.";
}
?>