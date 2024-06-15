<?php
require_once('database.php');

// Delete the student from the database
if(!empty($_POST['student_id'] && !empty($_POST['course_id']))){
	try{
		$student_id=trim($_POST['student_id']);
		$course_id=trim($_POST['course_id']);
		$q = "delete from enrollments where student_id=? and course_id=?";
		$stm=$db->prepare($q)->execute([$student_id,$course_id]);
		if(!empty($stm)){
			$msg= "Student enrollment revoked!";
		}else{
			$msg= "Something went wrong !";
			die($q);
		}
	}
	catch (PDOException $e) {
	 echo 'Error Message: ' .$e->getMessage();
	}
}

// Display the Home page
include('index.php');