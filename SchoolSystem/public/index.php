<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ .'/../models/classModel.php';

$DataBase = new Database();

$db = $DataBase->getConnection();

if (!$db) {
    die("Failed to get database connection."); 
}
else{
    echo "successfull connection to database\n";
}

$classModel = new ClassModel($db);  
/*$classModel->createClass("502");*/


$classes = $classModel->getAllClasses();

 foreach ($classes as $classRow) {
    echo "Class ID: " . $classRow['ID'] . ", Class Name: " . $classRow['Name'] . "\n";
 }
