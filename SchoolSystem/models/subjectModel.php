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

    public function getAllSubjects(): array
    {

        $query = "SELECT * FROM " . $this->table_name;

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {

            error_log("Error Reading all Subjects: " . $e->getMessage());
            return [];
        }
    }


    public function getSubjectById(int $id): mixed
    {

        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error reading Subject: " . $e->getMessage());
            return [];
        }
    }

    public function updateSubject(int $id, string $name): bool
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error updating Subject: " . $e->getMessage());
            return false;
        }
    }

    public function deleteSubject(int $id): bool
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error deleting Subject: " . $e->getMessage());
            return false;
        }
    }
}