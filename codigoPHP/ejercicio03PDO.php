<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 03</title>
    <link rel="stylesheet" href="../webroot/css/style.css">
    <style>
        .required {
            background-color: lightyellow;
        }

        .locked {
            background-color: lightgray;
        }

        .error {
            color: red;
        }
    </style>
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
        define("DSN", "mysql:host=10.199.9.174;dbname=DBJENCDWESProyectoTema4");
        //define("DSN", "mysql:host=192.168.1.200;dbname=DBJENCDWESProyectoTema4");
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
                    $fecha = str_replace('T', ' ', $_POST['FechaCreacionDepartamento']) . ':00';
                    $sql = $pdo->prepare("INSERT INTO Departamento (CodDepartamento, DescDepartamento, FechaCreacionDepartamento, VolumenDeNegocio, FechaBajaDepartamento) VALUES (?,?,?,?,?)");
                    if ($sql->execute([$_REQUEST["CodDepartamento"], $_REQUEST["DescDepartamento"], $fecha, $_REQUEST["VolumenDeNegocio"], null])) {
                        echo "<h2>Departamento insertado correctamente</h2>";
                    } else {
                        echo "<h2>Insercion fallida</h2>";
                    }

                    //Escritura fallida
                } catch (PDOException $exceptionPDO) {
                    if ($exceptionPDO->getCode() === "23000") {
                        echo "<p class='error'>Codigo de derpartamento repetido</p>";
                        $mostrarFormulario = true;
                    } else {
                        echo "<h2>Error en la escritura</h2>";
                        echo "<p>" . $exceptionPDO->getMessage() . "</p>";
                    }
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
                <input class="required" type="text" id="CodDepartamento" name="CodDepartamento" placeholder="COD"
                    value="<?php echo isset($_REQUEST["CodDepartamento"]) ? $_REQUEST["CodDepartamento"] : ''; ?>">
                <br>

                <label for="DescDepartamento">Descripcion</label>
                <input type="text" id="DescDepartamento" name="DescDepartamento" placeholder="Descripcion"
                    value="<?php echo isset($_REQUEST["DescDepartamento"]) ? $_REQUEST["DescDepartamento"] : ''; ?>">
                <br>

                <label for="VolumenDeNegocio">Volumen De Negocio</label>
                <input type="text" id="VolumenDeNegocio" name="VolumenDeNegocio" placeholder="1000"
                    value="<?php echo isset($_REQUEST["VolumenDeNegocio"]) ? $_REQUEST["VolumenDeNegocio"] : ''; ?>">
                <label>€</label>
                <br>

                <label for="FechaCreacionDepartamento">Fecha de Creacion</label>
                <input class="locked" type="datetime-local" id="FechaCreacionDepartamento" name="FechaCreacionDepartamento"
                    value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
                <br>

                <label for="FechaBajaDepartamento">Fecha de Baja</label>
                <input class="locked" type="date" id="FechaBajaDepartamento" name="FechaBajaDepartamento" readonly>
                <br>

                <button type="submit" name="submit">Enviar</button>
            </form>
            <?php
        } ?>

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