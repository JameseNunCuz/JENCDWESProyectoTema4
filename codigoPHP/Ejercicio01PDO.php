<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 01</title>
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
      *@since 03/11/2025
      *@version 03/11/2025
      */

    //Preparacion de los datos para la conexion a la base de datos
    //define("DSN", "mysql:host=10.199.9.174;dbname=DBJENCDWESProyectoTema4");
    define("DSN", "mysql:host=192.168.1.200;dbname=DBJENCDWESProyectoTema4");
    define("USERNAME", "adminsql");
    define("PASSWORD", "password");

    //Conexion a la base de datos correcta y ver atributos de la conexion
    echo "<h1>Conexion a la base de datos con los parametros correctos</h1>";
    try {
        $pdo = new PDO(DSN, USERNAME, PASSWORD);
        echo "<h2>Conexion corecta a la DB</h2>";
        echo "<h3>Atributos de la conexion</h3>";

        $atributos = ["AUTOCOMMIT", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS", "DRIVER_NAME", "ERRMODE", "ORACLE_NULLS", "PERSISTENT", "SERVER_INFO", "SERVER_VERSION"/*,"PREFETCH" => PDO::ATTR_PREFETCH,"TIMEOUT" => PDO::ATTR_TIMEOUT*/];

        foreach ($atributos as $atributo) {
            echo $atributo . ": " . $pdo->getAttribute(constant( "PDO::ATTR_$atributo" )) . "<br>";
        }

    } catch (PDOException $exceptionPDO) {
        echo "<h2>Error al conectar con la base de datos</h2>";
        echo "<p>" . $exceptionPDO->getMessage() . "</p>";
    } finally {
        unset($pdo);
    }

    //Conexion a la base de datos incorrecta
    echo "<br><h1>Conexion a la base de datos con los parametros incorrectos</h1>";
    try {
        $pdo = new PDO(DSN, USERNAME, "patata");
        echo "<h2>Conexion corecta a la DB</h2>";
    } catch (PDOException $exceptionPDO) {
        echo "<h2>Error al conectar con la base de datos</h2>";
        echo "<p>" . $exceptionPDO->getMessage() . "</p>";
    } finally {
        unset($pdo);
    }

    //Conexion a la base de datos con driver incorrecto
    echo "<br><h1>Conexion a la base de datos con el driver incorrecto</h1>";
    try {
        $pdo = new PDO("error:host=10.199.9.174;dbname=DBJENCDWESProyectoTema4", USERNAME, PASSWORD);
        echo "<h2>Conexion corecta a la DB</h2>";
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