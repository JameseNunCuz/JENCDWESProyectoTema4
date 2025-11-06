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
      *@version 06/11/2025
      */

    $mostrarFormulario = true;
    $errores = [];

    //---------------Validar formulario---------------
    if (isset($_REQUEST["submit"])) {

    }

    //---------------Escribir en la base de datos---------------
    if(empty($errores)){
        //Preparacion de los datos para la conexion a la base de datos
        define("DSN", "mysql:host=10.199.9.174;dbname=DBJENCDWESProyectoTema4");
        define("USERNAME", "adminsql");
        define("PASSWORD", "password");

        //Conexion a la base de datos
        try {
            $pdo = new PDO(DSN, USERNAME, PASSWORD);

            //Escribir datos
            try {


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
            <input type="text" id="CodDepartamento" name="CodDepartamento" placeholder="COD" required>
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