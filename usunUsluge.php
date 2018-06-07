<?php
session_start();
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$pdo->query("SET CHARSET utf8");
        $sql = "DELETE FROM Usluga  WHERE nazwauslugi = ?";
        $q = $pdo->prepare($sql);
		try{
        $q->execute(array($id));
        //Database::disconnect();
        header("Location: PanelUslug");
		}
		
				catch (Exception $e)
				{
					
					
					$_SESSION['uslugaZajeta'] = '<span style="color:red">Nie możesz usunąć zarezerwowanej usługi!</span>';
					
					
				}
				finally
				{
					
					header('Location: PanelUslug.php');
					Database::disconnect();
					
				}
		 
		
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
	
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
</head>
 
<body>


	<div id="naglowekRezerwacji">Usuń Usługe</div>
				<form id="formularzRezerwacji"  action="usunUsluge.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<label id="lebel">Nazwa usługi:</label>
					<input type="text" name="nazwauslugi" readonly value="<?php echo $id;?>"/>

					<button id="zaloguj"  class="btn btn-lg btn-primary btn-block" type="submit">Tak</button>
					<button id="zarejstruj" type="button" class="btn btn-lg btn btn-danger btn-block" onclick="location.href='PanelUslug.php'">Nie</button>
				</form>
  </body>
</html>