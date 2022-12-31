<?php
	$conn = mysqli_connect('sql212.epizy.com','epiz_33286352','Firetali246!','epiz_33286352_fall2022');

	if(!$conn){
		echo 'Connection error: ' . mysql_connect_error();
	}

	try{
		$dsn = "mysql:host=localhost;dbname=fall2022";
		$conn = new PDO($dsn,'Tali','test1234');
	}catch(Exception $e){
		echo 'Error connecting to server';
	}

	
  

?>