
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
		$termin2 = $_POST['termin2'];
		  echo $user;
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE Pokoj set dostepny = 'nie' WHERE numerpokoju = ?"; //usuwam z wolnych pokoi
		$q = $pdo->prepare($sql);
        $q->execute(array($id));
		$sql2 = "INSERT INTO RezerwacjePokoi (  pokojid, termin,termin2, userid) VALUES((SELECT pokojid from Pokoj WHERE numerpokoju = ?),?,?,(SELECT userid from Uzytkownik WHERE Uzytkownik.email = ?))"; //dodaje do rezerwacji
	    $q2 = $pdo->prepare($sql2);
        $q2->execute(array($id,$termin,$termin2,$user));
        Database::disconnect();
        header("Location: WolnePokoje.php");     
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
	
	      <link data-require="jqueryui" data-semver="1.10.0" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />
    <link rel="stylesheet" href="style.css" />
    <script data-require="jquery" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="jqueryui" data-semver="1.10.0" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>
    <script src="script.js"></script>
    <script src="http://www.datejs.com/build/date.js"></script>
	  
 
  
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
	<style>
      #datevalid {
        background: lightgreen;
        display: none;
      }
      
      #datenotvalid{
        background: red;
        display: none;
      }
	  
	  #datevalid2 {
        background: lightgreen;
        display: none;
      }
      
      #datenotvalid2 {
        background: red;
        display: none;
      }
	  
	  
	  
	  
    </style>
	
    <script>
      $(function() {
        $( "#delivery_date" ).datepicker({ 
          dateFormat: "yy-mm-dd",
        });
      });
	  $(function() {
        $( "#delivery_date2" ).datepicker({ 
          dateFormat: "yy-mm-dd",
        });
      });
	  
      var walidacja = false;
	  var walidacja2 = false;
	  var start3;
	  
	  
      function validate() {
        var enteredDate = $("#delivery_date").prop("value");
        var parsed = Date.parse(enteredDate); 
        var start = Date.today(); 
		start3 = start;
        var end = Date.today().add(21).days(); 
		
        console.log(parsed);
        console.log(start); 
        console.log(end);
        if (parsed.between(start, end)) {
			
          $("#datevalid").fadeIn(200);
          $("#datenotvalid").hide();
		  walidacja = true;
		  console.log(walidacja);
		   
		  
        } else {
          $("#datenotvalid").fadeIn(200);
          $("#datevalid").hide();
		  document.getElementById("formularzRezerwacji").reset(); 
        }
		
      }
	  
	   function validate2() {
        var enteredDate = $("#delivery_date2").prop("value");
        var parsed = Date.parse(enteredDate); 
        var start = Date.today().add(1).days(); 
        var end = Date.today().add(21).days(); 
        console.log(parsed);
        console.log(start); 
        console.log(end);
		console.log(start3);
        if (parsed.between(start, end)) {
          $("#datevalid2").fadeIn(200);
          $("#datenotvalid2").hide();
		  walidacja2 = true;
		  console.log(walidacja2);
		  
        } else {
          $("#datenotvalid2").fadeIn(200);
          $("#datevalid2").hide();
			document.getElementById("formularzRezerwacji").reset(); 
        }
      }
	  
	 
	  
    </script>
	
    
   
  
	
	
	
	


		<div id="naglowekRezerwacji">Zarezerwuj Pokój</div>
			<form id="formularzRezerwacji"  action="ZarezerwujPokoj.php" method="post">
				<label id="lebel">Numer Pokoju:</label>
				<input type="text" name="id" readonly value="<?php echo $id;?>"/>
				<label id="lebel">Termin od:</label>
				<input  type="text" name="termin" id="delivery_date"  required onchange="validate()" />
					<div id="datevalid">Data prawidłowa</div>
					<div id="datenotvalid">Data nieprawidłowa</div>
				<label id="lebel">Termin do:</label>
				<input  type="text" name="termin2"id="delivery_date2"  required onchange="validate2()" />
					<div id="datevalid2">Data prawidłowa</div>
					<div id="datenotvalid2">Data nieprawidłowa</div>
				<button id="zaloguj"  class="btn btn-lg btn-primary btn-block" type="submit">Potwierdź</button>
				<button id="zarejstruj" type="button" class="btn btn-lg btn btn-danger btn-block" onclick="location.href='WolnePokoje.php'">Rezygnuj</button>
			</form>
    
	</div>
  </body>
</html>