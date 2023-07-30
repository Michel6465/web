<link rel="stylesheet" type="text/css" href="<?= asset('navbar.css') ?>">
<nav>
	<a href="<?= route('welcome') ?>" alt="Accueil"><img src="<?= asset('img/favicon-32x32.png') ?>" alt="logo"></a>
	<a href="<?= route('welcome') ?>" alt="Accueil">Accueil</a>
	<a href="<?= route('menu') ?>" alt="Menu">Menu</a>
	<a href="<?= route('portfolio') ?>" alt="test">Portfolio</a>
	<a href="<?= route('obli') ?>" alt="Jeu">Jeu</a>
	<a href="<?= route('test') ?>" alt="test">tests</a>
	<?php if ($_param['route'] = 'welcome'): ?>
		<div class="flex-end">
			<img id="audioButton" src="<?= asset('img/snow/play.svg') ?>">
			<audio id="audioPlayer" src="<?= asset('sound/welcome/GoT - King Of The North.mp3') ?>" hidden>Audio non chargé</audio>
			<img src="<?= asset('img/snow/snowflake.bmp') ?>" alt="snow">
		</div>
	<?php endif; ?>
</nav>
