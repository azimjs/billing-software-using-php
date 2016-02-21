<?php
error_reporting(0);
		try 
		{
				 // connect to SQLite from PDO database
				 $dbh = new PDO("sqlite:omelec.db");

		}
		catch(PDOException $e)
		{
				 echo $e->getMessage();//this getMessage throws an exception if any 
			  
		}
		
		

		$id=$_GET['id'];
		$sql = $dbh->query("DELETE FROM register WHERE invnum='$id'");		
		header('location:reports.php?action=success');

;?>
