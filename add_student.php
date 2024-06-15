<?php
    
	require_once('database.php');


	// if(isset($user)){
	// // 	if($user['role']=='Admin'){
	// // 		header("location:index.php"); 
	// // 	}else{
	// // 		header("location:student_home.php"); 
	// // 	}
	// // }

	// }
if(isset($_POST['course_id'])){


if(!empty($_POST) ){
// Get the student form data
	$course_id = trim($_POST['course_id']);//remove unwanted spance and put data
	$student_id = trim($_POST['student_id']);
}
}
// Add the student to the database  
	try{
		$exist=$db->query("select id from enrollments where course_id=$course_id and student_id=$student_id")->fetch();
		if(empty($exist)){
			$q = "insert into enrollments(student_id,course_id) VALUES (?,?)";
			$stm=$db->prepare($q)->execute([$student_id,$course_id]);
			if(!empty($stm)){
				$msg= "Student enrollment done!";
			}else{
				$msg= "Something went wrong while student enrollment";
				//die($q);
			}
		}else{
				$msg= "Student already enrolled!";
		}
		
	}
	catch (PDOException $e) {
	 echo 'Error Message: ' .$e->getMessage();
	}


	if(isset($_SESSION['user'])){
		
if($user['role']=="Student"){
	header("location:student_home.php"); 
}else{
	    // Display the Student List page
	include('index.php');
}
	}	
	echo 'succussfull!';
?>