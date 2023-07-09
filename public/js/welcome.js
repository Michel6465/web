// Global variables ========================================================
const NB_SNOWBALLS = 50;
const MIN_SPEED_BALL_CREATION = 1000/NB_SNOWBALLS; // ms
const SNOWBALL_RADIUS = 5;
const SPEED = 10;
const FPS = 50;
const PATH = "./public/img/snow/";

var snow = new Image(); snow.src = PATH+"snowflake.bmp";
var srcPlay = PATH+"play.svg";
var srcPause = PATH+"pause.svg";
var audioPlayer = document.getElementById('audioPlayer');
var audioButton = document.getElementById('audioButton');

var bgImage = new Image(); bgImage.src = PATH+"snow_background.jpg";
var bgImageWidth;
var bgImageHeight;
var bgImageX;
var bgImageY;
var bgTransparency = 0;
var lastBgTransparency = 0;
var bgImageBlur = 0;

var previousTime;

var canvas = document.getElementById('canvas');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
var ctx = canvas.getContext('2d');

window.addEventListener('DOMContentLoaded', init);

// Program start ===========================================================
function init () {
	window.addEventListener('resize', resizeCanvas, false);
	
	for (let i=0; i<NB_SNOWBALLS; i++) {
		Game.addSnowball();
	}
	console.log('init');
	Game.createSnowballs(gaussRandom(MIN_SPEED_BALL_CREATION, 2));
	calculateBgPos();
	
	previousTime = performance.now()-1;
	window.requestAnimationFrame(main); // Start the cycle
}

// Start the program
function main(timestamp) {
	if (previousTime+1/FPS < timestamp) {
		// Calculate the new state
		Game.updateWind();
		for (let snowball of Game.snowballs) {
			snowball.update();
		}
		
		// Draw the current state
		// Slightly larger because when the snowballs "fall" at the bottom, they remain displayed
		ctx.clearRect(-20, -20, Game.width+40, Game.height+40);
		
		// Black background
		ctx.fillStyle = "black";
		ctx.fillRect(-20, -20, Game.width+40, Game.height+40);
		
		// Eventually background image according to music
		if (bgTransparency != 0 || (lastBgTransparency<0.5 && bgTransparency == 0)) {
			ctx.globalAlpha = bgTransparency;
			ctx.filter = 'blur('+bgImageBlur+'px)';
			ctx.drawImage(bgImage, bgImageX, bgImageY, bgImageWidth, bgImageHeight);
			ctx.globalAlpha = 1;
			ctx.filter = 'blur(0px)';
		}
		
		// Render snowflakes
		for (let snowball of Game.snowballs) {
			snowball.draw();
		}
	}
	
	window.requestAnimationFrame(main);
}

function resizeCanvas() {
	canvas.width = window.innerWidth;
	canvas.height = window.innerHeight;
	Game.width = canvas.width;
	Game.height = canvas.height;
	calculateBgPos();
}

// Objects ===============================================================
// Game object
var Game = {
	width: canvas.width,
	height: canvas.height,
	wind: new Wind(),
	previousWind: new Wind(),
	snowballs: [],
	addSnowball (x) {
		this.snowballs.push(new Snowball(x));
	},
	removeSnowball (index) {
		this.snowballs[index] = null;
		this.snowballs.splice(index, 1);
	},
	createSnowballs (time) {
		this.addSnowball(0);
		setTimeout (
			() => { this.createSnowballs(rand(MIN_SPEED_BALL_CREATION)); },
			time
		);
	},
	updateWind () {
		if (this.wind.start + this.wind.duration < performance.now()) {
			this.previousWind = this.wind;
			this.wind = new Wind();
		}
	}
};

