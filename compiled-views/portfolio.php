<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/functions.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/system/helpers/constants.php') ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Portfolio</title>
		<link rel="stylesheet" type="text/css" href="<?= asset('portfolio.css') ?>">
		<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-32x32.png') ?>" sizes="32x32" />
		<link rel="icon" type="image/x-icon" href="<?= asset('img/favicon-16x16.png') ?>" sizes="16x16" />
		<link rel="prefetch" as="image" href="<?= asset('img/underConstruction.jpg') ?>" />
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" ></script>
	</head>
	<body class="container min-vw-100 p-0">
		<div class="d-flex fullHeight overflow-hidden" id="presentation">
			<div class="d-flex flex-column">
				<div class="wow animate__animated animate__bounceInLeft">Louis Bouchereau</div>
				<div class="wow animate__animated animate__bounceInLeft animate__delay-1s">Développeur full stack</div>
			</div>
			<img class="position-absolute vw-100" src="<?= asset('img/portfolio/background.jpg') ?>" alt="">
		</div>
		
		<div class="d-flex fullHeight flex-column" id="competences">
			<h2 class="w-100 justify-content-center my-4">Principales compétences</h2>
			<div class="row justify-content-center mb-2">
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/javascript.png') ?>" alt="javascript">
					<span>Javascript</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/linux.png') ?>" alt="linux">
					<span>Linux</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/php.png') ?>" alt="php">
					<span>Php</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/bash.png') ?>" alt="bash">
					<span>Bash</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/c.png') ?>" alt="c">
					<span>C</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/python.png') ?>" alt="python">
					<span>Python</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/git.png') ?>" alt="git">
					<span>Git</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/apache.png') ?>" alt="apache">
					<span>Apache</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/laravel.png') ?>" alt="laravel">
					<span>Laravel</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/bootstrap.png') ?>" alt="bootstrap">
					<span>Bootstrap</span>
					<label></label>
				</div>
			</div>
			
			<h2 class="w-100 justify-content-center my-4">Compétences secondaires</h2>
			<div class="row row justify-content-center">
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/java.png') ?>" alt="java">
					<span>Java</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/springboot.png') ?>" alt="springboot">
					<span>Springboot</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/junit.png') ?>" alt="junit">
					<span>Junit 5</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/nodejs.png') ?>" alt="nodejs">
					<span>Nodejs</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/r.png') ?>" alt="r">
					<span>R</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/assembleur.png') ?>" alt="assembleur">
					<span>Assembleur</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/labview.png') ?>" alt="labview">
					<span>Labview</span>
					<label></label>
				</div>
				<div class="wow animate__animated animate__zoomIn">
					<img src="<?= asset('img/portfolio/keras.png') ?>" alt="keras">
					<span>Keras</span>
					<label></label>
				</div>
			</div>

			<div class="container-sm" id="contact">
				<h2 class="my-4">Contact</h2>
				<form class="my-4">
					<div class="w-50 mx-auto wow animate__animated animate__slideInLeft form-floating my-3">
						<input class="form-control" type="email" placeholder="bidon" required>
						<label>Votre email</label>
					</div>
					<div class="w-50 mx-auto wow animate__animated animate__slideInLeft form-floating my-3" id="mailMessage">
						<textarea class="form-control" placeholder="bidon" required></textarea>
						<label>Entrez votre message</label>
					</div>
					<div class="wow animate__animated animate__slideInLeft my-3">
						<button type="button" class="btn btn-dark" onclick="sendMail()">Envoyer</button>
					</div>
					<div class="wow animate__animated animate__slideInLeft">
						<span></span>
					</div>
				</form>
			</div>
		</div>
		
		
		
		<script>
			// Mail
			let contact = document.getElementById('contact');
		
			async function sendMail() {
				let msg = document.getElementById('mailMsg');
				let data = new Object();
				data['reply'] = contact.getElementByTagName('input')[0].value;
				data['msg'] = contact.getElementByTagName('input')[1].value;
				
				const response = await fetch("<?= ajax('SendMail.php') ?>",{
					method: "POST",
					body: JSON.stringify(data)
				});
				
				const res = await response.json();
				
				contact.getElementByTagName('span')[0].innerHTML = res;
			}

			// Animations
			for (let d of document.getElementsByClassName('fullHeight')) {
				d.style.height = window.screen.height+"px";
			}

			const initMailDelays = new Promise((resolve, reject) => {
				let inputs = document.getElementsByClassName('animate__slideInLeft');
				for (let i=0; i<inputs.length; i++) {
					inputs[i].dataset.wowDelay = (250*i) + "ms";
				}
				resolve();
			});

			const initCompetencesDelays = new Promise((resolve, reject) => {
				let competences = document.getElementsByClassName('animate__zoomIn');
				for (let i=0; i<competences.length; i++) {
					competences[i].dataset.wowDelay = (250*i) + "ms";
				}
				resolve();
			});

			Promise.all([initCompetencesDelays, initMailDelays]).then(() => {	new WOW().init() });			
		</script>
	</body>
</html>
