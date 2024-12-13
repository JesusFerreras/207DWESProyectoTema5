<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Jesús Ferreras">
        <link rel="stylesheet" href="../webroot/css/estilos.css">
        <title>Ejercicio00</title>
    </head>
    <body>
        <header>
            <h2>Contenido de las variables superglobales</h2>
        </header>
        <main>
            <?php
            /**
             * @author Jesus Ferreras
             * @since 2024/11/19
             * @version 2024/11/20
             */
            
            print('<h3 style="margin-bottom: 16px">$_SESSION</h3>'.(isset($_SESSION)? mostrar($_SESSION):'<p>Variable indefinida</p>'));
            print('<h3 style="margin-bottom: 16px">$_COOKIE</h3>'.mostrar($_COOKIE));
            print('<h3 style="margin-bottom: 16px">$_SERVER</h3>'.mostrar($_SERVER));
            print('<h3 style="margin-bottom: 16px">$_GET</h3>'.mostrar($_GET));
            print('<h3 style="margin-bottom: 16px">$_POST</h3>'.mostrar($_POST));
            print('<h3 style="margin-bottom: 16px">$_FILES</h3>'.mostrar($_FILES));
            print('<h3 style="margin-bottom: 16px">$_REQUEST</h3>'.mostrar($_REQUEST));
            print('<h3 style="margin-bottom: 16px">$_ENV</h3>'.mostrar($_ENV));
               
            ?>
        </main>
        <footer>
            <a href="../../index.html">Jesús Ferreras González</a>
            <a href="../indexProyectoTema5.php">Tema 5</a>
        </footer>
    </body>
</html>

<?php
    //Devuelve una tabla con los valores del array si no es vacio, en caso contrario devuelve 'Variable vacia'
    function mostrar($array) {
        if (!empty($array)) {
            $contenido = '<table>';
            foreach ($array as $clave => $valor) {
                $contenido .= "<tr><th>$clave</th><td>$valor</td></tr>";
            }
            $contenido .= '</table>';
            
            return $contenido;
        } else {
            return '<p>Variable vacía</p>';
        }
    }
?>