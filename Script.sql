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

-- Inserting classes
INSERT INTO Class (Name) VALUES
('101'),
('102'),
('103'),
('104'),
('201'),
('202'),
('203'),
('301'),
('302'),
('303');

-- Inserting students
INSERT INTO Student (ClassID, Name, DateOfBirth) VALUES
(1, 'Alice Smith', '2005-03-15'), 
(2, 'Bob Johnson', '2004-11-20'), 
(3, 'Charlie Brown', '2006-07-08'), 
(4, 'David Lee', '2005-09-01'), 
(5, 'Eve Davis', '2004-05-28'),
(1, 'Fiona Wilson', '2006-01-10'), 
(2, 'George Miller', '2005-06-03'),
(3, 'Hannah Garcia', '2004-12-24'), 
(4, 'Ian Rodriguez', '2005-04-12'), 
(5, 'Julia Martinez', '2006-08-18');

-- Inserting subjects
INSERT INTO Subject (Name) VALUES
('Algebra'),
('Poetry'),
('Chemistry'),
('Ancient Civilizations'),
('Programming'),
('Trigonometry'),
('Shakespeare'),
('Biology'),
('Modern History'),
('Algorithms');

-- Linking students to subjects
INSERT INTO StudentSubject (StudentID, SubjectID) VALUES
(1, 1), 
(1, 2), 
(2, 2), 
(3, 3), 
(4, 4), 
(5, 5),
(6, 1), 
(7, 2),
(8, 3),
(9, 4),
(10, 5),
(1,5), 
(2,1),
(3,4); 

