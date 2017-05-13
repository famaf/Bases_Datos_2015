<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql =  "SELECT DISTINCT `ID_Tutor`
            FROM `Cursando` c inner join `Grupo_Familiar` gf on c.ID_Alumno = gf.ID_Alumno
            WHERE `Grado` = 1 and `ID_Tutor` not in (
                                    select `ID_Tutor`
                                    from `Cursando` cc inner join `Grupo_Familiar` gff on cc.ID_Alumno = gff.ID_Alumno
                                    where `Grado` != 1
                                    )";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}?>
<table border=4>
<tr>
<td>ID Tutor</td>
</tr>
<?php
while($row = $result->fetch_assoc()){
?> 
 <tr>
<td><?php echo $row['ID_Tutor']; ?></td>
</tr>

<?php
}

?>

</table>
<?php

$db->close();


?>