<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>
<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // Kontrola błędów
        $pokojError = null;
        $cenaError = null;
		$wielkoscError = null;
        $dostepnyError = null;
         
        // Przechwytywanie przesłanych przez formluarz wartości
        $numerpokoju = $_POST['numerpokoju'];
        $cena = $_POST['cena'];
		$wielkosc = $_POST['wielkosc'];
        $dostepny = $_POST['dostepny'];
      
        // Walidacja
        $valid = true;
        if (empty($numerpokoju)) {$pokojError = 'Wpisz numer pokoju';$valid = false;}
        if (empty($cena)) {$cenaError = 'Wpisz cene';$valid = false;}
		if (empty($wielkosc)) {$wielkoscError = 'Wpisz wielkość pokoju';$valid = false;}
        if (empty($dostepny)) {$dostepnyError = "Określ dostępność pokoju ('Tak'/'Nie')";$valid = false;}
		
		 
         
			// insert data
			if ($valid) {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO Pokoj (numerpokoju,cena,wielkosc,dostepny) VALUES(?,?,?,?)";
				$q = $pdo->prepare($sql);
				try{
				$q->execute(array($numerpokoju,$cena,$wielkosc,$dostepny));
				Database::disconnect();
				header("Location: PanelPokoi.php");
				}
				catch (Exception $e)
				{
					
					
					$_SESSION['numerPokojuZajety'] = '<span style="color:red">Numer pokoju zajęty, pokoju nie dodano!</span>';
					
					
				}
				finally
				{
					
					header('Location: PanelPokoi.php');
					Database::disconnect();
					
				}
			}
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
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Kreator dodawania pokoju</h3>
                    </div>
					
                    
					<form class="form-horizontal" action="dodajPokoj.php" method="post">
					
                      <div class="control-group <?php echo !empty($pokojError)?'error':'';?>">
                        <label class="control-label">Numer Pokoju</label>
                        <div class="controls">
                            <input name="numerpokoju" type="text"  placeholder="Numer Pokoju" value="<?php echo !empty($numerpokoju)?$numerpokoju:'1';?>">
                            <?php if (!empty($pokojError)): ?>
                                <span class="help-inline"><?php echo $pokojError;?></span>
                            <?php endif; ?>
						
                        </div>
                      </div>
					  
                      <div class="control-group <?php echo !empty($cenaError)?'error':'';?>">
                        <label class="control-label">Cena</label>
                        <div class="controls">
                            <input name="cena" type="text" placeholder="Cena" value="<?php echo !empty($cena)?$cena:'150';?>">
                            <?php if (!empty($cenaError)): ?>
                                <span class="help-inline"><?php echo $cenaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
					  <div class="control-group <?php echo !empty($wielkoscError)?'error':'';?>">
                        <label class="control-label">Wielkosc</label>
                        <div class="controls">
                            <input name="wielkosc" type="text" placeholder="Wielkosc" value="<?php echo !empty($wielkosc)?$wielkosc:'2-osobowy';?>">
                            <?php if (!empty($wielkoscError)): ?>
                                <span class="help-inline"><?php echo $wielkoscError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
					  <div class="control-group <?php echo !empty($dostepnyError)?'error':'';?>">
                        
                        <div class="controls">
                            <input name="dostepny" type="hidden" placeholder="Dostepny" value="<?php echo !empty($dostepny)?$dostepny:'tak';?>">
                            <?php if (!empty($dostepnyError)): ?>
                                <span class="help-inline"><?php echo $dostepnyError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Utwórz</button>
                          <a class="btn" href="PanelPracownika.php">Cofnij</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>