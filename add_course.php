<?php
    require_once('database.php');

// Get the course form data
if(!empty($_POST['course_code']) && !empty($_POST['course_name'])){
	$course_code=trim($_POST['course_code']);
	$course_name=trim($_POST['course_name']);
	 // Add the course to the database  
	try{
		$q = "insert into courses(course_code,course_name) VALUES (?,?)";
		$stm=$db->prepare($q)->execute([$course_code,$course_name]);
	}
	catch (PDOException $e) {
	 echo 'Error Message: ' .$e->getMessage();
	}
}

   
   
   
    // Display the Course List page
    include('course_list.php');
   // echo 0;
    

?>