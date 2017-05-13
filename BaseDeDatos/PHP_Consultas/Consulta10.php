<?php

$db = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql =  "SELECT ID_Oficio, Nombre, Solicitudes, FIND_IN_SET(
                                                    Solicitudes, (
                                                                select GROUP_CONCAT( Solicitudes order by Solicitudes desc ) 
                                                                from Oficios 
                                                            ) 
                                                ) as Ranking
    from Oficios
    order by Ranking asc";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}?>
<table border=4>
<tr>
<td>ID Oficio</td><td>Oficio</td><td>Cant. Solicitudes</td><td>Ranking</td>

</tr>
<?php
while($row = $result->fetch_assoc()){
?> 
 <tr>
<td><?php echo $row['ID_Oficio']; ?></td>
<td><?php echo $row['Nombre']; ?></td>
<td><?php echo $row['Solicitudes']; ?></td>
<td><?php echo $row['Ranking']; ?></td>
</tr>

<?php
}

?>

</table>
<?php

$db->close();


?>