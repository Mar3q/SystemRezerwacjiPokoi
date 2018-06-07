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
        $uslugaError = null;
        $cenaError = null;
        $dostepnyError = null;
         
        // Przechwytywanie przesłanych przez formluarz wartości
        $nazwauslugi = $_POST['nazwauslugi'];
        $cena = $_POST['cena'];
        $dostepny = $_POST['dostepny'];
      
        // Walidacja
        $valid = true;
        if (empty($nazwauslugi)) {$uslugaError = 'Wpisz nazwe uslugi';$valid = false;}
        if (empty($cena)) {$cenaError = 'Wpisz cene';$valid = false;}
        if (empty($dostepny)) {$dostepnyError = "Określ dostępność pokoju ('Tak'/'Nie')";$valid = false;}
		
		 
         
			// insert data
			if ($valid) {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO Usluga (nazwauslugi,cena,dostepny) VALUES(?,?,?)";
				$q = $pdo->prepare($sql);
				
				try{
				$q->execute(array($nazwauslugi,$cena,$dostepny));
				//Database::disconnect();
				header("Location: PanelUslug.php");
				}
				catch (Exception $e)
				{
					
					
					$_SESSION['nazwaUslugiZajeta'] = '<span style="color:red">Nazwa usługi zajęta, usługi nie dodano!</span>';
					
					
				}
				finally
				{
					
					header('Location: PanelUslug.php');
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
                        <h3>Kreator dodawania usługi</h3>
                    </div>
             
                    <form class="form-horizontal" action="dodajUsluge.php" method="post">
					
                      <div class="control-group <?php echo !empty($uslugaError)?'error':'';?>">
                        <label class="control-label">Nazwa usługi</label>
                        <div class="controls">
                            <input name="nazwauslugi" type="text"  placeholder="Nazwa usługi" value="<?php echo  !empty($nazwauslugi)?$nazwauslugi:'spa';?>">
                            <?php if (!empty($uslugaError)): ?>
                                <span class="help-inline"><?php echo $uslugaError;?></span>
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
                          <a class="btn" href="PanelUslug.php">Cofnij</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>