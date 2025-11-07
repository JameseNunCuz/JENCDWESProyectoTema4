<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 03</title>
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
      *@version 07/11/2025
      */
    //Preparacion de los datos para la conexion a la base de datos
    define("DSN", "mysql:host=10.199.9.174;dbname=DBJENCDWESProyectoTema4");
    define("USERNAME", "adminsql");
    define("PASSWORD", "password");

    $mostrarFormulario = true;

    //---------------Validar formulario---------------
    if (isset($_REQUEST["submit"])) {
        require_once "../core/231018libreriaValidacion.php";
        $errores = [];

        $validacion = new validacionFormularios();
        array_push($errores, $validacion->comprobarAlfabetico($_REQUEST["CodDepartamento"], 3, 1, 1));
        array_push($errores, $validacion->comprobarAlfanumerico($_REQUEST["DescDepartamento"], 255, 1, 0));
        array_push($errores, $validacion->validarFecha($_REQUEST["FechaCreacionDepartamento"]));
        array_push($errores, $validacion->comprobarFloat($_REQUEST["VolumenDeNegocio"]));
        array_push($errores, $validacion->validarFecha($_REQUEST["FechaBajaDepartamento"]));

        //Comprobar si hay algun valor en el array de errores que sea distinto de null o cadena vacia, es decir si hay errores en este
        if (count(array_filter($errores, fn($error) => !is_null($error) && $error !== '')) === 0) {
            $mostrarFormulario = false;
        } else {
            //Mostrar errores
            foreach ($errores as $error) {
                if (!is_null($error) && $error !== '') {
                    echo "<p style='color:red;'>$error</p><br>";
                }
            }
        }
    }

    //---------------Escribir en la base de datos---------------
    if (!$mostrarFormulario) {
        //Conexion a la base de datos
        try {
            $pdo = new PDO(DSN, USERNAME, PASSWORD);

            //Escribir datos uando prepared statements
            try {
                $sql = $pdo->prepare("INSERT INTO Departamento (CodDepartamento, DescDepartamento, FechaCreacionDepartamento, VolumenDeNegocio, FechaBajaDepartamento) VALUES (?,?,?,?,?)");
                if ($sql->execute([$_REQUEST["CodDepartamento"], $_REQUEST["DescDepartamento"], $_REQUEST["FechaCreacionDepartamento"], $_REQUEST["VolumenDeNegocio"], $_REQUEST["FechaBajaDepartamento"]])) {
                    echo "<h2>Departamento insertado correctamente</h2>";
                } else {
                    echo "<h2>Insercion fallida</h2>";
                }

                //Escritura fallida
            } catch (PDOException $exceptionPDO) {
                echo "<h2>Error en la escritura</h2>";
                echo "<p>" . $exceptionPDO->getMessage() . "</p>";
            }
            //Conexion fallida
        } catch (PDOException $exceptionPDO) {
            echo "<h2>Error al conectar con la base de datos</h2>";
            echo "<p>" . $exceptionPDO->getMessage() . "</p>";
        } finally {
            unset($pdo);
        }
    }

    //---------------Mostrar formulario en pantalla---------------
    if ($mostrarFormulario) {
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="CodDepartamento">Codigo de departamento</label>
            <input type="text" id="CodDepartamento" name="CodDepartamento" placeholder="COD">
            <br>

            <label for="DescDepartamento">Descripcion</label>
            <input type="text" id="DescDepartamento" name="DescDepartamento" placeholder="Descripcion">
            <br>

            <label for="FechaCreacionDepartamento">Fecha de Creacion</label>
            <input type="date" id="FechaCreacionDepartamento" name="FechaCreacionDepartamento">
            <br>

            <label for="VolumenDeNegocio">Volumen De Negocio</label>
            <input type="text" id="VolumenDeNegocio" name="VolumenDeNegocio" placeholder="1000">
            <br>

            <label for="FechaBajaDepartamento">Fecha de Baja</label>
            <input type="date" id="FechaBajaDepartamento" name="FechaBajaDepartamento">
            <br>

            <button type="submit" name="submit">Enviar</button>
        </form>
        <?php
    } ?>

    <div class="footer">
        <button onclick="location.href = '../../'">
            <h3>James Edward Nuñez Cuzcano</h3>
        </button>
    </div>
</body>

</html>