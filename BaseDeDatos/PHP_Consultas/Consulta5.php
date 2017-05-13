<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql =  "SELECT Nombre as Nombre_Oficio
         from (select count(*) as Cantidad_Cursos
               from (select Grado, Seccion
                     from Curso
                     group by Grado, Seccion) as tabla1
              ) as t1
              inner join
              (select Nombre, count(Nombre) as Apariciones
               from (select Grado, Seccion, Nombre
                     from Oficios of inner join Oficios_Tutores ot on of.ID_Oficio = ot.ID_Oficio
                                     inner join Grupo_Familiar gf on ot.ID_Tutor = gf.ID_Tutor
                                     inner join Cursando cur on gf.ID_Alumno = cur.ID_Alumno
                     where Año = 2015
                     group by Grado, Seccion, Nombre) as tabla2
               group by Nombre
              ) as t2
              on t1.Cantidad_Cursos = t2.Apariciones";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}?>
<head>
<style type="text/css">
thead {color:white;background:#069}
tbody {color:red}
</style>
</head>
<body>
<table style="margin-top:10px; margin-left:500px;" border=4>
  <thead>
      <tr>
         <th>Oficios</th>
      </tr>
   </thead>
<?php
while($row = $result->fetch_assoc()){
?> 
 <tr>
<td><?php echo $row['Nombre_Oficio']; ?></td>
</tr>
</body>

<?php
}

?>

</table>
<?php

$db->close();


?>
