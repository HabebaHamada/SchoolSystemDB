<?php

require_once __DIR__ . '/../config/dataBaseConfig.php';


class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $charset = DB_CHARSET;
    private $conn; 

    public function getConnection() {

        /*Reset Connection*/
        $this->conn = null; 
        try {
            $dsn = "mysql:host={$this->host};
                    dbname={$this->db_name};
                    charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation for true prepared statements
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);

        } catch(PDOException $exception) {
            // In a real application, you would log this error securely, not print it directly
            error_log("Database Connection Error: " . $exception->getMessage());
            // For this example, we'll print it to demonstrate
            die("Database connection error: " . $exception->getMessage());
        }

        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }

}

?>