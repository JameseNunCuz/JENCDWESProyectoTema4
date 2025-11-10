<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 05</title>
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
          *@since 10/11/2025
          *@version 10/11/2025
          */

        $mostrarFormulario = null;     //Variable que indica si hay nque mostrar o no el formulario
        $errores = [];//Array para almacenar los mensajes de error
        
        //----------------Comprobación del formulario----------------
        //Si se ha recibido el formulario valida las respuestas
        if (isset($_REQUEST["submit"])) {
            require "../core/231018libreriaValidacion.php"; //Requiere la libreria de validacion
        
            $validacion = new validacionFormularios(); //Objeto de la clase de validacion
        
            array_push($errores, $validacion->comprobarAlfabetico($_REQUEST["nombre"], 50, 3, 1)); //Comprobacion del nombre
            array_push($errores, $validacion->validarTelefono($_REQUEST["numeroTelefono"], 1)); //Comprobacion del telefono
            array_push($errores, $validacion->validarEmail($_REQUEST["email"])); //Comprobacion del email)
        
            //Las respuestas del formulario han sido validadas y estan bien, sacar los datos por pantalla, se indica que no muestre el formulario
            if ($errores[0] == null && $errores[1] == null && $errores[2] == null) {
                echo "Respuestas recibidas y correctas<br>";
                echo "El nombre es: " . $_REQUEST["nombre"] . "<br>";
                echo "El telefono es: " . $_REQUEST["numeroTelefono"] . "<br>";
                echo "El email es: " . $_REQUEST["email"] . "<br>";

                $mostrarFormulario = false; //Se indica que no saque el formulario
        
                //Los datos son invalidos, volver a mostrar el formulario y sacar errores por pantalla
            } else {
                $mostrarFormulario = true; //Se indica que saque el formulario por pantalla
            }

            //----------------Tratamiento de los datos----------------
        } else {
            $mostrarFormulario = true; //Se indica que saque el formulario por pantalla
        }

        //----------------Sacar el formulario por pantalla----------------
        if ($mostrarFormulario) {
            ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="nombre">Nombre</label>
                <?php
                if (isset($errores[0]) && empty($errores[0])) {
                    echo "<input type='text' id='nombre' name='nombre' placeholder='Nombre' value='" . $_REQUEST["nombre"] . "'>";
                } else {
                    echo "<input type='text' id='nombre' name='nombre' placeholder='Nombre'>";
                }

                if (isset($errores[0])) {
                    echo ("<label class='error'>" . $errores[0] . "</label>");
                }
                ?><br>

                <label for="telefono">Nº de telefono</label>
                <?php
                if (isset($errores[1]) && empty($errores[1])) {
                    echo "<input type='tel' id='numeroTelefono' name='numeroTelefono' placeholder='123456789' value='" . $_REQUEST["numeroTelefono"] . "'>";
                } else {
                    echo "<input type='tel' id='numeroTelefono' name='numeroTelefono' placeholder='123456789'>";
                }

                if (isset($errores[1])) {
                    echo ("<label class='error'>" . $errores[1] . "</label>");
                }
                ?><br>

                <label for="email">Correo electronico</label>
                <?php
                if (!empty($errores)) {
                    if (is_null($errores[2])) {
                        echo "<input type='text' id='email' name='email' placeholder='algo@algo.algo' value='" . $_REQUEST["email"] . "'>";
                    } else {
                        echo "<input type='text' id='email' name='email' placeholder='algo@algo.algo'>";
                    }
                } else {
                    echo "<input type='text' id='email' name='email' placeholder='algo@algo.algo'>";
                }

                if (isset($errores[2])) {
                    echo ("<label class='error'>" . $errores[2] . "</label>");
                }
                ?><br>

                <button type="submit" name="submit">Enviar</button>
            </form>

        <?php } ?>

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