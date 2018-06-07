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
	<link rel="stylesheet" type="text/css" href="styl2.css">
	<script src="akcje.js"></script> 
</head>
 <body>

    <div class="container">
             <br>
            <div class="row">
			<p>
					<a id="powrot" href="PanelPracownika.php" class="btn "><</a>
                </p>
                <table id="tabelaRezerwacjePokoi" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                     <!-- <th>Numer Rezerwacji</th> -->
					  <th>Imie</th>
                      <th>Nazwisko</th>
					  <th>Numer Zarezerwowanego pokoju</th>
					  <th>Termin od:</th>
					  <th>Termin do:</th>
					  <th>opłacono:</th>
					  <th>Funkcje</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				   //$sql = 'SELECT * FROM customers ORDER BY id DESC';
				   $user = $_SESSION['user']; //aktualny użytkownik
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = "SELECT rezerwacjaid, imie, nazwisko, numerpokoju, termin,termin2,oplacono
							FROM RezerwacjePokoi,Uzytkownik,Pokoj
							WHERE RezerwacjePokoi.userid = Uzytkownik.userid 
							and RezerwacjePokoi.pokojid = Pokoj.pokojid";
                   $pdo->query("SET CHARSET utf8");
				   foreach ($pdo->query($sql) as $row) {
						
                            echo '<tr>';
                            //echo '<td>'. $row['rezerwacjaid'] . '</td>';
                            echo '<td>'. $row['imie'] . '</td>';
                            echo '<td>'. $row['nazwisko'] . '</td>';
							echo '<td>'. $row['numerpokoju'] . '</td>';
							echo '<td>'. $row['termin'] . '</td>';
							echo '<td>'. $row['termin2'] . '</td>';
							echo '<td>'. $row['oplacono'] . '</td>';
							echo '<td width=250>';
                              
                                echo ' ';
                                 echo '<a id="anulujRezerwacje" class="btn btn-danger" href="AnulujRezerwacjePokoju.php?id='.$row['rezerwacjaid'].'&numerpokoju='.$row['numerpokoju'].'&termin='.$row['termin'].'">Anuluj Rezerwacje</a>';
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