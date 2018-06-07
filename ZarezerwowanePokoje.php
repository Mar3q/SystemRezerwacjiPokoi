<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
			if ($_SESSION['user']=='admin')
	{
		header('Location: PanelRezerwacjiPokoi.php');
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
					  <th>Numer pokoju</th>
					  <th>Termin od:</th>
					   <th>Termin do:</th>
					   <th>opłacono:</th>
					  <th>Funkcje</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = "SELECT rezerwacjaid, imie, nazwisko, numerpokoju, termin,termin2,oplacono
							FROM RezerwacjePokoi,Uzytkownik,Pokoj
							WHERE RezerwacjePokoi.userid =  Uzytkownik.userid
							and RezerwacjePokoi.pokojid = Pokoj.pokojid
							and Uzytkownik.email = '".$_SESSION['user']."'";
                   $pdo->query("SET CHARSET utf8");
				   foreach ($pdo->query($sql) as $row) {
						
                            echo '<tr>';
							
                            $_SESSION['numerpokoju'] = $row['numerpokoju'];
                            echo '<td>'. $row['imie'] . '</td>';
                            echo '<td>'. $row['nazwisko'] . '</td>';
							echo '<td>'. $row['numerpokoju'] . '</td>';
							echo '<td>'. $row['termin'] . '</td>';
							echo '<td>'. $row['termin2'] . '</td>';
							echo '<td>'. $row['oplacono'] . '</td>';
							
							echo '<td width=250>';
                              
                                echo ' ';
							
                                echo '<a id="anulujRezerwacje" class="btn " href="AnulujRezerwacjePokoju.php?id='.$row['rezerwacjaid'].'&numerpokoju='.$row['numerpokoju'].'&termin='.$row['termin'].'">Anuluj Rezerwacje</a>'; //działa!
                                 
								echo '<a id="zarezerwuj" class="btn" href="zaplac.php?id='.$row['rezerwacjaid'] .'">Zapłać</a>';
								echo '</td>';
								echo ' ';
 
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
 
</body>
</html>