<?php

  include "establecer-sesion.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        // Comprobar si el token CSRF enviado en el formulario coincide con el token almacenado en la sesión
        if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) 
        {
            // El token es válido, procesar el formulario
            // Realizar la acción deseada 
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
                    $row = mysqli_fetch_object($resultado);//Trata la fila como un Objeto
                    //El objeto $row es de la clase StdClass

                    if ($row->password == $password)//Se comprueba la contraseña
                    {
                        $_SESSION['nombre'] = $row->nombre;
                        $_SESSION['apellidos'] = $row->apellidos;
                        header('Location:./inicio.php');
                    }
                    else//Contraseña Erronea
                    {
                        $_SESSION['error'] = "Contraseña Incorrecta";
                        header('Location:./index.php');
                    }
                    
                    $mysqli->close();

                }
            }
            else
            {
                $_SESSION['error'] = "Debes hacer login para poder acceder";
                header('Location:./index.php');
            }
        } 
        else 
        {
            // El token no es válido, posible ataque CSRF
            die("Solicitud no válida. Token CSRF no coincide.");// o mensaje en alert y redirección a index
        }
    }

    
    
