-- Create a new database (if it doesn't exist)
CREATE DATABASE IF NOT EXISTS SchoolSystem;

USE SchoolSystem;

CREATE TABLE IF NOT EXISTS Class(
   ClassID   int AUTO_INCREMENT PRIMARY KEY,
   ClassName varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Student(
   StudentID          int AUTO_INCREMENT PRIMARY KEY,
   StudentClassID     int ,
   StudentName        varchar(255) NOT NULL,
   StudentDateOfBirth date,
   
   FOREIGN KEY (StudentClassID) REFERENCES Class(ClassID) -- Define ClassID as a foreign key
);

CREATE TABLE IF NOT EXISTS Subject(
   SubjectID    int AUTO_INCREMENT PRIMARY KEY,
   SubjectName  varchar(255) NOT NULL
);

/*Create the linking table for the many-to-many relationship between Students and Subjects*/
CREATE TABLE IF NOT EXISTS StudentSubject (
    StudentID INT NOT NULL,       
    SubjectID INT NOT NULL,           
    PRIMARY KEY (StudentID, SubjectID), /*Composite Primary Key */

    FOREIGN KEY (StudentID) REFERENCES Student(StudentID), 
    FOREIGN KEY (SubjectID) REFERENCES Subject(SubjectID)  
);