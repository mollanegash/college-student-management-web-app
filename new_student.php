<?php
require_once('database.php');

//fetching list of courses and student inrolled in first course_list
$msg="";
try{
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		$first_name=trim($_POST['first_name']);
		$last_name=trim($_POST['last_name']);
		$email=trim($_POST['email']);
		$password=md5(trim($_POST['email']));
		$user=$db->query("select id from users where email='$email'")->fetch();
		if(!empty($user)){
			$msg= "This email is already registered!";
		}else{
			$q = "insert into users(email,password,first_name,last_name) VALUES (?,?,?,?)";
			$stm=$db->prepare($q)->execute([$email,$password,$first_name,$last_name]);
		}
		if($stm){
			if($_SESSION['user']['role']=="Admin"){
				$msg= "student registeration is successful";
				header("location:index.php"); 
			}
			$msg= "Registeration is successful, <a href='login.php'>click here</a> to login";
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
<header><h1>Register new student</h1></header>
<main>
    <section>
	<?php 
		if(!empty($msg)){
			echo "<div style='color:gray'>$msg</div>";
		}
	?>
	<form method="post" id="login_form">
		<br>
        <label>First Name</label>
        <input type="text" name="first_name" required><br><br>
		<label>Last Name</label>
        <input type="text" name="last_name" required><br><br>
		<label>Email:</label>
        <input type="text" name="email" required><br><br>
		<label>password:</label>
        <input type="password" name="password" required><br><br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Register"><br>

    </form>
  

    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Molla Negash.</p>
</footer>
</body>
</html>
