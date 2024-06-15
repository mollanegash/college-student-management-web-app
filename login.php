<?php
require_once('database.php');

//fetching list of courses and student inrolled in first course_list
$msg="";
if(isset($user)){
	if($user['role']=='Admin'){
		header("location:index.php"); 
	}else{
		header("location:student_home.php"); 
	}
}
try{
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		$email=trim($_POST['email']);
		$password=md5(trim($_POST['email']));
		$q="select id,email,first_name,last_name,role,registration_date from users where email='$email' and password='$password'";
		$user=$db->query($q)->fetch();
		if(!empty($user)){
			$_SESSION['user']=$user;
			if($user['role']=='Admin'){
				header("location:index.php"); 
			}else{
				header("location:student_home.php"); 
			}
		}else{
			$msg="Check your credentials and try again!";
		}
	} 
}catch (PDOException $e) {
	 echo 'Error Message: ' .$e->getMessage();
}



?>

<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Login</h1></header>
<main>
    <section>
	<?php 
		if(!empty($msg)){
			echo "<div style='color:red'>$msg</div>";
		}
	?>
	<form method="post" id="login_form">
		<br>
        <label>Email:</label>
        <input type="text" name="email" requried><br><br>
        <label>password:</label>
        <input type="password" name="password" requried><br><br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Login"><br>

    </form>
  

    </section>
</main>
<p>
<strong><a href="signup.php">Signup</a></strong>
</p>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Molla Deribie Negash.</p>
</footer>
</body>
</html>
