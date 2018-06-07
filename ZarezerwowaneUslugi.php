<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	if ($_SESSION['user']=='admin')
	{
		header('Location: PanelRezerwacjiUslug.php');
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
            <div class="row">
			<p> <a id="powrot" href="PanelKlienta.php" class="btn "><</a></p>
                <table id="tabelaRezerwacje" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Imie</th>
                      <th>Nazwisko</th>
					  <th>Nazwa usługi</th>
					  <th>Termin</th>
					  <th>Funkcje</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = "SELECT rezerwacjaid, imie, nazwisko, nazwauslugi, termin
							FROM RezerwacjeUslug,Uzytkownik,Usluga
							WHERE RezerwacjeUslug.userid =  Uzytkownik.userid
							and RezerwacjeUslug.uslugaid = Usluga.uslugaid
							and Uzytkownik.email = '".$_SESSION['user']."'";
                   //$pdo->query("SET CHARSET utf8");
				   foreach ($pdo->query($sql) as $row) {			
                            echo '<tr>';

                            echo '<td>'. $row['imie'] . '</td>';
                            echo '<td>'. $row['nazwisko'] . '</td>';
							echo '<td>'. $row['nazwauslugi'] . '</td>';
							echo '<td>'. $row['termin'] . '</td>';
							echo '<td width=250>';  
                                echo ' ';         
								echo '<a id="anulujRezerwacje" class="btn " href="AnulujRezerwacjeUslugi.php?id='.$row['rezerwacjaid'].'&nazwauslugi='.$row['nazwauslugi'].'&termin='.$row['termin'].'">Anuluj Rezerwacje</a>';
                                echo '</td>';             
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
 
</body>
</html>