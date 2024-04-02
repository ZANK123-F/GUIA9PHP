<?php
// Implementación del patrón de diseño con PHP y la extensión MySQLi
class Database
{
    private $_connection;
    // La instancia estática
    private static $_instance;
    private $_host = "localhost";
    private $_username = "root"; // Corrección: añadido el signo de igual
    private $_password = "";
    private $_database = "libros"; // Corrección: añadido el signo de igual
    private $_charset = "utf8";

    public static function getInstance()
    {
        // Verificar si existe una instancia de base de datos creada.
        // Si no existe, crear una nueva
        if (!self::$_instance) {
            self::$_instance = new self(); // Corrección: añadido el operador de asignación
        }
        return self::$_instance;
    }

    // Constructor de la clase creado con la extensión MySQLi
    private function __construct()
    {
        $this->_connection = new mysqli(
            $this->_host,
            $this->_username,
            $this->_password,
            $this->_database
        );
        // Verificar si se creó el objeto conexión
        if ($this->_connection->connect_errno) {
            die("Falló la conexión a MySQL: (" . $this->_connection->connect_errno . ") " . $this->_connection->connect_error); // Corrección: concatenar correctamente los mensajes de error
        }
        // Estableciendo el cotejamiento de caracteres a utf8
        $this->_connection->set_charset($this->_charset);
    }

    // Método mágico para evitar la duplicación del objeto conexión
    private function __clone()
    {
    }

    // Obtener la conexión
    public function getConnection()
    {
        return $this->_connection;
    }
}

