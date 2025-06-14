<?php

abstract class BaseModel {
    protected $conn; 

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

}