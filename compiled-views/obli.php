<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/functions.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/constants.php') ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Accueil</title>
		<link rel="stylesheet" type="text/css" href="<?= asset('obli.css') ?>">
		<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-32x32.png') ?>" sizes="32x32" />
		<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-16x16.png') ?>" sizes="16x16" />
	</head>
	<body>
		<?php $_param=['route' => 'obli']; require_once 'navbar.php'; unset($_param); ?>
		
		<canvas id="canvas">Mon canvas</canvas>
		
		<script src="<?= asset('obli.js') ?>" type="module"></script>
	</body>
</html>
