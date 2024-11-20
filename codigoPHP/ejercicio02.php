<!doctype html>
<?php
/**
 * @author Jesus Ferreras
 * @since 2024/11/20
 * @version 2024/11/20
 */

    //Se importa el fichero con los parametros de conexion
    require_once '../config/confDB.php';
    
    try {
        //Se abre la conexion
        $miDB = new PDO(DSN, USUARIO, PASSWORD);

        //Conjunto de datos resultante del query
        $resultadoConsulta = $miDB->query('select * from T02_Departamento');
    } catch (Exception $ex) {
        //Se muestran el mensaje y codigo de error
        print('<p>Error: '.$ex->getMessage().'<br>Codigo: '.$ex->getCode().'</p>');
    } finally {
        //Se cierra la conexion
        unset($miDB);
    }

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != 'admin' || $_SERVER['PHP_AUTH_PW'] != 'paso')) {
        header('WWW-Authenticate: Basic realm="Realm"');
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="author" content="Jesús Ferreras">
                <link rel="stylesheet" href="../webroot/css/estilos.css">
                <title>Ejercicio02</title>
            </head>
            <body>
                <header>
                    <h2>Desarrollo de un control de acceso con identificación del usuario basado en el uso de una tabla “Usuario” de la base de datos</h2>
                </header>
                <main>
                    <p>Error de autenticación</p>
                </main>
                <footer>
                    <a href="../../index.html">Jesús Ferreras González</a>
                    <a href="../indexProyectoTema5.php">Tema 5</a>
                </footer>
            </body>
        </html>
        <?php
        exit;
    } else {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="author" content="Jesús Ferreras">
                <link rel="stylesheet" href="../webroot/css/estilos.css">
                <title>Ejercicio02</title>
            </head>
            <body>
                <header>
                    <h2>Desarrollo de un control de acceso con identificación del usuario basado en el uso de una tabla “Usuario” de la base de datos</h2>
                </header>
                <main>
                    <?php
                        print("<p>Usuario: {$_SERVER['PHP_AUTH_USER']}</p>");
                        print("<p>Contraseña: {$_SERVER['PHP_AUTH_PW']}</p>");
                    ?>
                </main>
                <footer>
                    <a href="../../index.html">Jesús Ferreras González</a>
                    <a href="../indexProyectoTema5.php">Tema 5</a>
                </footer>
            </body>
        </html>
        <?php
    }
?>