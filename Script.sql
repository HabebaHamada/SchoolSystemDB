-- Create a new database (if it doesn't exist)
CREATE DATABASE IF NOT EXISTS SchoolSystem;

USE SchoolSystem;

CREATE TABLE IF NOT EXISTS Class(
   ID   int AUTO_INCREMENT PRIMARY KEY,
   Name varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Student(
   ID          int AUTO_INCREMENT PRIMARY KEY,
   ClassID     int ,
   Name        varchar(255) NOT NULL,
   DateOfBirth date,
   
   FOREIGN KEY (ClassID) REFERENCES Class(ID) -- Define ClassID as a foreign key
);

CREATE TABLE IF NOT EXISTS Subject(
   ID    int AUTO_INCREMENT PRIMARY KEY,
   Name  varchar(255) NOT NULL
);

/*Create the linking table for the many-to-many relationship between Students and Subjects*/
CREATE TABLE IF NOT EXISTS StudentSubject (
    StudentID INT NOT NULL,       
    SubjectID INT NOT NULL,           
    PRIMARY KEY (StudentID, SubjectID), /*Composite Primary Key */

    FOREIGN KEY (StudentID) REFERENCES Student(ID), 
    FOREIGN KEY (SubjectID) REFERENCES Subject(ID)  
);
