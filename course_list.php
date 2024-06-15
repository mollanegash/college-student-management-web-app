<?php
require_once('database.php');

// Get all courses
try{
	$courses=$db->query("select * from courses order by course_code asc")->fetchAll();
	//var_dump($courses);die;
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
<main>
    <h1>Course List</h1>
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
    <p>
    <h2>Add Course</h2>
    
    <form action="add_course.php" method="post"
              id="add_course_form">

        <label>Course Id:</label>
        <input type="text" name="course_code"><br>
        <label>Course Name:</label>
        <input type="text" name="course_name" width="200"><br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Add Course"><br>

    </form>


    <br>
    <p><a href="index.php">List Students</a></p>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Molla Negash.</p>
    </footer>
</body>
</html>