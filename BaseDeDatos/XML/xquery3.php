xquery version "1.0";
<Response>
{
    for $x in doc('http://www.institutodubois.com.ar/fm/grupo10/File.xml')/Escuela/Tutores/Tutor
        where $x/count(Alumnos/Alumno) > 3
        return $x
}
</Response>