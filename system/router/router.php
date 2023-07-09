<?php

$request = $_SERVER['REQUEST_URI'];
$viewsDirectory = $_SERVER['DOCUMENT_ROOT'] . '/compiled-views';

switch ($request) {

	case '':
	case '/':
	case '/welcome':
		require "$viewsDirectory/welcome.php";
		break;

	case '/menu':
		require "$viewsDirectory/menu.php";
		break;

	default:
		http_response_code(404);
		require "$viewsDirectory/404.php";
		break;
}
?>
