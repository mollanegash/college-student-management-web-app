<?php
require_once('database.php');
if(!empty($_GET['format']) && !empty($_GET['action'])){
try{
	//get format info
	$format=trim($_GET['format']); 
	//get action info
	$action=trim($_GET['action']);
	//get course id if any
	$course=empty($_GET['course'])?"":$_GET['course'];
	
	if($action=="courses"){
		$q="select * from courses ";
		if(!empty($course)){
			$q.=" where code_code='$course'";
		}else{
			$q.=" order by course_code asc" ;
		}
	}else{
		$q="select id, first_name,last_name,email,registration_date,role from users";
		if(!empty($course)){
			$c=$db->query("select id from courses where course_code='$course'")->fetch();
			if(!empty($c)){
				$cid=$c['id'];
				$q="select s.id,s.first_name,s.last_name,s.email,s.registration_date,s.role from enrollments enr left join users s on s.id=enr.student_id where course_id=$cid";
			}
			
		}
	}
	
	$data=$db->query($q)->fetchAll(PDO::FETCH_ASSOC);
	
	//echo "<pre>";var_dump($data);die;
	if($format=="xml"){
		$xml_doc=new DOMDocument();
		$root=$xml_doc->createElement($action);
		foreach($data as $d){
			if($action=="courses"){
				$course=$xml_doc->createElement('course');
				$course->appendChild($xml_doc->createElement('id',$d['id']));
				$course->appendChild($xml_doc->createElement('course_code',$d['course_code']));
				$course->appendChild($xml_doc->createElement('course_name',$d['course_name']));
				$root->appendChild($course);
			}
			else{
				$course=$xml_doc->createElement('student');
				$course->appendChild($xml_doc->createElement('id',$d['id']));
				$course->appendChild($xml_doc->createElement('first_name',$d['first_name']));
				$course->appendChild($xml_doc->createElement('last_name',$d['last_name']));
				$course->appendChild($xml_doc->createElement('email',$d['email']));
				$course->appendChild($xml_doc->createElement('role',$d['role']));
				$course->appendChild($xml_doc->createElement('registration_date',$d['registration_date']));
				$root->appendChild($course);
			}
			
		}
		$xml_doc->appendChild($root);
		header('Content-Type: application/xml;charset=UTF-8;');
		echo $xml_doc->saveXML();
	}
	else{	
		header('Content-Type: application/json; charset=UTF-8;');
		echo json_encode($data,JSON_PRETTY_PRINT);
	}
} 
catch (PDOException $e) {
	 echo 'Error Message: ' .$e->getMessage();
}
}else{
	echo "Invalid Request!";
}
?>