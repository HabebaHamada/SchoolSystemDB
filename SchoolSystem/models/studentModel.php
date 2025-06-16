<?php

require_once __DIR__ . '/baseModel.php';

class StudentModel extends BaseModel {
    private $table_name = "Student";

       /*
    CRUD 
    C -> CREATE
    R -> READ
    U -> UPDATE
    D -> DELETE */

         /**
     * Create a new Student
     * @param array $data Associative array with keys 'ClassID', 'Name', 'DateOfBirth'
     * @return int|false The ID of the new student or false on failure
     */
    public function createStudent($studentData): int|bool{
        $query = "INSERT INTO " . $this->table_name . " (ClassID, Name, DateOfBirth) VALUES (:ClassID, :Name, :DateOfBirth)";

        try{
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
                return $this->conn->lastInsertId();
            }
        
        }catch(PDOException $e){

            error_log("Error creating student: " . $e->getMessage());
        }

        return false;

    }

    
    public function getAllStudents(): array{
        $query = "SELECT * FROM " . $this->table_name;
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        
        } catch(PDOException $e){
            
            error_log("Error Reading all Students: " . $e->getMessage());
            return [];
        }
    }

    public function getStudentById($id): array|bool{
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

}