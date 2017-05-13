-- 1) Listar los teléfonos de los tutores en los cuales alguno de los dos tiene
-- apellido Díaz.
SELECT `Telefono`
FROM `GrupoFamiliar`
WHERE `ApellidoTutor1` = 'diaz'
OR `ApellidoTutor2` = 'diaz'


-- 2) Listar los Electricistas y sus emails (para poderles enviar una solicitud
-- de cotización por email).
-- Como no se aclaraba en la especificacion del problema a que se referia con 
-- “Listar los Electricistas” , directamente pusimos sus Emails.
SELECT `Email`
FROM `GrupoFamiliar`
NATURAL JOIN `Oficios`
NATURAL JOIN `OficiosTutores`
WHERE `Oficio` = 'electricista'


-- 3) Listar los plomeros que viven en barrio Alberdi de la ciudad de Córdoba.
-- En este caso decidimos listar los nombres y apellidos del Tutor 1.
SELECT `NombreTutor1` , `ApellidoTutor1`
FROM `GrupoFamiliar`
NATURAL JOIN `OficiosTutores`
NATURAL JOIN `Oficios`
WHERE `Oficio` = 'plomero'
AND `Barrio` = 'alberdi'
AND `Ciudad` = 'cordoba'


-- 4) Listar los plomeros que viven en barrio Alberdi de la ciudad de Córdoba
-- ordenados por fecha de alta de menor a mayor.
-- En este caso decidimos listar los nombres y apellidos del Tutor 1.
SELECT `NombreTutor1` , `ApellidoTutor1`
FROM `GrupoFamiliar`
NATURAL JOIN `OficiosTutores`
NATURAL JOIN `Oficios`
WHERE `Oficio` = 'plomero'
AND `Barrio` = 'alberdi'
AND `Ciudad` = 'cordoba'
ORDER BY `Fecha Alta` ASC

-- 5) Listar los grupos familiares que tienen un solo tutor
-- (Nombre y apellido del tutor 2 son nulos).
-- Aqui decidimos listar solamente los ID de los grupos familiares.
SELECT `Idgrupofamiliar`
FROM `GrupoFamiliar`
WHERE `NombreTutor2` IS NULL
OR `ApellidoTutor2` IS NULL


