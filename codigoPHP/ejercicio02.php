<!doctype html>
<?php
/**
 * @author Jesus Ferreras
 * @since 2024/11/20
 * @version 2024/11/21
 */

    //Se importa el fichero con los parametros de conexion
    require_once '../config/confDB.php';
    
    $mensajeError = null;
    
    if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
        try {
            //Se abre la conexion
            $DB = new PDO(DSN, USUARIO, PASSWORD);
            
            //Se recoge el usuario con el codigo introducido
            $seleccion = $DB->prepare(<<<FIN
                select * from T01_Usuario
                    where T01_CodUsuario = :codigo
                    and T01_Password = sha2(:contrasena, 256)
                ;
            FIN);

            $seleccion->execute([
                ':codigo' => $_SERVER["PHP_AUTH_USER"],
                ':contrasena' => $_SERVER["PHP_AUTH_USER"].$_SERVER["PHP_AUTH_PW"]
            ]);

            $usuario = $seleccion->fetchObject();
                    
            //Si no existe el usuario
            if (!$usuario) {
                $mensajeError = '<p>Error de autenticación</p>';
            } else {
                //Se actualiza el numero de conexiones del usuario
                $actualizacion = $DB->prepare(<<<FIN
                    update T01_Usuario
                        set T01_NumConexiones = T01_NumConexiones+1,
                        T01_FechaHoraUltimaConexion = now()
                        where T01_CodUsuario = :codigo
                    ;
                FIN);
                        
                $actualizacion->execute([
                    ':codigo' => $_SERVER['PHP_AUTH_USER']
                ]);
            }
        } catch (Exception $ex) {
            //Se muestran el mensaje y codigo de error
            $mensajeError = '<p>Error: '.$ex->getMessage().'<br>Codigo: '.$ex->getCode().'</p>';
        } finally {
            //Se cierra la conexion
            unset($DB);
        }
    }
    
    //Si hay algun mensaje de error o el usuario o contrasena no estan definidos
    if (!is_null($mensajeError) || !(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))) {
        //Se pide la autenticacion
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
                    <?php
                        print($mensajeError);
                    ?>
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
        <title>Ejercicio02</title>
    </head>
    <body>
        <header>
            <h2>Desarrollo de un control de acceso con identificación del usuario basado en el uso de una tabla “Usuario” de la base de datos</h2>
        </header>
        <main>
            <?php
                print(
                    "<p>Bienvenido $usuario->T01_DescUsuario esta es la ".($usuario->T01_NumConexiones+1)." vez que se conecta.".
                    ($usuario->T01_NumConexiones>0? " Se conectó por última vez el $usuario->T01_FechaHoraUltimaConexion</p>" : "</p>")
                );
            ?>
        </main>
        <footer>
            <a href="../../index.html">Jesús Ferreras González</a>
            <a href="../indexProyectoTema5.php">Tema 5</a>
        </footer>
    </body>
</html>