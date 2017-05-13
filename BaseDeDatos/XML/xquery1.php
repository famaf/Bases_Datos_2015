xquery version "1.0";
<Response>
{
    for $x in doc('http://www.institutodubois.com.ar/fm/grupo10/File.xml')
        return $x/Escuela/Tutores/Tutor/Alumnos/Alumno[contains(Nombre_Alumno,"Perez") or contains(Apellido_Alumno,"Perez")]
}
</Response>