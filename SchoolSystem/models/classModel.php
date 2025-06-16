<?php

require_once __DIR__ . '/baseModel.php';

class ClassModel extends BaseModel {
    private $table_name = "Class";

    /*
    CRUD 
    C -> CREATE
    R -> READ
    U -> UPDATE
    D -> DELETE */

    public function createClass($name): int|bool {
        
        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (:name)";

        try{
            $stmt = $this->conn->prepare($query);

            if (!isset($name)) {

                 error_log("Error creating class: 'Name' key is missing .");
                 return false; 
            }
            
            $stmt->bindParam(':name', $name);

            if ($stmt->execute()) 
            {
                return (int) $this->conn->lastInsertId();
            } 
            else 
            {
                 error_log("Error executing class creation query.");
                 return false;
            }       
         } 
            catch(PDOException $e){
            error_log("Error creating class: " . $e->getMessage());
            return false;
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

    public function getClassById(int $id):array|bool {
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row;
        } catch(PDOException $e){
             error_log("Error reading class: " . $e->getMessage());
             return false;          
        }
    }



    public function updateClass(int $id, $name){
        $query = "UPDATE " . $this->table_name . " SET name = :name WHERE id = :id";

        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
        } catch(PDOException $e){
            error_log("Error updating class: " . $e->getMessage());
            return false;
        }
    }

    public function deleteClass($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
         } catch(PDOException $e){
            error_log("Error deleting  class: " . $e->getMessage());
            return false;
        }
    }

    public function getStudentsToEachClass() 
    {
        $query = "SELECT Class.Name AS className, Student.Name AS studentName 
                FROM " . $this->table_name 
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