<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/functions.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/constants.php') ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Accueil</title>
		<link rel="stylesheet" type="text/css" href="<?= asset('welcome.css') ?>">
		<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-32x32.png') ?>" sizes="32x32" />
		<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-16x16.png') ?>" sizes="16x16" />
	</head>
	<body>
		<nav>
			<a href="<?= route('welcome') ?>" alt="Accueil"><img src="<?= asset('img/favicon-32x32.png') ?>" alt="logo"></a>
			<a href="<?= route('welcome') ?>" alt="Accueil">Accueil</a>
			<a href="<?= route('menu') ?>" alt="Menu">Menu</a>
			<div class="flex-end">
				<img id="audioButton" src="<?= asset('img/snow/play.svg') ?>">
				<audio id="audioPlayer" src="<?= asset('sound/welcome/GoT - King Of The North.mp3') ?>" hidden>Audio non chargé</audio>
				<img src="<?= asset('img/snow/snowflake.bmp') ?>" alt="snow">
			</div>
		</nav>
		
		<canvas id="canvas">Mon canvas</canvas>
		
		<span id="warning" hidden>Assurez-vous d'avoir activé le son</span>
		<script src="<?= asset('welcome.js') ?>" type="module"></script>
	</body>
</html>
