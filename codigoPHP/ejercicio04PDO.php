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

    <?php /** 
      *@author James Edward
      *@since 07/11/2025
      *@version 07/11/2025
      */

    //Preparacion de los datos para la conexion a la base de datos
    define("DSN", "mysql:host=10.199.9.174;dbname=DBJENCDWESProyectoTema4");
    define("USERNAME", "adminsql");
    define("PASSWORD", "password");

    $mostrarFormulario = true;

    //----Validar formulario----
    if (isset($_POST["submit"])) {

    }

    //----Mostrar formulario----
    if ($mostrarFormulario) {
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="DescDepartamento">Descripcion del departamento</label>
            <input type="text" id="DescDepartamento" name="DescDepartamento" placeholder="Descripcion">
            <br>

            <button type="submit" name="submit">Enviar</button>
        </form>
    <?php } ?>

    <div class="footer">
        <button onclick="location.href = '../../'">
            <h3>James Edward Nuñez Cuzcano</h3>
        </button>
    </div>
</body>

</html>