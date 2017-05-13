xquery version "1.0";
<Response>
{
    for $x in doc('http://www.institutodubois.com.ar/fm/grupo10/File.xml')
        return $x/Escuela/Cursos/Curso[Cantidad_de_Alumnos > 30]
}
</Response>