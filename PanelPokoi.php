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
    <div class="container">
            <br>
            <div class="row">
			<p>
			        <a id="powrot" href="PanelPracownika.php" class="btn "><</a>
                    <a id="dodaj" href="dodajPokoj.php" class="btn ">Dodaj Pokój</a>
					<div style="color:red; font-size : 2.5vw;" >
					<?php if(isset($_SESSION['pokojZajety']))	echo $_SESSION['pokojZajety']; ?>
					<?php unset($_SESSION['pokojZajety']);?>
					<?php if(isset($_SESSION['numerPokojuZajety']))	echo $_SESSION['numerPokojuZajety']; ?>
					<?php unset($_SESSION['numerPokojuZajety']);?>
					</div>
                </p>
                <table id="tabela" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Numer Pokoju</th>
					  <th>Cena (zł)</th>
                      <th>Wielkosc</th>
					  <th>Wolny</th>
					   <th>Funkcje</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				   //$sql = 'SELECT * FROM customers ORDER BY id DESC';
				   $user = $_SESSION['user']; //aktualny użytkownik
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = "SELECT * FROM Pokoj ";
                   $pdo->query("SET CHARSET utf8");
				   foreach ($pdo->query($sql) as $row) {
							
                            echo '<tr>';
                            echo '<td>'. $row['numerpokoju'] . '</td>';
                            echo '<td>'. $row['cena'] . '</td>';
                            echo '<td>'. $row['wielkosc'] . '</td>';
							echo '<td>'. $row['dostepny'] . '</td>';
							
							echo '<td width=200>';
                       
                     
                                echo ' ';
                                echo '<a id="anulujRezerwacje" class="btn btn-danger" href="usunPokoj.php?id='.$row['numerpokoju'].'">Usuń pokój</a>';
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