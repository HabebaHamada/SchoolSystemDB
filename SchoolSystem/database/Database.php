<?php

require_once __DIR__ . '/../config/dataBaseConfig.php';


class Database {
    private static $host = DB_HOST;
    private static $db_name = DB_NAME;
    private static $username = DB_USERNAME;
    private static $password = DB_PASSWORD;
    private static $charset = DB_CHARSET;
    private static $conn = null;
    private function __construct() {
    }

    public static function getConnection() {

        if (self::$conn === null) 
        {

        try {
            $dsn = "mysql:host=" . self::$host . ";
                    dbname=" . self::$db_name . ";
                    charset=" . self::$charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation for true prepared statements
            ];

            self::$conn = new PDO($dsn, self::$username, self::$password, $options);

        } catch(PDOException $exception) {
            // In a real application, you would log this error securely, not print it directly
            error_log("Database Connection Error: " . $exception->getMessage());
            // For this example, we'll print it to demonstrate
            die("Database connection error: " . $exception->getMessage());
        }
        }
        return self::$conn;
    }

    public static function closeConnection() {
        self::$conn = null;
    }

}

?>