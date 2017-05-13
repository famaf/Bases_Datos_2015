CREATE PROCEDURE `alumnosPasan`(IN DNIAlumno int(8), IN aluTurno varchar(10), IN aluSeccion char(1))
BEGIN
    UPDATE Alumno, Curso SET Alumno.Id_curso = (SELECT Id
			FROM (
            SELECT grado AS grad
            FROM Curso
            INNER JOIN Alumno ON Alumno.Id_curso = Curso.Id
            WHERE Alumno.DNI = DNIAlumno
           ) S, Curso
          WHERE Curso.grado = S.grad +1
          AND Curso.turno =  aluTurno
          AND Curso.seccion =  aluSeccion)
WHERE Alumno.DNI_Alumno = DNIAlumno;
UPDATE Alumno SET Paso = 0 where Alumno.DNI = DNIAlumno;
END
