<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
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
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<title>Serwis</title>
	<link rel="stylesheet" type="text/css" href="styl.css">
	<script src="akcje.js"></script> 
</head>
 <body>

    <div class="container">
            <br>
            <div class="row">
				<p>
                    <a id="powrot" href="PanelPracownika.php" class="btn "><</a>
                    <a id="dodaj" href="dodajUsluge.php" class="btn ">Dodaj Usługe</a>
					<div style="color:red; font-size : 2.5vw;" >
					<?php if(isset($_SESSION['uslugaZajeta']))	echo $_SESSION['uslugaZajeta']; ?>
					<?php unset($_SESSION['uslugaZajeta']);?>
					
					<?php if(isset($_SESSION['nazwaUslugiZajeta']))	echo $_SESSION['nazwaUslugiZajeta']; ?>
					<?php unset($_SESSION['nazwaUslugiZajeta']);?>
			
					</div>
                </p>
                <table id="tabela" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nazwa uslugi</th>
					  <th>Cena(zl)</th>
					  <th>Dostępna</th>
					  <th>Funkcje</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				   //$sql = 'SELECT * FROM customers ORDER BY id DESC';
				   $user = $_SESSION['user']; //aktualny użytkownik
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = "SELECT * FROM Usluga ";
                   $pdo->query("SET CHARSET utf8");
				   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['nazwauslugi'] . '</td>';
                            echo '<td>'. $row['cena'] . '</td>';
							echo '<td>'. $row['dostepny'] . '</td>';
							echo '<td width=200>';
                                
                                
                                echo ' ';
                                echo '<a id="anulujRezerwacje" class="btn btn-danger" href="usunUsluge.php?id='.$row['nazwauslugi'].'">Usuń usługe</a>';
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