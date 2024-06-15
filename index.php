<?php
require_once('database.php');

if(!isset($user)){
	header("location:login.php"); 
}else{
	if($user['role']=="Student"){
		header("location:student_home.php"); 
	}
}

//fetching list of courses and student inrolled in first course_list

try{

	$q1="select * from courses order by course_code asc";
	$courses=$db->query($q1)->fetchAll();
	if(!empty($_GET['course_id'])){
		$selected_course=trim($_GET['course_id']);
	}else{
		$selected_course=$courses[0]['id'];
	}
	$q2="select * from enrollments enr left join users u on u.id=enr.student_id  where course_id=$selected_course";
	$students=$db->query($q2);
	$course=$db->query("select * from courses where id='$selected_course'")->fetch();
	
	//var_dump($students->fetch());die;
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
    <center><h1>Student List</h1></center>

    <aside>
        <!-- display a list of categories -->
        <h2>Courses</h2>
        <nav>
        <ul>
            <?php 

				foreach($courses as $c){
					echo "<li><a href='?course_id=".$c['id']."'>".$c['course_code']."</a></li>";
				}
			?>
        </ul>
        </nav>          
    </aside>

    <section>
	 <h2><?php echo $course['course_code'].'-'.$course['course_name'];?></h2>
        <!-- display a table of Students -->
        
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>&nbsp;</th>
            </tr>
			<?php 
			while($st=$students->fetch()){	
					echo "<tr>";
					echo "<td>".$st['first_name']."</td>";
					echo "<td>".$st['last_name']."</td>";
					echo "<td>".$st['email']."</td>";
					echo "<td><form method='post' action='delete_student.php'><input type='hidden' name='student_id' value='".$st['student_id']."'><input type='hidden' name='course_id' value='".$course['id']."'><input type='submit' value='delete'></form></td>";
					echo "</tr>";
			}
			?>
            
        </table>

        <p><a href="add_student_form.php?course_id=<?php echo $course['id'];?>">Add student to <?php echo $course['course_code'];?></a></p>
		
		 <p><a href="new_student.php">Register new student</a></p>

        <p><a href="course_list.php">List Courses</a></p>    

    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Molla Negash.</p>
</footer>
</body>
</html>
