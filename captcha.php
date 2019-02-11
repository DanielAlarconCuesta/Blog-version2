<?php
	session_start();

	function generateRandomText() {
		$length = rand(3, 5);

		$code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$code = substr(str_shuffle($code), 0, $length);
		$_SESSION["captcha"] = $code;

		return $code;
	}

	function printCode($image, $code) {
		$width = 30;
		$height = 60;

		for ($i=0; $i<strlen($code); $i++) {
			$letter = $code[$i];
			$sizeFont = rand(30, 35);
			$angle = rand(-25, 25);
			$linesAmount = rand(3, 5);

			$width+=30;

			$font = rand(1, 3);
			switch($font) {
				case 1:
					$font = dirname(__FILE__) . '/fonts/AmaticSC-Bold.ttf';
					break;
				case 2:
					$font = dirname(__FILE__) . '/fonts/ShadowsIntoLight.ttf';
					break;
				case 3:
					$font = dirname(__FILE__) . '/fonts/ZCOOLKuaiLe-Regular.ttf';
					break;
			}

			$blanco = imagecolorallocate($image, 255, 255, 255);
			imagettftext($image, $sizeFont, $angle, $width, $height, $blanco, $font, $letter);
		}
	}

	function printLines($image) {

		$linesAmount = rand(3, 5);

		for ($i=1; $i<=$linesAmount; $i++) {
			$startX = rand(0, 150);
			$endX = rand($startX, 300);
			$startY = rand(0, 60);
			$endY = rand($startY, 120);
			$blanco = imagecolorallocate($image, 255, 255, 255);
			imageline($image, $startX, $startY, $endX, $endY, $blanco);
		}
	}


	// Creación y configuración del lienzo
	$width = 270;
	$height = 120;

	$image = imagecreatetruecolor($width, $height);
	$blanco = imagecolorallocate($image, 255, 255, 255);
	$azul = imagecolorallocate($image, 0, 0, 64);

	// Se dibuja la imagen
	imagefill($image, 0, 0, $azul);


	/*imageline($image, 0, 0, $width, $height, $blanco);
	imagestring($image, 4, 50, 150, 'DWES', $blanco);*/
	// Generación de la imagen.

	$code = generateRandomText();
	printCode($image, $code);
	printLines($image);

	header('content-type: image/png');
	imagepng ($image);
	// Liberamos la imagen de memoria.
	imagedestroy($image);

 ?>
