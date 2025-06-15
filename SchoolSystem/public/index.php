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
//$classModel->createClass("502");


$classes = $classModel->getAllClasses();

 /*foreach ($classes as $classRow) {
    echo "Class ID: " . $classRow['ID'] . ", Class Name: " . $classRow['Name'] . "\n";
 }*/

 $CLass_5=$classModel->getClassById(15);
  /*  if ($CLass_5) {
        echo "Class ID: " . $CLass_5['ID'] . ", Class Name: " . $CLass_5['Name'] . "\n";
    } else {
        echo "Class with ID 5 not found.\n";
    }*/

$classModel->updateClass(13,"500");
$classModel->updateClass(12,"501");
$classes = $classModel->getAllClasses();

 /*foreach ($classes as $classRow) {
    echo "Class ID: " . $classRow['ID'] . ", Class Name: " . $classRow['Name'] . "\n";
 }*/

$classModel->deleteClass(13);
$classes = $classModel->getAllClasses();

 /*foreach ($classes as $classRow) {
    echo "Class ID: " . $classRow['ID'] . ", Class Name: " . $classRow['Name'] . "\n";
 }*/

 $students=$classModel->getStudentsToEachClass();
  /*  foreach ($students as $studentRow) {
        echo "Class Name: " . $studentRow['className'] . ", Student Name: " . $studentRow['studentName'] . "\n";
    }*/
