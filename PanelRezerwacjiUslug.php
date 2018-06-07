<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
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
 <style>
 /* body {background: url("notatka.jpg") no-repeat fixed center;  opacity: 0.9;} */
#busun,#bodczytaj,#baktualizuj {  width: 20vw; height: 3em;}
 </style>
    <div class="container">
             <br>
            <div class="row">
			<p>
                    
					<a id="powrot" href="PanelPracownika.php" class="btn "><</a>
                </p>
                <table id="tabelaRezerwacje" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <!--<th>Numer Usługi</th>-->
					  <th>Imie</th>
                      <th>Nazwisko</th>
					  <th>Nazwa Usługi</th>
					  <th>Termin</th>
					  <th>Funkcje</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				   //$sql = 'SELECT * FROM customers ORDER BY id DESC';
				   $user = $_SESSION['user']; //aktualny użytkownik
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = "SELECT rezerwacjaid, imie, nazwisko, nazwauslugi, termin
							FROM RezerwacjeUslug,Uzytkownik,Usluga
							WHERE RezerwacjeUslug.userid = Uzytkownik.userid 
							and RezerwacjeUslug.uslugaid = Usluga.uslugaid";
                   $pdo->query("SET CHARSET utf8");
				   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            //echo '<td>'. $row['rezerwacjaid'] . '</td>';
                            echo '<td>'. $row['imie'] . '</td>';
                            echo '<td>'. $row['nazwisko'] . '</td>';
							echo '<td>'. $row['nazwauslugi'] . '</td>';
							echo '<td>'. $row['termin'] . '</td>';
							echo '<td width=250>';
                                
                                echo ' ';
                                echo '<a id="anulujRezerwacje" class="btn btn-danger" href="AnulujRezerwacjeUslugi.php?id='.$row['rezerwacjaid'].'&nazwauslugi='.$row['nazwauslugi'].'&termin='.$row['termin'].'">Anuluj Rezerwacje</a>';
                                echo '</td>';
                               
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>

</html>