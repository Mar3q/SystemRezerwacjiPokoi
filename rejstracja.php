<?php
	session_start();
	
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

<div id="naglowekRejstracji">Panel Rejstracji</div>


    <form id="formularzRejstracji"  action="zarejstruj.php" method="post" id="rejstracja">
        <input id="wprowadzanyText" type="email" name="nickRejstracja" class="form-control" placeholder="Email:" required autofocus>
        <input id="wprowadzanyText" type="password" name="hasloRejstracja"  pattern=".{5,25}" class="form-control" placeholder="Hasło: minimum 5 znaków" required autofocus>
        <input id="wprowadzanyText" type="text" name="imieRejstracja"  pattern="[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ]{1,25}"  class="form-control" placeholder="Imie:" required autofocus>
        <input id="wprowadzanyText" type="text" name="nazwiskoRejstracja" pattern="[a-zA-Z]{1,25}" class="form-control" placeholder="Nazwisko:" required autofocus>
        <input id="wprowadzanyText" type="text" pattern="^[1-9]{1}\d{8}$"  name="telefonRejstracja" class="form-control" placeholder="Telefon: xxxxxxxxx" required autofocus>
        <button id="zaloguj" class="btn btn-lg btn-primary btn-block" type="submit">Zarejstruj</button>
        <button id="zarejstruj" type="button" class="btn btn-lg btn btn-warning btn-block" onclick="location.href='index.php'">Powrót do logowania</button>
    </form> 
	<div id="bledyRejstracji">
			<?php if(isset($_SESSION['udanaRejstracja']))	echo $_SESSION['udanaRejstracja']; ?>
			<?php if(isset($_SESSION['bladRejstracji']))	echo $_SESSION['bladRejstracji']; ?>
	</div>








</body>
</html>