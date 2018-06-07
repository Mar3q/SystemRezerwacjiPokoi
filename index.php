<?php
	session_start();
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: PanelKlienta.php');
		exit();
	}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<title>Serwis</title>
	<link rel="stylesheet" type="text/css" href="styl.css">
	<script src="akcje.js"></script> 
</head>

<body>
		<div id="naglowek">System rezerwacji pokoi</div>
			<form  id="formularzLogowania" action="zaloguj.php" method="post" id="logowanie">
				<input id="wprowadzanyText" type="text" name="login" class="form-control" placeholder="Email"  value="testowe@wp.pl" required autofocus>
				<input id="wprowadzanyText" type="password" name="haslo" class="form-control" placeholder="Hasło" value="testowe" required autofocus>
				<button id="zaloguj" class="btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
				<button id="zarejstruj" class=" btn-lg btn-warning btn-block" onclick="location.href='rejstracja.php'" id="przyciskRejstracji">Załóż bezpłatne konto</button>
			</form>
			
				<?php if(isset($_SESSION['bladLogowania']))	echo $_SESSION['bladLogowania']; ?>
				<?php unset($_SESSION['bladRejstracji']); unset($_SESSION['udanaRejstracja']);?>
				
				
				
				




	
</body>
</html>