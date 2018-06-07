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
		
		  
    }
  
    if ( !(empty($_POST['id']))) {
        // keep track post values
        $id = $_POST['id'];
		$termin = $_POST['termin'];
       
	   
	   $hour= date('H:i:s');
	   $termin2 = $termin." ".$hour;
	   
	   
	   
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
        
		
		$sql = "UPDATE Usluga set dostepny = 'nie' WHERE nazwauslugi = ?"; //usuwam z wolnych pokoi
		$q = $pdo->prepare($sql);
        $q->execute(array($id));
		
		
		$sql2 = "INSERT INTO RezerwacjeUslug (  uslugaid, termin, userid) VALUES((SELECT uslugaid from Usluga WHERE nazwauslugi = ?),?,(SELECT userid from Uzytkownik WHERE Uzytkownik.email = ?))"; //dodaje do rezerwacji
	    $q2 = $pdo->prepare($sql2);
        $q2->execute(array($id,$termin2,$user));
		
        Database::disconnect();
        header("Location: WolneUslugi.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	
	<script src="jquery-3.2.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<title>Serwis</title>
	<link rel="stylesheet" type="text/css" href="styl.css">
	<script src="akcje.js"></script> 
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	  
	<script>
		$( function() {
		$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		} );
  </script>
  
 
		
</head>
 
<body>



<div id="naglowekRezerwacji">Zarezerwuj Usługę</div>
			<form id="formularzRezerwacji"  action="ZarezerwujUsluge.php" method="post">
				<label id="lebel">Nazwa Usługi:</label>
				<input type="text" name="id" readonly value="<?php echo $id;?>"/>
				<label id="lebel">Termin:</label>
				<input  type="text" name="termin" class="datepicker" required />
				<button id="zaloguj"  class="btn btn-lg btn-primary btn-block" type="submit">Potwierdź</button>
				<button id="zarejstruj" type="button" class="btn btn-lg btn btn-danger btn-block" onclick="location.href='WolneUslugi.php'">Rezygnuj</button>
			</form>

                     
					 
                   

  </body>
</html>