// Define the Snowball object
function Snowball (y) {
	this.x = rand(-1/3*Game.width, 4/3*Game.width);
	this.y = y ?? rand(Game.height);
	this.vx = rand(-2*SPEED, 2*SPEED);
	this.vy = rand(8*SPEED,16*SPEED);
	this.ax = 0;
	this.ay = 0.1*SPEED;
	this.nextRand = 0;
	this.radius = gaussRandom(SNOWBALL_RADIUS, 3, true);
	
	this.update = function () {
		this.clean();
		let durationRatio = (performance.now() - Game.wind.start) / Game.wind.duration;
		let calcWindx = Game.wind.vx*(1-durationRatio) + Game.previousWind.vx*durationRatio;
		let calcWindy = Game.wind.vy*(1-durationRatio) + Game.previousWind.vy*durationRatio;
		this.x += (this.vx + calcWindx) * (this.radius/SNOWBALL_RADIUS) / 100;
		this.y += (this.vy + calcWindy) * (this.radius/SNOWBALL_RADIUS) / 100;
		this.vx += this.ax; // Refreshes when resetting vx, à réfléchir
		this.vy += this.ay;
		if (this.nextRand == 0) {
			this.nextRand = rand(5,10);
			this.vx += rand(-1*SPEED, 1*SPEED);
		} else {
			this.nextRand--;
		}
		let delta = rand(-0.1, 0.1);
		if (delta + this.radius < 1) this.radius = 3;
		else if (delta + this.radius > 8) this.radius = 8;
		else this.radius += delta;
	}
	
	this.draw = function () {
		ctx.drawImage(snow, this.x, this.y, this.radius, this.radius);
	}
	
	this.clean = function () {
		if (this.y > Game.height+this.radius) {
			Game.removeSnowball(Game.snowballs.indexOf(this));
		}
	}
}

// Define the Wind object
function Wind () {
	this.vx = rand(-20, 20);
	this.vy = rand(10);
	this.duration = rand(20000); // 10 sec
	this.start = performance.now();
}

// Music & interaction ===========================================================
// Onclick sur musique: changement bouton play/pause
audioButton.onclick = () => {
	if (audioPlayer.paused) {
		audioPlayer.play();
		audioButton.src = srcPause;
		calculateBgPos();
	} else {
		audioPlayer.pause();
		audioButton.src = srcPlay;
	}
}

audioPlayer.onended = () => { audioButton.src = srcPlay; }

// Show background according to music
// Music duration: 1:28
// bgTransparency 0 -> 1. '35' < '45' -- '1:05' > '1:20'
// bgImageBlur 0 -> +inf
audioPlayer.ontimeupdate = () => {
	let currentTime = audioPlayer.currentTime;
	if (currentTime < 80) {
		lastBgTransparency = bgTransparency;
		
		if (currentTime < 25) bgTransparency = 0;
		else if (currentTime < 45.25) bgTransparency = ((currentTime-25)/21)**1.5;
		else if (currentTime < 65) bgTransparency = 1;
		else bgTransparency = 1 - (((currentTime-65)/15)**0.5);
		
		if (currentTime < 45.25) bgImageBlur = 10;
		else bgImageBlur = 0;
	}
}

// Calculate background image position and blur when the window is resized
function calculateBgPos () {
	if (bgImage.height/Game.height > bgImage.width/Game.width) {
		bgImageHeight = Game.height;
		bgImageWidth = Game.width*(Game.height/bgImage.height);
		bgImageX = (Game.width - bgImageWidth) / 2;
		bgImageY = 0;
	} else {
		bgImageWidth = Game.width;
		bgImageHeight = Game.height*(Game.width/bgImage.width);
		bgImageX = 0;
		bgImageY = (Game.height - bgImageHeight) / 2;
	}
}

// Create html and js modal

// Utilities ===================================================================
// min included, max excluded, not excluded. If only min is provided, use rand(0, min)
function rand (min, max, not) {
	if (typeof min === undefined) {
		min = 0;
		max = 1;
	}
	
	if (max === undefined) {
		max = min;
		min = 0;
	}
	
	let ret;
	let i=0;
	do {
		ret = parseFloat((Math.random() * (max - min) + min).toFixed(4));
		i++;
	} while (ret == not && i<200);
	
	return ret;
}

// Generates a random number with a gaussian distribution using the Box-Muller transformer
function gaussRandom (mu, sigma, positive) {
	let epsilon = 0.0001;

	if (mu === undefined) {
		mu = 0;
		sigma = 1;
	} else if (sigma === undefined) {
		sigma = 1;
	}

    //create two random numbers, make sure u1 is greater than epsilon
    let u1, u2;
    do {
        u1 = Math.random();
    } while (u1 <= epsilon);
    u2 = Math.random();

    //compute z0 and z1
    let mag = sigma * Math.sqrt(-2.0 * Math.log(u1));
    let z0  = mag * Math.cos(2*PI * u2) + mu;
    // let z1  = mag * Math.sin(2*PI * u2) + mu;
    
    if (positive) z0 = Math.abs(z0);

    return z0;
}

// Global variable
var PI = Math.PI;
