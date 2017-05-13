-------------- Consulta 1 --------------

select ID_Alumno, Nombre, Apellido
from Alumnos
where Apellido = 'Perez'

---------------------------------------

-------------- Consulta 2 --------------

select Grado, Seccion, Turno, Cantidad as Cantidad_de_Alumnos
from Curso
where Cantidad > 10

---------------------------------------

-------------- Consulta 3 --------------

select Nombre, Cantidad_de_Hijos
from ( select ID_Tutor, count(ID_Alumno) as Cantidad_de_Hijos
       from Grupo_Familiar
       group by ID_Tutor
     ) tabla1
     inner join Tutores tuto
     on tabla1.ID_Tutor = tuto.ID_Tutor
where Cantidad_de_Hijos > 3

---------------------------------------
