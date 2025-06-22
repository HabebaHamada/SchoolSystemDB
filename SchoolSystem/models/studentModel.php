<?php

require_once __DIR__ . '/../database/Database.php';
/**
 * StudentModel handles CRUD operations for the Student entity.
 * It interacts with the database to create, read, update, and delete student records.
 */
class StudentModel
{
    private $table_name = "Student";

    private $conn;
    /**
     * ClassModel constructor initializes the database connection.
     */
    public function __construct()
    {
        $this->conn = Database::getConnection(); // Assuming Database::getConnection() returns a PDO instance
    }

    /*
    CRUD 
    C -> CREATE
    R -> READ
    U -> UPDATE
    D -> DELETE */

    /**
     * Create a new Student
     * @param array $data Associative array with keys 'ClassID', 'Name', 'DateOfBirth'
     * @return int The ID of the new student or 0 on failure
     */
    public function createStudent(array $studentData): int
    {
        $query = "INSERT INTO " . $this->table_name . " (ClassID, Name, DateOfBirth) VALUES (:ClassID, :Name, :DateOfBirth)";

        try {
            $stmt = $this->conn->prepare($query);

            /*Handling that Class ID Parameter is optional*/
            if (isset($data['ClassID'])) {
                $stmt->bindParam(':ClassID', $studentData['ClassID']);
            } else {
                $stmt->bindValue(':ClassID', null, PDO::PARAM_NULL);
            }

            $stmt->bindParam(':Name', $studentData['Name']);

            /*Handling that Date of Birth Parameter is optional*/
            if (isset($data['DateOfBirth'])) {
                $stmt->bindParam(':DateOfBirth', $studentData['DateOfBirth']);
            } else {
                $stmt->bindValue(':DateOfBirth', null, PDO::PARAM_NULL);
            }

            if ($stmt->execute()) {
                return (int)$this->conn->lastInsertId();
            }
        } catch (PDOException $e) {

            error_log("Error creating student: " . $e->getMessage());
        }

        return 0; // Return 0 on failure

    }


    public function getAllStudents(): array
    {
        $query = "SELECT * FROM " . $this->table_name;
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {

            error_log("Error Reading all Students: " . $e->getMessage());
            return [];
        }
    }

    public function getStudentById(int $id): mixed
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error reading class: " . $e->getMessage());
            return [];
        }
    }
}