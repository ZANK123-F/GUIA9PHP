<?php

class Database
{
    private static $dbName = 'tienda';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    private static $dbCharset = 'utf8';
    private static $cont = null;

    // Constructor de la clase (se corrigió el nombre del constructor)
    public function __construct()
    {
        die('Init function is not allowed');
    }

    // Método para conectar a la base de datos
    public static function connect()
    {
        // Una sola conexión para toda la aplicación
        if (null == self::$cont) {
            try {
                self::$cont = new PDO(
                    "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName . ";charset=" . self::$dbCharset,
                    self::$dbUsername,
                    self::$dbUserPassword
                );
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    // Método para desconectar de la base de datos
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>