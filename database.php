<?php
   // $dsn = 'mysql:host=localhost;dbname=cs602db';
   // $username = 'cs602_user';
   // $password = 'cs602_secret';
   
    $dsn = 'mysql:host=localhost;dbname=cs602db';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
		 session_start();  
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
	
	if(isset($_SESSION['user'])){        
		$user=$_SESSION['user'];
	}


