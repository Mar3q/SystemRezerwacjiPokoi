<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	if ($_SESSION['user']!='admin')
	{
		header('Location: PanelKlienta.php');
		//exit();
	}
	
?>
<!DOCTYPE html>
<html lang="en">
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
 
 
		<div id="naglowekPanelAdmina">
			<div>
				<h4 id="h4"><?php echo "<p id='powitanieAdmina'>Witaj w Panelu Admina ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';?>
				</h4>
			</div>
		</div>
		
			<div class="dropdown">
				<button class="dropbtn">Zarządzaj !</button>
					<div class="dropdown-content">
						<a href="PanelPokoi.php">Pokojami</a>
						<a href="PanelUslug.php">Usługami</a>
						<a href="PanelRezerwacjiPokoi.php">Rezerwacjami Pokoi</a>
						<a href="PanelRezerwacjiUslug.php">Rezerwacjami Usług</a>
						<!--<a href="">Profilem</a>-->
					</div>	
			</div>
			


			
						
				
  </body>
</html>