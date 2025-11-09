<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 04</title>
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

    <!-- Formulario de la descripcion del departamento -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="DescDepartamento">Descripcion del departamento a buscar:</label>
        <input type="text" id="DescDepartamento" name="DescDepartamento" placeholder="Descripcion">
        <br>

        <button type="submit" name="submit">Enviar</button>
    </form>

    <?php /** 
      *@author James Edward
      *@since 07/11/2025
      *@version 09/11/2025
      */

    //Preparacion de los datos para la conexion a la base de datos
    //define("DSN", "mysql:host=10.199.9.174;dbname=DBJENCDWESProyectoTema4");
    define("DSN", "mysql:host=192.168.1.200;dbname=DBJENCDWESProyectoTema4");
    define("USERNAME", "adminsql");
    define("PASSWORD", "password");

    $mostrarFormulario = true;

    //----------Hacer consulta----------
    if (isset($_POST["submit"])) {
        try {
            //Crear conexion con la db
            $pdo = new PDO(DSN, USERNAME, PASSWORD);
            $resultadoConsulta = null;

            //Preparar sql
            $sql = "SELECT CodDepartamento, DescDepartamento, FechaCreacionDepartamento, VolumenDeNegocio, FechaBajaDepartamento FROM DBJENCDWESProyectoTema4.Departamento";

            //Consulta si se ha introducido una descripcion
            if (!empty($_POST["DescDepartamento"])) {
                $sql .= " WHERE DescDepartamento LIKE :descripcion;";
                try {
                    $consulta = $pdo->prepare($sql);
                    $consulta->bindValue(":descripcion", "%" . $_POST["DescDepartamento"] . "%", PDO::PARAM_STR);
                    $consulta->execute();
                    $resultadoConsulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $exceptionPDO) {
                    echo "<h2>Error en la consulta SQL</h2>";
                    echo "<p>" . $exceptionPDO->getMessage() . "</p>";
                }

                //Consulta si no se ha introducido nada
            } else {
                try {
                    $resultadoConsulta = $pdo->query($sql);
                } catch (PDOException $exceptionPDO) {
                    echo "<h2>Error en la consulta SQL</h2>";
                    echo "<p>" . $exceptionPDO->getMessage() . "</p>";
                }
            }

            //----------Salida----------
    
            //No se encontraron resultados
            if (empty($resultadoConsulta)) {
                echo "<h2>No se han encontrado resultados</h2>";

                //Se han encontrado resultados, se muestran en una tabla
            } else {
                echo "<h2>Resultado de la consulta:</h2>";
                echo "<table><tr></tr><th>CodDepartamento</th><th>DescDepartamento</th><th>FechaCreacionDepartamento</th><th>VolumenDeNegocio</th><th>FechaBajaDepartamento</th></tr>";
                foreach ($resultadoConsulta as $resultado) {
                    echo "<tr><td>" . $resultado['CodDepartamento'] . "</td><td>" . $resultado['DescDepartamento'] . "</td><td>" . $resultado['FechaCreacionDepartamento'] . "</td><td>" . $resultado['VolumenDeNegocio'] . "</td><td>" . $resultado['FechaBajaDepartamento'] . "</td></tr>";
                }
            }


        } catch (PDOException $exceptionPDO) {
            echo "<h2>Error al conectar con la base de datos</h2>";
            echo "<p>" . $exceptionPDO->getMessage() . "</p>";
        } finally {
            unset($pdo);
        }

        //----Mostrar formulario----
    }
    ?>

    <div class="footer">
        <button onclick="location.href = '../../'">
            <h3>James Edward Nuñez Cuzcano</h3>
        </button>
    </div>
</body>

</html>