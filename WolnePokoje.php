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
            <div class="row">
			<p> <a id="powrot" href="PanelKlienta.php" class="btn "><</a></p>
                <table id="tabela" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Numer Pokoju</th>
					  <th>Cena (zł)</th>
                      <th>Wielkosc</th>
					  <!--<th>Dostępny</th>-->
					  <th>Funkcje</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				   $user = $_SESSION['user']; //aktualny użytkownik
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = "SELECT * FROM Pokoj WHERE dostepny = 'tak' ";
                   $pdo->query("SET CHARSET utf8");
				   foreach ($pdo->query($sql) as $row) 
				   {
                            echo '<tr>';
                            echo '<td>'. $row['numerpokoju'] . '</td>';
                            echo '<td>'. $row['cena'] . '</td>';
                            echo '<td>'. $row['wielkosc'] . '</td>';
							//echo '<td>'. $row['dostepny'] . '</td>';
							echo '<td width=250>';
                                echo '<a id="zarezerwuj" class="btn" href="ZarezerwujPokoj.php?id='.$row['numerpokoju'] .'">Zarezerwuj</a>';
                                echo ' ';              
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