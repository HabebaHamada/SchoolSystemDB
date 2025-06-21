<?php

require_once __DIR__ .'/../database/Database.php';
require_once __DIR__ .'/../models/classModel.php';
require_once __DIR__ .'/../models/studentModel.php';


/* The connection will be established the first time 
Database::getConnection() is called*/

$classModel = new ClassModel();  
$studentModel = new StudentModel();
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
$newStudent=array("ClassID"=>"1", "Name"=>"Habeba", "DateOfBirth"=>"2004-11-20");
$studentModel->createStudent($newStudent);  
$students=$studentModel->getAllStudents();


foreach ($students as $student) {
    echo "Student Name: ". $student['Name']. "\n";
}