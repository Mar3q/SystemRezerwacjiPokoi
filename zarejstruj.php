<?php //error_reporting(0); ?>   
<?php
session_start();
require 'database.php';

    if ( ($_POST['nickRejstracja']!=null) AND ($_POST['hasloRejstracja']!=null)) 
	{
      
			//łapanie wartość przesłanych przez formularz
			$nickRejstracja = $_POST['nickRejstracja'];
			$hasloRejstracja = $_POST['hasloRejstracja'];
			$imieRejstracja = $_POST['imieRejstracja'];
			$nazwiskoRejstracja = $_POST['nazwiskoRejstracja'];
			$telefonRejstracja = $_POST['telefonRejstracja'];
			$peselRejstracja = $_POST['peselRejstracja'];
			$valid = true;
         
		 
         
			// Wprowadzanie danych
			if ($valid) 
			{
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO Uzytkownik (email,haslo,imie,nazwisko,telefon) VALUES(?,?,?,?,?)";
				$q = $pdo->prepare($sql);
				try
				{
					$q->execute(array($nickRejstracja,$hasloRejstracja,$imieRejstracja,$nazwiskoRejstracja,$telefonRejstracja));
					$_SESSION['udanaRejstracja'] = '<span style="color:green">Utworzono konto o nicku: '.$nickRejstracja.'</span>';
					unset($_SESSION['bladRejstracji']);
				}
				catch (Exception $e)
				{
					$_SESSION['bladRejstracji'] = '<span style="color:red">Nick jest zajęty!</span>';
					unset($_SESSION['udanaRejstracja']);
				}
				finally
				{
					echo "First finally.\n";
					header('Location: rejstracja.php');
					Database::disconnect();
					
				}
			}	
    }
	else
	{
		
		$_SESSION['bladRejstracji'] = '<span style="color:red">Podaj nick i hasło!</span>';
		unset($_SESSION['udanaRejstracja']);
	}
?>