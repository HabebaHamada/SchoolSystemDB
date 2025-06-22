<?php

require_once __DIR__ . '/../database/Database.php';

/**
 * SubjectModel handles CRUD operations for the Subject entity.
 * It interacts with the database to create, read, update, and delete Subject records.
 */
class SubjectModel
{

    private $table_name = "Subject";


    private $conn;
    /**
     * SubjectModel constructor initializes the database connection.
     */
    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    /*
    CRUD 
    C -> CREATE
    R -> READ
    U -> UPDATE
    D -> DELETE */

    public function createSubject(string $name): int
    {

        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (:name)";

        try {
            $stmt = $this->conn->prepare($query);

            if (!isset($name)) {

                error_log("Error creating subject: 'Name' key is missing .");
                return 0;
            }

            $stmt->bindParam(':name', $name);

            if ($stmt->execute()) {
                return (int) $this->conn->lastInsertId();
            } else {
                error_log("Error executing subject creation query.");
                return 0;
            }
        } catch (PDOException $e) {
            error_log("Error creating subject: " . $e->getMessage());
            return 0;
        }
    }
}