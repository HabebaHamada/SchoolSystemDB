<?php

require_once __DIR__ . '/../database/Database.php';

/**
 * ClassModel handles CRUD operations for the Class entity.
 * It interacts with the database to create, read, update, and delete class records.
 */
class ClassModel {
    private $table_name = "Class";


    private $conn;
    /**
     * ClassModel constructor initializes the database connection.
     */
    public function __construct() {
        $this->conn = Database::getConnection(); 
    }

    /*
    CRUD 
    C -> CREATE
    R -> READ
    U -> UPDATE
    D -> DELETE */

    public function createClass(string $name): int{
        
        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (:name)";

        try{
            $stmt = $this->conn->prepare($query);

            if (!isset($name)) {

                 error_log("Error creating class: 'Name' key is missing .");
                 return 0; 
            }
            
            $stmt->bindParam(':name', $name);

            if ($stmt->execute()) 
            {
                return (int) $this->conn->lastInsertId();
            } 
            else 
            {
                 error_log("Error executing class creation query.");
                 return 0;
            }       
         } 
            catch(PDOException $e){
            error_log("Error creating class: " . $e->getMessage());
            return 0;
        }

    }

    public function getAllClasses(): array{
        
        $query = "SELECT * FROM " . $this->table_name;

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        
        } catch(PDOException $e){
            
            error_log("Error Reading all Classes: " . $e->getMessage());
            return [];
        }
    }

    public function getClassById(int $id):mixed{
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch(PDOException $e){
             error_log("Error reading class: " . $e->getMessage());
             return [];          
        }
    }



    public function updateClass(int $id, string $name): bool{
        $query = "UPDATE " . $this->table_name . " SET name = :name WHERE id = :id";

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            return $stmt->execute();
        } catch(PDOException $e){
            error_log("Error updating class: " . $e->getMessage());
            return false;
        }
    }

    public function deleteClass(int $id): bool{
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
         } catch(PDOException $e){
            error_log("Error deleting  class: " . $e->getMessage());
            return false;
        }
    }

    public function getStudentsToEachClass() :array
    {
        $query = "SELECT Class.Name AS className, Student.Name AS studentName FROM " . $this->table_name 
                 . " LEFT JOIN Student ON Class.ID= Student.ClassID";

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        
        } catch(PDOException $e){
            
            error_log("Classes has no associated students : " . $e->getMessage());
            return [];
        }
    }


}