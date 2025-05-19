USE SchoolSystem;

/*Query to return students associated to Every Class*/
SELECT Class.Name AS className, Student.Name AS studentName
FROM Class 
INNER JOIN Student ON Class.ID=Student.ClassID;

/*Query to return count of students associated to Every Subject*/
SELECT Subject.Name AS subjectName , COUNT(StudentSubject.StudentID) AS numberOfStudents
FROM Subject 
LEFT JOIN StudentSubject ON Subject.ID = StudentSubject.SubjectID
GROUP BY Subject.Name
ORDER BY numberOfStudents ;

/*Query to return Names of students associated to Every Subject*/
SELECT Subject.Name AS subjectName, Student.Name AS studentName
FROM Subject  
LEFT JOIN StudentSubject ON Subject.ID = StudentSubject.SubjectID
LEFT JOIN Student
