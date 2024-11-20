<!doctype html>
<?php
/**
 * @author Jesus Ferreras
 * @since 2024/11/19
 * @version 2024/11/20
 */
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != 'administrador' || $_SERVER['PHP_AUTH_PW'] != '1234')) {
        header('WWW-Authenticate: Basic realm="Realm"');
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="author" content="Jesús Ferreras">
                <link rel="stylesheet" href="../webroot/css/estilos.css">
                <title>Ejercicio01</title>
            </head>
            <body>
                <header>
                    <h2>Desarrollo de un control de acceso con identificación del usuario basado en la función header()</h2>
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
    }
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="Jesús Ferreras">
            <link rel="stylesheet" href="../webroot/css/estilos.css">
            <title>Ejercicio01</title>
        </head>
        <body>
            <header>
                <h2>Desarrollo de un control de acceso con identificación del usuario basado en la función header()</h2>
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