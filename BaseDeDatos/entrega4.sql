Cursos
SELECT Grado, Seccion, Turno, Cantidad FROM Curso


Tutores con sus alumnos
SELECT tab1.Nombre as Nombre, tab1.Apellido as Apellido, alu.Apellido as Apellido_Alumno, alu.Nombre as Nombre_Alumno 
	From Alumnos as alu inner join 
	(SELECT gf.ID_Alumno, gf.ID_Tutor, tut.Nombre, tut.Apellido From Grupo_Familiar as gf 
	inner join Tutores as tut on gf.ID_Tutor Where gf.ID_Tutor = tut.ID_Tutor) as tab1 
	on alu.ID_Alumno WHERE alu.ID_Alumno = tab1.ID_Alumno