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

    public function getAllStudents(): bool{
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getStudentById($id): bool{
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    public function createStudent($id, $name , $class_id ,$dataOfBirth): bool{
        $query = "INSERT INTO " . $this->table_name . " (id, name, class_id, date_of_birth) VALUES (:id, :name, :class_id, :date_of_birth)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->bindParam(':date_of_birth', $dataOfBirth);
        return $stmt->execute();
    }



}