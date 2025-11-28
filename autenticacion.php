<?php
    session_start();//hay que hacer que sea segura

    if (isset($_POST['identi']))
    {
        $host = 'localhost';
        $usuario = 'root';  //inseguro ***
        $password = '';     //inseguro ***
        $baseDatos = 'login-php';

        $mysqli = new mysqli($host, $usuario, $password, $baseDatos);

        if ($mysqli->connect_error)
        {
        //die('Error de conexión: ' .$mysqli->connect_error);
        $_SESSION['error'] = "No se h podido comprobar usuario en este momento. Vuelve a intentarlo más tarde";
        header('Location:./index.php');
        }

        // habria que comprobar si hubo un intento de XSS y
        // contestar con un mensaje de error reprobatorio
        $usuario = htmlspecialchars($_POST['identi']);
        $password = htmlspecialchars($_POST['pass']);

        // nos queda: hacer la query
        // redireccionar a index si no está o la contraseña erronea
        // rediccionar a inicio.php si todo es correcto

        $querySQL = "SELECT * FROM usuarios where idusuario = '". $usuario ."'";
        $resultado = $mysqli->query($querySQL);

        if ($resultado->num_rows == 0) //El usuario no existe
        {
            $_SESSION['error'] = "Usuario incorrecto";
            header('Location:./index.php');
        }
        else //El usuario si existe
        {
            $_SESSION['error'] = "Usuario encontrado";
            header('Location:./index.php');
        }
    }
    else
    {
        $_SESSION['error'] = "Debes hacer login para poder acceder";
        header('Location:./index.php');
    }
    
