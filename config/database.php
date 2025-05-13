<?php
class Database
{
    private static $host = 'localhost';
    private static $db_name = 'bd_dashboard';
    private static $username = 'root';
    private static $password = '';
    private static $charset = 'utf8mb4';

    public static function connect()
    {
        try {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=" . self::$charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            return new PDO($dsn, self::$username, self::$password, $options);
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
}
