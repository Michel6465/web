<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/functions.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/constants.php') ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Accueil</title>
		<link rel="stylesheet" type="text/css" href="<?= asset('welcome.css') ?>">
		<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-32x32.png') ?>" sizes="32x32" />
		<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-16x16.png') ?>" sizes="16x16" />
		<link rel="prefetch" as="image" href="<?= asset('img/underConstruction.jpg') ?>" />
	</head>
	<body>
		<?php $_param=['route' => 'welcome']; require_once 'navbar.php'; unset($_param); ?>
		
		<canvas id="canvas">Mon canvas</canvas>
		
		<span id="warning" hidden>Assurez-vous d'avoir activé le son</span>
		<script src="<?= asset('welcome.js') ?>" type="module"></script>
	</body>
</html>
