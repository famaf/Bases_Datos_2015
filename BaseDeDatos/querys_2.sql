1)

select Grado, Seccion, Turno, count(ID_Alumno) as Cantidad_de_Alumnos
from Cursando 
where Año = 2015
group by Grado, Seccion, Turno


2)

select alu_gf.ID_Alumno, cantidad_int.Cantidad - 1 as Cantidad_Hnos
from ( select resultado.Nro_GrupoFamiliar, count(resultado.Nro_GrupoFamiliar) as Cantidad
       from ( select res2.Nro_GrupoFamiliar 
              from ( select ID_Alumno
                     from Cursando
                     where Estado = 'Cursando'
                   ) as res1
                   inner join
                   ( select distinct ID_Alumno, Nro_GrupoFamiliar
                     from Grupo_Familiar
                     where 1
                   ) as res2
                   on res1.ID_Alumno = res2.ID_Alumno
            ) as resultado
       group by resultado.Nro_GrupoFamiliar
     ) as cantidad_int
     inner join
     ( select res1.ID_Alumno, res2.Nro_GrupoFamiliar
       from ( select ID_Alumno
              from Cursando
              where Estado = 'Cursando'
            ) as res1
            inner join
            ( select ID_Alumno, Nro_GrupoFamiliar
              from Grupo_Familiar
              where 1
            ) as res2
            on res1.ID_Alumno = res2.ID_Alumno
     ) as alu_gf
     on cantidad_int.Nro_GrupoFamiliar = alu_gf.Nro_GrupoFamiliar


4)
-- FORMA 1
select distinct gf.ID_Tutor
from ( select ID_Alumno
       from Cursando
       where Grado = 1
     ) as c
     natural join Grupo_Familiar gf
where ID_tutor not in ( select gff.ID_tutor
                        from ( select ID_Alumno
                               from Cursando
                               where Grado != 1
                             ) as cc 
                             natural join Grupo_Familiar gff
                      )

-- FORMA 2
select distinct ID_Tutor
from Cursando c inner join Grupo_Familiar gf on c.ID_Alumno = gf.ID_Alumno
where Grado = 1 and ID_Tutor not in ( select ID_Tutor
                                      from Cursando cc inner join Grupo_Familiar gff on cc.ID_Alumno = gff.ID_Alumno
                                      where Grado != 1
                                    )


5)

select Nombre as Nombre_Oficio
from ( select count(*) as Cantidad_Cursos
       from ( select Grado, Seccion
              from Curso
              group by Grado, Seccion
            ) as tabla1
     ) as t1
     inner join
     ( select Nombre, count(Nombre) as Apariciones
       from ( select Grado, Seccion, Nombre
              from Oficios of inner join Oficios_Tutores ot on of.ID_Oficio = ot.ID_Oficio
                              inner join Grupo_Familiar gf on ot.ID_Tutor = gf.ID_Tutor
                              inner join Cursando cur on gf.ID_Alumno = cur.ID_Alumno
              where Año = 2015
              group by Grado, Seccion, Nombre
            ) as tabla2
       group by Nombre
     ) as t2
     on t1.Cantidad_Cursos = t2.Apariciones


6)

select Grado, Seccion, Turno, (Cantidad*100/Cantidad2014)-100 as Evolucion
from ( select *
       from ( select Grado, Seccion, Turno, count(ID_Alumno) as Cantidad
              from Cursando
              where Año = 2015
              group by Grado, Seccion, Turno
            ) as T2015
            inner join
            ( select Grado as Grado2014, Seccion as Seccion2014, Turno as Turno2014, count(ID_Alumno) as Cantidad2014
              from Cursando
              where Año = 2014
              group by Grado2014, Seccion2014, Turno2014
            ) as T2014
            on T2014.Grado2014=T2015.Grado and T2014.Seccion2014=T2015.Seccion and T2014.Turno2014=T2015.Turno
     ) as Tabl


7)

delimiter //

create procedure inscripcion_automatica(in este_anio int)
begin
    declare id_student int;
    declare year int;
    declare grade int;
    declare state varchar(16);
    declare secc varchar(16);
    declare turn varchar(16);

    declare cur1 cursor for select ID_Alumno, Grado, Seccion, Turno, Estado, Año from Cursando where Estado = 'finalizado' and Año = este_anio;

    declare continue handler for not found set @done = true;

    open cur1;

    read_loop: loop
        fetch cur1 into id_student, grade, secc, turn, state, year;

        if @done then
            leave read_loop;
        end if;

        if grade = 1 then
            insert into Cursando values (id_student, grade + 1, secc, turn, 'cursando', year + 1);
        elseif grade = 2 then
            insert into Cursando values (id_student, grade + 1, secc, turn, 'cursando', year + 1);
        elseif grade = 3 then
            insert into Cursando values (id_student, grade + 1, secc, turn, 'cursando', year + 1);
        elseif grade = 4 then
            insert into Cursando values (id_student, grade + 1, secc, turn, 'cursando', year + 1);
        elseif grade = 5 then
            insert into Cursando values (id_student, grade + 1, secc, turn, 'cursando', year + 1);
        end if;

    end loop read_loop;

    close cur1;

end //

delimiter ;


8)

select resultado.grado, resultado.seccion, count(*) Cantidad_Deudores
from ( select Table1.ID_Alumno, Table2.Grado, Table2. Seccion, count(distinct Mes) as Meses_Pagados
       from ( select ID_Alumno, Mes
              from Pagos
              where Año = 2015
            ) as Table1
            inner join
            ( select ID_Alumno, Grado, Seccion
              from Cursando
              where Estado = 'Cursando'
            ) as Table2
            on Table1.ID_Alumno = Table2.ID_Alumno
       group by Table1.ID_Alumno
     ) as resultado 
where resultado.Meses_Pagados = 6
group by resultado.grado, resultado.seccion


9)

select ID_Alumno
from ( select Grado, Seccion, Turno
       from ( select cur.Grado, cur.Seccion, cur.Turno
              from ( select ID_Tutor
                     from Oficios of inner join Oficios_Tutores oft on of.ID_Oficio = oft.ID_Oficio
                    where Nombre = 'Dentista'
                   ) tuden
                   inner join Grupo_Familiar gf on tuden.ID_Tutor = gf.ID_Tutor
                   inner join Cursando cur on gf.ID_Alumno = cur.ID_Alumno
              group by Grado, Seccion, Turno
            ) tut
       where Grado = 1 and Seccion = 'D' and Turno = 'Tarde'
     ) grasectu
     natural join Cursando


10)

select ID_Oficio, Nombre, Solicitudes, FIND_IN_SET(
                Solicitudes, ( select GROUP_CONCAT( Solicitudes order by Solicitudes desc)
                               from Oficios
                             )
                ) as Ranking
from Oficios
order by Ranking asc

-- Otra forma de hacer el ranking:

select ID_Oficio, Nombre, Solicitudes, @curRank := @curRank + 1 as Ranking
from Oficios, (select @curRank := 0) r
order by Solicitudes desc
