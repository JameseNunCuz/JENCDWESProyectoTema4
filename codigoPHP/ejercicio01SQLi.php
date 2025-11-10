<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 01 MySQLi</title>
    <link rel="stylesheet" href="../webroot/css/style.css">
</head>

<body>
    <header>
        <table>
            <tr>
                <td>
                    <h2>Desarrollo web en entorno servidor</h2>
                </td>
                <td>
                    <h1>Tema 4: Técnicas de acceso a datos en PHP</h1>
                </td>
                <td>
                    <button class="active" onclick="location.href = '../'">
                        <h5>Volver</h5>
                    </button>
                </td>
            </tr>
        </table>
    </header>

    <main>

        <?php /** 
          *@author James Edward
          *@since 06/11/2025
          *@version 09/11/2025
          */

        //Preparacion de los datos para la conexion a la base de datos
        define("HOST", "10.199.9.174");
        //define("HOST", "192.168.1.200");
        define("USERNAME", "adminsql");
        define("PASSWORD", "password");
        define("DBNAME", "DBJENCDWESProyectoTema4");

        //Conexion a la base de datos correcta y ver atributos de la conexion
        echo "<h1>Conexion a la base de datos con los parametros correctos</h1>";
        try {
            $sqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
            echo "<h2>Conexion corecta a la DB</h2>";
            echo "<h3>Atributos de la conexion</h3>";

            $mysqli_attributes = [
                'client_info' => $sqli->client_info,        // MySQL client library version
                'client_version' => $sqli->client_version,     // Client library version number
                'connect_errno' => $sqli->connect_errno,      // Last connection error code
                'connect_error' => $sqli->connect_error,      // Last connection error message
                'errno' => $sqli->errno,              // Most recent function call error code
                'error' => $sqli->error,              // Most recent function call error message
                'field_count' => $sqli->field_count,        // Number of columns for the last query
                'host_info' => $sqli->host_info,          // Host connection information
                'info' => $sqli->info,               // Additional info from the last query
                'insert_id' => $sqli->insert_id,          // Last auto-increment ID
                'protocol_version' => $sqli->protocol_version,   // MySQL protocol version
                'server_info' => $sqli->server_info,        // Server version string
                'server_version' => $sqli->server_version,     // Server version number
                'sqlstate' => $sqli->sqlstate,           // SQLSTATE error code
                'thread_id' => $sqli->thread_id,          // Thread ID of current connection
                'warning_count' => $sqli->warning_count,      // Number of warnings for the last query
                'stat' => $sqli->stat(),             // Current server status info
                'host' => $sqli->host_info,          // Host info (redundant but convenient)
                'ping' => $sqli->ping() ? 'Alive' : 'Dead', // Check connection status
            ];

            foreach ($mysqli_attributes as $atributo => $valor) {
                try {
                    echo $atributo . ": " . $valor . "<br>";
                } catch (mysqli_sql_exception $exceptionSQLI) {
                    echo $atributo . ": Empty/Error <br>";
                }
            }

        } catch (mysqli_sql_exception $exceptionSQLI) {
            echo "<h2>Error al conectar con la base de datos</h2>";
            echo "<p>" . $exceptionSQLI->getMessage() . "</p>";
        } finally {
            unset($sqli);
        }

        //Conexion a la base de datos incorrecta
        echo "<br><h1>Conexion a la base de datos con los parametros incorrectos</h1>";
        try {
            $sqli = new mysqli(HOST, USERNAME, "PASSWORD", DBNAME);
            echo "<h2>Conexion corecta a la DB</h2>";
        } catch (mysqli_sql_exception $exceptionSQLI) {
            echo "<h2>Error al conectar con la base de datos</h2>";
            echo "<p>" . $exceptionSQLI->getMessage() . "</p>";
        } finally {
            unset($sqli);
        }

        //Conexion a la base de datos con driver incorrecto
        /*echo "<br><h1>Conexion a la base de datos con el driver incorrecto</h1>";
        try {
            $sqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
            echo "<h2>Conexion corecta a la DB</h2>";
        } catch (mysqli_sql_exception  $exceptionSQLI) {
            echo "<h2>Error al conectar con la base de datos</h2>";
            echo "<p>" . $exceptionSQLI->getMessage() . "</p>";
        } finally {
            unset($sqli);
        }*/

        ?>

    </main>

    <footer>
        <h2>James Edward Nuñez Cuzcano</h2>
        <div>
            <button class="active" onclick="window.open('https://github.com/JameseNunCuz')"><img
                    src="../webresources/github.png"></button>
            <button class="active" onclick="location.href='../../../'"><img src="../webresources/home.png"></button>
        </div>
    </footer>
</body>

</html>