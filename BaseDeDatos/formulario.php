<?php
    echo "Estoy antes de Crear<br>";
    crear(); //Creamos el archivo
    echo "Estoy despues de Crear y antes de Leer<br>";
    leer(); //Luego lo leemos
    echo "Estoy despues de Leer<br>";

    //Para crear el archivo
    function crear()
    {
        echo "HOLA 1<br>";
        $bd = new mysqli('localhost', 'ddubois_grupo10', 'lahermanademario', 'ddubois_grupo10') 
              or die("Error al conectar con MySQL-> ".mysql_error());
        echo "HOLA 2<br>";

        $stmt = $bd->prepare("SELECT ID_Tutor, cur.ID_Alumno, Grado, Seccion, Turno, Año FROM Cursando cur INNER JOIN Grupo_Familiar gf ON cur.ID_Alumno = gf.ID_Alumno");
        echo "HOLA 3<br>";
        $stmt->execute();
        echo "HOLA 4<br>";
        $stmt->store_result();
        echo "HOLA 5<br>";
        $stmt->bind_result($id_tutor, $id_alumno, $grado, $seccion, $tutor, $anio);
        echo "HOLA 6<br>";

        $xml = new DomDocument('1.0', 'UTF-8');
        echo "HOLA 7<br>";
        $listado = $xml->createElement('listado');
        $listado = $xml->appendChild($listado);
        echo "HOLA 8<br>";
        while($stmt->fetch())
        {
            echo "HOLA 9 WHILE<br>";
            $nodo_id_tutor = $xml->createElement('ID_Tutor', $Id_tutor);
            $nodo_id_tutor = $listado->appendChild($nodo_id_tutor);
            $nodo_id_alumno = $xml->createElement('ID_ALumno', $id_alumno);
            $nodo_id_alumno = $listado->appendChild($nodo_id_alumno);
            $nodo_grado = $xml->createElement('Grado', $grado);
            $nodo_grado = $listado->appendChild($nodo_grado);
            $nodo_seccion = $xml->createElement('Seccion', $seccion);
            $nodo_seccion = $listado->appendChild($nodo_seccion);
            $nodo_turno = $xml->createElement('Turno', $turno);
            $nodo_turno = $listado->appendChild($nodo_turno);
            $nodo_anio = $xml->createElement('Año', $anio);
            $nodo_anio = $listado->appendChild($nodo_anio);
        }
        echo "HOLA 10 fuera del while<br>";
        $stmt->free();
        $bd->close();
        echo "HOLA 11 cerre la data base<br>";
        $xml->formatOutput = true;
        echo "HOLA 12 antes de save<br>";
        $el_xml = $xml->saveXML();
        echo "HOLA 13 Aca Estoy !!!<br>";
        $xml->save('mario.xml');
        echo "HOLA 14 pude guardar<br>";

        //Mostramos el XML puro
        echo "<p><b>El XML ha sido creado.... Mostrando en texto plano:</b></p>".
            htmlentities($el_xml)."<br/><hr>";
    }

    //Para leerlo
    function leer()
    {
        echo "<p><b>Ahora mostrandolo con estilo</b></p>";
        $xml = simplexml_load_file('mario.xml');
        $salida ="";

        foreach($xml->listado as $item)
        {
            $salida .=
                "<b>ID_Tutor:</b> " . $item->id_tutor . "<br/>".
                "<b>ID_Alumno:</b> " . $item->id_alumno . "<br/>".
                "<b>Grado:</b> " . $item->grado . "<br/>".
                "<b>Seccion:</b> " . $item->seccion . "<br/>".
                "<b>Turno:</b> " . $item->turno . "<br/><hr/>";
                "<b>Año0:</b> " . $item->anio . "<br/><hr/>";
        }
        echo $salida;
    }
?>
