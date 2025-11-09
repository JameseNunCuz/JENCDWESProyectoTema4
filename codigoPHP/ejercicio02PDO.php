<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 02</title>
    <link rel="stylesheet" href="../webroot/css/style.css">
</head>

<body>
    <div class="header">
        <div class="title">
            <h1>Desarrollo web en entorno servidor</h1>
            <h2>Tema 4: Técnicas de acceso a datos en PHP</h2>
        </div>
        <button class="home active" onclick="location.href = '../'">Volver</button>
    </div>

    <?php /** 
      *@author James Edward
      *@since 06/11/2025
      *@version 09/11/2025
      */

    //Preparacion de los datos para la conexion a la base de datos
    //define("DSN", "mysql:host=10.199.9.174;dbname=DBJENCDWESProyectoTema4");
    define("DSN", "mysql:host=192.168.1.200;dbname=DBJENCDWESProyectoTema4");
    define("USERNAME", "adminsql");
    define("PASSWORD", "password");

    //Conexion a la base de datos
    try {
        $pdo = new PDO(DSN, USERNAME, PASSWORD);

        //Consulta de la tabla departamento
        try {
            //Crear y ejecutar consulta
            $consulta = $pdo->query("SELECT CodDepartamento, DescDepartamento, FechaCreacionDepartamento, VolumenDeNegocio, FechaBajaDepartamento FROM DBJENCDWESProyectoTema4.Departamento");
            $resultadoConsulta = $consulta->fetchAll();

            //Salida de la informacion en forma de tabla
            echo "<table><tr></tr><th>CodDepartamento</th><th>DescDepartamento</th><th>FechaCreacionDepartamento</th><th>VolumenDeNegocio</th><th>FechaBajaDepartamento</th></tr>";
            foreach ($resultadoConsulta as $resultado) {
                echo "<tr><td>" . $resultado['CodDepartamento'] . "</td><td>" . $resultado['DescDepartamento'] . "</td><td>" . $resultado['FechaCreacionDepartamento'] . "</td><td>" . $resultado['VolumenDeNegocio'] . "</td><td>" . $resultado['FechaBajaDepartamento'] . "</td></tr>";
            }
            echo "</table>";
            //consulta fallida
        } catch (PDOException $exceptionPDO) {
            echo "<h2>Error en la consulta</h2>";
            echo "<p>" . $exceptionPDO->getMessage() . "</p>";
        }
        //Conexion fallida
    } catch (PDOException $exceptionPDO) {
        echo "<h2>Error al conectar con la base de datos</h2>";
        echo "<p>" . $exceptionPDO->getMessage() . "</p>";
    } finally {
        unset($pdo);
    }
    ?>

    <div class="footer">
        <button onclick="location.href = '../../'">
            <h3>James Edward Nuñez Cuzcano</h3>
        </button>
    </div>
</body>

</html>