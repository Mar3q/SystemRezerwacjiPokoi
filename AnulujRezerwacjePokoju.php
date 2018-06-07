<?php
	session_start();
?>
<?php
    require 'database.php';
	$id = 0;
	 $termin = 0;  //musza byc jakoś przechwycone ?
     $user=$_SESSION['user']; // jest zalogowany cały czas, dlatego zmienna sesji

    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
		$termin = $_REQUEST['termin'];
    }
	if ( !empty($_GET['numerpokoju'])) {
        $numerpokoju = $_REQUEST['numerpokoju'];
    }
	
     
    if ( !(empty($_POST['numerpokoju']))) {
        // keep track post values
        
		$numerpokoju = $_POST['numerpokoju'];
		$id = $_POST['id'];
        $termin = $_POST['termin'];
		

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "UPDATE Pokoj set dostepny = 'tak' WHERE numerpokoju = ?"; //dodaje do wolnych pokoi
		//USSUNAC Z REZERWACJI!! ŻEBY NIE REZERWOWAC TYCH SAMYCH POKOI
		$q = $pdo->prepare($sql);
        $q->execute(array($numerpokoju));
		
		$sql2 = "DELETE FROM RezerwacjePokoi WHERE rezerwacjaid = ?"; //usunuecie z rezerwacji
	    $q2 = $pdo->prepare($sql2);
        $q2->execute(array($id));
		
        Database::disconnect();
        header("Location: ZarezerwowanePokoje.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Serwis</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" type="text/css" href="styl.css">
	<script src="akcje.js"></script> 
	
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
</head>
<body>
			<div id="naglowekRezerwacji">Anuluj Rezerwacje</div>
				<form id="formularzRezerwacji"  action="AnulujRezerwacjePokoju.php" method="post">
					<label id="lebel">Numer Pokoju:</label>
					<input type="text" name="numerpokoju" readonly value="<?php echo $numerpokoju;?>"/>
					<label id="lebel">Termin:</label>
					<input type="text" name="termin" readonly value="<?php echo $termin;?>"/>
					<input type="hidden" name="id" readonly value="<?php echo $id;?>"/>
					
					<button id="zaloguj"  class="btn btn-lg btn-primary btn-block" type="submit">Potwierdź</button>
					<button id="zarejstruj" type="button" class="btn btn-lg btn btn-danger btn-block" onclick="location.href='ZarezerwowanePokoje.php'">Rezygnuj</button>
				</form>

  </body>
</html>