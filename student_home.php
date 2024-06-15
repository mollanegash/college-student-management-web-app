<?php
require_once('database.php');

if(empty($user)){
	echo "<h2>Unauthorised Access</h2>";
	echo "Please click <a href='login.php' >here to login</a> to access this page";
}
$student_id=$user['id'];
// Get all courses
try{
	$courses=$db->query("select * from courses order by course_code asc")->fetchAll();
	$q="select * from enrollments enr left join courses c on c.id=enr.course_id where student_id=$student_id";
	$enr_courses=$db->query($q)->fetchAll();
	//var_dump($enr_courses);die;
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
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Course Manager</h1></header>
<p><a style="color:red" href="logout.php">Logout</a></p>
<main>
<?php 
		if(!empty($msg)){
			echo "<div style='color:red'><strong>$msg</strong></div>";
		}
	?>
    <h1>Full Course List</h1>
    <table>
        <tr>
            <th>ID</th><th>Name</th>
			<?php 
				foreach($courses as $c){
					echo "<tr>";
					echo "<td>".$c['course_code']."</td>";
					echo "<td>".$c['course_name']."</td>";
					echo "</tr>";
				}
			?>
        </tr>
        
        <!-- add code for the rest of the table here -->
    </table>
	<h1>Registered Courses</h1>
    <table>
        <tr>
            <th>ID</th><th>Name</th>
			<?php 
				$already_enrolled=[];
				foreach($enr_courses as $c){
					$already_enrolled[]=$c['id'];
					echo "<tr>";
					echo "<td>".$c['course_code']."</td>";
					echo "<td>".$c['course_name']."</td>";
					echo "</tr>";
				}
				if(empty($already_enrolled)){
					 $new_courses=$courses;
				}
				else{
					$already_enrolled=implode(',',$already_enrolled);
					$q="select * from courses where id not in ($already_enrolled)";
					$new_courses=$db->query($q)->fetchAll();
				}
				
				
			?>
        </tr>
        
        <!-- add code for the rest of the table here -->
    </table>
    <p>
    <h2>Register for new course</h2>
    <form action="add_student.php" method="post" id="add_course_form">

        <input type="hidden" name="student_id" value="<?php echo $student_id?>"><br>
        <strong>Select Course</strong><br><br>
			<select name="course_id">
			<?php
				foreach($new_courses as $st){
					echo "<option value='".$st['id']."'>".$st['course_code'].": ".$st['course_name']."</option>";
				}
			?>
			</select><br><br>
        <label>&nbsp;</label>
        <input type="submit" value="Register"><br>
		
    </form>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Molla Negash.</p>
    </footer>
</body>
</html>