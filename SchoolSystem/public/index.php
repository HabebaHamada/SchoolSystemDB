<?php

require_once __DIR__ . '/../database/Database.php';

$DataBase = new Database();

$db = $DataBase->getConnection();

if (!$db) {
    die("Failed to get database connection."); 
}
else{
    echo "successfull connection to database\n";
}

$query = "SELECT * FROM Class";
$result = $db->prepare($query);
$result->execute();

$rowCount = $result->rowCount();
echo "Number of rows in CLASS table: " . $rowCount . "\n";



