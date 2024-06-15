<?php
require('database.php');

// Get all courses
try{
	
	if(empty($_GET['course_id'])){
		die("Invalid request");
	}
	$course_id=trim($_GET['course_id']);
	$course=$db->query("select * from courses where id=$course_id ")->fetch();
	if(empty($course)){
		die("unable to fetch course detail!");
	}
	$enr=$db->query("select * from enrollments where course_id=$course_id");
	$already_enrolled=[];
	while($e=$enr->fetch()){
		$already_enrolled[]=$e['student_id'];
	}
	if(empty($already_enrolled)){
		 $q="select * from users where role='Student'";
	}
	else{
		$already_enrolled=implode(',',$already_enrolled);
		$q="select * from users where role='Student' and id not in ($already_enrolled)";
	}
	
	$students=$db->query($q)->fetchAll();
	//var_dump($students);die;
	if(empty($students)){
		die("No student found for registration!");
	}
}
catch (PDOException $e) {
	 echo 'Error Message: ' .$e->getMessage();
}

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Course Enrollment</h1></header>
 <h3>Course: <?php echo $course['course_code'].":".$course['course_name']; ?></h3>
    <main>
        <h1>Enroll Student</h1>
        <form action="add_student.php" method="post" id="add_student_form">
			<input type="hidden" name="course_id" value="<?php echo $course_id;?>" >
			<br><strong>Select Student</strong><br>
			<select name="student_id">
			<?php
				foreach($students as $st){
					echo "<option value='".$st['id']."'>".$st['first_name']." ".$st['last_name']."[".$st['email']."]</option>";
				}
			?>
			</select><br><br>
            <input type="submit" value="Enroll Student"><br>
        </form>
        <p><a href="index.php">View Student List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Molla Negash.</p>
    </footer>
</body>
</html>