<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/functions.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/constants.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<link rel="stylesheet" type="text/css" href="<?= asset('welcome.css') ?>">
	<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-32x32.png') ?>" sizes="32x32" />
	<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-16x16.png') ?>" sizes="16x16" />
</head>
<body>
	<nav>
		<a href="<?= route('welcome') ?>" alt="Accueil"><img height="" src="<?= asset('img/favicon-32x32.png') ?>" alt="logo"></a>
		<a href="<?= route('welcome') ?>" alt="Accueil">Accueil</a>
		<a href="<?= route('menu') ?>" alt="Menu">Menu</a>
	</nav>
	
	<img class="underConstruction" src="<?= asset('img/underConstruction.jpg') ?>" alt="Under construction">
	
	
</body>
</html>
