<?php
include "establecer-sesion.php";
$_SESSION = [];
session_destroy();
/***HABRÍA QUE DESTRUIR EXPLICITAMENTE LA COOKIE
 * DE SESION Y OTRAS POTENCIALMENTE PELIGROSAS
 */
header('Location:./index.php');