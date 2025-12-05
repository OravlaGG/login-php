<?php
include "establecer-sesion.php";
$_SESSION = [];
session_destroy();
/***HABRÍA QUE DESTRUIR EXPLICITAMENTE LA COOKIE
 * DE SESION Y OTRAS POTENCIALMENTE PELIGROSAS
 */
// envía como Set-Cookie para invalidar la cookie de sesión
if (isset($_COOKIE[session_name()])) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
}
header('Location:./index.php');