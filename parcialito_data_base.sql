Hacer un procedimiento que dado un grupo familiar,
muestre todos los hijos con la cantiadad de años que curso.


select cur.ID_Alumno
from Grupo_Familiar gf inner join Cursando cur on gf.ID_Alumno = cur.ID_Alumno
where Nro_GrupoFamiliar = 1


select cur.ID_Alumno, count(cur.ID_Alumno) as Años_Cursados
from Grupo_Familiar gf inner join Cursando cur on gf.ID_Alumno = cur.ID_Alumno
where Nro_GrupoFamiliar = 1
group by ID_Alumno


select Nro_GrupoFamiliar, cur.ID_Alumno, count(cur.ID_Alumno) as Años_Cursados
from Grupo_Familiar gf inner join Cursando cur on gf.ID_Alumno = cur.ID_Alumno
where Nro_GrupoFamiliar = 1
group by ID_Alumno


drop procedure if exists cantidad;


delimiter //

create procedure cantidad(in este_grupofamiliar int)
begin

    select Nro_GrupoFamiliar, cur.ID_Alumno, count(cur.ID_Alumno) as Años_Cursados
    from Grupo_Familiar gf inner join Cursando cur on gf.ID_Alumno = cur.ID_Alumno
    where Nro_GrupoFamiliar = este_grupofamiliar
    group by ID_Alumno;

end //

delimiter ;

